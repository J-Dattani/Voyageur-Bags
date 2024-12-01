<?php
if(!isset($_SESSION['username']))
{
    header('location: auth-login.php');
}
?>