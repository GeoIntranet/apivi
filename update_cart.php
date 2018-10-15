<?php
//https://services.scansource.com/apisandbox/swagger/ui/index#/
//API Key
//Customer # 1000000854
//Headers ---> 'Authorization' => "Basic {$credentials},Bearer {$acceso->access_token}"
use Carbon\Carbon;
require __DIR__ . '/vendor/autoload.php';

$key = 'DpHO1fNQO8XUpFyk2CwgMkIGt2iK5g0w';
$client = new \GuzzleHttp\Client();
$cartModel = [];
$cartmodel['Name'] = $_POST['name'];
$cartmodel['Description'] = $_POST['desc'];
$cartmodel['Id'] = $_POST['id'];
$cartModelJson = json_encode($cartmodel);

/**
 * Update Specificité d'un cart
 */
$updateCart = $client->request('put', 'https://services.scansource.com/apisandbox/cart/euroweb', [
    'headers' => [
        'Ocp-Apim-Subscription-Key' => $key
    ],
    'query' =>[
        'cartCollectionKey' => 'euroweb',

    ],
    'form_params' => [
        'Id' => $cartmodel['Id'],
        'Name' => $cartmodel['Name'],
        'Description' => $cartmodel['Description'],
    ]
]);

$datareturn  = [
    'id' => $cart,
    'name' => $cartmodel['Name'],
    'description' => $cartmodel['Description'],
];

echo json_encode($datareturn);






