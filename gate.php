<?php
    include_once "./head.php";

    $serial = $mnv_f->create_serial();

?>
<body>
    <div id="container">
        <div id="header">
            <div class="inner">
                <a href="./index_cat.php" class="logo" onclick="gtag('event', '홈버튼', {'event_category': '게이트페이지', 'event_label': '메인로고'});">
                    <img src="./images/logo.png" alt="로얄캐닌 홈으로">
                </a>
                <nav class="menu">
                    <ul>
                        <li>
                            <a href="index_cat.php#section1" onclick="gtag('event', 'GNB', {'event_category': '게이트페이지', 'event_label': '메인'});">메인</a>
                        </li>
                        <li>
                            <a href="index_cat.php#section2" onclick="gtag('event', 'GNB', {'event_category': '게이트페이지', 'event_label': '주치의 프로젝트'});">주치의 프로젝트</a>
                        </li>
                        <li class="active">
                            <a href="index_cat.php#section3" onclick="gtag('event', 'GNB', {'event_category': '게이트페이지', 'event_label': '주치의력 테스트'});">주치의력 테스트</a>
                        </li>
                        <li>
                            <a href="index_cat.php#section4" onclick="gtag('event', 'GNB', {'event_category': '게이트페이지', 'event_label': '주치의력 업그레이드 TIPS'});">주치의력 업그레이드 TIPS</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="content _sub __gate">
            <div class="inner">
                <?php
                include_once "./sub_header.php";
                ?>
                <div class="title-block">
                    <div class="prj-title">
                        <img src="./images/project_logo.svg" class="project-logo" alt="고양이 주치의 프로젝트">
                        <span class="text">
                            <em>주치의</em><img src="./images/icon_power.png" alt="력" class="icon"><em>테스트</em></span>
                    </div>
                    <div class="subject">
                        반려묘가 보이는 행동으로<br><b>주치의력을 테스트해보세요!</b>
                    </div>
                </div>
                <div class="cat-block">
                    <img src="./images/gate_cat.jpg" alt="고양이">
                </div>
                <div class="input-wrapper">
                    <div class="message">
                        세심한 관찰이 필요한 <b>반려묘 정보를 입력</b>해 주세요.
                    </div>
                    <div class="input-group">
                        <label for="cat-name" class="cat-name-label">반려묘 이름</label>
                        <input type="text" id="cat-name" class="input-text" placeholder="반려묘 이름을 입력해주세요.">
                    </div>
                    <div class="input-group">
                        <label for="cat-age" class="cat-age-label">반려묘 출생년도</label>
                        <select id="cat-age" class="select-box">
                            <option value="2000">2000</option>
                            <option value="2001">2001</option>
                            <option value="2002">2002</option>
                            <option value="2003">2003</option>
                            <option value="2004">2004</option>
                            <option value="2005">2005</option>
                            <option value="2006">2006</option>
                            <option value="2007">2007</option>
                            <option value="2008">2008</option>
                            <option value="2009">2009</option>
                            <option value="2010">2010</option>
                            <option value="2011">2011</option>
                            <option value="2012">2012</option>
                            <option value="2013">2013</option>
                            <option value="2014">2014</option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="" selected>선택해주세요</option>
                        </select>
                        <div class="radio-wrap">
                            <span>최근 1년 내 동물병원에 방문한 적 있나요?</span>
                            <div>
                                <!-- <button type="button" class="fake-radio is-active">Y</button> -->
                                <button type="button" class="fake-radio" onclick="gtag('event', '동물병원 방문여부', {'event_category': '게이트페이지', 'event_label': 'Y'});">Y</button>
                                <button type="button" class="fake-radio" onclick="gtag('event', '동물병원 방문여부', {'event_category': '게이트페이지', 'event_label': 'N'});">N</button>
                            </div>
                        </div>
                    </div>
                    <div class="agree-wrap">
                        <!-- <button type="button" class="chk-trigger">
                            <span class="chk-shape"></span>
                            <span class="text">인정보수집 활용에 동의합니다.</span>
                        </button> -->
                        <button type="button" class="chk-trigger">
                            <span class="chk-shape"></span>
                            <span class="text">개인정보 수집 및 마케팅 활용에 동의합니다. (필수)</span>
                        </button>
                    </div>
                </div>
                <!-- <a href="./checklist.php" class="type-01 go-next" id="go-next">다음으로</a> -->
                <a href="javascript:void(0)" class="type-01 go-next" id="go-next" onclick="gtag('event', '이벤트참여', {'event_category': '게이트페이지', 'event_label': '이벤트참여_게이트'});">다음으로</a>
                <div class="popup _agree" id="agree-popup">
                    <div class="inner">
                        <button type="button" class="popup-close" data-popup="@close"></button>
                        <div class="agree-wrap">
                            <div class="block">
                                <h5>개인 정보 수집 활용 동의</h5>
                                <p>
                                    로얄캐닌코리아(이하 ‘회사’라 칭함) 이벤트 진행을 위한 개인 정보 수집
                                    이용을 위하여 다음과 같이 귀하의 동의를 받고자 합니다.<br />회사는 보다
                                    원활한 서비스 제공을 위하여 고객의 정보를 수집하고 있습니다.<br />고객의
                                    정보는 이벤트 서비스에 참여하기 위한 필수 정보로서 제공을 원하지
                                    않을 경우 수집하지 않으며, 동의 거부 시 이벤트 참여에 제한을 받을 수
                                    있습니다.<br />회사는 본 이벤트를 위하여 다음과 같이 고객님의 개인 정보를
                                    수집 및 이용합니다.<br />> 수집 ∙ 이용 목적 : 이벤트 혜택을 제공하기 위한
                                    정보 전달 : 이벤트 혜택 이용에 따른 본인확인, 고지사항 전달<br />> 수집 필수
                                    항목 : 이름, 휴대 전화번호, 주소<br />> 보유/이용기간 : 이벤트 종료 후 1년까지
                                    (단, 관계 법령에 따라 필요한 경우 해당 법률에서 정한 기간까지)
                                </p>
                            </div>
                            <div class="block">
                                <h5>제 3자 개인 정보 취급 위탁 동의</h5>
                                <p>
                                    로얄캐닌코리아(이하 ‘회사’라 칭함)는 서비스 향상과 원활한 진행을
                                    위하여 개인 정보 처리 업무를 외부 전문 업체에 위탁하여 처리하고
                                    있습니다.<br />고객은 아래와 같은 개인 정보 취급 위탁에 동의하지 않을
                                    권리가 있으며 동의 거부 시 이벤트 참여에 제한을 받을 수 있습니다.<br />> 
                                    취급 위탁업체 / 위탁업무 및 이용목적 : 미니버타이징(주) / 이벤트 대행
                                    및 운영<br />> 취급 위탁업체 / 위탁업무 및 이용목적 : 로얄캐닌 각 협업 
                                    동물병원 지점 / 이벤트 경품 제공 및 서비스 제공<br />> 보유 및 이용기간 : 
                                    이벤트 종료 후 1년까지 (단, 관계 법령에 따라 필요한 경우 해당 법률에서 
                                    정한 기간까지)
                                </p>
                            </div>
                            <div class="block">
                                <h5>마케팅 활용 수신 동의</h5>
                                <p>
                                    로얄캐닌코리아(이하 ‘회사’라 칭함)는 수집된 개인 정보를 이용하여
                                    각종 서비스•상품 및 타사 서비스와 결합된 상품에 대하여 홍보, 가입
                                    권유, 프로모션, 이벤트 목적으로 본인에게 정보/광고를 전화, SMS, 
                                    MMS, 이메일, 우편 등을 통해 전달 합니다.<br />회사는 마케팅 / 홍보를 위하여 
                                    고객의 개인 정보 이용에 동의를 구하며, 동의 거부 시 이벤트 참여와 
                                    이벤트 정보 안내 등 서비스 제한이 있을 수 있습니다.
                                </p>
                            </div>
                            <button type="button" class="type-01" id="btn-confirm" data-popup="@close">확인</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="footer">
                <span class="for-a11y">Copyright © 2020. ROYAL CANIN all rights reserved.</span>
            </div>
        </div>
    </div>
    <script>
        var visit_hospital = "";
        $(document).on('click', '.chk-trigger', function() {
            var $this = $(this);
            if(!$this.hasClass('is-active')) {
                royalcaninCat.popup.show($('#agree-popup'));
            }
            $this.toggleClass('is-active');
        });
        $(document).on('click', '.fake-radio', function() {
            var $this = $(this);
            $('.fake-radio').removeClass('is-active');
            $this.toggleClass('is-active');
            visit_hospital = $this.text();
        });

        $(document).on('click', '#go-next', function() {
            var cat_name = $("#cat-name").val();
            var cat_age = $("#cat-age").val();
            var cat_name = $("#cat-name").val();
            var agree_num = 0;
            $('.chk-trigger').each(function(idx, el) {
                if($(el).hasClass('is-active')) {
                    agree_num++;
                }
            });

            if (cat_name == "") {
                alert("반려묘의 이름을 입력해 주세요.");
                $("#cat-name").focus();
                return false;
            }

            if (cat_age == "") {
                alert("반려묘의 출생연도를 선택해 주세요.");
                return false;
            }

            if (visit_hospital == "") {
                alert("최근 1년 내 동물병원에 방문하신적이 있으신지 선택해 주세요.");
                return false;
            }

            if (agree_num < 1) {
                alert("약관에 모두 동의하셔야만 이벤트에 참여하실 수 있습니다.")
                return false;
            }

            // 데이터 저장
            $.ajax({
                url: "./main_exec.php",
                type: 'POST',
                data: {
                    "exec"          : "insert_cat_data",
                    "cat-name"      : cat_name,
                    "cat-age"       : cat_age,
                    "cat-visit"     : visit_hospital,
                    "cat-serial"    : "<?php echo $serial?>"
                },
                success: function (response) {
                    if (response == "Y") {
                        setTimeout(function() {
                            location.href = "./checklist.php?serial=<?php echo $serial?>";
                        }, 200);
                    }else{

                    }
                },
                error: function(jqXHR, errMsg) {
                    // Handle error
                    console.log(errMsg);
                }
            });
        });
    </script>
</body>
</html>