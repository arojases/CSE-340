<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration | PHP Motors</title>
    <link rel="stylesheet" href="/phpmotors/css/main.css" type="text/css">
</head>

<body>
    <div class="principal">
        <header id="header">
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
        </header>

        <nav id="page_nav">
            <?php echo $navList; ?>
            <!-- <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php'; ?> -->
        </nav>

        <main>
            <h1>Registration</h1>

            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>

            <form action="/phpmotors/accounts/index.php" method="post">
                <fieldset>

                    <label for="fname">First Name</label> <br>
                    <input type="text" id="fname" name="clientFirstname" required
                        <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?>> <br>

                    <label for="lname">Last Name</label> <br>
                    <input type="text" id="lname" name="clientLastname" required
                        <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?>> <br>

                    <label for="mail">Email Address</label> <br>
                    <input type="email" id="mail" name="clientEmail" required
                        <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>> <br>

                    <label for="pass">Password</label> <br>
                    <input type="password" id="pass" name="clientPassword"
                        pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required> <br>

                    <span>(Must be at least 8 characters and have 1 uppercase letter number and special
                        character.)</span><br><br>

                    <input type="submit" name="submit" id="register" value="Register">

                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="register">
                </fieldset>

            </form>
        </main>

        <footer id="footer">
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>

</body>

</html>