<!DOCTYPE html>
<html lang="en">

<head>
<title>Shoe Lit Products</title>
    <meta http-equiv="Content-Language" content="en-us" />
    <meta charset="UTF-8">
    <link href="./main.css" rel="stylesheet" type="text/css" />
    <link href="./cart.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="./functions.js"></script>
</head>

<body onload="displayShoppingCart()">
    <div id="wrapper">
        <header>
        <h1>SHOE LIT PRODUCTS</h1>
            <nav>
                <?php include 'navigation.php';?>
            </nav>
            <script>
                document.getElementById("shopping-CartOption").className = "current";
            </script>
        </header>
        <div id="content">
            <a id="emptyCart">YOUR CART IS CURRENTLY EMPTY</a>
            <table id="cart_tbl">
                <tr>
                    <th>Amount</th>
                    <th>Test</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th>Total</th>
                    <th id="total_tableCell"></th>
                </tr>
            </table>
            
            <button id="checkout" type="button" onclick="openCheckout()">CHECKOUT</button>
            <button id="checkout" type="button" onclick="location.href='products.php';">Continue Shopping</button>

        </div>
        <footer id="page">
        </footer>
    </div>
</body>

</html>