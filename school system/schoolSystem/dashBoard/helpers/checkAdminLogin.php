<?php
if(!isset($_SESSION['userData']))
{
    header("location:/group14/schoolSystem/dashBoard/adminLogIn.php");
    exit;
}

?>