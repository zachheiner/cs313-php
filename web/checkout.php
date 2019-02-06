<!DOCTYPE html>
<html lang="en">

<head>
    <title>CHECKOUT</title>
    <meta http-equiv="Content-Language" content="en-us" />
    <meta charset="UTF-8">
    <link href="./main.css" rel="stylesheet" type="text/css" />
    <link href="./checkout.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="./functions.js"></script>
</head>

<body onload="enableSubmit(false)">
    <div id="wrapper">
        <header>
        <h1>SHOE LIT CHECKOUT</h1>
        <nav>
                <?php include 'navigation.php';?>
        </nav>
        </header>
        <div id="content">
            <form action="review_order.php" id="checkout_form" method="post">
                <label>First Name *</label><span id="firstNameErr">Required</span>
                <input type="text" name="firstName" id="firstNameInput" onchange="firstNameValidation(this.id);">
                <label>Last Name *</label><span id="lastNameErr">Required</span>
                <input type="text" name="lastName" id="lastNameInput" onchange="lastNameValidation(this.id);">
                <label>Address *</label><span id="address1Err">Required</span>
                <input type="text" name="address1" id="address1Input" onchange="address1Validation(this.id);">
                <label>Address 2</label>
                <input type="text" name="address_line2">
                <label>City *</label><span id="cityErr">City State</span>
                <input type="text" name="city" id="cityInput" onchange="cityValidation(this.id);">
                <label>zip *</label><span id="zipErr">Invalid zip</span>
                <input type="text" name="zip" id="zipInput" onchange="zipValidation(this.id);">
                <label>State *</label><span id="stateErr">Invalid State</span>
                <input type="text" name="state" id="stateInput" onchange="stateValidation(this.id);">
                <label>Email *</label><span id="emailErr">Invalid Email</span>
                <input type="text" name="email" id="emailInput" onchange="emailValidation(this.id);">
                <label>Phone *</label><span id="phoneErr">Invalid Phone</span>
                <input type="text" name="phone" id="phoneInput" onchange="phoneValidation(this.id);">
                <label>Credit card type *</label><span id="creditCardTypeErr">Select a type</span>
                <select name="creditCardType" id="creditCardTypeInput" onchange="creditCardTypeValidation(this.id);">
                    <option value="0">Select...</option>
                    <option value="1">VISA/MASTERCARD</option>
                    <option value="2">AMERICAN EXPRESS</option>
                </select>
                <label>Credit card number *</label><span id="creditCardErr">Invalid credit card number</span>
                <input type="text" name="creditCard" id="creditCardInput" onchange="creditCardValidation(this.id);">
                <label>Expiration Month *</label><span id="expirationMonthErr">Select a month</span>
                <select name="expirationMonth" id="expirationMonthInput" onchange="expirationMonthValidation(this.id);">
                    <option value="0">Select...</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <label>Expiration Year *</label><span id="expirationYearErr">Invalid year format</span>
                <input type="text" name="expirationYear" id="expirationYearInput" onchange="expirationYearValidation(this.id);">
                <input class="enabledButton" type="button" onclick="resetForm()" value="Reset form">
                <input class="disabledButton" id="submit_form" type="submit" value="Submit">
                <br />
                <br />
                <br />
                <label>(*) required</label>
            </form>
        </div>
        <footer id="page">
        </footer>
    </div>
</body>

</html>