<?php
include 'lib/session.php';
Session::init();
Session::destroy();
header("Location: login.php");
exit();
?>
