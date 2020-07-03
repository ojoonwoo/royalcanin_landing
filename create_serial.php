<?php
    include_once "./include/autoload.php";
    $mnv_f 			= new mnv_function();
    $my_db      = $mnv_f->Connect_MySQL();
    $mobileYN      = $mnv_f->MobileCheck();

    $serial = $mnv_f->create_serial();

    print_r($serial);
?>