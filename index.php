<?php

use Carbon\Carbon;

require __DIR__ . '/vendor/autoload.php';

$client = new \GuzzleHttp\Client();
$data = $client->request('GET', 'https://services.scansource.com/api/product/search', [
    'headers' => [
        'Ocp-Apim-Subscription-Key'      => 'DpHO1fNQO8XUpFyk2CwgMkIGt2iK5g0w'
    ],
    'query' =>[
        'customerNumber' => '1000000854',
        'includeObsolete' => 'true',
        'searchText' => 'MC92',
        'pageSize' => '1',
        'page' => '1',
    ]
]);

$listdata = $data->getBody();
$listdata_ = json_decode($listdata->getContents());
require('connection.php');
$database = new database();
$database = $database->connec();
var_dump($database);
$sql = 'SELECT * FROM it_it';
$sth = $database->prepare($sql);
$sth->execute();

$red = $sth->fetchAll(2);
//var_dump($red);
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous">
    </script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<button onclick="createNew()">add new </button>
<table class="table table-border">
    <thead>
    <tr>
        <th>NOM</th>
        <th>DESCRIPTION</th>
        <th>dt</th>
    </tr>
    </thead>

    <tbody id="table-body">
    <?php foreach($listdata_ as $index  => $value) :?>
        <tr>
            <td nowrap><?php echo $value->ManufacturerItemNumber?></td>
            <td><?php echo $value->Description?></td>
            <td nowrap><?php echo (Carbon::now())->format('d-m-Y')?></td>
        </tr>
    <?php endforeach?>
    </tbody>
</table>
<script>
    function createNew() {
        $("#add-more").hide();
        var data = '<tr class="table-row" id="new_row_ajax">' +
            '<td contenteditable="true" id="txt_title" onBlur="addToHiddenField(this,\'title\')" onClick="editRow(this);"></td>' +
            '<td contenteditable="true" id="txt_description" onBlur="addToHiddenField(this,\'description\')" onClick="editRow(this);"></td>' +
            '<td><input type="hidden" id="title" /><input type="hidden" id="description" /><span id="confirmAdd"><a onClick="addToDatabase()" class="ajax-action-links">Save</a> / <a onclick="cancelAdd();" class="ajax-action-links">Cancel</a></span></td>' +
            '</tr>';
        $("#table-body").append(data);
    }
    function cancelAdd() {
        $("#add-more").show();
        $("#new_row_ajax").remove();
    }

    $(document).ready(function(){

        console.log('test')
    })
</script>
</body>
</html>





