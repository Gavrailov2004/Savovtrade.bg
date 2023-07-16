<?php
session_start();
$conn = mysqli_connect("localhost:3305", "root", "", "savovdata");
$_SESSION = [];
session_unset();
session_destroy();
header("Location: home.html");?>