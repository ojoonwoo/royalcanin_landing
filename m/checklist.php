<?php
    include_once "./head.php";

    $serial = $_GET['serial'];

    if ($_SESSION['miniver_serial'] != $serial || !$_SESSION['miniver_serial']) {
        echo "<script>location.href = 'index.php';</script>";
    }

    $query = "SELECT mb_cat_name, mb_cat_birth FROM member_info WHERE 1 AND mb_serial = '".$serial."'";
    $result = mysqli_query($my_db, $query);
        
    $cat_info = mysqli_fetch_array($result);
?>
<body>
    <div id="container">
        <div class="content _sub __checklist">
            <?php
            include_once "./sub_header.php";
            ?>
            <div class="title-block">
                <div class="prj-title">
                    <img src="./images/project_logo.svg" class="project-logo" alt="고양이 주치의 프로젝트">
                    <span class="text">
                        <em>주치의</em><img src="./images/icon_power.png" alt="력" class="icon"><em>테스트</em>
                    </span>
                </div>
                <div class="subject">
                    우리 반려묘 <?=$cat_info['mb_cat_name']?>!<br><b>혹시 이런 모습을 보이나요?</b>
                </div>
                <input type="hidden" id="cat-age" value="<?=(date("Y")-$cat_info['mb_cat_birth'])?>">
            </div>
            <div class="indicator-block">
                <div class="guide">
                    <img src="./images/icon_chkguide.png" alt="터치 가이드 이미지" class="icon">
                    <span>해당되는 항목을 모두 터치해주세요.</span>
                </div>
                <ul class="indicator">
                    <li class="is-current"></li>
                    <li></li>
                </ul>
            </div>
            <div class="checklist-container">
                <div class="list-wrapper">
                <ul class="group is-current"></ul>
                <ul class="group"></ul>
                </div>
            </div>
            <button type="button" class="type-01" id="go-next">다음으로</button>
        </div>
        <div id="footer">
            <span class="for-a11y">Copyright © 2020. ROYAL CANIN all rights reserved.</span>
        </div>
    </div>
    <script>
        // serial 없으면 고양이 정보입력으로 튕길것
        var $doc = $(document);
        $doc.ready(function() {
            catTest.init();
        });

        var catTest = function() {
            var currentStep = 0;
            var checklist = {};
            var isAnimate = false;
            var $wrapperEl = $('.list-wrapper');
            var $groupEl = $('.list-wrapper .group');
            var $indicatorEl = $('.indicator');
            return {
                init: function() {
                    // 초기화
                    // checklist json 가져와서 뿌림
                    $.ajax({
                        url: "../checklist_info.json",
                        cache: false,
                        dataType: "json",
                        type: 'get',
                        success: function (data) {
                            var object = data;
                            var checklistEl = "";

                            for (var key in object) {
                                checklist[key] = {};
                                checklist[key].list = [];
                                object[key].list.forEach(function(item) {
                                    var el = "<li>";
                                        el += "<button type='button' class='chk-trigger' data-cate='"+key+"'>";
                                        el += "<span class='chk-shape'></span>";
                                        el += "<span class='text'>"+item.question+"</span>";
                                        el += "</button>";
                                        el += "</li><br>";
                            
                                    checklistEl += el;
                                });
                                // $('[data-cate="'+key+'"]').html(checklistEl);
                            }

                            var chkElArray = checklistEl.split('<br>');
                            chkElArray.splice(-1,1);
                            chkElArray = chkElArray.sort(function(){return 0.5-Math.random()});
                            
                            var groupNum = 0;
                            for(var j=0; j<chkElArray.length; j++) {
                                // if(j!==0 && j%4===0 && j!==chkElArray.length-1) {
                                //     groupNum++;
                                // }
                                if(j===7) {
                                    groupNum++;
                                }
                                $('ul.group').eq(groupNum).append(chkElArray[j]);
                            }
                        },
                        error: function(jqXHR, errMsg) {
                            // Handle error
                            console.log(errMsg);
                        }
                    });
                    this.bind();
                },
                bind: function() {
                    // 이벤트 바인딩
                    var _this = this;
                    $doc.on('click', '.chk-trigger', function() {
                        var $this = $(this);
                        $this.toggleClass('is-active');
                    });
                    $doc.on('click', '#go-next', function() {
                        if(isAnimate) return false;
                        _this.nextStep();
                    });
                    $doc.on('click', '#go-before', function(e) {
                        if(isAnimate) return false;
                        _this.prevStep();
                    });
                },
                prevStep: function() {
                    if(currentStep<1) {
                        history.back();
                        return;
                    } else {
                        this.stepAnimate('prev');
                    }
                },
                nextStep: function() {
                    if(currentStep>=1) {
                        this.submit();
                        return;
                    } else {
                        this.stepAnimate('next');
                    }
                },
                stepAnimate: function(direction) {
                    isAnimate = true;
                    var stepTl = gsap.timeline({onComplete: function(){
                        (direction==='next') ? currentStep++ : currentStep--;
                        isAnimate = false;
                        if(Number(currentStep)===1) {
                            $('#go-next').text('결과 보기');
                        } else {
                            $('#go-next').text('다음으로');
                        }
                        $('.list-wrapper .group').removeClass('is-current').eq(currentStep).addClass('is-current');
                    }});
                    if(direction === 'next') {
                        stepTl
                        .to($groupEl.eq(currentStep).find('li'), {duration: 0.55, autoAlpha: 0})
                        .to($wrapperEl, {duration: 0.55, x: "-="+100+'%'}, "-=0.55")
                        .to($groupEl.eq(currentStep+1).find('li'), {stagger: 0.15, autoAlpha: 1}, "-=0.45")
                        .to($indicatorEl.find('li').eq(currentStep), {duration: 0.2, width: 6}, "-=1.1")
                        .to($indicatorEl.find('li').eq(currentStep+1), {duration: 0.5, width: 21, ease: "elastic.out(1, 0.6)"}, "-=0.6");
                        
                    } else {
                        stepTl
                        .to($wrapperEl, {duration: 0.55, x: "+="+100+'%'})
                        .to($groupEl.eq(currentStep-1).find('li'), {stagger: 0.15, autoAlpha: 1}, "-=0.45")
                        .to($indicatorEl.find('li').eq(currentStep), {duration: 0.2, width: 6}, "-=1.1")
                        .to($indicatorEl.find('li').eq(currentStep-1), {duration: 0.5, width: 21, ease: "elastic.out(1, 0.6)"}, "-=0.6")
                        .set($groupEl.eq(currentStep).find('li'), {autoAlpha: 0});
                    }
                },
                submit: function() {
                    // 초기화 필요할 시 
                    // checklist[key].list = [];
                    // checklist[key].checkedLength = 0;

                    var hematuria = "N";

                    $('.chk-trigger').each(function(idx, el) {
                        var key = $(this).attr('data-cate');
                        var question = $(this).find('.text').text();
                        var pushVal = {"question": question, "checked": $(el).hasClass('is-active') ? "Y" : "N"};
                        checklist[key].list.push(pushVal);
                    });

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

                    if(checklist.urinary.checkedLength >= 3 || Number($('#cat-age').val()) >= 8) {
                        hematuria = "Y";
                    }

                    gtag('event', '이벤트참여', {'event_category': '체크리스트페이지', 'event_label': '이벤트참여_체크리스트'});
                    // 체크 정보 db update 후 callback에서 result로 serial같이 넘김
                    // 데이터 저장
                    $.ajax({
                        url: "../main_exec.php",
                        type: 'POST',
                        data: {
                            "exec"          : "insert_check_data",
                            "mb_check"      : JSON.stringify(checklist),
                            "mb_serial"    : "<?php echo $serial?>",
                            "mb_urinary"     : checklist.urinary.checkedLength,
                            "mb_result"     : hematuria
                        },
                        success: function (response) {
                            if (response == "Y") {
                                setTimeout(function() {
                                    location.href = "./result.php?serial=<?php echo $serial?>";
                                }, 200);
                            }else{
                                alert('오류입니다. 관리자에게 문의해주세요.');
                            }
                        },
                        error: function(jqXHR, errMsg) {
                            // Handle error
                            console.log(errMsg);
                        }
                    });

                }
            };
        }();
    </script>
</body>
</html>