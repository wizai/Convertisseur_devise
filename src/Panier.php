<?php
/**
 * Created by PhpStorm.
 * User: williamnisole
 * Date: 2019-02-21
 * Time: 11:32
 */

namespace Devise;


class Panier
{

    public $products = [];

    public function Add( $produits )
    {
        array_push($this->products, $produits);
    }

    public function Convert($deviseConvert)
    {
        $total = 0;
        foreach ($this->products as $value)
        {
            $rate = $this->getRate($deviseConvert, $value->devise);
            $prixConvert = ($value->prix * $rate) * $value->quantite;
            $total += $prixConvert;
        }
        return $total;
    }

    public function  getRate($deviseFinal, $deviseBegin)
    {
        if ($deviseBegin !== $deviseFinal) {
            $response = file_get_contents('https://api.exchangeratesapi.io/latest?base=' . $deviseBegin . '');
            $return = json_decode($response);
            return $return->rates->$deviseFinal;
        } else {
            return 1;
        }
    }
}
