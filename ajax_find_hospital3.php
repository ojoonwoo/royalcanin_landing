<?php
    include_once "./include/autoload.php";
    $mnv_f 		= new mnv_function();
    $my_db      = $mnv_f->Connect_MySQL();

    $sido       = $_REQUEST['sido'];
    $sigungu    = $_REQUEST['sigungu'];
    $query = "SELECT hospital_name, hospital_addr1, hospital_addr2, hospital_addr3, hospital_addr4, hospital_code FROM hospital_list3 WHERE 1 AND hospital_addr1 like '%".$sido."%' AND hospital_addr2 like '%".$sigungu."%' ORDER BY hospital_addr2 ASC, hospital_addr3 ASC, hospital_name ASC";
    $result = mysqli_query($my_db, $query);
    $total_cnt = mysqli_num_rows($result);

    if ($total_cnt < 1) {
        $query = "SELECT hospital_name, hospital_addr1, hospital_addr2, hospital_addr3, hospital_addr4, hospital_code FROM hospital_list3 WHERE 1 AND hospital_addr1 like '%".$sido."%' ORDER BY hospital_addr2 ASC, hospital_addr3 ASC, hospital_name ASC";
        $result = mysqli_query($my_db, $query);
    }

    $html = "";
    $return_arr = [];
    $i=0;
    while($data = mysqli_fetch_array($result)) {
        if(strpos($data['hospital_addr4'], $data['hospital_addr3']) !== false) {  
            $addr = $data['hospital_addr1']." ".$data['hospital_addr2']." ".$data['hospital_addr4'];
        } else {  
            $addr = $data['hospital_addr1']." ".$data['hospital_addr2']." ".$data['hospital_addr3']." ".$data['hospital_addr4'];
        }  
                
        $html .= "<li><button type='button' class='hospi-trigger' data-code='".$data['hospital_code']."'><div><span class='chk-shape'></span></div><div><p class='h-name'>".$data['hospital_name']."</p><p class='h-addr'>".$addr."</p></div></button></li>";
        $i++;
    }
    $return_arr['html'] = $html;
    $return_arr['cnt'] = $i;

    echo json_encode($return_arr, JSON_UNESCAPED_UNICODE);
?>