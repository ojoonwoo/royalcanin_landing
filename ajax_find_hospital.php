<?php
    include_once "./include/autoload.php";
    $mnv_f 		= new mnv_function();
    $my_db      = $mnv_f->Connect_MySQL();

    $sido       = $_REQUEST['sido'];
    $sigungu    = $_REQUEST['sigungu'];
    $query = "SELECT hospital_name, hospital_addr FROM hospital_list WHERE 1 AND hospital_addr like '%".$sido." ".$sigungu."%' ORDER BY hospital_name ASC";
    $result = mysqli_query($my_db, $query);
    $total_cnt = mysqli_num_rows($result);

    if ($total_cnt < 1) {
        $query = "SELECT hospital_name, hospital_addr FROM hospital_list WHERE 1 AND hospital_addr like '%".$sido."%' ORDER BY hospital_name ASC";
        $result = mysqli_query($my_db, $query);
    }

    $html = "";
    $return_arr = [];
    $i=0;
    while($data = mysqli_fetch_array($result)) {
        $html .= "<li><button type='button' class='hospi-trigger'><div><span class='chk-shape'></span></div><div><p class='h-name'>".$data['hospital_name']."</p><p class='h-addr'>".$data['hospital_addr']."</p></div></button></li>";
        $i++;
    }
    $return_arr['html'] = $html;
    $return_arr['cnt'] = $i;

    echo json_encode($return_arr, JSON_UNESCAPED_UNICODE);
?>