<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('Check login page');



$I->seeInDatabase('users', array('email' => 'foo@bar.com'));
