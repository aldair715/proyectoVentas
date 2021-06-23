<?php
    session_start();
    if($_SESSION["ingreso"]=="si")
    {

    }
    else
    {
        header("Location:index.php?error=3");
    }
?>