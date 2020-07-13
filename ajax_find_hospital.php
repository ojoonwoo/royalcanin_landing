<?php
    include_once "./include/autoload.php";
    $mnv_f 		= new mnv_function();
    $my_db      = $mnv_f->Connect_MySQL();

    $sido       = $_REQUEST['sido'];
    $sigungu    = $_REQUEST['sigungu'];
    $query = "SELECT hospital_name, hospital_addr FROM hospital_list WHERE 1 AND hospital_addr like '%".$sido." ".$sigungu."%'";
    $result = mysqli_query($my_db, $query);

    while($data = mysqli_fetch_array($result)) {
        "<li><button type='button' class='hospi-trigger'><div><span class='chk-shape'></span></div><div><p class='h-name'>".$data['hospital_name']."</p><p class='h-addr'>".$data['hospital_addr']."</p></div></button></li>";

    }
?>