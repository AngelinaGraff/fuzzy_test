<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\UserResult;
use App\Repository\QuestionRepository;
use App\Service\AnswerChecker;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class QuizController extends AbstractController
{
    private $answerChecker;

    public function __construct(AnswerChecker $answerChecker)
    {
        $this->answerChecker = $answerChecker;
    }

    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return $this->redirectToRoute('app_quiz');
    }

    #[Route('/quiz', name: 'app_quiz')]
    public function index(): Response
    {
        return $this->render('quiz/index.html.twig');
    }

    #[Route('/api/quiz', name: 'quiz_api', methods: ['GET'])]
    public function getQuestions(QuestionRepository $questionRepository, CacheInterface $cache): JsonResponse
    {
        try {
            $questions = $cache->get('quiz_questions', function (ItemInterface $item) use ($questionRepository) {
                $item->expiresAfter(3600);
                return $questionRepository->findQuestionsWithAnswers();
            });
        
            if (empty($questions)) {
                return $this->json(['error' => 'Вопросы не найдены'], Response::HTTP_BAD_REQUEST);
            }
        
            $data = [];
        
            shuffle($questions);
        
            foreach ($questions as $question) {
                $answers = [];
                foreach ($question->getAnswers() as $answer) {
                    $answers[] = [
                        'id' => $answer->getId(),
                        'answerText' => $answer->getAnswerText(),
                    ];
                }
            
                shuffle($answers);
            
                $data[] = [
                    'id' => $question->getId(),
                    'questionText' => $question->getQuestionText(),
                    'answers' => $answers,
                ];
            }
        
            return $this->json($data);
        } catch (\Exception $e) {
            return $this->json(['error' => 'Ошибка при получении вопросов.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    #[Route('/api/quiz/submit', name: 'quiz_submit', methods: ['POST'])]
    public function submitQuiz(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator): JsonResponse
    {
        try {
            $submittedContent = json_decode($request->getContent(), true);

            if (!isset($submittedContent['answers']) || !is_array($submittedContent['answers'])) {
                return $this->json(['error' => 'Некорректные данные'], Response::HTTP_BAD_REQUEST);
            }

            $submittedAnswers = $submittedContent['answers'];
            $questionIds = array_keys($submittedAnswers);

            if (empty($submittedAnswers)) {
                return $this->json(['error' => 'Некорректные данные'], Response::HTTP_BAD_REQUEST);
            }

            $questions = $entityManager->getRepository(Question::class)->findBy(['id' => $questionIds]);

            $correctAnswers = [];
            $incorrectAnswers = [];

            foreach ($questions as $question) {
                $submittedAnswerIds = array_map('intval', $submittedAnswers[$question->getId()] ?? []);
                $correctAnswerIds = $this->answerChecker->getCorrectAnswerIds($question);

                if ($this->answerChecker->areAnswersCorrect($correctAnswerIds, $submittedAnswerIds)) {
                    $correctAnswers[] = $question->getId();
                } else {
                    $incorrectAnswers[] = $question->getId();
                }
            }

            $userResult = new UserResult();
            $userResult->setCorrectAnswers($correctAnswers);
            $userResult->setIncorrectAnswers($incorrectAnswers);
            $entityManager->persist($userResult);
            $entityManager->flush();

            return $this->json([
                'correctAnswers' => $correctAnswers,
                'incorrectAnswers' => $incorrectAnswers,
            ]);
        } catch (\Exception $e) {
            return $this->json(['error' => 'Произошла ошибка при обработке вашего запроса.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    #[Route('/api/quiz/results', name: 'quiz_results', methods: ['GET'])]
    public function getResults(Request $request, QuestionRepository $questionRepository): JsonResponse
    {
        $correctIds = $request->query->get('correct', '') ? explode(',', $request->query->get('correct')) : [];
        $incorrectIds = $request->query->get('incorrect', '') ? explode(',', $request->query->get('incorrect', '')) : [];

        if (!is_array($correctIds) || !is_array($incorrectIds)) {
            return $this->json(['error' => 'Некорректные параметры запроса'], Response::HTTP_BAD_REQUEST);
        }
    
        $correctQuestions = $questionRepository->findBy(['id' => $correctIds]);
        $incorrectQuestions = $questionRepository->findBy(['id' => $incorrectIds]);

        if (empty($correctQuestions) && empty($incorrectQuestions)) {
            return $this->json(['error' => 'Вопросы не найдены'], Response::HTTP_BAD_REQUEST);
        }

        $formatQuestions = function($questions) {
            return array_map(function($question) {
                return [
                    'id' => $question->getId(),
                    'questionText' => $question->getQuestionText(),
                    'answers' => array_map(function($answer) {
                        return [
                            'id' => $answer->getId(),
                            'answerText' => $answer->getAnswerText()
                        ];
                    }, $question->getAnswers()->toArray())
                ];
            }, $questions);
        };

        return $this->json([
            'correctQuestions' => $formatQuestions($correctQuestions),
            'incorrectQuestions' => $formatQuestions($incorrectQuestions)
        ]);
    }
}