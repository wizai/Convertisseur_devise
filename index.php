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
        <form action="convertir.php" method="post" name="convertor" enctype="multipart/form-data">
            <div class="header">
                <ul>
                    <li class="active">Panier</li>
                    <li>Résultat</li>
                </ul>
            </div>
            <div class="container panier active">
                <div class="choiceDevise">
                    <label for="mainDevise">Convertir en : </label>
                    <select name="mainDevise" id="mainDevise">
                        <option value="USD">$</option>
                        <option value="EUR">€</option>
                        <option value="JPY">¥</option>
                        <option value="GBP">£</option>
                        <option value="CLF">UF</option>
                    </select>
                </div>
                <div>
                    <div class="content">
                        <div class="product_block">
                            <div class="left">
                                <input class="product_block__name" required name="convertor[name][]" type="text" placeholder="Nom du produit">
                                <div class="product_block__infoPrix">
                                    <div class="product_block__prix">
                                        <label for="product_block__prix">Prix : </label>
                                        <input type="number" id="product_block__prix" required name="convertor[prix][]" placeholder="10" min="0" step="0.01">
                                    </div>
                                    <div class="product_block__devise">
                                        <label for="product_block__prix">Devise : </label>
                                        <select name="convertor[devise][]" id="product_block__devise">
                                            <option value="USD">$</option>
                                            <option value="EUR">€</option>
                                            <option value="JPY">¥</option>
                                            <option value="GBP">£</option>
                                            <option value="CLF">UF</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="right">
                                <div class="actionMoreLess less"><i class="fas fa-minus"></i></div>
                                <input type="number" class="product_block__quantite" name="convertor[quantite][]" value="1" ">
                                <div class="actionMoreLess more"><i class="fas fa-plus"></i></div>
                            </div>
                            <div class="product_block_delete">
                                <i class="far fa-trash-alt"></i>
                            </div>
                        </div>
                    </div>
                    <div class="addProductBlock">
                        <i class="fas fa-plus"></i>
                    </div>
                    <input type="submit" value="Convertir" class="input_convert">
                </div>
            </div>
            <div class="container resultat">
                <div class="content">
                    <h2>Montant total : </h2>
                    <h1></h1>
                </div>
            </div>
        </form>
    </div>
</section>
<script>

    $("body").on('click','.actionMoreLess',function(){
        let $parent = $(this).closest('.product_block');
        let $Input = $($parent).find('.product_block__quantite');
        if ($(this).hasClass('more'))
            $Input.val(parseInt($Input.val())+1);
        else if ($Input.val()>=1)
            $Input.val(parseInt($Input.val())-1);
    });
    $("body").on('click','.product_block_delete',function(){
        let $produit = $(this).closest('.product_block');
        $($produit).fadeOut('slow', function(){
            $($produit).remove();
        });
    });

    $('.addProductBlock').on('click' , function (e) {
        e.preventDefault();
        const template = " <div class=\"product_block\">\n" +
            "                            <div class=\"left\">\n" +
            "                                <input class=\"product_block__name\" required name=\"convertor[name][]\" type=\"text\" placeholder=\"Nom du produit\">\n" +
            "                                <div class=\"product_block__infoPrix\">\n" +
            "                                    <div class=\"product_block__prix\">\n" +
            "                                        <label for=\"product_block__prix\">Prix : </label>\n" +
            "                                        <input type=\"number\" id=\"product_block__prix\" required name=\"convertor[prix][]\" placeholder=\"10\" min=\"0\" step=\"0.01\">\n" +
            "                                    </div>\n" +
            "                                    <div class=\"product_block__devise\">\n" +
            "                                        <label for=\"product_block__prix\">Devise : </label>\n" +
            "                                        <select name=\"convertor[devise][]\" id=\"product_block__devise\">\n" +
            "                                            <option value=\"USD\">$</option>\n" +
            "                                            <option value=\"EUR\">€</option>\n" +
            "                                            <option value=\"JPY\">¥</option>\n" +
            "                                            <option value=\"GBP\">£</option>\n" +
            "                                            <option value=\"CLF\">UF</option>\n" +
            "                                        </select>\n" +
            "                                    </div>\n" +
            "                                </div>\n" +
            "                            </div>\n" +
            "                            <div class=\"right\">\n" +
            "                                <div class=\"actionMoreLess less\"><i class=\"fas fa-minus\"></i></div>\n" +
            "                                <input type=\"number\" class=\"product_block__quantite\" name=\"convertor[quantite][]\" value=\"1\" \">\n" +
            "                                <div class=\"actionMoreLess more\"><i class=\"fas fa-plus\"></i></div>\n" +
            "                            </div>\n" +
            "                            <div class=\"product_block_delete\">\n" +
            "                                <i class=\"far fa-trash-alt\"></i>\n" +
            "                            </div>\n" +
            "                        </div>";
        $('#convertor .container.panier .content').append(template).fadeIn('slow');
    });


    $('form').submit(function(e) {
        $('.header li, #convertor .container.panier').removeClass('active');
        $('.header li:last-of-type, #convertor .container.resultat').addClass('active');
        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function(data)
            {
                $('#convertor .container.resultat h1').html(data);
            }
        });

        e.preventDefault();
    });

</script>
</body>
</html>
