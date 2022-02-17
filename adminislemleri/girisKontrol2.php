<?php
session_start();
if (array_key_exists("ss_kulad", $_SESSION) == false) {
    header("Location:giris.php");
} ?>