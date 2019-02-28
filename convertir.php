<?php

require __DIR__ . '/vendor/autoload.php';
use Devise\Produit;
use Devise\Panier;

$Panier = new Panier();
$produits = [];
if (isset($_POST['convertor'])) {
    $convert = $_POST['convertor'];
    $mainDevise = $_POST['mainDevise'];
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

    $total = $Panier->Convert($mainDevise);

    switch ($mainDevise) {
        case 'USD':
            echo round($total, 2)."<span>$</span>";
            break;
        case 'EUR' :
            echo round($total, 2)."<span>€</span>";
            break;
        case 'JPY' :
            echo round($total, 2)."<span>¥</span>";
            break;
        case 'GBP' :
            echo round($total, 2)."<span>£</span>";
            break;
        case 'CLF' :
            echo round($total, 2)."<span>UF</span>";
            break;
    }
};
