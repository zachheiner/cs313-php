function key(index) {
  switch (index) {
    case 1:
      return "Jason Markk Cleaner";

    case 2:
      return "Shoe Horn";

    case 3:
      return "Shoe Tree";

    case 4:
      return "Reshovenator cleaner";
  }
}

function price(index) {
  switch (index) {
    case 1:
      return 35;

    case 2:
      return 15;

    case 3:
      return 25;

    case 4:
      return 40;
  }
}

function createCookie(name, value, days) {
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    var expires = "; expires=" + date.toGMTString();
  } else var expires = "";
  console.log(name);
  document.cookie = name + "=" + value + expires + "; path=/";
}

function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
}

function eraseCookie(name) {
  createCookie(name, "", -1);
}

function updateCookie(name, value) {
  var cvalue = parseInt(readCookie(name)) || 0;
  cvalue += value;
  if (cvalue < 0) {
    cvalue = 0;
  }
  createCookie(name, cvalue, 1);
}

function addToCart(item) {
  var cKey = key(item);
  var cvalue = parseInt(readCookie(cKey)) || 0;
  createCookie(cKey, cvalue + 1, 1);
}

function toUSD(number) {
  var number = number.toString(),
    dollars = number.split('.')[0],
    cents = (number.split('.')[1] || '') + '00';
  dollars = dollars.split('').reverse().join('')
    .replace(/(\d{3}(?!$))/g, '$1,')
    .split('').reverse().join('');
  return '$' + dollars + '.' + cents.slice(0, 2);
}

function insertRow(amount, test, price, editable) {
  var table = document.getElementById("cart_tbl");
  var row = table.insertRow(1);
  var tableCell0 = row.insertCell(0);
  var tableCell1 = row.insertCell(1);
  var tableCell2 = row.insertCell(2);
  var tableCell3 = row.insertCell(3);
  tableCell0.innerHTML = amount;
  tableCell1.innerHTML = test;
  tableCell2.innerHTML = toUSD(price);
  tableCell3.innerHTML = toUSD(amount * price);
  if (editable) {
    var addBtn = document.createElement("BUTTON");
    var addText = document.createTextNode("+");
    addBtn.appendChild(addText);
    var rmvBtn = document.createElement("BUTTON");
    var rmvText = document.createTextNode("-");
    rmvBtn.appendChild(rmvText);
    addBtn.onclick = function () {
      updateCookie(test, 1);
      amount = readCookie(test)
      tableCell0.innerHTML = amount;
      tableCell0.appendChild(addBtn);
      tableCell0.appendChild(rmvBtn);
      tableCell3.innerHTML = toUSD(amount * price);
      updateTotal();
    };
    rmvBtn.onclick = function () {
      updateCookie(test, -1);
      amount = readCookie(test)
      tableCell0.innerHTML = readCookie(test);
      tableCell0.appendChild(addBtn);
      tableCell0.appendChild(rmvBtn);
      tableCell3.innerHTML = toUSD(amount * price);
      updateTotal();
    };
    tableCell0.appendChild(addBtn);
    tableCell0.appendChild(rmvBtn);
  }
}

function checkItemIndex(index, editable) {
  var cKey = key(index);
  var cvalue = parseInt(readCookie(cKey)) || 0;
  if (editable || (!editable && cvalue > 0)) {
    insertRow(cvalue, cKey, price(index), editable);
  }
}

function total(index) {
  var test = key(index);
  var amount = parseInt(readCookie(test)) || 0;
  return amount * price(index);
}

function totalCost() {
  var total_cost = total(1);
  total_cost += total(2);
  total_cost += total(3);
  total_cost += total(4);
  return total_cost;
}

function updateTotal() {
  var total_tableCell = document.getElementById("total_tableCell");
  var total_cost = totalCost();
  total_tableCell.innerHTML = toUSD(total_cost);

  var visibility = "hidden";
  if (total_cost > 0) {
    visibility = "visible";
  }
}

function displayShoppingCart() {
  checkItemIndex(4, true);
  checkItemIndex(3, true);
  checkItemIndex(2, true);
  checkItemIndex(1, true);
  updateTotal();

  var total_cost = totalCost();
  if (total_cost > 0) {
    document.getElementById("cart_tbl").style.visibility = "visible";
    document.getElementById("emptyCart").style.visibility = "hidden";
  } else {
    document.getElementById("cart_tbl").style.visibility = "hidden";
    document.getElementById("emptyCart").style.visibility = "visible";
  }
}

