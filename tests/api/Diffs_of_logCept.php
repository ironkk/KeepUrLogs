<?php 
$I = new ApiTester($scenario);
$I->wantTo('Get the diffs of specific log');
$body = [
    'log_id' => 100
];
$I->sendPOST('logs/diffs?api_token=M2mxGXvj7t21OXd4x', $body);
$I->seeResponseCodeIs(200);
$I->canSeeHttpHeader('Content-Type', 'application/json');
$I->seeResponseIsJson();
$response = [
    'success' => true,
    'diffs' => [
        'field'     => "stock",
        'old_value' => 1,
        'new_value' => 2,
    ]
];
$I->seeResponseContainsJson($response);
