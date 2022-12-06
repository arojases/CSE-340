<?php
    if($_SESSION['clientData']['clientLevel'] < 2){
        header('location: /phpmotors/');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($invInfo['invMake'])){
        echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title>
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
            <h1><?php if(isset($invInfo['invMake'])){
                echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?>
            </h1>

            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>

            <form action="/phpmotors/vehicles/index.php" method="post">
                <fieldset>
                    <legend>Confirm Vehicle Deletion. The delete is permanent.</legend>

                    <label for="invMake">Make:</label><br>
                    <input type="text" name="invMake" id="invMake" readonly
                        <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>><br><br>

                    <label for="invModel">Model:</label><br>
                    <input type="text" name="invModel" id="invModel" readonly
                        <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>><br><br>

                    <label for="invDescription">Description:</label><br>
                    <textarea name="invDescription" id="invDescription" readonly>
                        <?php if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea><br><br>

                    <input type="submit" name="submit" value="Delete Vehicle">
                    <input type="hidden" name="action" value="deleteVehicle">
                    <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){echo $invInfo['invId'];} ?>">
                </fieldset>
            </form>
        </main>

        <footer id="footer">
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>

</body>

</html>