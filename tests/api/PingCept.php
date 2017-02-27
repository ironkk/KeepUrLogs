<?php 
$I = new ApiTester($scenario);
$I->wantTo('send ping and get pong');
$I->sendPOST('logs/ping?api_token=M2mxGXvj7t21OXd4x');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContainsJson([
    'success' => true,
    'message' => 'pong',
]);
