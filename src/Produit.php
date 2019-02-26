<?php
/**
 * Created by PhpStorm.
 * User: williamnisole
 * Date: 2019-02-21
 * Time: 11:32
 */

namespace Devise;


class Produit
{

    public function __construct($name, $prix, $devise , $quantite)
    {
        $this->prix = $prix;
        $this->devise = $devise;
        $this->name = $name;
        $this->quantite = $quantite;
    }

}
