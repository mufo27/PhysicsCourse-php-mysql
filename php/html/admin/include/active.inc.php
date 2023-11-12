<?php

if (isset($_GET['main'])) {

    $main = 'active';
}


if (isset($_GET['course']) || isset($_GET['course_lesson'])) {

    $course = 'active';
}

if (isset($_GET['lesson']) || isset($_GET['lesson_sub'])) {

    $lessons = 'active';
}

// if (
//     isset($_GET['manage_category']) ||
//     isset($_GET['manage_category_sub']) ||
//     isset($_GET['manage_product']) || isset($_GET['manage_product_img']) ||
//     isset($_GET['manage_product_2']) || isset($_GET['manage_product_img_2']) ||
//     isset($_GET['manage_sell']) || isset($_GET['manage_sell_status']) ||
//     isset($_GET['manage_buy']) || isset($_GET['manage_buy_status']) ||
//     isset($_GET['manage_do_cycle'])
// ) {

//     $manage = 'active';

//     if (isset($_GET['manage_category'])) {

//         $category = 'active';
//     }

//     if (isset($_GET['manage_category_sub'])) {

//         $category_sub = 'active';
//     }

//     if (isset($_GET['manage_product']) || isset($_GET['manage_product_img'])) {

//         $product = 'active';
//     }

//     if (isset($_GET['manage_product_2']) || isset($_GET['manage_product_img_2'])) {

//         $product_2 = 'active';
//     }

//     if (isset($_GET['manage_do_cycle'])) {

//         $do_cycle = 'active';
//     }

// }


// if (isset($_GET['area_zone']) || isset($_GET['area_zone_users'])) {

//     $area_zone = 'active';
// }

// if (isset($_GET['c_order']) || isset($_GET['c_order_details'])) {

//     $c_order = 'active';
// }

// if (isset($_GET['c_payment'])) {

//     $c_payment = 'active';
// }

// if (isset($_GET['c_delivery'])) {

//     $c_delivery = 'active';
// }

// if (isset($_GET['c_product_total_print']) || isset($_GET['c_order_print'])) {

//     $print = 'active';

//     if (isset($_GET['c_product_total_print'])) {

//         $c_product_total_print = 'active';
//     }

//     if (isset($_GET['c_order_print'])) {

//         $c_order_print = 'active';
//     }

// }

// if (isset($_GET['f_order'])) {

//     $f_order = 'active';
// }
