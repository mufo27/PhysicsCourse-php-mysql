<?php 

    
    session_start();
    session_destroy();

    // echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    // echo '<script type="text/javascript">
    //     Swal.fire({
    //     icon: "success",
    //     title: "ออกจะระบบ เรียบร้อย", 
    //     showConfirmButton: false,
    //     timer: 2000
    //     });
    // </script>';
    // echo "<meta http-equiv=\"refresh\" content=\"3; URL=index.php\">";
    // exit;
    

    header( "location:index.php" );

?>