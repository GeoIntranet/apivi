<?php

require('connection.php');
use Carbon\Carbon as Carbon;
require __DIR__ . '/vendor/autoload.php';
$database = new database();

$database_ = $database->connect();

$res = $database
    ->select('activities')
    ->get();
//var_dump($res);

$itemToUpdate = $res[0]->id;
var_dump($itemToUpdate);
$data = [
    'id'=>$itemToUpdate,
    'type'=> 'test_blabla_bla'
];
//$updated = $database->update('activities',$data);

$data = [
    ':user_id'=> 1,
    ':subject_id' => 15,
    ':subject_type'=>'insert_CLASS',
    ':type'=>'insert_type_test',
    ':created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
    ':updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
];
//$inserted = $database->insert('activities',$data);




$id=[':id'=>$itemToUpdate];
$deleted = $database->delete('activities',$id);

$res = $database
    ->select('activities')
    ->get();


//$sql = 'SELECT * FROM it_it';
//$sth = $database->database->prepare($sql);
//$sth->execute();
//$red = $sth->fetchAll(2);

//var_dump($red);