<?php
    include_once "./head.php";

    $serial = $mnv_f->create_serial();
?>
<body>
    <div id="container">
        <div class="content _sub __coupon">
            <div class="title-block">
                <div class="prj-title">
                    <img src="./images/project_logo.svg" class="project-logo" alt="고양이 주치의 프로젝트">
                    <span class="text">
                        <em>주치의</em><img src="./images/icon_power.png" alt="력" class="icon"><em>테스트</em>
                    </span>
                </div>
                <div class="subject">
                    건강검진권 모바일 쿠폰
                </div>
                <div class="sub-title">
                    반려묘에게<br /><b>건강함을 선물하세요</b>
                </div>
            </div>
            <div class="cat-block">
                <img src="./images/coupon_gift_1.png" alt="10만원 상당 건강검진 상품권">
            </div>
            <div class="info-block">
                <dl>
                    <dt>쿠폰 혜택</dt>
                    <dd>건강검진 10만원권</dd>
                </dl>
                <dl>
                    <dt>사용 기간</dt>
                    <dd>2020.9.15 ~ 2020.12.31</dd>
                </dl>
                <dl>
                    <dt>사용 가능 병원</dt>
                    <dd>000 동물 병원</dd>
                </dl>
            </div>
            <a href="javascript:void(0)" class="type-01 go-next" id="go-next" onclick="gtag('event', '이벤트참여', {'event_category': '게이트페이지', 'event_label': '이벤트참여_게이트'});">다음으로</a>
        </div>
        <div id="footer">
            <span class="for-a11y">Copyright © 2020. ROYAL CANIN all rights reserved.</span>
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
                alert("약관에 동의하셔야만 이벤트에 참여하실 수 있습니다.")
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
                        console.log('error');
                        alert("참여자가 많아 접속이 지연되고 있습니다. 다시 시도해 주세요!")
                        location.reload();
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