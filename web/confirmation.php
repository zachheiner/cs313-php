<!DOCTYPE html>
<html lang="en">

<head>
    <title>SHOE LIT CONFIRMATION</title>
    <meta http-equiv="Content-Language" content="en-us" />
    <meta charset="UTF-8">
    <link href="./main.css" rel="stylesheet" type="text/css" />
    <link href="./checkout.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="./functions.js"></script>
</head>

<body>
    <div id="wrapper">
        <header>
        <h1>SHOE LIT CONFIRMATION</h1>
        </header>
        <div id="content">
            <?php
        if (isset($_POST['confirm'])) {
          echo '<script type="text/javascript">',
               'deleteCookies();',
               '</script>';
          echo "<h2>Your order is accepted</h2>";
          echo "<p>Please allow 48 hours for the items to ship.</p>";
        } elseif (isset($_POST['cancel'])) {
          echo "<h2>Your order was canceled</h2>";
          echo "<p>Continue shopping...</p>";
        }
      ?>
                <br />
                <br /> </div>
        <footer id="page">
        </footer>
    </div>
</body>

</html>