<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shoe Lit Products</title>
    <meta http-equiv="Content-Language" content="en-us" />
    <meta charset="UTF-8">
    <link href="./main.css" rel="stylesheet" type="text/css" />
    <link href="./products.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="./functions.js"></script>
</head>

<body>
    <div id="wrapper">
        <header>
            <h1>SHOE LIT PRODUCTS</h1>
            <nav>
                <?php include 'navigation.php';?>
            </nav>
            <script>
                document.getElementById("productOption").className = "current";
            </script>
        </header>
        <div id="content">
            <h2>PRODUCTS TO HELP YOUR SNEAKERS</h2>
            <p class="content">Nothing could be more important than preventative care for your beloved shoes. Here are all the neccesities for your shoe care needs!</p>

            <div class="item">
                <img src="images/jasonmarkk.jpg" alt="Jason Markk" style="width:100%; height: 400px;">
                <div class="description">
                    <button type="button" onclick="addToCart(1)">ADD TO CART</button>
                    <h3>Jason Markk Cleaner</h3>
                    <p> PRICE: $35</p>
                    <br />
                    <ul>
                        <li>Cleans leather, suade and nubuck</li>
                        <li>Fresh, clean scent</li>
                    </ul>
                </div>
            </div>

            <div class="item">
                <img src="images/shoehorn.jpeg" alt="Shoe Horn" style="width:100%; height: 320px;">
                <div class="description">
                    <button type="button" onclick="addToCart(2)">ADD TO CART</button>
                    <h3>Shoe Horn</h3>
                    <p> PRICE: $15</p>
                    <br />
                    <ul>
                        <li>Allows for easy slip in without damaging the back fo the shoe</li>
                        <li>Stainless Steel</li>
                        <li>Ergonomic design</li>
                
                    </ul>
                </div>
            </div>

            <div class="item">
                <img src="images/shoetree.jpeg" alt="Shoe tree" style="width:100%; height: 320px;">
                <div class="description">
                    <button type="button" onclick="addToCart(3)">ADD TO CART</button>
                    <h3>Shoe Tree</h3>
                    <p> PRICE: $25</p>
                    <br />
                    <ul>
                        <li>Spring loaded design allows for easy on/off</li>
                        <li>Keeps toe boxes looking full</li>
                        <li>Universal Design</li>
                    </ul>
                </div>
            </div>

            <div class="item">
                <img src="images/reshovenator.jpg" alt="Reshovenator" style="width:100%; height: 320px;">
                <div class="description">
                    <button type="button" onclick="addToCart(4)">ADD TO CART</button>
                    <h3>Reshovenator Cleaner</h3>
                    <p> PRICE: $40</p>
                    <br />
                    <ul>
                        <li>Pack includes 3 kinds of brushes for all types of cleaning</li>
                        <li>Fresh citrus smell</li>
                    </ul>
                </div>
            </div>

        </div>
        <footer id="page">
        </footer>
    </div>
</body>

</html>