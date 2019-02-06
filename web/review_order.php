<!DOCTYPE html>
<html lang="en">

<head>
    <title>SHOE LIT REVIEW ORDER</title>
    <meta http-equiv="Content-Language" content="en-us" />
    <meta charset="UTF-8">
    <link href="./main.css" rel="stylesheet" type="text/css" />
    <link href="./review_order.css" rel="stylesheet" type="text/css" />
    <link href="./cart.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="./functions.js"></script>
</head>

<body onload="displayOrderReview()">
    <div id="wrapper">
        <header>
            <h1>SHOE LIT REVIEW ORDER</h1>
        </header>
        <div id="content">
            <h2>Purchase review</h2>
            <h3>Your info:</h3>
            <p>
                <?php echo $_POST["firstName"] . " " . $_POST["lastName"]; ?>
            </p>
            <p>
                <?php echo $_POST["address1"]; ?>
            </p>
            <p>
                <?php echo $_POST["address_line2"]; ?>
            </p>
            <p>
                <?php echo $_POST["city"] . " " . $_POST["state"] . " " . $_POST["zip"]; ?>
            </p>
            <p>Phone:
                <?php echo $_POST["phone"]; ?>
            </p>
            <p>E-mail:
                <?php echo $_POST["email"]; ?>
            </p>
            <h3>Your payment:</h3>
            <p>Credit card type:
                <?php 
        $type = $_POST["creditCardType"];
        switch($type) {
          case "1":
            echo "VISA/MASTERCARD";
            break;
          case "2":
            echo "AMERICAN EXPRESS";
            break;
          default:
            break;
        }
        ?>
            </p>
            <p>Credit card number:
                <?php echo $_POST["creditCard"]; ?>
            </p>
            <p>Expiration:
                <?php 
        $month = $_POST["expirationMonth"];
        $year = $_POST["expirationYear"];
        switch($month) {
          case "1":
            echo "January" . " " . $year;
            break;
          case "2":
            echo "February" . " " . $year;
            break;
          case "3":
            echo "March" . " " . $year;
            break;
          case "4":
            echo "April" . " " . $year;
            break;
          case "5":
            echo "May" . " " . $year;
            break;
          case "6":
            echo "June" . " " . $year;
            break;
          case "7":
            echo "July" . " " . $year;
            break;
          case "8":
            echo "August" . " " . $year;
            break;
          case "9":
            echo "September" . " " . $year;
            break;
          case "10":
            echo "October" . " " . $year;
            break;
          case "11":
            echo "November" . " " . $year;
            break;
          case "12":
            echo "December" . " " . $year;
            break;
          default:
            break;
        }
        ?>
            </p>
            <h3>Your items:</h3>
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
            <br />
            <form action="confirmation.php" id="confirmation_form" method="post">
                <?php
          // add client info as hidden fields
          foreach ($_POST as $a => $b) {
            echo '<input type="hidden" name="'.htmlentities($a).'" value="'.htmlentities($b).'">';
          }
          // add items from cookies as hidden fields
          foreach ($_COOKIE as $a => $b) {
            echo '<input type="hidden" name="'.htmlentities($a).'" value="'.htmlentities($b).'">';
          }
        ?>
                    <input type="submit" name="confirm" alt="Confirm" value="Confirm" id="confirm" />
                    <input type="submit" name="cancel" alt="Cancel" value="Cancel" /> </form>
        </div>
        <footer id="page">
        </footer>
    </div>
</body>

</html>