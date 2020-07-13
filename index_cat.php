<?php
    include_once "./include/autoload.php";
    $mnv_f 			= new mnv_function();
    $my_db      = $mnv_f->Connect_MySQL();
    $mobileYN      = $mnv_f->MobileCheck();

    $siteURL = parse_url($mnv_f->siteURL());
    if ($mobileYN == "MOBILE")
    {
		if(isset($siteURL['query'])) {
			echo "<script>location.href='./m/index.php?".$siteURL['query']."';</script>";
		} else {
			echo "<script>location.href='./m/index.php';</script>";
		}
    }else{
		$saveMedia     = $mnv_f->SaveMedia();
		$rs_tracking   = $mnv_f->InsertTrackingInfo($mobileYN);
		// print_r($rs_tracking);
    }

    include_once "./head.php";
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
                            <a href="javascript:void(0)" data-url="#section2">주치의 프로젝트</a>
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
        <div class="content _main">
            <section class="section _01" id="section1">
                <div class="wrapper">
                    <h1 class="title-block">
                        <img src="./images/project_logo.svg" alt="고양이 주치의 프로젝트" class="project-logo">
                        <div class="main-title">
                            <p>고양이는</p>
                            <p class="bg-line">아파도 숨기는 사실,</p>
                            <p>알고 계세요?</p>
                        </div>
                        <div class="sub-title">
                            <p>반려묘가 숨기고 있을지 모를</p>
                            <p><b>건강 이상 신호 확인</b>해보고</p>
                            <p><b>무료 건강검진의 기회</b>도 받아보세요!</p>
                        </div>
                        <!-- <img src="./images/main_01_title.png" alt="고양이는 아파도 숨기는 사실, 알고 계세요? 반려묘가 숨기고 있을지 모를 건강 신호 확인해보고 무료 건강검진의 기회도 받아보세요!" class="title"> -->
                    </h1>
                    <img src="./images/main_01_cat.png" alt="고양이" class="cat resize-elm" data-width="0.51">
                    <!-- scroll down -->
                    <div class="scoll-down-group">
                        <span class="anim _1"></span>
                        <span class="anim _2"></span>
                        <span class="txt">scroll down</span>
                    </div>
                </div>
            </section>
            <section class="section _02" id="section2">
                <div class="title-block">
                    <img src="./images/project_logo.svg" alt="고양이 주치의 프로젝트" class="project-logo">
                    <p class="tt">#주치의 프로젝트</p>
                    <p class="sub">직접 경험해본 보호자들이 말한다</p>
                </div>
                <div class="infl-video-container">
                    <div class="title-block">
                        <div class="title">
                            <span>반려묘를 꿰뚫어보는 <b>프로 집사도 주치의가 필요해요</b></span>
                            <!-- <span>사랑하는 반려묘 앞에서는 <br><b>누구보다 예민해져야해요</b></span> -->
                        </div>
                    </div>
                    <div class="yt-container">
                        <img src="./images/yt_container_cat_body.png" alt="" class="object _body">
                        <img src="./images/yt_container_cat_tail.png" alt="" class="object _tail">
                        <div id="player-infl">
                            <!-- youtube video -->
                            <!-- <img src="./images/infl_video_sample.jpg" alt=""> -->
                        </div>
                    </div>
                </div>
                <!-- 활성탭에 따른 컨텐츠 변경 -->
                <div class="tab-container-wrap">
                    <ul class="tab-container" data-video-target="infl">
                        <li>
                            <button type="button" class="tab-trigger is-active" data-key="3_6h0o-t3Vw">
                                <img src="./images/infl_tab_thumb_01_active.png" alt="" class="thumb">
                                <span>프로 집사의<br>#주치의 프로젝트</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="tab-trigger" data-key="CAInhDnQFaA">
                                <img src="./images/infl_tab_thumb_02_common.png" alt="" class="thumb">
                                <span>예민보스 집사의<br>#주치의 프로젝트</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="tab-trigger" data-key="NWROQ1tCFPM">
                                <img src="./images/infl_tab_thumb_03_common.png" alt="" class="thumb">
                                <span>현명 집사의<br>#주치의 프로젝트</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </section>
            <section class="section _03" id="section3">
                <div class="title-block">
                    <img src="./images/project_logo.svg" alt="고양이 주치의 프로젝트" class="project-logo">
                    <p class="prj-title">
                        <span class="text">
                            <em>주치의</em><img src="./images/icon_power.png" alt="력" class="icon"><em>테스트</em>
                        </span>
                    </p>
                    <p class="sub">
                        아픈 것을 잘 드러내지 않는 반려묘이기에<br>
                        세심하게 살펴주는 가장 가까운 주치의로써의 관찰 능력은 필수!<br>
                        <b>나의 주치의력을 테스트 해 보시고 반려묘의 신호는 물론<br>
                        무료 건강검진권 당첨의 기회도 잡으세요!</b>
                    </p>
                    <div class="date-block">
                        <dl>
                            <dt>참여기간</dt>
                            <dd>0000. 00. 00 ~ 0000. 00. 00</dd>
                        </dl>
                        <dl>
                            <dt>당첨자 확인</dt>
                            <dd>0000. 00. 00</dd>
                        </dl>
                    </div>
                    <img src="./images/section_03_group.png" alt="" class="img-group">
                    <a href="./gate.php" class="type-01" id="go-sub">시작하기</a>
                    <div class="dash-line"></div>
                    <div class="benefit-area">
                        <p class="tt">참여 혜택!</p>
                        <p class="sub">증정품은 추첨을 통해 제공됩니다.</p>
                        <ul>
                            <li>
                                <div class="cnt-ball">
                                    <span>100명</span>
                                </div>
                                <img src="./images/benefit_img_01.png" alt="10만원 상당의 건강검진권 100명">
                                <p>10만원 상당의<br><b>건강검진권</b></p>
                                <button type="button" data-popup="#reward1-popup">건강검진권 사용안내</button>
                            </li>
                            <li>
                                <div class="cnt-ball">
                                    <span>50명</span>
                                </div>
                                <img src="./images/benefit_img_02.png" alt="혈뇨검출 체외진단기 헤마츄리아 디텍션 50명">
                                <p>혈뇨검출 체외진단기<br><b>헤마츄리아 디텍션</b></p>
                                <button type="button" data-popup="#reward2-popup">헤마츄리아 사용법</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
            <section class="section _04" id="section4">
                <img src="./images/section_04_cutie.png" alt="고양이" class="cute">
                <div class="title-block">
                    <img src="./images/project_logo.svg" alt="고양이 주치의 프로젝트" class="project-logo">
                    <p class="prj-title">
                        <span class="text">
                            <em>주치의</em><img src="./images/icon_power.png" alt="력" class="icon"><em>업그레이드 TIPS</em>
                        </span>
                    </p>
                </div>
                <div class="tab-container-wrap">
                    <ul class="tab-container" data-video-target="tips">
                        <li>
                            <button type="button" class="tab-trigger is-active" data-key="SauuYLbs_FI">
                                <img src="" alt="" class="icon">
                                <span>고양이를 병원에<br>데려가는 꿀팁</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="tab-trigger" data-key="nBBb6CvKJ5s">
                                <img src="" alt="" class="icon">
                                <span>OOO질병이<br>궁금하시다면?</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="tab-trigger" data-key="nBBb6CvKJ5s">
                                <img src="" alt="" class="icon">
                                <span>5가지 징후<br>요로계</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="tab-trigger" data-key="coy3EAxcrv0">
                                <img src="" alt="" class="icon">
                                <span>5가지 징후<br>스트레스</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="tab-trigger" data-key="hdhT-xC3byo">
                                <img src="" alt="" class="icon">
                                <span>5가지 징후<br>신장</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="tab-trigger" data-key="8JscdpO7oeg">
                                <img src="" alt="" class="icon">
                                <span>5가지 징후<br>소화기</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="tab-trigger" data-key="hmiCvnEDckA">
                                <img src="" alt="" class="icon">
                                <span>5가지 징후<br>체중</span>
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="tips-video-container">
                    <div class="yt-container">
                        <div id="player-tips">
                            <!-- youtube video -->
                        </div>
                    </div>
                </div>
                <ul class="article-list">
                    <li>
                        <a href="https://www.royalcanin.com/kr/cats/health-and-wellbeing/is-your-cat-stressed" target="_blank">
                            <img src="./images/article_img_01.png" alt="" class="thumb">
                            <span class="text">
                                <span>반려묘 스트레스 확인 방법</span>
                                <span>자세히 보기 ></span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.royalcanin.com/kr/cats/health-and-wellbeing/keeping-your-cat-at-a-healthy-weight" target="_blank">
                            <img src="./images/article_img_02.png" alt="" class="thumb">
                            <span class="text">
                                <span>체중 유지 방법</span>
                                <span>자세히 보기 ></span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.royalcanin.com/kr/cats/health-and-wellbeing/my-cat-is-losing-its-hair" target="_blank">
                            <img src="./images/article_img_03.png" alt="" class="thumb">
                            <span class="text">
                                <span>털이 빠지는 이유</span>
                                <span>자세히 보기 ></span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.royalcanin.com/kr/cats/health-and-wellbeing/common-illnesses-in-older-cats" target="_blank">
                            <img src="./images/article_img_04.png" alt="" class="thumb">
                            <span class="text">
                                <span>노령묘 질환</span>
                                <span>자세히 보기 ></span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.royalcanin.com/kr/cats/health-and-wellbeing/how-your-cats-diet-affects-its-urinary-health" target="_blank">
                            <img src="./images/article_img_05.png" alt="" class="thumb">
                            <span class="text">
                                <span>요로기계 건강이 중요한 이유</span>
                                <span>자세히 보기 ></span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.royalcanin.com/kr/cats/health-and-wellbeing/what-makes-a-cats-digestive-system-healthy" target="_blank">
                            <img src="./images/article_img_06.png" alt="" class="thumb">
                            <span class="text">
                                <span>소화기계</span>
                                <span>자세히 보기 ></span>
                            </span>
                        </a>
                    </li>
                </ul>
            </section>
        </div>
        <div class="popup _reward" id="reward1-popup">
            <div class="inner">
                <button type="button" class="popup-close" data-popup="@close"></button>
                <div class="title-block">
                    <p class="title">반려묘에게<br><b>건강함을 선물하세요</b></p>
                </div>
                <img src="./images/popup_reward_01_img.png" alt="" class="r-img">
                <p class="text"><b>10만원 상당의 건강검진권</b>이<br>추첨을 통해 제공됩니다.</p>
                <div class="guide-block">
                    <dl>
                        <dt>사용 기간 : </dt>
                        <dd> 2020. 9. 15 ~ 2020. 12. 31</dd>
                    </dl>
                    <dl>
                        <dt>유의사항 : </dt>
                        <dd>10만원 이상 발생하는 비용은 본인 부담입니다. 보다 자세한 관련 사항은 000을 참고하세요.</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="popup _reward" id="reward2-popup">
            <div class="inner">
                <button type="button" class="popup-close" data-popup="@close"></button>
                <div class="title-block">
                    <p class="title">
                        소변에 혈액이 섞여 있는 것은<br>여러가지 질병의 신호! 
                    </p>
                    <p class="sub">
                        대표적으로 재발하는 경향이 있는 요로계 질환
                    </p>
                    <img src="./images/popup_reward_02_prd_img.png" alt="" class="prd-img">
                </div>
                <img src="./images/popup_reward_02_img.png" alt="" class="r-img">
                <div class="guide-block">
                    <p>헤마츄리아 디텍션 사용방법</p>
                    <img src="./images/popup_reward_02_guide_img.png" alt="">
                </div>
            </div>
        </div>
        <div id="footer">
            <span class="for-a11y">Copyright © 2020. ROYAL CANIN all rights reserved.</span>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.3/ScrollToPlugin.min.js"></script>
    <script>
    // 2. This code loads the IFrame Player API code asynchronously.
    var tag = document.createElement('script');

    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    // 3. This function creates an <iframe> (and YouTube player)
    //    after the API code downloads.
    var playerInfl, playerTips;
    var playerWidth = $('.yt-container').width();
    function onYouTubeIframeAPIReady() {
        playerInfl = new YT.Player('player-infl', {
            height: playerWidth*9/16,
            width: playerWidth,
            videoId: '3_6h0o-t3Vw',
            playerVars: {'enablejsapi': 1, 'autoplay': 1, 'controls': 1, 'rel': 0, 'loop': 1, 'origin': 'http://royalcaninevent2020.com', 'playsinline': 1},
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
        playerTips = new YT.Player('player-tips', {
            height: playerWidth*9/16,
            width: playerWidth,
            videoId: 'SauuYLbs_FI',
            playerVars: {'enablejsapi': 1, 'autoplay': 1, 'controls': 1, 'rel': 0, 'loop': 1, 'origin': 'http://royalcaninevent2020.com', 'playsinline': 1},
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }

    // 4. The API will call this function when the video player is ready.
    function onPlayerReady(event) {
        event.target.playVideo();
    }

    // 5. The API calls this function when the player's state changes.
    //    The function indicates that when playing a video (state=1),
    //    the player should play for six seconds and then stop.
    var done = false;
    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
            // setTimeout(stopVideo, 6000);
            // done = true;
        }
    }
    function stopVideo() {
        // player.stopVideo();
    }
    </script>
    <script>
        $(document).ready(function() {
            paramObj = get_query();
            // paramValArr = Object.values(paramObj);
            paramValArr = get_param_arr(paramObj);

            // 메인 섹션 1 한화면에 보일 수 있도록 조정
            // var winwidth = $(window).width();
            // var vh = $(window).height();
            // $('.section._01').attr('style', 'height:'+ $(window).height()+'px');
            // $('.section._01 .resize-elm').each(function() {
            //     var wid = vh*$(this).attr('data-width');
            //     $(this).attr('style', 'width:'+(wid/winwidth)*100+'%');  
            // })
            // $('.menu-transition-layer').css({
            //     'width': winwidth*4,
            //     'height': winwidth*4,
            //     'top': -winwidth+'px',
            //     'right': -winwidth+'px',
            // })

        });


        // 헤더 햄버거 클릭 이벤트
        var menuTlEnd = true;
        $(document).off().on('click', '.gnb-toggle', function() {
            menuToggle();
        })

        // 메뉴레이어 토글
        function menuToggle(callbackFunc, targetURL) {
            if(menuTlEnd) {
                menuTlEnd = false;
                if($('html').hasClass('menu-opened')) {
                    // menu close animation
                    var closeTl = gsap.timeline({onComplete: menuTimelineEnd});
                    closeTl
                        .to($('#menu-layer li'), {duration: 0.15, y: 5, autoAlpha: 0})
                        .to($('#menu-layer .cat'), {duration: 0.1, y: 5, autoAlpha: 0})
                        .set($('#menu-layer'), {display: 'none'})
                        .to($('#header .logo'), {duration: 0.45, x: 0, ease: "power3.out"})
                        .to($('.menu-transition-layer'), {duration: 0.45, scale: 0, ease: "sine"}, "-=0.3")
                } else {
                    // menu open animation
                    var openTl = gsap.timeline({onComplete: menuTimelineEnd});
                    openTl
                        .to($('.menu-transition-layer'), {duration: 0.45, scale: 1, ease: "sine"})
                        .to($('#header .logo'), {duration: 0.45, x: -($(window).width()/2-($('#header .logo').width()/2+20)), ease: "power3.out"}, "-=0.3")
                        .set($('#menu-layer'), {display: 'block'}, "-=0.3")
                        .to($('#menu-layer .cat'), {duration: 0.1, y: 0, autoAlpha: 1}, "-=0.3")
                        .to($('#menu-layer .cat'), {duration: 0.2, ease: "linear"}, "-=0.3")
                        .to($('#menu-layer li'), {duration: 0.35, stagger: 0.15, y: 0, autoAlpha: 1}, "-=0.2")
                }
                $('.gnb-toggle').toggleClass('is-active');
            }

            function menuTimelineEnd() {
                menuTlEnd = true;
                $('html').toggleClass('menu-opened scroll-blocking');
                if(typeof(callbackFunc) == 'function') {
                    callbackFunc(targetURL);
                }
            }
        }

        // 메뉴레이어 섹션 클릭 이벤트 -> 메뉴레이어 닫고 섹션 이동으로
        $(document).on('click', '#menu-layer li a', function(e) {
            e.preventDefault();
            var targetURL = $(this).attr('data-url');
            menuToggle(sectionMove, targetURL);
        });

        // 섹션 이동
        function sectionMove(target) {
            gsap.to(window, {duration: 1, scrollTo: { y: target, offsetY: 57 }, ease: "power2"});
        }
        
        // 상품영역 탭 이벤트
        $(document).on('click', '.tab-trigger', function() {
            var $this = $(this);
            var $container = $this.closest('.tab-container');
            var targetKey = $this.attr('data-key');
            var targetVideo = $container.attr('data-video-target');
            if($this.hasClass('is-active')) {
                return;
            }
            $container.find('.tab-trigger').each(function (idx, el) {
                var $img = $(el).find('img');
                if($(el).is($this)) {
                    $(el).addClass('is-active');
                    $img.attr('src', $img.attr('src').replace('common', 'active'));
                } else {
                    $(el).removeClass('is-active');
                    $img.attr('src', $img.attr('src').replace('active', 'common'));
                }
            });

            if(targetVideo == 'infl') {
                playerInfl.loadVideoById(targetKey, 0);
            } else {
                playerTips.loadVideoById(targetKey, 0);
            }
        });


    </script>
</body>
</html>