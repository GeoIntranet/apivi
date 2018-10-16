<?php

//https://services.scansource.com/apisandbox/swagger/ui/index#/
//API Key
//Customer # 1000000854
use Carbon\Carbon;
require __DIR__ . '/vendor/autoload.php';

    $key = 'DpHO1fNQO8XUpFyk2CwgMkIGt2iK5g0w';
    $client = new \GuzzleHttp\Client();

    //$client->request(method,url,[options [] ])->getBody()->getcontents()
    $currentCart = $client->request('GET', 'https://services.scansource.com/apisandbox/cart/list/euroweb', [
        'headers' => [
            'Ocp-Apim-Subscription-Key'      => $key
        ],
        'query' =>[
        ]
    ])
    ->getBody()
    ->getContents();

$listdata_ = json_decode($currentCart);

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

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>

<br><br><br><br>
<div style="margin: 0 30px 0 30px">

    <button class="btn btn-primary" onclick="createNew()">Nouvelle session pannier</button>
    <button class="btn btn-info" onclick="refreshSession()">actualiser</button>
    <br>
    <br>
    <table class="table table-border" id="updateRow" style="display: none">
        <thead>
            <tr>
                <th colspan="5">MISE A JOUR</th>
            </tr>
        </thead>
        <tbody id="updateTable">
        </tbody>
    </table>
    <br>
    <table class="table table-border">
        <thead>
        <tr>
            <th>ID</th>
            <th>NOM</th>
            <th>DESCRIPTION</th>
            <th>dt</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody>
        <tr id="new_session" style="display: none">
            <td>X</td>
            <td><input type="text" id="txt_name" placeholder="test" class="form-control" ></td>
            <td><input type="text" id="txt_description" placeholder="test" class="form-control" ></td>
            <td>

                <button class="btn btn-primary" onClick="getSaveInput()">Save</button>
                <button class="btn btn-danger" onclick="cancelAdd()">Cancel</button>
            </td>
        </tr>
        </tbody>

        <tbody id="table-body">
        <?php //var_dump($listdata_) ?>
        <?php foreach($listdata_->Carts as $index  => $value) :?>
            <tr id="cart_<?php echo $value->Id?>" >
                <td nowrap id="id_cart_<?php echo $value->Id?>">->
                    <?php if($listdata_->CurrentCartId === $value->Id): ?>
                        <?php echo "<b style='color:mediumseagreen'>$value->Id</b>"?>
                    <?php else :?>
                        <?php echo $value->Id?>
                    <?php endif ?>
                </td>
                <td nowrap id="name_cart_<?php echo $value->Id?>"><?php print_r($value->Name)?></td>
                <td id="desc_cart_<?php echo $value->Id?>"><?php print_r($value->Description)?></td>
                <td nowrap><?php echo (Carbon::now())->format('d-m-Y')?></td>
                <td>
                    <button class="btn btn-danger" id="<?php echo $value->Id?>" onclick="deleteCart(<?php echo $value->Id?>)">delete</button>

                    <button class="btn btn-primary" id="<?php echo $value->Id?>" onclick="getUpdateFormCart(<?php echo $value->Id?>)">update</button>
                </td>
            </tr>
        <?php endforeach?>

        </tbody>
    </table>
</div>

<script>

    function updateData(){
        console.log('saveData');
    }

    function getUpdateFormCart(id){
        var updateName = $('#name_cart_'+id).text();
        var updateDesc = $('#desc_cart_'+id).text();
        var updatedId='updated_id';
        var updatedNameCart='updated_name_cart_'+id;
        var updatedDescCart='updated_desc_cart_'+id;

        $('#updateTable').append('<tr id="updateRowTable" class="updtrow">'+
                '<td id='+updatedId+'>'+id+'<td>'+
                '<td><input id='+updatedNameCart+' class="form-control" type="text" name="update_name" value='+updateName+'><td>'+
                '<td><input id='+updatedDescCart+' class="form-control" type="text" name="update_desc" value='+updateDesc+'><td>'+
                '<td> <button class="btn btn-primary" id="saveUpdateData" >Save</button> <button id="cancelUpdateData" class="btn btn-danger" >Cancel</button><td>'+
            '</tr>');

        $('#updateRow').toggle();
    }

    function deleteCart(id){
        $.ajax({
            url: "delete_cart.php",
            type: "post",
            data:'id='+id,
            success: function(data){
                var jsonData = jQuery.parseJSON(data);
                $("#cart_"+jsonData.id).remove();
            }
        });
    }

    function createNew() {
        $("#new_session").show();
    }

    function cancelAdd() {
        resetInput();
        $("#new_session").toggle();
    }

     function resetInput(){
        $("#txt_name").val(" ") ;
        $("#txt_description").val(" ");
    }

    function refreshSession() {
        var PRIV_KEY = "0b21f6745e54dbdd87529df6b963ae21f89c12cb";
        var PUBLIC_KEY = "f5b5849487d06f92a19e64d7bffee663";
        var ts = new Date().getTime();
        var hash = CryptoJS.MD5(ts + PRIV_KEY + PUBLIC_KEY).toString();
        $.ajax({
            url: "https://gateway.marvel.com:443/v1/public/characters",
            type: "get",
            data:{
                ts:ts,
                apikey: PUBLIC_KEY,
                hash: hash,
                limit: 100,
            },
            success: function(data){
                //var jsonData = jQuery.parseJSON(data);
                console.log(data.data);
                //$("#cart_"+jsonData.id).remove();
            }
        });
    }

    /**
     */
    function getSaveInput() {
        var description = $('#txt_description').val();
        var name = $('#txt_name').val();

        if(name.length > 1 && description.length > 1){
            console.log('requette ajax');
            $.ajax({
                url: "new_cart.php",
                type: "POST",
                data:'name='+name+'&description='+description,
                success: function(data){
                    resetInput();
                    var jsonData = jQuery.parseJSON(data);
                        var newValue = '<tr id="cart_'+jsonData.id+'"><td id="id_cart_'+jsonData.id+'">->'+jsonData.id+'</td><td id="name_cart_'+jsonData.id+'">'+jsonData.name+'</td><td id="desc_cart_'+jsonData.id+'">'+jsonData.description+'</td><td></td>' +
                        '<td>' +
                            '<button class="btn btn-danger" id='+jsonData.id+' onClick="deleteCart('+jsonData.id+')">delete</button> '+
                            ' <button class="btn btn-primary" id='+jsonData.id+' onClick="getUpdateFormCart('+jsonData.id+')">update</button>'+
                        '</td>' +
                        '</tr>'
                    $("#table-body").prepend(newValue);
                    $("#new_session").toggle();
                    location.reload();
                }
            });
        }
    }

    (function(){
        $(document).on( "click", "#saveUpdateData", function() {
            var id = $('#updated_id').text();
            var updatedName = $('#updated_name_cart_'+id).val();
            var updatedDesc = $('#updated_desc_cart_'+id).val();

            $.ajax({
                url: "update_cart.php",
                type: "POST",
                data:{
                    id:id,
                    name:updatedName,
                    desc:updatedDesc,
                },
                success: function(data){
                    console.log(data);
                    $('#updateRowTable').remove();
                    $('#updateRow').toggle();
                    location.reload();
                },
            });

        });

        $(document).on( "click", "#cancelUpdateData", function() {
            $('#updateRowTable').remove();
            $('#updateRow').toggle();
        });

        
    })(jQuery)


</script>
</body>
</html>





