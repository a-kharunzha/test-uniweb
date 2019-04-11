<?php declare(strict_types=1);

require_once realpath(__DIR__.'/../vendor/autoload.php');

$dsn = sprintf('mysql:host=%s;dbname=%s',getenv('DATABASE_HOST'),getenv('DATABASE_NAME'));
$db = new PDO('mysql:host=db;dbname=test-uniweb', getenv('DATABASE_USER'), getenv('DATABASE_PASS'));

//
//var_dump($_GET);

//
$query = $db->prepare('SELECT `ident`,`value`,`version` FROM `data`');
$query->execute();
$existing = [];
// все что есть в таблице в БД с ключем по айди
while($dbRow = $query->fetch(PDO::FETCH_ASSOC)){
    $existing[$dbRow['ident']] = $dbRow;
}

$output = [
    'delete'=>[],
    'update'=>[],
    'new'=>[]
];
foreach($_GET['ident'] as $index => $rowIdent){
    $rowVersion = $_GET['version'][$index];
    $rowValue = $_GET['value'][$index];
    // 1. delete - список идентификаторов, которые пришли в запросе и отсутствуют в БД
    if(!isset($existing[$rowIdent])){
        $output['delete'][] = $rowIdent;
        continue;
    }
    $existingRow = $existing[$rowIdent];
    unset($existing[$rowIdent]);
    //
    //2. update - список значений и версий по идентификаторам, где версия в БД стала больше чем версия пришедшая в запросе
    if($existingRow['version'] > $rowVersion){
        $output['update'][$rowIdent] = [
            'value'=>$existingRow['value'],
            'version'=>$existingRow['version'],
        ];
        continue;
    }
}

// 3. new - список значений и версий по идентификаторам, которые отсутствуют в пришедшем запросе, но есть в БД
// к этому моменту в $existing остались только такие, каких не было в запросе
foreach($existing as $existingRow){
    $output['new'][$existingRow['ident']] = [
        'value'=>$existingRow['value'],
        'version'=>$existingRow['version'],
    ];

}

//var_dump($output);
// сериализованный так сериализованный
echo serialize($output);