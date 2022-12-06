<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PHP Motors</title>
    <link rel="stylesheet" href="/phpmotors/css/main.css" type="text/css">
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
            <h1>Sign in</h1>

            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            ?>

            <form action="/phpmotors/accounts/index.php" method="post">

                <label for="mail">Email</label><br>
                <input type="email" id="mail" name="clientEmail" required
                    <?php if(isset($clientEmail)){echo "value='$clientEmail'";}?>> <br>

                <label for="pass">Password</label><br>
                <input type="password" id="pass" name="clientPassword"
                    pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required> <br>

                <span>(Must be at least 8 characters and have 1 uppercase letter number and special
                    character.)</span><br><br>

                <button type="submit">Login</button>
                <input type="hidden" name="action" value="Login">

            </form>

            <span>Not a member yet?</span> <br>
            <a href="/phpmotors/accounts/index.php?action=registration">Create a New Account</a>

        </main>

        <footer id="footer">
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>

</body>

</html>