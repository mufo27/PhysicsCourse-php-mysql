<?php

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "physics";

        // $servername = "localhost";
        // $username = "u222502990_physics_data1";
        // $password = "4C*=Ay[bhG]j";
        // $database = "u222502990_physics_v1";

        try {

            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password, 
                                array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'")
                            );

                            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            date_default_timezone_set("Asia/Bangkok");
            // echo "Connected successfully";

            

        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            // $e->getMessage();
        }

        function setFor($val){
            if($val === 1){
                $show_for = 'ม.1';
            } else if ($val === 2) {
                $show_for = 'ม.2';
            } else if ($val === 3) {
                $show_for = 'ม.3';
            } else if ($val === 4) {
                $show_for = 'ม.4';
            } else if ($val === 5) {
                $show_for = 'ม.5';
            } else if ($val === 6) {
                $show_for = 'ม.6';
            } else if ($val === 7) {
                $show_for = 'ป.ตรี';
            } else {
                $show_for = 'ทั้งหมด';
            }
    
            return "$show_for";
        }

        function setTyqId($txt1){
            if($txt1 === 1){
                $tyq = 'ปรนัย';
            } else if ($txt1 === 2) {
                $tyq = 'อัตรนัย';
            } else {
                $tyq = 'ใช่หรือไม่';
            }
    
            return "$tyq";
        }

        function setTyaId($txt2){
            if($txt2 === 1){
                $tya = 'ปรนัย';
            } else if ($txt2 === 2) {
                $tya = 'อัตรนัย';
            } else {
                $tya = 'ใช่หรือไม่';
            }
    
            return "$tya";
        }

        function setTyzId($txt3){
            if($txt3 === 1){
                $tyz = 'P';
            } else {
                $tyz = 'K';
            }
    
            return "$tyz";
        }
        
?>


