<?php

function displayMessage($icon, $title, $text, $url)
{
    echo '<script type="text/javascript">
            Swal.fire({
            icon: "' . $icon . '",
            title: "' . $title . '",
            text: "' . $text . '"
            });
        </script>';
    echo "<meta http-equiv=\"refresh\" content=\"2; URL=$url\">";
    exit;
}

function getGradeText($grade)
{
    switch ($grade) {
        case 1:
            return 'ม.1';
        case 2:
            return 'ม.2';
        case 3:
            return 'ม.3';
        case 4:
            return 'ม.4';
        case 5:
            return 'ม.5';
        case 6:
            return 'ม.6';
        case 7:
            return 'ป.ตรี';
        default:
            return 'ทั้งหมด';
    }
}

function getPayStatusText($grade)
{
    switch ($grade) {
        case 0:
            return 'ฟรี';
        case 1:
            return 'ไม่ฟรี';
        default:
            return 'ทั้งหมด';
    }
}

function getStatusText($grade)
{
    switch ($grade) {
        case 0:
            return 'ปิด';
        case 1:
            return 'เปิด';
        default:
            return 'ทั้งหมด';
    }
}
