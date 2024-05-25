<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Database</title>
    <link rel="stylesheet" href="../public/styles.css">
    <link rel="icon" type="image/x-icon" href="../public/logo.png">
</head>
<body class="db">
    <header>
        <h1>Food DataBase</h1>
    </header>

    <main class="dbmain">
    <div id="sideMenu">
            <br>
            <a href="../Controllers/userProfile_controller.php">User Profile</a>
            <a href="../Controllers/preference_controller.php">Preferences Management</a>
            <a href="../Controllers/shoppinglist_controller.php">Shopping List</a>
            <a href="../Controllers/foodDatabase_controller.php">Food Database</a>
            <a href="../Controllers/statistics_controller.php">Statistics</a>
            <a href="#" id="logoutLink">Logout</a>
            <form id="logoutForm" action="../public/logout.php" method="post">
                <input type="hidden" name="logoutbutton" value="1">
            </form>
        </div>
    <button id="menuButton" >
        &#9776;
    </button>
        <section class="products">
            <article class="product">
                <img src="https://imgproxy-retcat.assets.schwarz/VARZDHCRweYoDDFi0bmcvKrBmU13KJOD2fxykKoJb4k/sm:1/w:1278/h:959/cz/M6Ly9wcm9kLWNhd/GFsb2ctbWVkaWEvcm8vMS9EQUU2QkExNDM3QkVGM0Y4Q0NERTM3M0U/yN0MxQjUyRkI3QjIwNENFMTM0RjY2OEY2NUMzNDEzM0U3N0EyQTEyLmpwZw.jpg" alt="Oats">
                <h2>Oats</h2>
                <p>$1.99</p>
                <button>Add to Cart</button>
            </article>
            <article class="product">
                <img src="https://imgproxy-retcat.assets.schwarz/pGg23cnpQI3uNRG5nGwU6-G2b_r9RhojK_b3psCIw-M/sm:1/w:1278/h:959/cz/M6Ly9wcm9kLWNhd/GFsb2ctbWVkaWEvcm8vMS82Nzk2MUQ3QTgzOEZDNEVBQTU5QkI4QTZ/ENUM4MjQ2MTJDREU2NDhGNTZCRTgyNDI4MDFGMTE1MzQ3ODk5MkQ3LmpwZw.jpg" alt="Chicken">
                <h2>Chicken Breast</h2>
                <p>$5.99</p>
                <button>Add to Cart</button>
            </article>
            <article class="product">
                <img src="https://archivana.com/pics/bc/b8/bcb8ac57e6ec809b93004a1daea04c689ac6cd75.jpg" alt="Rice">
                <h2>Rice</h2>
                <p>$0.99</p>
                <button>Add to Cart</button>
            </article>
            <article class="product">
                <img src="https://archivana.com/pics/d3/d1/d3d194790c4669323f204e19a0f55608b2068d6b.jpg" alt="Blueberries">
                <h2>Blueberries</h2>
                <p>$3.99</p>
                <button>Add to Cart</button>
            </article>
            <article class="product">
                <img src="https://imgproxy-retcat.assets.schwarz/a1opA9QDSDu85hlcnhyXmGn68LHL4EHo0WrL-Q227Kw/sm:1/w:1278/h:959/cz/M6Ly9wcm9kLWNhd/GFsb2ctbWVkaWEvcm8vMS8yMjAyMTM1QkQzM0IxMjgyRkVCM0FEMjY/0NThFOTU3OEU5QUUwMUMyMTNCNjNFQ0U1OTlDMzIzNjQyNkU3REY3LmpwZw.jpg" alt="Milk">
                <h2>Milk</h2>
                <p>$2.99</p>
                <button>Add to Cart</button>
            </article>
            <article class="product">
                <img src="https://imgproxy-retcat.assets.schwarz/5dJFHWTn6aJ5HZ-FKMl3KhcglpGUG4xdfm9q-asv3Kw/sm:1/w:1278/h:959/cz/M6Ly9wcm9kLWNhd/GFsb2ctbWVkaWEvcm8vMS8zNUYzNUMxNTgwMEYwQzE1QzU1NDdFNzI/5NkNGNjBFQTJGNUUyNkYzNzc4NERDMjZDQjdGMUU3NEJBMzRGNUYyLmpwZw.jpg" alt="Tuna">
                <h2>Tuna</h2>
                <p>$1.99</p>
                <button>Add to Cart</button>
            </article>
            <article class="product">
                <img src="https://imgproxy-retcat.assets.schwarz/vJMjNrKGNmmYo70jnb31DQxVKWkLDorof_IB2qTIUJU/sm:1/w:1278/h:959/cz/M6Ly9wcm9kLWNhd/GFsb2ctbWVkaWEvbmwvMS9EN0Q0Rjk1NTE1Njc2MDNCQ0U1NDUwRkQ/1M0NERDlEOTRDRTZFQzlCRkU5RUM3ODFFOUQ5RkNGRDc1NkJDN0IzLmpwZw.jpg" alt="Pasta">
                <h2>Pasta</h2>
                <p>$4.99</p>
                <button>Add to Cart</button>
            </article>
            <article class="product">
                <img src="https://sortiment.lidl.ch/media/catalog/product/cache/38c728e59b3a47950872534eff8a1e63/2/7/2793_PSXX.jpg" alt="Kinder">
                <h2>Kinder Maxi King</h2>
                <p>$1.99</p>
                <button>Add to Cart</button>
            </article>
            <article class="product">
                <img src="https://imgproxy-retcat.assets.schwarz/yVp8xQUCBfdSrrYXnSNyMQp5JKb4efoYnSmxDIARyx4/sm:1/w:1278/h:959/cz/M6Ly9wcm9kLWNhd/GFsb2ctbWVkaWEvcm8vMS85MzEyREQ5MTNGNTAyMDI1QzM3MTc3N0E/5MDMyNDg0RkE3NkQ2QjdDMkFGQjU4QzNDREQ0NUVGNTM4RjkyNDQyLmpwZw.jpg" alt="Bread">
                <h2>Bread</h2>
                <p>$2.99</p>
                <button>Add to Cart</button>
            </article>
            <article class="product">
                <img src="https://imgproxy-retcat.assets.schwarz/y6Etzxcx2IG_oqRnzFLYBg8oYkSlRChyFDPSExGYNHk/sm:1/w:1278/h:959/cz/M6Ly9wcm9kLWNhd/GFsb2ctbWVkaWEvcm8vMS9GRUE0NURDN0U5OTExRTg1Q0RBNTMzMjQ/wM0MwRDIyMzREOEMyREI1NzZBQjMxM0Y0MDExQjVFODJDMTM5MDI4LmpwZw.jpg" alt="Apple Juice">
                <h2>Apple Juice</h2>
                <p>$3.99</p>
                <button>Add to Cart</button>
            </article>
            <article class="product">
                <img src="https://archivana.com/pics/f8/3b/f83bb7db30b0f02ce673cf8f13c8da3f7a58e3de.jpg" alt="Water">
                <h2>Water</h2>
                <p>$1.99</p>
                <button>Add to Cart</button>
            </article>
            <article class="product">
                <img src="https://imgproxy-retcat.assets.schwarz/l3qqWjQVeUejnbyZ0jRDyjGNU_dLti5_ARyD1oty5PU/sm:1/w:1278/h:959/cz/M6Ly9wcm9kLWNhd/GFsb2ctbWVkaWEvcm8vMS9EM0NCMjBFNURBQzg0NzNFNDJGMDY2NTU/3RkM4MTA1QzM3NUJBRkUxOUY3NEMzMjhCNzA5RTg4NkY5Q0UwNEJELmpwZw.jpg" alt="Grapes">
                <h2>Grapes</h2>
                <p>$4.99</p>
                <button>Add to Cart</button>
            </article>
            <article class="product">
                <img src="https://imgproxy-retcat.assets.schwarz/BD-qdTEg2UBWzxFhIVG7e0fIapCkkkxGb5hragZEp_8/sm:1/w:1500/h:1125/cz/M6Ly9wcm9kLWNhd/GFsb2ctbWVkaWEvcm8vMS9BREI5NDhCMDlFRDY2MzU0MTVCQjg3QjE/5QjE0NjY2RDA4ODkxNjgxRUIzN0JBMEM4NDgwNzVFODlBRTdGQTc3LmpwZw.jpg" alt="7Days">
                <h2>7Days</h2>
                <p>$2.99</p>
                <button>Add to Cart</button>
            </article>
            <article class="product">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTIsGvc4JQxKtWunkWOJ-2c5As4b9iNg4untkA67TDFRA&s" alt="Cucumber">
                <h2>Cucumber</h2>
                <p>$4.50</p>
                <button>Add to Cart</button>
            </article>
            <article class="product">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSYc7f6GkhioJjzNgI6O1aDvrO08DxJ17YSd6xmwJ-kbQ&s" alt="Steak">
                <h2>Steak</h2>
                <p>$30.00</p>
                <button>Add to Cart</button>
            </article>
        </section>
    </main>

    <script src="../public/script.js"></script>
    <script>
        document.getElementById('logoutLink').addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('logoutForm').submit();
});
    </script>

</body>
</html>