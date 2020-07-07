<?php
    include_once "./head.php";
?>
<body>
    <!-- Google Tag Manager (noscript) -->

    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5TSHTM5"

    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

    <!-- End Google Tag Manager (noscript) -->
    <div id="container">
        <div class="content _sub __checklist">
            <?php
                include_once "./sub_header.php";
            ?>
            <div class="title-block">
                <h1>발견하셨나요?</h1>
                <p>강아지의 <b>신호를 1개 이상 선택</b>해주세요</p>
            </div>
            <ul class="checklist"></ul>
            <button type="button" class="type-01" id="go-result" onclick="lbReload('RCK_2020CCN_BTN_CONV2_checklist','','','');gtag('event', 'GA_RCK_2020CCN_BTN_CONV2_checklist');">결과 확인</button>
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

                if (Number(checklist[key1].checkedLength) < 1 && Number(checklist[key2].checkedLength) < 1) {
                    alert('해당하는 항목을 1개 이상 선택해 주세요!');
                    return false;
                }
                // 불필요 값 삭제
                // delete checklist[key2].order;
                // delete checklist[key2].checkedLength;
            } else {
                resultIssue = paramValArr[0];

                if (Number(checklist[key1].checkedLength) < 1) {
                    alert('해당하는 항목을 1개 이상 선택해 주세요!');
                    return false;
                }
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
            var keyPool = ['skin', 'weight', 'digest', 'neutral', 'fur', 'stress'];
            paramObj = get_query();
            // paramValArr = Object.values(paramObj);
            paramValArr = get_param_arr(paramObj);
            
            for(var i=0; i<paramValArr.length; i++) {
                if($.inArray(paramValArr[i], keyPool) == -1) {
                    alert('정상적으로 참여해주세요!');
                    location.href = './index.php';
                    // paramValArr.splice(paramValArr.indexOf(paramValArr[i]), 1);
                    // if(paramValArr.length)
                    // console.log(paramValArr.length);
                }
            }
            
            $.ajax({
                url: "../checklist_info.json",
                cache: false,
                dataType: "json",
                type: 'get',
                success: function (data) {
                    var object = data;
                    
                    for (var key in object) {
                        if(key == paramObj.param1 || key == paramObj.param2) {
                            checklist[key] = {};
                            checklist[key].order = object[key].order;
                            object[key].list.forEach(function(item) {
                                var el = "<li>";
                                    el += "<button type='button' class='chk-trigger' data-key='"+key+"' data-counseling='"+item.counseling+"'>";
                                    el += "<span class='chk-shape'></span>";
                                    el += "<span class='text'>"+item.question+"</span>";
                                    el += "</button>";
                                    el += "</li>";
                                
                                checklistEl += el;
                            });
                        }
                    }
                    $('.checklist').html(checklistEl);
                },
                error: function(jqXHR, errMsg) {
                    // Handle error
                    alert(errMsg);
                }
            });
        });
    </script>
</body>
</html>