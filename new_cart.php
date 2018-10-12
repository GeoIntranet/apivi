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
$cartmodel['Description'] = $_POST['description'];
$cartModelJson = json_encode($cartmodel);

/**
 * AJOUT CART a UNE SESSIOn ex session : euroweb -> cart1 __ cart2 __ cart3 __ etc...
 */
$cart = $client->request('post', 'https://services.scansource.com/apisandbox/cart/euroweb', [
    'headers' => [
        'Ocp-Apim-Subscription-Key' => $key
    ],
    'query' =>[
        'currentCart' => 'true',
    ],
    'form_params' => [
        'Name' => $cartmodel['Name'],
        'Description' => $cartmodel['Description'],
    ]
])->getBody()->getContents();

$datareturn  = [
    'id' => $cart,
    'name' => $cartmodel['Name'],
    'description' => $cartmodel['Description'],
];

echo json_encode($datareturn);






