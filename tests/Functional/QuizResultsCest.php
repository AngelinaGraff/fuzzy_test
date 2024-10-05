<?php

namespace Functional;

use \FunctionalTester;

class QuizResultsCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function tryToGetQuizResults(FunctionalTester $I)
    {
        $correctAnswers = [5, 6];
        $incorrectAnswers = [7, 8, 9];

        $I->sendGET('/api/quiz/results', [
            'correct' => implode(',', $correctAnswers),
            'incorrect' => implode(',', $incorrectAnswers)
        ]);

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson([
            'correctQuestions' => [
                ['id' => 5],
                ['id' => 6]
            ],
            'incorrectQuestions' => [
                ['id' => 7]
            ]
        ]);

        $I->seeResponseMatchesJsonType([
            'correctQuestions' => [
                ['id' => 'integer', 'answers' => 'array']
            ],
            'incorrectQuestions' => [
                ['id' => 'integer', 'answers' => 'array']
            ]
        ]);

        $response = json_decode($I->grabResponse(), true);
        $I->assertNotEmpty($response['correctQuestions'][0]['answers']);
        $I->assertNotEmpty($response['incorrectQuestions'][0]['answers']);
    }
}
