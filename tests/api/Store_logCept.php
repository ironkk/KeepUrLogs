<?php
$I = new ApiTester($scenario);
$I->wantTo('Store log via API and see it in database');
$body = [
    'action'    => 'hello store zxc',
    'date'      => new DateTime('now'),
    'level'     => 1,
    'have_diff' => false,
];
$I->sendPOST('logs/store?api_token=M2mxGXvj7t21OXd4x', $body);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeInDatabase('logs', ['message' => 'hello store zxc', 'level' => 1, 'have_diff' => 0]);
$I->seeResponseContainsJson([
    'success' => true,
    'message' => 'Log successfully saved',
]);