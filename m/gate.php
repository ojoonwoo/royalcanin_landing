<?php
    include_once "./head.php";
?>
<body>
    <!-- Google Tag Manager (noscript) -->

    <!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5TSHTM5"

    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->

    <!-- End Google Tag Manager (noscript) -->
    <div id="container">
        <div class="content _sub __gate">
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
                        <option value="2020" selected>2020</option>
                    </select>
                </div>
                <div class="radio-wrap">
                    <span>최근 1년 내 동물병원에 방문한 적 있나요?</span>
                    <div>
                        <button type="button" class="fake-radio is-active">Y</button>
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
            <a href="./checklist.php" class="type-01 go-next" id="go-next">다음으로</a>
        </div>
        <div id="footer">
            <span class="for-a11y">Copyright © 2020. ROYAL CANIN all rights reserved.</span>
        </div>
    </div>
    <script>
        var paramObj = {};
        var paramValArr = [];
        var checklistEl = "";
        var checklist = {};
        var counselingFlag = "N";

        $(document).on('click', '.chk-trigger', function() {
            var $this = $(this);
            $this.toggleClass('is-active');
        });

        $(document).on('click', '#go-result', function() {
            // 초기화
            var resultIssue = "";
            counselingFlag = "N";
            for(var i = 0; i < paramValArr.length; i++) {
                var key = paramValArr[i];
                checklist[key].list = [];
            }

            // ga 이벤트 param1&param2 보냄

            // $('.chk-trigger.is-active').each(function(idx, el) {
            $('.chk-trigger').each(function(idx, el) {
                var key = $(this).attr('data-key');
                var question = $(this).find('.text').text();
                // var pushVal = {"question": question, "checked": "Y"};
                var pushVal = {"question": question, "checked": $(el).hasClass('is-active') ? "Y" : "N"};
                checklist[key].list.push(pushVal);
                if($(el).hasClass('is-active') && $(el).attr('data-counseling') == 'Y') {
                    counselingFlag = "Y";
                }
            });

            // result 산출
            // 우선 순위
            // 1 weight(체중)
            // 2 skin(피부)
            // 3 digest(소화)
            // 4 neutral(중성화)
            // 5 stress(스트레스)
            // 6 fur(털)
        
            var key1 = paramValArr[0],
                key2 = paramValArr[1];

            for (var key in checklist) {
                var len = 0;
                checklist[key].list.forEach(function(item) {
                    if(item.checked == 'Y') {
                        len++;
                    }
                });
                checklist[key].checkedLength = len;
                // console.log('key:', key);
                // console.log('length:', len);
            }

            if(paramValArr.length > 1) {
                var num = (Number(checklist[key1].checkedLength) - Number(checklist[key2].checkedLength));
                if (num > 0) {
                    // 1번키의 리스트 개수가 많음
                    resultIssue = key1;
                } else if (num < 0) {
                    // 2번키의 리스트 개수가 많음
                    resultIssue = key2;
                } else {
                    // 개수 동률 우선순위값으로 result 산출
                    // console.log(key1+' order:', Number(checklist[key1].order));
                    // console.log(key2+' order:', Number(checklist[key2].order));
                    resultIssue = (Number(checklist[key1].order) < Number(checklist[key2].order)) ? key1 : key2;
                }

                // 불필요 값 삭제
                // delete checklist[key2].order;
                // delete checklist[key2].checkedLength;
            } else {
                resultIssue = paramValArr[0];
            }

            // 불필요 값 삭제
            // delete checklist[key1].order;
            // delete checklist[key1].checkedLength;
            
            // alert(resultIssue);
            // console.log(checklist);

            // 데이터 저장
            $.ajax({
                url: "../main_exec.php",
                type: 'POST',
                data: {
                    "exec"          : "insert_checked_data",
                    "check-data"    : JSON.stringify(checklist)
                },
                // data: JSON.stringify(checkedList),
                success: function (response) {
                    var param = "?issue="+resultIssue+"&counseling="+counselingFlag;
                    setTimeout(function() {
                        location.href = "./result.php"+param;
                    }, 200);
                },
                error: function(jqXHR, errMsg) {
                    // Handle error
                    alert(errMsg);
                }
            });
        });
        $(document).ready(function() {

        });
    </script>
</body>
</html>