<?php

$select_data = $conn->prepare("SELECT * FROM web_data");
$select_data->execute();
$row_data = $select_data->fetch(PDO::FETCH_ASSOC);

?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<meta name="generator" content="Hugo 0.84.0">
<title><?= $row_data['wn_name']; ?></title>

<link rel="icon" type="image/x-icon" href="../admin/web-name/upload/<?= $row_data['wn_logo']; ?>" />
<link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/offcanvas-navbar/">

<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap icons-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
<!-- font google -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">

<style type="text/css">
    body {
        font-family: 'Kanit', sans-serif;
        font-size: 16px;
    }

    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    /* .navbar {
        min-height: 75px;
    } */

    .dropdown:hover .dropdown-menu {
        display: block;
        margin-top: 0;
    }

    .bg-gradient-primary-to-secondary {
        background: linear-gradient(45deg, #9f1ae2, #2937f0) !important;
    }

    /* .bg-purple {
        background: #9f1ae2 !important;
    } */

    .bg-black {
        background-color: #000 !important;
    }

    /* .container {
            max-width: 960px;
            margin: 0 auto;
            position: relative;
        }

        .items {
            border: 1px solid #eee;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
        }

        .owl-prev {
            position: absolute;
            top: 150px;
            left: -50px;
        }
        .owl-next {
            position: absolute;
            top: 150px;
            right: -50px;
        }
        .owl-prev span, .owl-next span {
            font-size: 5rem;
        } */

</style>

<link href="../assets/dist/css/offcanvas.css" rel="stylesheet">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- <link rel="stylesheet" href="OwlCarousel2/dist/assets/owl.carousel.min.css">
<link rel="stylesheet" href="OwlCarousel2/dist/assets/owl.theme.default.min.css"> -->