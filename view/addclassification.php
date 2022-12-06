<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === TRUE && $_SESSION['clientData']['clientLevel'] > 1) {
    $continue = "continue";
} else {
    header('Location: /phpmotors');
}
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
            <h1>Add a New Clasification</h1>

            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>

            <form action="/phpmotors/vehicles/index.php" method="post">

                <fieldset>

                    <label for="classificationName">Enter a new classification:</label><br>
                    <input type="text" id="classificationName" name="classificationName" maxlength="30" placeholder="Max 30 Character"><br>

                    <input type="submit" name="submit" id="addclassidb" value="Add Classification">
                    <input type="hidden" name="action" value="addclassidb">

                </fieldset>
            </form>
        </main>

        <footer id="footer">
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>

</body>

</html>