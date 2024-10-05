<?php


namespace Functional;

use \FunctionalTester;

class QuizCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function tryToGetRandomQuestions(FunctionalTester $I)
    {
        $I->sendGET('/api/quiz');

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $I->seeResponseMatchesJsonType([
            'id' => 'integer',
            'questionText' => 'string',
            'answers' => 'array',
        ]);
    }
}