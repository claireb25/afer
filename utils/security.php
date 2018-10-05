<?php
    session_start();
    if( !isset( $_SESSION['user'] ) ){
        header("Location: /afer-back");
        die();
    }