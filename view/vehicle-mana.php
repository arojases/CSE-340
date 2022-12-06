<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];}

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
            <h1>Vehicle Management</h1>

            <?php
            if (isset($message)) {
                echo $message;
            }  
            ?>            
            
            <ul>
                <li><a href="/phpmotors/vehicles/index.php?action=addclassification">Add Classification</a></li>
                <li><a href="/phpmotors/vehicles/index.php?action=addvehicle">Add Vehicle</a></li>
            </ul>

            <?php
            if (isset($classificationList)) { 
                echo '<h2>Vehicles By Classification</h2>'; 
                echo '<p>Choose a classification to see those vehicles</p>'; 
                echo $classificationList; 
            }
            ?>

            <noscript>
            <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
            </noscript>

            <table id="inventoryDisplay"></table>

        </main>

        <footer id="footer">
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>

    <script src="../js/inventory.js"></script>

</body>

</html>
<?php unset($_SESSION['message']); ?>