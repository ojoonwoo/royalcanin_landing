<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoyalCanin</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/slick.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/jquery-3.3.1.min.js"></script>
    <script src="./js/slick.min.js"></script>
</head>
<body>
    <div id="container">
        <div class="content _sub __checklist">
            <div class="title-block">
                <h1>발견하셨나요?</h1>
                <p>강아지의 <b>모든 신호를 선택</b>해주세요</p>
            </div>
            <ul class="checklist"></ul>
            <button type="button" class="type-01" id="go-result">건강 맞춤 사료 추천 받기</button>
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
                    // console.log('counseling flag y')
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
            // console.log(checklist);
            // console.log(counselingFlag);
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
            // console.log(checklist);

            if(paramValArr.length > 1) {
                // console.log('한개보다 많으므로 비교');
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
                delete checklist[key2].order;
                delete checklist[key2].checkedLength;
            } else {
                // console.log('한개이므로 result 그대로 넘김');
                resultIssue = paramValArr[0];
            }

            // 불필요 값 삭제
            delete checklist[key1].order;
            delete checklist[key1].checkedLength;
            
            // alert(resultIssue);
            // console.log(checklist);

            $.ajax({
                url: "../main_exec.php",
                type: 'POST',
                data: {
                    "exec"          : "insert_checked_data",
                    "check-data"    : checkList.list
                },
                // data: JSON.stringify(checkedList),
                success: function (response) {
                    // console.log(response);
                    // counselingFlag, 
                },
                error: function(jqXHR, errMsg) {
                    // Handle error
                    alert(errMsg);
                }
            });

            // success 안으로 이동
            var param = "?issue="+resultIssue+"&counseling="+counselingFlag;
            setTimeout(function() {
                location.href = "./result.php"+param;
            });
        });
        $(document).ready(function() {
            var keyPool = ['skin', 'weight', 'digest', 'neutral', 'fur', 'stress'];
            paramObj = get_query();
            // console.log(paramObj);
            // paramValArr = Object.values(paramObj);
            paramValArr = get_param_arr(paramObj);
            
            for(var i=0; i<paramValArr.length; i++) {
                if($.inArray(paramValArr[i], keyPool) == -1) {
                    alert('정상적으로 참여해주세요!');
                    location.href = './index.html';
                    // paramValArr.splice(paramValArr.indexOf(paramValArr[i]), 1);
                    // if(paramValArr.length)
                    // console.log(paramValArr.length);
                }
            }
            
            // console.log(paramValArr);

            $.ajax({
                url: "./checklist_info.json",
                // cache: false,
                dataType: "json",
                type: 'get',
                success: function (data) {
                    var object = data;
                    
                    // checklist 
                    // for(var i=0; i<paramValArr.length; i++) {
                    //     var val = paramValArr[i];
                    //     checklistObj[val] = object[val];
                    // }
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
        function get_query(){
            var url = document.location.href;
            var qs = url.substring(url.indexOf('?') + 1).split('&');
            for(var i = 0, result = {}; i < qs.length; i++){
                qs[i] = qs[i].split('=');
                result[qs[i][0]] = decodeURIComponent(qs[i][1]);
            }
            return result;
        }

        // result 넘기기 전 localStorage에 체크한 항목 저장(저장할 때 나중에 확인하기 위한 unique key값이 있을지?)
        // localStorage 저장값 -> selectedChkKey / selectedChkList1 &로 구분 / selectedChkList2 &로 구분
        // 체크된 항목 순회하면서 상담 필요한 항목 있을시 result로 같이 넘김
    </script>
</body>
</html>