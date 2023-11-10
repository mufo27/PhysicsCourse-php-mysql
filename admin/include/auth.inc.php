<?php
    session_start();

    if (isset($_SESSION['id']) === "") {
    
        echo "<meta http-equiv=\"refresh\" content=\"0; URL=../../index.php\">";
        exit();
    }
?>
