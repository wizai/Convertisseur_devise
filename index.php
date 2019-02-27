<?php

require __DIR__ . '/vendor/autoload.php';
use Devise\Produit;
use Devise\Panier;

$Panier = new Panier();
//$Panier->Add(new Produit("Café", 20, "EUR",2));
//$Panier->Add(new Produit("Thé", 3, "USD",1));
//$total = $Panier->Convert("EUR");
//echo $total;

$produits = [];
$convert = $_POST['convertor'];
$name = $convert['name'];
$prix = $convert['prix'];
$devise = $convert['devise'];
$quantite = $convert['quantite'];

for ($i = 0; $i < count($convert['name']); $i++ ){
    $produits[] = [
        "name" => $name[$i],
        "prix" =>$prix[$i],
        "devise" =>$devise[$i],
        "quantite" =>$quantite[$i]
    ];
}

foreach ($produits as $item){
    $Panier->Add(new Produit($item['name'],$item['prix'],$item['devise'],$item['quantite']));
}

$total = $Panier->Convert("EUR");
echo $total;
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <title>🏦 | Convert</title>
</head>
<body>

<section class="main">
    <div id="convertor">
        <form action="" method="post" name="convertor" enctype="multipart/form-data">
            <div class="container">
                <div class="content">
                    <div class="product_block">
                        <div class="left">
                            <input class="product_block__name" name="convertor[name][]" type="text" placeholder="Nom du produit">
                            <div class="product_block__infoPrix">
                                <div class="product_block__prix">
                                    <label for="product_block__prix">Prix : </label>
                                    <input type="number" id="product_block__prix" name="convertor[prix][]" value="10">
                                </div>
                                <div class="product_block__devise">
                                    <label for="product_block__prix">Devise : </label>
                                    <input type="text" id="product_block__devise" name="convertor[devise][]" value="EUR">
                                </div>
                            </div>
                        </div>
                        <div class="right">
                            <div class="actionMoreLess less"><i class="fas fa-minus"></i></div>
                            <input type="number" class="product_block__quantite" name="convertor[quantite][]" value="1">
                            <div class="actionMoreLess more"><i class="fas fa-plus"></i></div>
                        </div>
                    </div>
                    <div class="product_block">
                        <div class="left">
                            <input class="product_block__name" name="convertor[name][]" type="text" placeholder="Nom du produit">
                            <div class="product_block__infoPrix">
                                <div class="product_block__prix">
                                    <label for="product_block__prix">Prix : </label>
                                    <input type="number" id="product_block__prix" name="convertor[prix][]" value="10">
                                </div>
                                <div class="product_block__devise">
                                    <label for="product_block__prix">Devise : </label>
                                    <input type="text" id="product_block__devise" name="convertor[devise][]" value="EUR">
                                </div>
                            </div>
                        </div>
                        <div class="right">
                            <div class="actionMoreLess less"><i class="fas fa-minus"></i></div>
                            <input type="number" class="product_block__quantite" name="convertor[quantite][]" value="1">
                            <div class="actionMoreLess more"><i class="fas fa-plus"></i></div>
                        </div>
                    </div>
                </div>
                <div class="addProductBlock">
                    <i class="fas fa-plus"></i>
                </div>
                <input type="submit" value="Convertir" class="input_convert">
            </div>
        </form>
    </div>
</section>
<script>

    $(document).ready(function () {
        $('.product_block').each(function () {
            let $Input = $('.product_block__quantite', this);
            $(".actionMoreLess", this).on('click',function(){
                if ($(this).hasClass('more'))
                    $Input.val(parseInt($Input.val())+1);
                else if ($Input.val()>=1)
                    $Input.val(parseInt($Input.val())-1);
            });
        });
    });

</script>
</body>
</html>
