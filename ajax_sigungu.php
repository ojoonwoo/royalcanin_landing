<?php
    include_once "./include/autoload.php";
    $mnv_f 		= new mnv_function();
    $my_db      = $mnv_f->Connect_MySQL();

    $sido       = $_REQUEST['sido'];
    $query = "SELECT sigungu FROM juso_info WHERE 1 AND sido = '".$sido."' ORDER BY sigungu ASC";
    $result = mysqli_query($my_db, $query);

    echo "<option value='' selected>시/구/군</option>";
    while($data = mysqli_fetch_array($result)) {
        echo "<option value='".$data['sigungu']."'>".$data['sigungu']."</option>";
    }
?>