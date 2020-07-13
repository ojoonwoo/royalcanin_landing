<?php
    include_once "./head.php";

    include_once "./include/autoload.php";
    $mnv_f 			= new mnv_function();
    $my_db      = $mnv_f->Connect_MySQL();

    $serial = $_GET['serial'];

    $query = "SELECT mb_cat_name FROM member_info WHERE 1 AND mb_serial = '".$serial."'";
    $result = mysqli_query($my_db, $query);

    $cat_info = mysqli_fetch_array($result);
?>
<body>
    <div id="container">
        <div id="header">
            <div class="inner">
                <a href="./" class="logo">
                    <img src="./images/logo.png" alt="로얄캐닌 홈으로">
                </a>
                <nav class="menu">
                    <ul>
                        <li class="active">
                            <a href="javascript:void(0)" data-url="#section1">메인</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" data-url="#section2">주치의 프로젝트</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" data-url="#section3">주치의력 테스트</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" data-url="#section4">주치의력 업그레이드 TIPS</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="content _sub __request">
            <div class="inner">

                <div class="sub-header">
                    <a href="javascript:void(0)" id="go-before"></a>
                    <a href="./" id="go-index"></a>
                </div>
                <div class="title-block">
                    <div class="prj-title">
                        <img src="./images/project_logo.svg" class="project-logo" alt="고양이 주치의 프로젝트">
                        <span class="text">
                            <em>주치의</em><img src="./images/icon_power.png" alt="력" class="icon"><em>테스트</em>
                        </span>
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
                    <p class="tip">
                        <span>병원선택 tip</span><em>보다 편안한 반려묘와의 병원 방문을 위해 가까운 병원을 추천합니다.</em>
                    </p>
                    <div class="row">
                        <div class="input-group _addr">
                            <label for="sido">동물병원 찾기</label>
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
                            <p class="guide-msg">* 건강검진권, 헤마츄리아 당첨 시 선택한 동물병원에서만 검진 및 수령이 가능하며 변경이 불가하니 신중하게 선택해주세요.</p>
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
                <div class="popup _req" id="other-popup">
                    <div class="inner">
                        <button type="button" class="popup-close" data-popup="@close"></button>
                        <div class="title-block">
                            <p class="title">가까운 병원을 검색해 선택해주세요!</p>
                        </div>
                        <div class="guide-icon">
                            <img src="./images/naver_search_guide.png" alt="">
                        </div>
                        <a href="https://map.naver.com/v5/search/" class="naver-search" target="_blank">
                            <img src="./images/button_naver.png" alt="네이버에서 가까운 동물병원 찾기">
                        </a>
                        <div class="input-wrapper">
                            <div class="input-group">
                                <label for="nv-h-name">동물병원 명</label>
                                <input type="text" id="nv-h-name" class="input-text" placeholder="동물병원 명을 기입해 주세요.">
                            </div>
                            <div class="input-group">
                                <label for="nv-h-name">동물병원 주소</label>
                                <input type="text" id="nv-h-addr" class="input-text" placeholder="복사한 동물병원 주소를 붙여넣어 주세요.">
                            </div>
                        </div>
                        <button type="button" class="type-01 hospi-select">입력 완료</button>
                        <p class="guide-msg">* 병원 선택 전, 해당 주소지가 맞는지 확인해주세요!</p>
                    </div>
                </div>
                <div class="popup _req" id="hospi-popup">
                    <div class="inner">
                        <button type="button" class="popup-close" data-popup="@close"></button>
                        <div class="title-block">
                            <p class="title">가까운 동물병원에서 쉽게 진단 받으세요!</p>
                            <p class="sub"><b>총 <em>?</em>건</b>이 검색되었습니다.</p>
                        </div>
                        <div class="list-block">
                            <ul>
                                <li>
                                    <button type="button" class="hospi-trigger">
                                        <div>
                                            <span class="chk-shape"></span>
                                        </div>
                                        <div>
                                            <p class="h-name">로얄 동물병원</p>
                                            <p class="h-addr">주소주소주소주소주소주소주소주소주소주소주소주소주소주소주소주소</p>
                                        </div>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="hospi-trigger">
                                        <div>
                                            <span class="chk-shape"></span>
                                        </div>
                                        <div>
                                            <p class="h-name">로얄 동물병원</p>
                                            <p class="h-addr">주소주소주소주소주소주소주소주소주소주소주소주소주소주소주소주소</p>
                                        </div>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="hospi-trigger">
                                        <div>
                                            <span class="chk-shape"></span>
                                        </div>
                                        <div>
                                            <p class="h-name">로얄 동물병원</p>
                                            <p class="h-addr">주소주소주소주소주소주소주소주소주소주소주소주소주소주소주소주소</p>
                                        </div>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="hospi-trigger">
                                        <div>
                                            <span class="chk-shape"></span>
                                        </div>
                                        <div>
                                            <p class="h-name">로얄 동물병원</p>
                                            <p class="h-addr">주소주소주소주소주소주소주소주소주소주소주소주소주소주소주소주소</p>
                                        </div>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="hospi-trigger">
                                        <div>
                                            <span class="chk-shape"></span>
                                        </div>
                                        <div>
                                            <p class="h-name">로얄 동물병원</p>
                                            <p class="h-addr">주소주소주소주소주소주소주소주소주소주소주소주소주소주소주소주소</p>
                                        </div>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <button type="button" class="type-01 hospi-select">선택 완료</button>
                        <p class="guide-msg">* 병원 선택 전, 해당 주소지가 맞는지 확인해주세요!</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer">
            <span class="for-a11y">Copyright © 2020. ROYAL CANIN all rights reserved.</span>
        </div>
    </div>
    <script>
        // serial 없으면 고양이 정보입력으로 튕길것
        var $doc = $(document);
        var hospiName = "";
        $doc.ready(function() {
            $doc.on('click', '.loc-trigger', function() {
                var $this = $(this);
                var location = $(this).attr('data-loc');
                if($this.hasClass('is-active')) {
                    return;
                }
                $('.loc-trigger').not($this).removeClass('is-active');
                $this.addClass('is-active');

                if(location=='other') {
                    royalcaninCat.popup.show($('#other-popup'));
                }
            });
            $doc.on('click', '.hospi-trigger', function() {
                var $this = $(this);
                $('.hospi-trigger').not($this).removeClass('is-active');
                $this.toggleClass('is-active');
            });
            $doc.on('click', '.hospi-select', function() {
                var popupId = $(this).closest('.popup').attr('id');
                var act = "";
                if(popupId == 'hospi-popup') {
                    act = "선택";
                    hospiName = $('.hospi-trigger.is-active').find('.h-name').text();
                    hospiAddr = $('.hospi-trigger.is-active').find('.h-addr').text();
                } else {
                    act = "입력";
                    hospiName = $('#nv-h-name').val();
                    hospiAddr = $('#nv-h-addr').val();
                }

                if(hospiName.length>0 && hospiAddr.length>0) {
                    royalcaninCat.popup.close($('#'+popupId));
                } else {
                    alert("병원정보를 "+act+"해주세요!");
                    return;
                }
            });
            $doc.on('click', '#addr-search', function() {
                // 주소검색 ajax callback {
                royalcaninCat.popup.show($('#hospi-popup'));
                // }
            });
        });
        
    </script>
</body>
</html>