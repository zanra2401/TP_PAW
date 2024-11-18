<?php
session_start();

unset($_SESSION["user"]);
unset($_SESSION["role"]);
session_destroy();
if (!$_SESSION["user"] && !$_SESSION["role"])
{
    header("Location: login.php");
}