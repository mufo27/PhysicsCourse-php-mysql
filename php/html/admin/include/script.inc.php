<script src="../assets/dist/js/vendors.bundle.js"></script>
<script src="../assets/dist/js/app.bundle.js"></script>
<!-- <script src="../assets/dist/js/notifications/sweetalert2/sweetalert2.bundle.js"></script> -->

<?php include('ckeditor.inc.php'); ?>

<script>
    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }

    var activeParam = getParameterByName('active');

    if (activeParam) {
        var element = document.getElementById(activeParam);
        if (element) {
            element.classList.add('active');
        }
    }

    var title = "ระบบจัดการข้อมูลคอร์สเรียนฟิสิกส์";
    var showTitle = '';

    switch (activeParam) {
        case 'main':
            showTitle = 'หน้าแรก | ' + title;
            break;
        case 'course':
            showTitle = 'คอร์สเรียน  | ' + title;
            break;
        case 'lesson':
            showTitle = 'บทเรียน | ' + title;
            break;
        default:
            showTitle = 'error: Title';
    }

    document.title = showTitle;
</script>