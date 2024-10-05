<?php


namespace Functional;

use \FunctionalTester;

class SubmitQuizCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function tryToSubmitAnswers(FunctionalTester  $I)
    {
        $answers = [
            5 => [17],
            6 => [24]
        ];

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('/api/quiz/submit', json_encode(['answers' => $answers]));

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $I->seeResponseMatchesJsonType([
            'correctAnswers' => 'array',
            'incorrectAnswers' => 'array',
        ]);
    }

    public function tryToSubmitInvalidAnswers(FunctionalTester  $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('/api/quiz/submit', json_encode(['answers' => null]));

        $I->seeResponseCodeIs(400);
    }
}