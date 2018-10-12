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
$cartmodel['Name'] = 'carteuroweb';
$cartmodel['Description'] = 'session cart euroweb';
$cartModelJson = json_encode($cartmodel);

/**
 * AJOUT CART a UNE SESSIOn ex session : euroweb -> cart1 __ cart2 __ cart3 __ etc...
 */
//$cart = $client->request('post', 'https://services.scansource.com/apisandbox/cart/euroweb', [
//    'headers' => [
//        'Ocp-Apim-Subscription-Key' => $key
//    ],
//    'query' =>[
//        'currentCart' => 'true',
//    ],
//    'form_params' => [
//        'Name' => 'euro_web_1',
//        'Description' => 'session cart euroweb',
//    ]
//]);

//$cart = $client->request('post', 'https://services.scansource.com/apisandbox/cart/euroweb', [
//    'headers' => [
//        'Ocp-Apim-Subscription-Key' => $key
//    ],
//    'query' =>[
//        'currentCart' => 'true',
//    ],
//    'form_params' => [
//        'Name' => 'euro_web_2',
//        'Description' => 'session cart euroweb',
//    ]
//]);
//
//$cart = $client->request('post', 'https://services.scansource.com/apisandbox/cart/euroweb', [
//    'headers' => [
//        'Ocp-Apim-Subscription-Key' => $key
//    ],
//    'query' =>[
//        'currentCart' => 'true',
//    ],
//    'form_params' => [
//        'Name' => 'euro_web_3',
//        'Description' => 'session cart euroweb',
//    ]
//]);
//
//$cart = $client->request('post', 'https://services.scansource.com/apisandbox/cart/euroweb', [
//    'headers' => [
//        'Ocp-Apim-Subscription-Key' => $key
//    ],
//    'query' =>[
//        'currentCart' => 'true',
//    ],
//    'form_params' => [
//        'Name' => 'euro_web_4',
//        'Description' => 'session cart euroweb',
//    ]
//]);
//
//$listDataCart = $cart->getBody();
//$createdCart = json_decode($listDataCart->getContents());

/**
 * AJOUt ITEM TO CURRENT CART , si pas de cartId , c'est le current
 */
//$addItemToCurrentCart = $client->request('post', 'https://services.scansource.com/apisandbox/cart/item/euroweb', [
//    'headers' => [
//        'Ocp-Apim-Subscription-Key' => $key
//    ],
//    'query' =>[
//        'cartCollectionKey' => 'euroweb',
//        'cartId' => 3475,
//
//    ],
//    'form_params' => [
//        'Item' => 'testjesuisuntest',
//        'Quantity' => 12,
//    ]
//]);

/**
 * DELETE CART specific --> cartID xx || all !! attention erreur si cartId ou collection indéfinie
 */
//$currentCart = $client->request('delete', 'https://services.scansource.com/apisandbox/cart/euroweb', [
//    'headers' => [
//        'Ocp-Apim-Subscription-Key'      => $key
//    ],
//    'query' =>[
//            'cartId' => 3474
//    ]
//]);

/**
 * Recupération de tous les carts
 */
$currentCart = $client->request('GET', 'https://services.scansource.com/apisandbox/cart/list/euroweb', [
    'headers' => [
        'Ocp-Apim-Subscription-Key'      => $key
    ],
    'query' =>[
    ]
]);

$listdata = $currentCart->getBody();
$listCarts = json_decode($listdata->getContents());

$listing = $listCarts->Carts;
//$current = $listCarts->CurrentCartId;
var_dump($listing[1]);

/**
 * Update Specificité d'un cart
 */
//$updateCart = $client->request('put', 'https://services.scansource.com/apisandbox/cart/euroweb', [
//    'headers' => [
//        'Ocp-Apim-Subscription-Key' => $key
//    ],
//    'query' =>[
//        'cartCollectionKey' => 'euroweb',
//
//    ],
//    'form_params' => [
//        'Id' => 3475,
//        'Name' => 'euro_web_3',
//        'Description' => 'session cart euroweb numer 3',
//    ]
//]);

/**
* Updarte Item by Specific Cart AND item
*/
//$updateItem = $client->request('put', 'https://services.scansource.com/apisandbox/cart/item/euroweb/3475', [
//    'headers' => [
//        'Ocp-Apim-Subscription-Key' => $key
//    ],
//    'query' =>[
//    ],
//    'form_params' => [
//        'cartId' => 3475,
//        'Id' =>7960,
//        'Item' =>'MC945646',
//        'Quantity' =>666,
//    ]
//]);



$currentCart = $client->request('GET', 'https://services.scansource.com/apisandbox/cart/list/euroweb', [
    'headers' => [
        'Ocp-Apim-Subscription-Key'      => $key
    ],
    'query' =>[
    ]
]);


$listdata = $currentCart->getBody();
$listCarts = json_decode($listdata->getContents());

$listing = $listCarts->Carts;
//$current = $listCarts->CurrentCartId;
//var_dump($listing[1]);

/**
 * Delete Item by Specific Cart AND item cartID , NOT OPTIONAL
 */
//$updateItem = $client->request('delete', 'https://services.scansource.com/apisandbox/cart/item/euroweb/7961', [
//    'headers' => [
//        'Ocp-Apim-Subscription-Key' => $key
//    ],
//    'query' =>[
//        'CartId' => 3475
//    ],
//    'form_params' => [
//            'CartId' => 3475
//    ]
//]);



?>

<script>
    $(document).ready(function(){
        console.log('test')
    })
</script>





