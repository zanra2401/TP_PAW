<?php
    session_start();
    require "../../config.php";
    require "../../fungsi.php";
    if (!isset($_SESSION["user"]) || !isset($_SESSION["role"]))
    {
        header("Location: " . ROOT . "/login.php");
    }

    if ($_SESSION["role"] != "Owner")
    {
        header("Location: " . ROOT . "/index.php");
    }

    if (isset($_GET["id"]))
    {
        deleteUser($_GET['id']);
    }   
    header("Location: " . ROOT . "/DataMaster/User/user.php");