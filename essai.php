<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="style.css">
    <title>€hange</title>
</head>

<body>
    <nav>
        <h1>€hange</h1>
        <a href=""><img src="image/github.png" alt=""></a>
    </nav>

    <?php

    // Appel de l'API de FXRates API
    $url = "https://api.fxratesapi.com/currencies";
    $response = file_get_contents($url);
    $php_array = json_decode($response, true);

    $select_array = array("from", "to");
    ?>

    

    <div class="conversion-container">
    <?php

    // Boucle pour la génération des selects
    foreach ($select_array as $id_name) 
    {
    ?>
    <div class= "<?php echo $id_name . '-container' ?>">
        <div class="select-container">
        <select name="<?php echo $id_name ?>" id="<?php echo $id_name ?>">
            <?php

            // Boucle pour la génération des options
            foreach ($php_array as $iso_code => $value) 
            {
            ?>
                <option value="<?php echo $iso_code ?>" 

                <?php if ($id_name == "from" && $iso_code == "USD") {echo "selected";}?>

                <?php if ($id_name == "to" && $iso_code == "XOF") {echo "selected";}?>>

                    <?php echo $value["name"] . ' (' . $iso_code . ')'; ?>
                </option>
            <?php
            }

            ?>
            
        </select>
        <img src="image\fleche-deroulante.png" alt="">
        </div>

        <?php 
        if ($id_name == "from") 
        {
            ?>
            <input type="number" name="from_number" id="from_number" value="1">
            <?php
        }
        else {
            ?>
            <!--resultat-->
            <p id="result"></p>
            <?php
        }
        ?>

    </div>

    <?php
    }

    ?>
    </div>




</body>

</html>








</script>