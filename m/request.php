<?php
    include_once "./head.php";

    include_once "../include/autoload.php";
    $mnv_f 			= new mnv_function();
    $my_db      = $mnv_f->Connect_MySQL();

    $serial = $_GET['serial'];

    $query = "SELECT mb_cat_name FROM member_info WHERE 1 AND mb_serial = '".$serial."'";
    $result = mysqli_query($my_db, $query);

    $cat_info = mysqli_fetch_array($result);
?>
<body>
    <div id="container">
        <div class="content _sub __request">
            <div class="sub-header">
                <a href="javascript:void(0)" id="go-before"></a>
                <a href="./" id="go-index"></a>
            </div>
            <div class="title-block">
                <div class="prj-title">
                    <img src="./images/project_logo.svg" class="project-logo" alt="고양이 주치의 프로젝트">
                    <span class="text">
                        <em>주치의</em><img src="./images/icon_power.png" alt="력" class="icon"><em>테스트</em></span>
                </div>
                <div class="subject">
                    <b><?=$cat_info['mb_cat_name']?>의 건강검진권 신청하기</b>
                </div>
            </div>
            <div class="location-selector">
                <button type="button" class="loc-trigger is-active" data-loc="central">
                    <img src="./images/icon_map_central.png" alt="수도권" class="map">
                    <p>서울, 경기, 인천 지역</p>
                </button>
                <button type="button" class="loc-trigger" data-loc="other">
                    <img src="./images/icon_map_other.png" alt="수도권 외 지역" class="map">
                    <p>서울, 경기, 인천<br><b>그 외 지역</b></p>
                </button>
            </div>
            <div class="input-wrapper">
                <div class="row">
                    <div class="input-group _addr">
                        <label for="sido">병원 찾기</label>
                        <select id="sido" class="select-box">
                            <option value="" selected>시/도</option>
                        </select>
                        <select id="sigugun" class="select-box">
                            <option value="" selected>시/구/군</option>
                        </select>
                        <button type="button" id="addr-search"><span class="for-a11y">찾기</span></button>
                    </div>
                </div>
                <div class="row">
                    <div class="input-group">
                        <input type="text" class="input-text" id="req-addr" placeholder="내가 선택한 병원" readonly>
                        <p class="guide-msg">* 건강검진권, 헤마츄리아 당첨 시 선택한 동물병원에서만 검진 및 수령이 가능합니다.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="input-group">
                        <label for="req-name">보호자 이름</label>
                        <input type="text" class="input-text" id="req-name" placeholder="">
                    </div>
                </div>
                <div class="row">
                    <div class="input-group _tel">
                        <label for="req-phone1">휴대 전화번호</label>
                        <input type="text" class="input-text" id="req-phone1" placeholder="">
                        <input type="text" class="input-text" id="req-phone2" placeholder="">
                        <input type="text" class="input-text" id="req-phone3" placeholder="">
                        <p class="guide-msg">* 본 무료 건강검진권과 헤마츄리아는 추첨을 통해 제공되며, 추첨은 별개로 진행됩니다.</p>
                    </div>
                </div>
            </div>
            <a href="javascript:void(0)" class="type-01 go-next" id="go-next">신청완료</a>
        </div>
        <div id="footer">
            <span class="for-a11y">Copyright © 2020. ROYAL CANIN all rights reserved.</span>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script>
        // serial 없으면 고양이 정보입력으로 튕길것
        var $doc = $(document);
        $doc.ready(function() {
            
        });
        
    </script>
</body>
</html>