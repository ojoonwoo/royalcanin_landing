<?php
    include_once "./head.php";

    if ($_SESSION['miniver_serial'] != $serial || !$_SESSION['miniver_serial']) {
        echo "<script>location.href = 'index.php';</script>";
    }
?>
<body>
    <div id="container">
        <div class="content _sub __result">
            <div class="sub-header">
                <a href="javascript:void(0)" id="go-before"></a>
                <a href="./" id="go-index"></a>
            </div>
            <div class="loading-layer">
                <div class="wrapper">
                    <img src="./images/project_logo.svg" class="project-logo" alt="고양이 주치의 프로젝트">
                    <h2>관찰한 행동을 분석 중 이에요!</h2>
                    <p>정확한 진단을 위해서는 <b>수의사님과의 상담이 필요</b>합니다.</p>
                    <span style="display:block; margin: 10px">로딩 애니메이션 필요!</span>
                </div>
            </div>
            <div class="title-block">
                <div class="prj-title">
                    <img src="./images/project_logo.svg" class="project-logo" alt="고양이 주치의 프로젝트">
                    <span class="text">
                        <em>주치의</em><img src="./images/icon_power.png" alt="력" class="icon"><em>테스트</em></span>
                </div>
                <div class="subject">
                    <b>OO의 행동을 분석한 결과..</b>
                </div>
            </div>
            <div class="cat-block">
                <img src="./images/result_cat.jpg" alt="고양이">
                <div class="info">
                    <div class="name-bx"><span>이름:</span><span>OO</span></div>
                    <div class="age-bx"><span>나이:</span><span>7세</span></div>
                </div>
            </div>
            <div class="chart-block">
                <div class="chart-wrapper">
                    <div class="labels">
                        <span class="weight">체중 관리</span>
                        <span class="stress">스트레스 관리</span>
                        <span class="urinary">요로계 질환</span>
                        <span class="kidney">신장 질환</span>
                        <span class="gastro">위장관 질환</span>
                    </div>
                    <div class="graph-container">
                        <canvas id="health-graph"></canvas>
                    </div>
                    <img src="./images/result_graph_guide.svg" alt="" class="chart-guideline">
                </div>
            </div>
            <div class="advice-block">
                <div class="icon-wrap">
                    <img src="" alt="" class="icon">
                </div>
                <h5 class="adv-title"></h5>
                <p class="adv-text"></p>
            </div>
            <a href="./request.php" class="type-01 go-next">건강검진권 신청하기</a>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script>
        // serial 없으면 고양이 정보입력으로 튕길것
        var $doc = $(document);
        // var keyInfo = {
        //     "weight": {
        //         "text": "체중 관리"
        //     },
        //     "stress": {
        //         "text": "스트레스 관리"
        //     },
        //     "urinary": {
        //         "text": "요로계 질환"
        //     },
        //     "kidney": {
        //         "text": "신장 질환"
        //     },
        //     "gastro": {   
        //         "text": "위장관 질환"
        //     }  
        // };
        var adviceObject = {
            "single": {
                "msg": {
                    "weight": "체중 관리에 대한 다양한 행동을 보이고 있어요. 과체중은 다양한 질병을 일으킬 가능성이 있으니 정확한 진단을 위해서는 수의사님과의 상담이 필요합니다.",
                    "gastro": "소화기 문제를 일으킬 다양한 원인 행동을 보이고 있어요. 이러한 행동은 소화기 관련 문제를 유발시킬 원인이 될 수 있으니 정확한 진단을 위해서는 수의사님과의 상담이 필요합니다.",
                    "urinary": "요로계 질환 관리에 대한 다양한 행동을 보내고 있어요. 배뇨에 어려움을 겪는 요로계는 고통스러운 염증으로 이어질 수 있기 때문에 수의사님과의 정확한 상담이 필요합니다.",
                    "kidney": "신장 관리에 대한 다양한 행동을 보내고 있어요. 고양이가 가장 많이 앓는 질병인 신장 질환은 지속될 시 변비가 결석 등 다른 질병도 앓기 쉬워요. 정확한 진단을 위해서는 수의사님과의 상담이 필요합니다.",
                    "stress": "스트레스 관리에 대한 다양한 행동을 보내고 있어요. 반려묘의 스트레스가 계속될 경우 요로계 질환 등 다양한 질환들을 유발할 가능성이 있어요. 정확한 진단을 위해서는 수의사님과의 상담이 필요합니다."
                }
            },
            "multi": {
                "msg": "다양한 문제 질환에 대한 행동을 보이고 있어요. 여러 의심 증상들을 보이는 만큼 정확한 진단을 위해 수의사님과의 상담을 권유합니다."
            }
        }
        var adviceArr = [];
        $doc.ready(function() {
            // db에서 serial로 로우 셀렉
            // 반려묘 정보, 체크정보
            // 체크정보 for in
            // 권고할 key 배열 생성
            // key 돌면서 if(checkedLength>=3) adviceArr.push(key);
            // (checklist[key].checkedLength/checklist[key].list.length)*100 -> 각 key 지표 점수
            // if(adviceArr.length>0 && adviceArr.length<2)
            // adviceArr[0] 권고
            // else if(adviceArr.length>=2)
            // adviceArr[i] 권고
            // else
            // 권고없음
            setTimeout(function() {
                gsap.to($('.loading-layer'), {duration: 0.3, autoAlpha: 0, onComplete: loadingEnd});
            }, 2000);
        });
        function loadingEnd() {
            myChart.data.datasets[0].data = [90, 40, 40, 40, 40];
            myChart.update();
        }
        var ctx = document.getElementById('health-graph');
        var myChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: ['체중 관리', '스트레스 관리', '요로계 질환', '신장 질환', '위장관 질환'],
                datasets: [{
                    label: 'Result',
                    data: [0, 0, 0, 0, 0],
                    // data: [90, 40, 40, 40, 40],
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
                // aspectRatio: 0.93,
                aspectRatio: 1,
                animation: {
                    // easing: 'easeInQuad',
                    duration: 5000,
                    render: function() {
                        console.log('render');
                    },
                    onComplete: function() {
                        // drawResult();
                    }
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