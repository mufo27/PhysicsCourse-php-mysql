<?php

function getGradeText($x)
{
    switch ($x) {
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

function getPayStatusText($x)
{
    switch ($x) {
        case 0:
            return 'ฟรี';
        case 1:
            return 'ไม่ฟรี';
        default:
            return 'ทั้งหมด';
    }
}

function getStatusText($x)
{
    switch ($x) {
        case 0:
            return 'ปิด';
        case 1:
            return 'เปิด';
        default:
            return 'ทั้งหมด';
    }
}

function getQuizType($x) {
    switch ($x) {
        case 1:
            return 'ปรนัย';
        case 2:
            return 'อัตรนัย';
        default:
            return 'ใช่หรือไม่';
    }
}

function getQuizSide($x) {
    return ($x === 1) ? 'P' : 'K';
}

function getStatusTextInCL($x) {
    return ($x > 0) ? 'ถูกใช้งาน' : 'ไม่ได้ถูกใช้งาน';
}

function getStatusTextInCR($x) {
    return ($x > 0) ? 'มีการลงทะเบียน' : 'ยังไม่มีการลงทะเบียน';
}

function displayMessage($icon, $title, $text, $urlPrefix)
{
    echo '<script type="text/javascript">
            Swal.fire({
            icon: "' . $icon . '",
            title: "' . $title . '",
            text: "' . $text . '"
            });
        </script>';
    echo "<meta http-equiv=\"refresh\" content=\"2; URL=$urlPrefix\">";
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

function checkFileUploadImage($x, $urlPrefix)
{
    if ($_FILES[$x]['tmp_name'] == "") {
        return "";
    }

    $allowedExts = array("jpg", "jpeg", "png", "gif");
    $maxFileSize = 2 * 1024 * 1024; // 2MB

    $temp = explode(".", $_FILES[$x]["name"]);
    $fileSize = $_FILES[$x]['size'];

    // Check if the file is an image
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $fileMimeType = finfo_file($finfo, $_FILES[$x]['tmp_name']);
    finfo_close($finfo);

    if (!in_array($temp[1], $allowedExts) || !preg_match('/^image\//', $fileMimeType)) {
        displayMessage("error", "Error", "ไฟล์ที่อัปโหลดไม่ใช่ ประเภทรูปภาพที่รองรับ เช่น jpg, jpeg, png และ gif", $urlPrefix);
        return "";
    }

    // Check if the file size is within the limit
    if ($fileSize > $maxFileSize) {
        displayMessage("error", "Error", "ไฟล์ที่อัปโหลดมีขนาดเกิน 2MB", $urlPrefix);
        return "";
    }

    // Generate new file name based on current date and time
    $newFileName = $x . '_' . date("YmdHis") . '.' . $temp[1];

    return $newFileName;
}

function checkFileUploadDocument($x, $urlPrefix)
{
    if ($_FILES[$x]['tmp_name'] == "") {
        return "";
    }

    $allowedExts = array("pdf", "docx");
    $maxFileSize = 5 * 1024 * 1024; // 5MB

    $temp = explode(".", $_FILES[$x]["name"]);
    $fileSize = $_FILES[$x]['size'];

    // Check if the file is a document (PDF or DOCX)
    $fileMimeType = mime_content_type($_FILES[$x]['tmp_name']);
    if (!in_array($temp[1], $allowedExts) || !in_array($fileMimeType, ["application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document"])) {
        displayMessage("error", "Error", "ไฟล์ที่อัปโหลดไม่ใช่ ประเภทเอกสารที่รองรับ เช่น PDF และ DOCX", $urlPrefix);
        return "";
    }

    // Check if the file size is within the limit
    if ($fileSize > $maxFileSize) {
        displayMessage("error", "Error", "ไฟล์ที่อัปโหลดมีขนาดเกิน 5MB", $urlPrefix);
        return "";
    }

    // Generate new file name based on current date and time
    $newFileName = $x . '_' . date("YmdHis") . '.' . $temp[1];

    return $newFileName;
}
