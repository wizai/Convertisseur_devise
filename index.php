<?php

require __DIR__ . '/vendor/autoload.php';
use Devise\Produit;
use Devise\Panier;

$Panier = new Panier();
$Panier->Add(new Produit("Café", 20, "EUR",2));
$Panier->Add(new Produit("Thé", 3, "USD",1));
$total = $Panier->Convert("EUR");
//echo $total;

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>🏦 | Convert</title>
</head>
<body>

<section class="main">
    <form action="" method="post" id="convertor">
        <div class="convertor_container">
            <h1>Convert</h1>
            <div class="product_block">
                <input type="text" placeholder="Nom du produit">
                <input type="number" placeholder="Prix du produit">
                <input type="text" placeholder="Devise du produit">
            </div>
            <input type="submit" value="Convertir" class="input_convert">
        </div>
    </form>
</section>

</body>
</html>
