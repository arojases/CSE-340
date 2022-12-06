<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <title>Home | PHP Motors</title>
    <link rel="stylesheet" href="/phpmotors/css/main.css" type="text/css" >
</head>

<body>
    <div class="principal">
        <header id="header">
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
        </header>

        <nav id="page_nav" class="clearfix">
            <?php echo $navList; ?> 
            <!-- <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php'; ?> -->            
        </nav>

        <div class="info">
            <p><b>DMC DeLorean</b> <br>
                3 Cup holders <br>
                Superman doors<br>
                Fuzzy dice!
            </p>
            <button class="btnown">Own Today</button>
        </div>

        <main>
            <h1>Welcome to PHP Motors!</h1>
            <img src="../phpmotors/images/delorean.jpg" alt="DeLorean">
        </main>

        <section>
            <div class="upgrades">
                <h2>DeLorean Upgrades</h2>
                <div id="flux" class="upgrades-options">
                    <div class=" flux">
                        <img src="../phpmotors/images/upgrades/flux-cap.png" alt="Flux Capacitor"> <br>
                    </div>
                    <a href="#">Flux Capacitor</a>
                </div>
                <div id="flame" class="upgrades-options">
                    <div class=" flame">
                        <img src="../phpmotors/images/upgrades/flame.jpg" alt="Flame Decals"> <br>
                    </div>
                    <a href="#">Flame Decals</a>

                </div>
                <div id="bumper" class="upgrades-options">
                    <div class=" bumper">
                        <img src="../phpmotors/images/upgrades/bumper_sticker.jpg" alt="Bumper Stickers"> <br>
                    </div>
                    <a href="#">Bumper Stickers</a>
                </div>
                <div id="hub" class="upgrades-options">
                    <div class=" hub">
                        <img src="../phpmotors/images/upgrades/hub-cap.jpg" alt="Hub Capss"> <br>
                    </div>
                    <a href="#">Hub Caps</a>

                </div>


            </div>
            <div class="reviews">
                <h2>DMC DeLorean Reviews</h2>
                <ul>

                    <li>"So fast its almost like travelling in time." (4/5)</li>
                    <li>"Coolest ride on the road." (4/5)</li>
                    <li>"I'm feeling McFly!" (5/5)</li>
                    <li>"The most futuristic ride of our day." (4.5/5)</li>
                    <li>"80's livin and I love it!" (5/5)</li>
                </ul>
            </div>

        </section>

        <footer id="footer">
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>

</body>

</html>