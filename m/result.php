<?php
    include_once "./head.php";

    $serial = $_GET['serial'];

    if ($_SESSION['miniver_serial'] != $serial || !$_SESSION['miniver_serial'] || !$serial) {
        echo "<script>location.href = 'index.php';</script>";
    }

    $query = "SELECT mb_cat_name, mb_cat_birth, mb_check FROM member_info WHERE 1 AND mb_serial = '".$serial."'";
    $result = mysqli_query($my_db, $query);
    
    $cat_info = mysqli_fetch_array($result);
?>
<body>
    <div id="container">
        <div class="content _sub __result">
            <?php
            include_once "./sub_header.php";
            ?>
            <div class="loading-layer">
                <div class="wrapper">
                    <img src="./images/project_logo.svg" class="project-logo" alt="고양이 주치의 프로젝트">
                    <h2>관찰한 행동을 분석 중 이에요!</h2>
                    <p>정확한 진단을 위해서는 <b>수의사 선생님과의 상담이 필요</b>합니다.</p>
                    <!-- <span style="display:block; margin: 10px">로딩 애니메이션 필요!</span> -->
                </div>
            </div>
            <div class="title-block">
                <div class="prj-title">
                    <img src="./images/project_logo.svg" class="project-logo" alt="고양이 주치의 프로젝트">
                    <span class="text">
                        <em>주치의</em><img src="./images/icon_power.png" alt="력" class="icon"><em>테스트</em>
                    </span>
                </div>
                <div class="subject">
                    <b><?=$cat_info['mb_cat_name']?>의 행동을 분석한 결과..</b>
                </div>
            </div>
            <div class="cat-block">
                <img src="./images/result_cat.jpg" alt="고양이">
                <div class="info">
                    <div class="name-bx"><span>이름 :</span><span><?=$cat_info['mb_cat_name']?></span></div>
                    <div class="age-bx"><span>나이 :</span><span><em id="age-num"><?=(date("Y")-$cat_info['mb_cat_birth'])?></em>세</span></div>
                </div>
            </div>
            <div class="chart-block">
                <div class="logo">
                    <span class="for-a11y">KSFM</span>
                </div>
                <div class="chart-wrapper">
                    <div class="labels">
                        <span class="weight">체중 관리</span>
                        <span class="stress">스트레스 관리</span>
                        <span class="urinary">요로계 관리</span>
                        <span class="kidney">신장 관리</span>
                        <span class="gastro">소화 관리</span>
                    </div>
                    <div class="graph-container">
                        <canvas id="health-graph"></canvas>
                    </div>
                    <img src="./images/result_graph_guide.svg" alt="" class="chart-guideline">
                </div>
            </div>
            <div class="advice-block">
                <div class="icon-wrap"></div>
                <h5 class="adv-subject"></h5>
                <p class="adv-text">
                    <span class="adv-msg"></span>
                    <span class="default-msg">지금 건강검진권을 신청하고<br>가까운 병원에서 수의사 선생님을 만나보세요.</span>
                    <span class="doctor-msg" style="display:none;">유심히 관찰하거나 수의사 선생님과의 정확한 상담으로<br>질병 가능성을 예방해 보세요</span>
                </p>
            </div>
            <div class="notice-block">
                <p>* 결과는 보호자가 인식하는 반려묘 신호 정도에 따라 상이할 수 있습니다.<br>본 테스트는 참고용이며, 수의사 선생님의 소견이나 수의학적 치료를 대체할 수 없습니다.</p>
            </div>
            <!-- <img src="./images/result_notice.png" alt="* 결과는 보호자가 인식하는 반려묘 신호 정도에 따라 상이할 수 있습니다. 본 테스트는 참고용이며, 수의사 선생님의 소견이나 수의학적 치료를 대체할 수 없습니다." class="noti-msg"> -->
            <a href="./request.php?serial=<?php echo $serial?>" class="type-01 go-next" onclick="gtag('event', '이벤트참여', {'event_category': '결과페이지', 'event_label': '이벤트참여_결과'});">건강검진권 신청하기</a>
        </div>
        <div id="footer">
            <span class="for-a11y">Copyright © 2020. ROYAL CANIN all rights reserved.</span>
        </div>
    </div>
    <?php
        echo "<script>var catInfo = ".json_decode(json_encode($cat_info['mb_check'], JSON_UNESCAPED_UNICODE))."</script>";
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script>
        // serial 없으면 고양이 정보입력으로 튕길것
        var $doc = $(document);
        var resultObject = {
            "weight": {
                "subject": "체중 관리"
            },
            "gastro": {
                "subject": "소화기 관리"
            },
            "urinary": {
                "subject": "요로계 질환 관리"
            },
            "kidney": {
                "subject": "신장 관리"
            },
            "stress": {
                "subject": "스트레스 관리"
            }
        }
        var adviceObject = {
            "single": {
                "msg": {
                    "weight": "과체중과 관련된 다양한 행동을 보이고 있어요.<br>과체중은 다양한 질병을 일으킬 가능성이 있으니<br>정확한 진단을 위해서는 수의사 선생님과의 상담이 필요합니다.",
                    "gastro": "소화기 문제를 일으킬 다양한 원인 행동을 보이고 있어요.<br>이러한 행동은 소화기 관련 문제를 유발시킬 원인이 될 수 있으니<br>정확한 진단을 위해서는 수의사선생님과의 상담이 필요합니다.",
                    "urinary": "요로계 질환과 관련된 다양한 행동을 보이고 있어요.<br>배뇨에 어려움을 겪으면 반려묘가 고통스럽기 때문에<br>수의사 선생님과의 정확한 상담이 필요합니다.",
                    "kidney": "신장 질환과 관련된 다양한 행동을 보이고 있어요.<br>반려묘가 가장 많이 앓는 질병인 신장 질환은<br>지속될 시 다른 질병도 앓기 쉬워요.<br>정확한 진단을 위해서는 수의사 선생님과의 상담이 필요합니다.",
                    "stress": "스트레스와 관련된 다양한 행동을 보이고 있어요.<br>반려묘의 스트레스가 계속될 경우 요로계 질환 등<br>다양한 질환들을 유발할 가능성이 있어요.<br>정확한 진단을 위해서는 수의사 선생님과의 상담이 필요합니다."
                },
            },
            "multi": {
                "msg": "다양한 문제 질환에 대한 행동을 보이고 있어요.<br>여러 의심 증상들을 보이는 만큼<br>정확한 진단을 위해 수의사 선생님과의 상담을 권유합니다."
            },
            "doctor": {
                "msg": "평소에 이상 증세를 보이지 않아도<br>숨기고 있는 질환이 있을 수 있어요. 고양이는 아파도 숨기거든요!<br>혹시 놓치고 있는 반려묘의 신호가 있는지"
            }
        }
        var adviceArray = [];
        for (var key in catInfo) {
            var len = catInfo[key].checkedLength;
            var point = (len/catInfo[key].list.length)*100;
            if(Number(len)>=3) {
                adviceArray.push(key);
            }
            // console.log('key:', key);
            // console.log('length', len);
            // console.log('point', point);
            // console.log('value:', catInfo[key]);

            resultObject[key].point = point;

            // 그래프 표현을 위해서(0 -> 15) presentPoint 속성 추가
            if(Number(resultObject[key].point) === 0) {
                resultObject[key].presentPoint = 15;
            } else {
                resultObject[key].presentPoint = point;
            }
        }
        $doc.ready(function() {

            var adv_subject = "";
            var adv_icon = [];
            var adv_msg = "";
            if(adviceArray.length>0 && adviceArray.length<2) {
                adv_icon.push("./images/advice_icon_"+adviceArray[0]+".png");
                adv_msg = adviceObject.single.msg[adviceArray[0]];
                adv_subject = "<span>집중적인 "+"<b>"+resultObject[adviceArray[0]].subject+"</b>가 필요해요!</span>"
            } else if(adviceArray.length>=2) {
                var adv_temp_subject = "";

                for(var i=0; i<adviceArray.length; i++) {
                    adv_icon.push("./images/advice_icon_"+adviceArray[i]+".png");
                    adv_msg = adviceObject.multi.msg;

                    (adviceArray.length-i!==1) ? adv_temp_subject += resultObject[adviceArray[i]].subject+", " : adv_temp_subject += resultObject[adviceArray[i]].subject;
                }
                adv_subject = "<span><b>"+adv_temp_subject+"</b>에 대해 다양한 신호를 보내고 있어요!</span>";
            } else {
                adv_icon.push("./images/advice_icon_doctor.png");
                adv_msg = adviceObject.doctor.msg;
                adv_subject = "<span><b>수의사 선생님의 더 정확한 진단</b>이 필요해요!</span>";
                $('.default-msg').hide();
                $('.doctor-msg').show();
            }

            for(var i=0; i<adv_icon.length; i++) {
                $('.advice-block .icon-wrap').append("<img src="+adv_icon[i]+" class='icon'>");
            }
            $('.advice-block .adv-subject').html(adv_subject);
            $('.advice-block .adv-msg').html(adv_msg);

            
            setTimeout(function() {
                gsap.to($('.loading-layer'), {duration: 0.3, autoAlpha: 0, onComplete: loadingEnd});
            }, 2000);
        });
        function loadingEnd() {
            // myChart.data.datasets[0].data = [resultObject.weight.point, resultObject.stress.point, resultObject.urinary.point, resultObject.kidney.point, resultObject.gastro.point];
            myChart.data.datasets[0].data = [resultObject.weight.presentPoint, resultObject.stress.presentPoint, resultObject.urinary.presentPoint, resultObject.kidney.presentPoint, resultObject.gastro.presentPoint];
            myChart.update();
            for(var i=0; i<adviceArray.length; i++) {
                $('.chart-wrapper .labels .'+adviceArray[i]).addClass('is-active');
            }
        }
        function defaultPointSetting() {
            var allZero = [];
            for (var key in resultObject) {
                if(Number(resultObject[key].point) === 0) {
                    allZero.push(true);
                }
            }
            // if(allZero.length==5) return [radomize100(), radomize100(), radomize100(), radomize100(), radomize100()];
            // else return [0, 0, 0, 0, 0];
            return [0, 0, 0, 0, 0]
        }
        
        function radomize100() {
            return Math.floor(Math.random(10)*100);
        }
        var ctx = document.getElementById('health-graph');
        var myChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: ['체중 관리', '스트레스 관리', '요로계 관리', '신장 관리', '소화 관리'],
                datasets: [{
                    label: 'Result',
                    // data: [0, 0, 0, 0, 0],
                    data: defaultPointSetting(),
                    // data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()],
                    backgroundColor: [
                        'rgba(227, 0, 26, 1)',
                        'rgba(227, 0, 26, 1)',
                        'rgba(227, 0, 26, 1)',
                        'rgba(227, 0, 26, 1)',
                        'rgba(227, 0, 26, 1)',
                    ],
                    borderColor: [
                        'rgba(227, 0, 26, 1)',
                        'rgba(227, 0, 26, 1)',
                        'rgba(227, 0, 26, 1)',
                        'rgba(227, 0, 26, 1)',
                        'rgba(227, 0, 26, 1)',
                    ],
                    borderWidth: 0,
                    pointRadius: 0,
                }]
            },
            options: {
                responsive: true,
                aspectRatio: 0.95,
                // aspectRatio: 1,
                animation: {
                    // easing: 'easeInQuad',
                    duration: 5000,
                    onComplete: function() {}
                },
                legend: {
                    display: false
                },
                scale: {
                    pointLabels:{
                        display: false,
                        fontColor: ['red', '#666', '#666', '#666', '#666'],
                        fontSize: '13'
                    },
                    gridLines: {
                        display: false,
                        // zeroLineColor: 'red',
                        // zeroLineBorderDash: [4, 4],
                        // color: ['rgba(0, 0, 0, 0.2)', 'rgba(0, 0, 0, 0.2)', 'rgba(0, 0, 0, 0.2)', 'rgba(0, 0, 0, 1)'],
                        // color: setColor(),
                        // borderDash: [5, 15],
                        // borderDashOffset: 4
                    },
                    angleLines: {
                        display: false,
                        color: 'rgba(0, 0, 0, 0.2)',
                    },
                    ticks: {
                        display: false,
                        stepSize: 25,
                        max: 100,
                        suggestedMin: 10,
                        suggestedMax: 100,
                        // beginAtZero: true
                    },
                }
            }
        });

        
    </script>
</body>
</html>