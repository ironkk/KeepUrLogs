<?php 
$I = new ApiTester($scenario);
$I->wantTo('get the 100 recent logs');
$I->sendPOST('logs/recents?api_token=M2mxGXvj7t21OXd4x');
$I->seeResponseCodeIs(200);
$I->canSeeHttpHeader('Content-Type', 'application/json');
$I->seeResponseIsJson();
$I->seeResponseContainsJson([
    'id'        => 93,
    'message'   => 'Vel velit eos officia voluptates dicta et dolorum labore.',
    'date'      => '2015-05-18 02:04:29',
    'level'     => 2,
    'stream_id' => 1,
    'raw_input' => '',
    'have_diff' => 0,
]);
