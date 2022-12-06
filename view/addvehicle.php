<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === TRUE && $_SESSION['clientData']['clientLevel'] > 1) {
    $continue = "continue";
} else {
    header('Location: /phpmotors');
}
?><?php
//create drop list
$dropList = '<select name="classificationId">';
foreach ($classifications as $classification){
    $dropList .= "<option value='$classification[classificationId]'";
    if(isset($classificationId)) {
        if($classification['classificationId'] === $classificationId) {
            $dropList .= ' selected ';
        }
    }
    $dropList .= ">$classification[classificationName]</option>";
}
$dropList .= "</select>";

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Title | PHP Motors</title>
    <link rel="stylesheet" href="../css/main.css" type="text/css">
</head>

<body>
    <div class="principal">
        <header id="header">
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
        </header>

        <nav>
            <?php echo $navList; ?>
        </nav>

        <main>
            <h1>Add a New Vehicle</h1>

            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>

            <form action="/phpmotors/vehicles/index.php" method="post">
                <fieldset>
                    <legend>All fields are required</legend>

                    <label>Classification:</label><br>
                    <?php echo $dropList; ?><br><br>

                    <label for="invMake">Make:</label><br>
                    <input type="text" id="invMake" name="invMake" required
                        <?php if(isset($invMake)){echo "value='$invMake'";}  ?>><br><br>

                    <label for="invModel">Model:</label><br>
                    <input type="text" id="invModel" name="invModel" required
                        <?php if(isset($invModel)){echo "value='$invModel'";}  ?>><br><br>

                    <label for="invDescription">Description:</label><br>
                    <textarea name="invDescription" id="invDescription" rows="5" cols="30"
                        required><?php if(isset($invDescription)){echo $invDescription;}?></textarea><br><br>

                    <label for="invImage">Image:</label><br>
                    <input type="text" id="invImage" name="invImage" value="/phpmotors/images/no-image.png" required
                        <?php if(isset($invImage)){echo "value='$invImage'";}  ?>><br><br>

                    <label for="invThumbnail">Thumbnail:</label><br>
                    <input type="text" id="invThumbnail" name="invThumbnail" value="/phpmotors/images/no-image.png"
                        required <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  ?>><br><br>

                    <label for="invPrice">Price:</label><br>
                    <input type="number" id="invPrice" name="invPrice" required
                        <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?>><br><br>

                    <label for="invStock">Stock:</label><br>
                    <input type="number" id="invStock" name="invStock" required
                        <?php if(isset($invStock)){echo "value='$invStock'";}  ?>><br><br>

                    <label for="invColor">Color:</label><br>
                    <input type="text" id="invColor" name="invColor" required
                        <?php if(isset($invColor)){echo "value='$invColor'";}  ?>><br><br>


                    <input type="submit" name="submit" id="addvehicledb" value="Add Vehicle">
                    <input type="hidden" name="action" value="addvehicledb">
                </fieldset>
            </form>
        </main>

        <footer id="footer">
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>

</body>

</html>