<?php

session_start();

$_SESSION = array();
session_destroy();

session_regenerate_id(true);


header("Location: auth-login.php?logout=1");
session_unset("result");
exit();
?>
