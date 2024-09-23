<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class FirstCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
    }

    public function frontpageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Login');
    }

    /**
     * @param AcceptanceTester $I
     * @return void
     */
    public function canLoginOnFrontend(AcceptanceTester $I)
    {
//        $I->amOnPage('/');
//        // we are using label to match user_name field
//        $I->fillField('username', 'wkeeling@shanahan.net');
//        $I->fillField('password', 'secret');
//        $I->click('login');

//        $I->wait(1); // wait for 3 secs
//        $I->seeInCurrentUrl('/profile');
//        $I->see('weeling@shanahan.net', '.panel-heading');
    }

    /**
     * @param AcceptanceTester $I
     * @return void
     */
//    public function canLoginOnBackend(AcceptanceTester $I)
//    {
//        $I->amOnPage('/admin');
//        // we are using label to match user_name field
//        $I->fillField('username', 'admin');
//        $I->fillField('password', 'secret');
//        $I->click('login');
//
//        $I->wait(1); // wait for 3 secs
//        $I->seeInCurrentUrl('/admin/dashboard');
//        $I->see('weeling@shanahan.net');
//    }
}

