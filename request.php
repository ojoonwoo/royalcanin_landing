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
                            <a href="./#section1">메인</a>
                        </li>
                        <li>
                            <a href="./#section2">주치의 프로젝트</a>
                        </li>
                        <li>
                            <a href="./#section3">주치의력 테스트</a>
                        </li>
                        <li>
                            <a href="./#section4">주치의력 업그레이드 TIPS</a>
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
                            <div class="label">
                                <label for="sido">동물병원 찾기</label>
                            </div>
                            <div class="input">
                                <select id="sido" class="select-box">
                                    <option value="" selected>시/도</option>
<?php
    $query = "SELECT sido FROM juso_info WHERE 1 GROUP BY sido";
    $result = mysqli_query($my_db, $query);

    while($data = mysqli_fetch_array($result)) {
?>
                            <option value="<?php echo $data['sido']?>"><?php echo $data['sido']?></option>
<?php        
    }
?>                            
                                </select>
                                <select id="sigugun" class="select-box">
                                    <option value="" selected>시/구/군</option>
                                </select>
                                <button type="button" id="addr-search"><span class="for-a11y">찾기</span></button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <div class="label">
                            </div>
                            <div class="input">
                                <input type="text" class="input-text" id="req-addr" placeholder="내가 선택한 병원" readonly>
                                <p class="guide-msg">* 건강검진권, 헤마츄리아 당첨 시 선택한 동물병원에서만 검진 및 수령이 가능하며 변경이 불가하니 신중하게 선택해주세요.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <div class="label">
                                <label for="req-name">보호자 이름</label>
                            </div>
                            <div class="input">
                                <input type="text" class="input-text" id="req-name" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group _tel">
                            <div class="label">
                                <label for="req-phone1">휴대 전화번호</label>
                            </div>
                            <div class="input">
                                <input type="text" class="input-text" id="req-phone1" placeholder="">
                                <input type="text" class="input-text" id="req-phone2" placeholder="">
                                <input type="text" class="input-text" id="req-phone3" placeholder="">
                                <p class="guide-msg">* 본 무료 건강검진권과 헤마츄리아는 추첨을 통해 제공되며, 추첨은 별개로 진행됩니다.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="javascript:void(0)" class="type-01 go-next" id="go-next">신청 완료</a>
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
                            <p class="sub"><b>총 <em id="hospi-cnt"></em>건</b>이 검색되었습니다.</p>
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
                <div class="popup _complete" id="complete-popup">
                    <div class="inner">
                        <button type="button" class="popup-close" data-popup="@close"></button>
                        <div class="title-block">
                            <img src="./images/project_logo.svg" alt="고양이 주치의 프로젝트" class="project-logo">
                            <p class="sub">
                                반려묘의 더 건강한 삶을 위한<br>건강검진권과 혈뇨검출기가<br>신청되었습니다! 
                            </p>
                        </div>
                        <div class="date-block">
                            <dl>
                                <dt>당첨자 발표일 : </dt>
                                <dd>2020.9.14</dd>
                            </dl>
                            <dl>
                                <dt>안내 방법 : </dt>
                                <dd>당첨되신 분들께는 문자를 통해 개별 안내 드립니다.</dd>
                            </dl>
                        </div>
                        <div class="benefit-area">
                            <ul>
                                <li>
                                    <img src="./images/benefit_img_01.png" alt="10만원 상당의 건강검진권 100명">
                                    <h5>무료 건강검진권</h5>
                                    <p>10만원 상당의 건강검진권이<br> 추첨을 통해 제공됩니다.</p>
                                </li>
                                <li>
                                    <img src="./images/benefit_img_02.png" alt="혈뇨검출 체외진단기 헤마츄리아 디텍션 50명">
                                    <h5>혈뇨검출 체외진단기</h5>
                                    <p>헤마츄리아 디텍션</p>
                                </li>
                            </ul>
                            <div class="noti-img">
                                <img src="./images/section_03_notice.png" alt="필독! 당첨되지 않은 신청자에게는 별도의 공지가 없는 점 양해 부탁드립니다. 본 건강검진권은 지정된 병원에서만 사용이 가능하며, 선택한 병원 이외의 지점에서 사용 불가합니다.">
                            </div>
                        </div>
                        <button type="button" class="type-01" id="btn-complete">확인</button>
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
                if ($("#sido").val() == "") {
                    alert("시/도를 선택해 주세요.");
                    return false;
                }

                if ($("#sigugun").val() == "") {
                    alert("시/구/군을 선택해 주세요.");
                    return false;
                }

                $.ajax({
                    url: "./ajax_find_hospital.php",
                    type: 'POST',
                    data: {
                        "sido"       : $("#sido").val(),
                        "sigungu"    : $("#sigugun").val()
                    },
                    success: function (response) {
                        var res = JSON.parse(response);
                        royalcaninCat.popup.show($('#hospi-popup'));
                        $("#hospi-cnt").text(res.cnt);
                        $(".list-block ul").html(res.html);
                    },
                    error: function(jqXHR, errMsg) {
                        // Handle error
                        console.log(errMsg);
                    }
                });

                // royalcaninCat.popup.show($('#hospi-popup'));
                // }
            });
            $doc.on('change', '#sido', function() {
                $.ajax({
                    url: "./ajax_sigungu.php",
                    type: 'POST',
                    data: {
                        "sido"    : $(this).val()
                    },
                    // data: JSON.stringify(checkedList),
                    success: function (response) {
                        $("#sigugun").html(response);
                    },
                    error: function(jqXHR, errMsg) {
                        // Handle error
                        console.log(errMsg);
                    }
                });
            });
            $doc.on('click', '.go-next', function() {
                console.log("수도권:", sudoYN)
                console.log("병원명:", hospiName);
                console.log("병원주소:", hospiAddr);
                var phoneRule = /^(?:(010-?\d{4})|(01[1|6|7|8|9]-?\d{3,4}))-?\d{4}$/;
                var userName = $('#req-name').val();
                var phoneNumber = $('#req-phone1').val()+$('#req-phone2').val()+$('#req-phone3').val();

                if(userName.trim().length<1) {
                    alert('보호자 이름을 올바르게 입력해주세요!');
                    $('#req-name').focus();
                    return;
                }
                if(!phoneRule.test(phoneNumber)) {
                    alert('휴대 전화번호를 올바르게 입력해주세요!');
                    return;
                }

                // 입력한 정보 저장 & 참여 완료 쿠키 생성

                alert('입력한 정보 저장 & 쿠키 생성');
                setCookie("cathealth_completed","Y","7") //변수, 변수값, 저장기간
                royalcaninCat.popup.show($('#complete-popup'));
            });

            $doc.on('click', '#btn-complete', function() {
                alert('참여가 완료되었습니다!');
                location.href="./index.php#section4";
            });
        });
        
    </script>
</body>
</html>