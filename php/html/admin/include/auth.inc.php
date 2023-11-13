<?php
session_start();

if (isset($_SESSION['id']) === "") {

    echo "<meta http-equiv=\"refresh\" content=\"0; URL=../../index.php\">";
    exit();
}

// if (empty($_SESSION['id'])) {
//     redirectToIndex();
// }

// function redirectToIndex() {
//     echo "<meta http-equiv=\"refresh\" content=\"0; URL=../../index.php\">";
//     exit();
// }