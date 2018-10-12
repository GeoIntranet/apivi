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
$cartmodel['id'] = $_POST['id'];
$cartModelJson = json_encode($cartmodel);


//DELETE CART specific --> cartID xx || all !! attention erreur si cartId ou collection indéfinie
$currentCart = $client->request('delete', 'https://services.scansource.com/apisandbox/cart/euroweb', [
    'headers' => [
        'Ocp-Apim-Subscription-Key'      => $key
    ],
    'query' =>[
            'cartId' => $cartmodel['id']
    ]
])->getBody()->getContents();

$datareturn  = [
    'id' => $cartmodel['id'],
];

echo json_encode($datareturn);






