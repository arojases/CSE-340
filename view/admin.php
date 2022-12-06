<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === FALSE) {
    header('Location: /phpmotors/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Content Title | PHP Motors</title>
    <link rel="stylesheet" href="../css/main.css" type="text/css" />
</head>

<body>
    <div class="principal">
        <header id="header">
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
        </header>

        <nav id="page_nav">
            <?php echo $navList; ?>
        </nav>

        <main>
            <h1><?php echo $_SESSION['clientData']['clientFirstname']," ", $_SESSION['clientData']['clientLastname']; ?>
            </h1>
            <?php if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];} ?>
            <ul>
                <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
                <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
                <li>Email: <?php echo $_SESSION['clientData']['clientEmail']; ?></li>
            </ul>

            <h3>You are logged in.</h3>

            <h2>Inventory Management</h2>
            <p>Use this link to uldate account information.</p>
            <p><a href="/phpmotors/accounts/?action=update-page">Update account information</a></p>

            <?php if ($_SESSION['clientData']['clientLevel'] > 1) {echo '<h2>Inventory Management</h2>
                                                        <p>Use this link to manage the inventory.</p>
                                                        <p><a href="/phpmotors/vehicles/index.php">Vehicle Management</a></p>';} ?>


            
            <h3>Your Reviews</h3>
            <?php echo $reviewHTML; ?>
        </main>

        <footer id="footer">
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>

</body>

</html>
<?php unset($_SESSION['message']); ?>