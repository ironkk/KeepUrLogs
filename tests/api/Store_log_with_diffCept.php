<?php 
$I = new ApiTester($scenario);
$I->wantTo('Store log via API with diff and see it in database');
$body = [
    'action'    => 'logs with diffs',
    'date'      => new DateTime('now'),
    'level'     => 1,
    'have_diff' => true,
    'diffs' => [
         [
          'field' => 'name',
          'old_value' => 'jhon doe',
          'new_value' => 'jon snow'
        ],
        [
            'field' => 'price',
            'old_value' => '0',
            'new_value' => '120'
        ],
    ]
];
$I->sendPOST('logs/store?api_token=M2mxGXvj7t21OXd4x', $body);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeInDatabase('logs', ['message' => 'logs with diffs', 'level' => 1, 'have_diff' => 1]);
$I->seeInDatabase('diffs', ['field' => 'name', 'old_value' => 'jhon doe', 'new_value' => "jon snow"]);
$I->seeInDatabase('diffs', ['field' => 'price', 'old_value' => '0', 'new_value' => "120"]);
$I->seeResponseContainsJson([
    'success' => true,
    'message' => 'Log successfully saved with diffs',
]);
