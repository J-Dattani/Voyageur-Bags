<?php
if(isset($_SESSION['username']))
{
    header('location: dashboard.php');
}
?>