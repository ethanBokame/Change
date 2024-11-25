<!DOCTYPE html>
<html lang="en">

<head>
    <?php $date = date("H_i_s"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="<?php echo 'script.js?v=' . $date?>" defer></script>
    <link rel="stylesheet" href="<?php echo 'style.css?v=' . $date?>">
    <link rel="shortcut icon" href="image/euro.png" type="image/x-icon">
    <title>€hange</title>
</head>

<body>
    <div class="big-container">
    <nav>
        <h1>€hange</h1>
        <a href=""><img src="image/github.png" alt=""></a>

    </nav>

    <div id="offline" style="color: #FF0000; display: flex; width: 100%; justify-content:center; gap:7px; margin: -30px 0; display: none;">
        <img src="image\pas-dinternet.png" width="20">
        <p style="margin-top: auto;">
            You are offline
        </p>
    </div>

    <?php

    // Appel de l'API de FXRates API
    $url = "https://api.fxratesapi.com/currencies";
    
    $response = @file_get_contents($url); // Enlever les messages d'erreurs

    if ($response == false) {
        echo '        
        <div style="color: #FF0000; display: flex; width: 100%; justify-content:center; gap:7px; margin: -30px 0;">
        <img src="image/alerte.png" width="20">
        <p style="margin-top: auto;">
            Error, reload the page
        </p>
        </div>';
    }

    $php_array = json_decode($response, true);

    $select_array = array("from", "to");
    ?>



    <div class="conversion-container">
        <?php
        

        // Boucle pour la génération des selects
        foreach ($select_array as $id_name) {
        ?>
            <div class="<?php echo $id_name . '-container' ?>">
                <div class="select-container">
                    <select name="<?php echo $id_name ?>" id="<?php echo $id_name ?>">
                        <?php

                        // Boucle pour la génération des options
                        foreach ($php_array as $iso_code => $value) {
                        ?>
                            <option value="<?php echo $iso_code ?>"

                                <?php if ($id_name == "from" && $iso_code == "USD") {
                                    echo "selected";
                                } ?>

                                <?php if ($id_name == "to" && $iso_code == "XOF") {
                                    echo "selected";
                                } ?>>

                                <?php echo $value["name"] . ' (' . $iso_code . ')'; ?>
                            </option>
                        <?php
                        }

                        ?>

                    </select>
                    <img src="image\fleche-deroulante.png" alt="">
                </div>

                <?php
                if ($id_name == "from") {
                ?>
                    <input type="number" name="from_number" id="from_number" value="1" placeholder="Enter the amount to convert" pattern="">
                <?php
                } else {
                ?>
                    <!--resultat-->
                    <p id="result"></p>
                <?php
                }
                ?>

            </div>

            <?php
            if ($id_name == "from") {
            ?>
                <div class="conv-img-container">
                    <img src="image\fleches-gauche-et-droite.png" id="conv-img">
                </div>
            <?php
            }
            ?>

        <?php
        }

        ?>
    </div>

    <footer>
        <p>© 2024 JsH. Tous droits réservés. Créé par <a href="https://www.linkedin.com/in/ethan-bokamé-0b59a430b">Ethan Bokamé</a><br><br>
            <b>shinzou wo sasageyo!</b>
        </p>
    </footer>
    </div>

</body>

</html>