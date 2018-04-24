<!DOCTYPE html>

<html>
    <head>
        <title>ACME</title>
        <meta charset="UTF-8">
        <link href="/acme/css/acme.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
            <nav>
                <?php echo $navList; ?> 
            </nav>
            <h1>Welcome to Acme!</h1>
        </header>
        <main>
            <figure class='rocket'>
                <img class='rocketImg' src="images/site/rocketfeature.jpg" alt="A image of Wile E. Coyote using the Acme Rocket.">
                <figcaption class='rocket-text'>
                    <b>Acme Rocket</b>
                    <br>Quick lighting fuse 
                    <br>NHTSA approved seat belts 
                    <br>Mobile launch stand included
                    <a href='/acme/products/?action=viewProd&prodNum=1'><img class='iwantit' src='/acme/images/site/iwantit.gif' alt='buy it button.'></a>
                </figcaption>

            </figure>
            <div class="reviews">
                <h2>Acme Rocket Reviews</h2>

                <ul>
                    <li>"I don't know how I ever caught roadrunners before this."(4/5)</li>
                    <li>"That thing was fast!"(4/5)</li>
                    <li>"Talk about fast delivery."(5/5)</li>
                    <li>"I didn't even have to pull the meat apart"(4.5/5)</li>
                    <li>"I'm on my thirtieth one. I love these things!"(5/5)</li>
                </ul>
            </div>

            <h2>Featured Recipes</h2>
            <div class="recipes">
                <figure class="bbq">
                    <img src='/acme/images/recipes/bbqsand.jpg' alt='Photo Roadrunner BBQ'>
                    <a href='#BBQ'>Pulled Roadrunner BBQ</a>
                </figure>

                <figure class="potpie">
                    <img src='/acme/images/recipes/potpie.jpg' alt='Photo of Roadrunner Pot Pie'>
                    <a href='#PotPie'>Roadrunner Pot Pie</a>
                </figure>

                <figure class="soup">
                    <img src="/acme/images/recipes/soup.jpg" alt='Photo of Roadrunner Soup'>
                    <a href='#Soup'>Roadrunner Soup</a>
                </figure>

                <figure class="tacos">
                    <img src='/acme/images/recipes/taco.jpg' alt="Photo of Roadrunner Tacos">
                    <a href='#Tacos'>Roadrunner Tacos</a>
                </figure>
            </div>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>
    </body>
</html>
