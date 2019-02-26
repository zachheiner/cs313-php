<?php

session_start();

function verifyLoggedIn() {
  if (!array_key_exists('user', $_SESSION) || !isset($_SESSION['user']) || trim($_SESSION['user']) == '') {
    echo "Not logged in.<br/><br/>Redirecting in 5 seconds.";
    ?>
      <script type="text/javascript">
        setTimeout(function() {
          window.location.href = "./login.php";
        }, 5000);
      </script>
    <?php
    die();
  }  
}

?>
