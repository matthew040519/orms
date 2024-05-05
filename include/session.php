<?php

    include('../include/connection.php');
    session_start();

    if($_SESSION['role'] == 2)
    {
        session_destroy();
        header('location: ../index.php');
    }

    // echo $_SESSION['role'];

    if(!$_SESSION['loggedin']){

        session_destroy();

        header('location: ../index.php');
    }

