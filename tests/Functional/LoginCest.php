<?php


namespace Tests\Functional;

use Tests\Support\FunctionalTester;

class LoginCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
    }

    /**
     * @param FunctionalTester $I
     * @return void
     */
    public function testLoginFrontendToProfile(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->click('login');
        $I->fillField('username', 'wkeeling@shanahan.net');
        $I->fillField('password', 'secret');
        $I->click('login');
        $I->seeInCurrentUrl('/profile');
        $I->see('wkeeling@shanahan.net','.panel-heading');
    }
}
