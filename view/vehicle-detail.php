<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $invInfo['invMake']; ?> Vehicles | PHP Motors</title>
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
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            ?>
            
            <?php echo $vehicle; ?>

            <h3>Customer Review</h3>
            <?php 
                if (!$_SESSION['loggedin']){
                    echo '<p>You can <a href = "/accounts/index.php?action=login">login</a> to create a review.</p>';
                }
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                }
            ?>
            <form action="/phpmotors/reviews/index.php" method="POST" <?php if (!$_SESSION['loggedin']){echo "hidden";} ?>>
                <label>Add your own review</label>
                <br>
                <textarea id="review" name="newReview" rows="4" cols="50" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required></textarea>
                <br>
                <input type="submit" name="submit" id="regbtn" value="Add Review">
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="addReview">
                <input type="hidden" name="userId" <?php echo 'value="'.$_SESSION['clientData']['clientId'].'"' ?>>
                <input type="hidden" name="carId" <?php echo 'value="'.$vehicleId.'"' ?>>
            </form>
            <?php 
                // Put the reviews on the page.
                if (isset($reviewHTML)){
                    echo $reviewHTML;
                }
            ?>
        </main>

        <footer id="footer">
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>

</body>

</html>