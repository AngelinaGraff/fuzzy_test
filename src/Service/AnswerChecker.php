<?php

namespace App\Service;

use App\Entity\Question;

class AnswerChecker
{
    public function getCorrectAnswerIds(Question $question): array
    {
        $correctAnswerIds = [];
        foreach ($question->getAnswers() as $answer) {
            if ($answer->isCorrect()) {
                $correctAnswerIds[] = $answer->getId();
            }
        }
        return $correctAnswerIds;
    }

    public function areAnswersCorrect(array $correctAnswerIds, array $submittedAnswerIds): bool
    {
        if (empty($submittedAnswerIds)) {
            return false;
        }
        
        sort($correctAnswerIds);
        sort($submittedAnswerIds);

        return !array_diff($submittedAnswerIds, $correctAnswerIds);
    }
    
    public function getAllValidCombinations(array $correctAnswerIds): array
    {
        $combinations = [];
        $count = count($correctAnswerIds);
        $totalCombinations = 1 << $count;

        for ($i = 1; $i < $totalCombinations; $i++) {
            $subset = [];
            for ($j = 0; $j < $count; $j++) {
                if ($i & (1 << $j)) {
                    $subset[] = $correctAnswerIds[$j];
                }
            }
            $combinations[] = $subset;
        }

        return $combinations;
    }
}
