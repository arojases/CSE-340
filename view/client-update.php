<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === FALSE) {
    header('Location: /phpmotors/index.php');
}

$clientFirstname = $_SESSION['clientData']['clientFirstname'];
$clientLastname = $_SESSION['clientData']['clientLastname'];
$clientEmail = $_SESSION['clientData']['clientEmail'];
$clientId = $_SESSION['clientData']['clientId'];

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
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
            <h1>Update Account Information</h1>
            <?php if (isset($_SESSION['message'])) {echo $_SESSION['message'];} ?>

            <h2>Client Information</h2>
            <form method="post" action="/phpmotors/accounts/index.php">
                <fieldset>
                    <label>First Name</label><br>
                    <input required type="text" name="clientFirstname" id="clientFirstname"
                        <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?>><br>
                    <label>Last Name</label><br>
                    <input required type="text" name="clientLastname" id="lname"
                        <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?>><br>
                    <label>Email</label><br>
                    <input required type="email" name="clientEmail" id="email"
                        <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>><br><br>
                    <input type="hidden" name="clientId" value="<?php if(isset($clientInfo['clientId'])){ echo $clientInfo['clientId'];} 
                                                           elseif(isset($clientId)){ echo $clientId; } ?>">
                    <input type="submit" name="submit" value="Update Info">
                    <input type="hidden" name="action" value="updateClient">
                </fieldset>
            </form>

            <h2>Update Password</h2>
            <?php if (isset($message1)) {
                echo $message1;
            } ?>

            <form method="post" action="/phpmotors/accounts/index.php">
                <fieldset>
                    <legend>This change will update your password.</legend><br>
                    <span>(Must be at least 8 characters and have 1 uppercase letter number and special
                        character.)</span><br>
                    <input required type="password" name="clientPassword" id="password"
                        pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br><br>
                    <input type="hidden" name="clientId" value="<?php if(isset($clientInfo['clientId'])){ echo $clientInfo['clientId'];} 
                                                           elseif(isset($clientId)){ echo $clientId; } ?>">
                    <input type="submit" name="submit" value="Update Password">
                    <input type="hidden" name="action" value="updatePassword">
                </fieldset>
            </form>
        </main>

        <footer id="footer">
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>

</body>

</html>
<?php unset($_SESSION['message']); ?>
