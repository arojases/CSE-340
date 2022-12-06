<?php
    if($_SESSION['clientData']['clientLevel'] < 2){
        header('location: /phpmotors/');
    exit;
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
    } elseif(isset($invInfo['classificationId'])){
        if($classification['classificationId'] === $invInfo['classificationId']){
            $dropList .= ' selected ';
        }
    }
    $dropList .= ">$classification[classificationName]</option>";
}
$dropList .= "</select>";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
                    echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
                elseif(isset($invMake) && isset($invModel)) { 
                    echo "Modify $invMake $invModel"; }?> | PHP Motors</title>
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
            <h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
                    echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
                elseif(isset($invMake) && isset($invModel)) { 
                    echo "Modify$invMake $invModel"; }?></h1>

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
                    <input type="text" name="invMake" id="invMake" required
                        <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>><br><br>

                    <label for="invModel">Model:</label><br>
                    <input type="text" name="invModel" id="invModel" required
                        <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>><br><br>

                    <label for="invDescription">Description:</label><br>
                    <textarea name="invDescription" id="invDescription" required>
                        <?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea><br><br>

                    <label for="invImage">Image:</label><br>
                    <input type="text" id="invImage" name="invImage" required
                        <?php if(isset($invImage)){echo "value='$invImage'";} elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; } ?>><br><br>

                    <label for="invThumbnail">Thumbnail:</label><br>
                    <input required type="text" name="invThumbnail" id="invThumbnail"
                        <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; } ?>><br><br>

                    <label for="invPrice">Price:</label><br>
                    <input type="number" id="invPrice" name="invPrice" required
                        <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }?>><br><br>

                    <label for="invStock">Stock:</label><br>
                    <input type="number" id="invStock" name="invStock" required
                        <?php if(isset($invStock)){echo "value='$invStock'";} elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; } ?>><br><br>

                    <label for="invColor">Color:</label><br>
                    <input type="text" id="invColor" name="invColor" required
                        <?php if(isset($invColor)){echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; } ?>><br><br>


                    <input type="submit" name="submit" value="Update Vehicle">
                    <input type="hidden" name="action" value="updateVehicle">
                    <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
                                                           elseif(isset($invId)){ echo $invId; } ?>">
                </fieldset>
            </form>
        </main>

        <footer id="footer">
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>

</body>

</html>