function displayOrderReview() {
  checkItemIndex(4, false);
  checkItemIndex(3, false);
  checkItemIndex(2, false);
  checkItemIndex(1, false);
  updateTotal();
}

var valid = 0;

function openCheckout() {
  window.open("checkout.php", "_self");
  valid = 0;
}

function deleteCookies() {
  eraseCookie(key(1));
  eraseCookie(key(2));
  eraseCookie(key(3));
  eraseCookie(key(4));
}

function resetForm() {
  document.getElementById("checkout_form").reset();
  enableSubmit(false);
}

function enableSubmit(enabled) {
  var btn = document.getElementById("submit_form")
  if (enabled === true) {
    btn.className = "enabledButton";
  } else {
    btn.className = "disableButton";
  }
  btn.disabled = !enabled;
}

function checkForValidity(number, x, n) {
  number ^= (-x ^ number) & (1 << n);
  return number;
}

function validation(id, pattern) {
  var input = document.getElementById(id).value;
  var test = pattern.test(input);
  var visibility = "hidden";
  if (test == false) {
    visibility = "visible";
  }
  document.getElementById(id.replace("Input", "Err")).style.visibility = visibility;
  return test
}

function firstNameValidation(id) {
  var a = validation(id, /^\s*[a-zA-Z]{3,}\s*$/);
  valid = checkForValidity(valid, a, 0);
  enableSubmit(valid == 4095);
}

function lastNameValidation(id) {
  var a = validation(id, /^\s*[a-zA-Z]{3,}\s*$/);
  valid = checkForValidity(valid, a, 1);
  enableSubmit(valid == 4095);
}

function address1Validation(id) {
  var a = validation(id, /^\s*\d{1,5}\s(\w\s*)*$/);
  valid = checkForValidity(valid, a, 2);
  enableSubmit(valid == 4095);
}

function cityValidation(id) {
  var a = validation(id, /^\s*[a-zA-Z]{3,}\s*$/);
  valid = checkForValidity(valid, a, 3);
  enableSubmit(valid == 4095);
}

function zipValidation(id) {
  var a = validation(id, /^\s*\d{5}\s*$/);
  valid = checkForValidity(valid, a, 4);
  enableSubmit(valid == 4095);
}

function stateValidation(id) {
  var a = validation(id, /^\s*(A[LKSZRAEP]|C[AOT]|D[EC]|F[LM]|G[AU]|HI|I[ADLN]|K[SY]|LA|M[ADEHINOPST]|N[CDEHJMVY]|O[HKR]|P[ARW]|RI|S[CD]|T[NX]|UT|V[AIT]|W[AIVY])\s*$/);
  valid = checkForValidity(valid, a, 5);
  enableSubmit(valid == 4095);
}

function emailValidation(id) {
  var a = validation(id, /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i);
  valid = checkForValidity(valid, a, 6);
  enableSubmit(valid == 4095);
}

function phoneValidation(id) {
  var a = validation(id, /^\s*(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}\s*$/);
  valid = checkForValidity(valid, a, 7);
  enableSubmit(valid == 4095);
}

function creditCardTypeValidation(id) {
  var a = validation(id, /^[12]$/);
  valid = checkForValidity(valid, a, 8);
  enableSubmit(valid == 4095);
}

function creditCardValidation(id) {
  var type = document.getElementById("creditCardTypeInput").value;
  var a
  if (type == 1) {
    a = validation(id, /^\s*\d{4}\s?\d{4}\s?\d{4}\s?\d{4}\s*$/);
  } else if (type == 2) {
    a = validation(id, /^\s*\d{4}\s?\d{6}\s?\d{5}\s*$/);
  }
  valid = checkForValidity(valid, a, 9);
  enableSubmit(valid == 4095);
}

function expirationMonthValidation(id) {
  var a = validation(id, /^([123456789]|1[012])$/);
  valid = checkForValidity(valid, a, 10);
  enableSubmit(valid == 4095);
}

function expirationYearValidation(id) {
  var a = validation(id, /^\s*\d{4}\s*$/);
  valid = checkForValidity(valid, a, 11);
  enableSubmit(valid == 4095);
}