<?php

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

function generatePagination($currentPage, $totalPages, $cal_per_page, $cal_total_records, $urlPrefix)
{
    echo '<div class="row mt-3">';
    echo '<div class="col-sm-12 col-md-5">';
    echo '<div class="dataTables_info">';
    echo 'กำลังแสดง ' . (($currentPage - 1) * $cal_per_page) + 1 . ' ถึง ' . min($currentPage * $cal_per_page, $cal_total_records) . ' จาก ' . $cal_total_records . ' รายการ';
    echo '</div>';
    echo '</div>';
    echo '<div class="col-sm-12 col-md-7">';
    echo '<nav aria-label="Page navigation example">';
    echo '<ul class="pagination justify-content-end">';

    // Previous page
    if ($currentPage > 1) {
        echo '<li class="page-item">';
        echo '<a class="page-link" href="' . $urlPrefix . '&page=' . ($currentPage - 1) . '" tabindex="-1" aria-disabled="true">ก่อนหน้า</a>';
        echo '</li>';
    } else {
        echo '<li class="page-item disabled">';
        echo '<a class="page-link" href="#" tabindex="-1" aria-disabled="true">ก่อนหน้า</a>';
        echo '</li>';
    }

    // Page numbers
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<li class="page-item ' . ($i == $currentPage ? 'active' : '') . '">';
        echo '<a class="page-link" href="' . $urlPrefix . '&page=' . $i . '">';
        echo $i;
        if ($i == $currentPage) {
            echo '<span class="sr-only">(current)</span>';
        }
        echo '</a>';
        echo '</li>';
    }

    // Next page
    if ($currentPage < $totalPages) {
        echo '<li class="page-item">';
        echo '<a class="page-link" href="' . $urlPrefix . '&page=' . ($currentPage + 1) . '">ถัดไป</a>';
        echo '</li>';
    } else {
        echo '<li class="page-item disabled">';
        echo '<a class="page-link" href="#" tabindex="-1" aria-disabled="true">ถัดไป</a>';
        echo '</li>';
    }

    echo '</ul>';
    echo '</nav>';
    echo '</div>';
    echo '</div>';
}