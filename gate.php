<?php
    include_once "./head.php";

    $serial = $mnv_f->create_serial();

    // print_r($serial);
?>
<body>
    <!-- Google Tag Manager (noscript) -->

    <!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5TSHTM5"

    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->

    <!-- End Google Tag Manager (noscript) -->
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
                            <a href="javascript:void(0)" data-url="#section2">주치의 프로젝트</a>
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
        <div class="content _sub __gate">
            <div class="inner">
                <div class="sub-header">
                    <a href="javascript:history.back()" id="go-before"></a>
                    <a href="./" id="go-index"></a>
                </div>
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
                        세심한 관찰이 필요한<br><b>반려묘 정보를 입력</b>해 주세요
                    </div>
                    <div class="input-group">
                        <label for="cat-name">반려묘 이름</label>
                        <input type="text" id="cat-name" class="input-text" placeholder="반려묘 이름을 입력해주세요.">
                    </div>
                    <div class="input-group">
                        <label for="cat-age">반려묘 출생년도</label>
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
                            <option value="2020">2020</option>
                            <option value="" selected>선택해주세요</option>
                        </select>
                    </div>
                    <div class="radio-wrap">
                        <span>최근 1년 내 동물병원에 방문한 적 있나요?</span>
                        <div>
                            <!-- <button type="button" class="fake-radio is-active">Y</button> -->
                            <button type="button" class="fake-radio">Y</button>
                            <button type="button" class="fake-radio">N</button>
                        </div>
                    </div>
                    <div class="agree-wrap">
                        <button type="button" class="chk-trigger">
                            <span class="chk-shape"></span>
                            <span class="text">개인정보수집 활용에 동의합니다.</span>
                        </button>
                        <button type="button" class="chk-trigger">
                            <span class="chk-shape"></span>
                            <span class="text">마케팅 활용에 동의합니다.</span>
                        </button>
                    </div>
                </div>
                <!-- <a href="./checklist.php" class="type-01 go-next" id="go-next">다음으로</a> -->
                <a href="javascript:void(0)" class="type-01 go-next" id="go-next">다음으로</a>
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
                alert("최근 1년내 동물병원에 방문하신적이 있으신지 선택해 주세요.");
                return false;
            }

            if (agree_num < 2) {
                alert("약관에 모두 동의하셔야만 이벤트에 참여하실 수 있습니다.")
                return false;
            }

            // 데이터 저장
            $.ajax({
                url: "../main_exec.php",
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