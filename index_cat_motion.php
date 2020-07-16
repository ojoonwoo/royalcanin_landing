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
<style>
.content .section._01 .cat {
    opacity: 0;
}
.is-load .content .section._01 .cat {
    opacity: 1;
	-webkit-animation: scale-in-center 2s cubic-bezier(0.175, 0.885, 0.320, 1.275) 6s both;
            animation: scale-in-center 2s cubic-bezier(0.175, 0.885, 0.320, 1.275) 6s both;
}
.main-anim1 {
    opacity: 0;
}
.main-anim2 {
    opacity: 0;
}
.main-anim3 {
    opacity: 0;
}
.is-load .main-anim1 {
    opacity: 1;
	-webkit-animation: fade-in 2s cubic-bezier(0.215, 0.610, 0.355, 1.000) both;
            animation: fade-in 2s cubic-bezier(0.215, 0.610, 0.355, 1.000) both;
}
.is-load .main-anim2 {
    opacity: 1;
	-webkit-animation: fade-in 2s cubic-bezier(0.215, 0.610, 0.355, 1.000) 2s both;
            animation: fade-in 2s cubic-bezier(0.215, 0.610, 0.355, 1.000) 2s both;
}
.is-load .main-anim3 {
    opacity: 1;
	-webkit-animation: fade-in 2s cubic-bezier(0.215, 0.610, 0.355, 1.000) 4s both;
            animation: fade-in 2s cubic-bezier(0.215, 0.610, 0.355, 1.000) 4s both;
}

@-webkit-keyframes scale-in-center {
  0% {
    -webkit-transform: scale(0);
            transform: scale(0);
    opacity: 1;
  }
  100% {
    -webkit-transform: scale(1);
            transform: scale(1);
    opacity: 1;
  }
}
@keyframes scale-in-center {
  0% {
    -webkit-transform: scale(0);
            transform: scale(0);
    opacity: 1;
  }
  100% {
    -webkit-transform: scale(1);
            transform: scale(1);
    opacity: 1;
  }
}
@-webkit-keyframes fade-in {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
@keyframes fade-in {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

</style>
<body>
    <!-- Google Tag Manager (noscript) -->

    <!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5TSHTM5"

    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->

    <!-- End Google Tag Manager (noscript) -->
    <div id="container">
        <div id="header">
            <div class="inner">
                <a href="./index_cat.php" class="logo">
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
                            <p class="main-anim1">고양이는</p>
                            <p class="bg-line main-anim2">아파도 숨기는 사실,</p>
                            <p class="main-anim3">알고 계세요?</p>
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
                            <span class="quotes">“</span>
                            <span>반려묘를 꿰뚫어보는 <b>프로 집사도 주치의가 필요해요</b></span>
                            <span class="quotes">”</span>
                            <!-- <span>사랑하는 반려묘 앞에서는 <br><b>누구보다 예민해져야해요</b></span> -->
                        </div>
                    </div>
                    <div class="review-area">
                        <div class="yt-container">
                            <!-- <img src="./images/yt_container_cat_body.png" alt="" class="object _body">
                            <img src="./images/yt_container_cat_tail.png" alt="" class="object _tail"> -->
                            <div class="comming-soon"><span>COMMING SOON</span></div>
                            <div id="player-infl" class="player">
                                <!-- youtube video -->
                                <!-- <img src="./images/infl_video_sample.jpg" alt=""> -->
                            </div>
                        </div>
                        <!-- 활성탭에 따른 컨텐츠 변경 -->
                        <div class="tab-container-wrap">
                            <ul class="tab-container" data-video-target="infl">
                                <li>
                                    <!-- <button type="button" class="tab-trigger is-active" data-key="3_6h0o-t3Vw"> -->
                                    <button type="button" class="tab-trigger is-active" data-key="commingsoon">
                                        <img src="./images/infl_tab_thumb_01_active.png" alt="" class="thumb">
                                        <span>뽀양의 #주치의 프로젝트</span>
                                        <img src="./images/main_02_play_btn_active.png" alt="" class="play-btn">
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="tab-trigger" data-key="CAInhDnQFaA">
                                    <!-- <button type="button" class="tab-trigger" data-key="commingsoon"> -->
                                        <img src="./images/infl_tab_thumb_02_common.png" alt="" class="thumb">
                                        <span>지안스캣의 #주치의 프로젝트</span>
                                        <img src="./images/main_02_play_btn_common.png" alt="" class="play-btn">
                                    </button>
                                </li>
                                <li>
                                    <!-- <button type="button" class="tab-trigger" data-key="NWROQ1tCFPM"> -->
                                    <button type="button" class="tab-trigger" data-key="">
                                        <img src="./images/infl_tab_thumb_03_common.png" alt="" class="thumb">
                                        <span>아리랑의 #주치의 프로젝트</span>
                                        <img src="./images/main_02_play_btn_common.png" alt="" class="play-btn">
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section _03" id="section3">
                <div class="title-block">
                    <img src="./images/project_logo.svg" alt="고양이 주치의 프로젝트" class="project-logo">
                    <p class="prj-title">
                        <span class="text">
                            <em>주치의</em><img src="./images/icon_power2.png" alt="력" class="icon2"><em>테스트</em>
                        </span>
                    </p>
                    <p class="sub">
                        아픈 것을 잘 드러내지 않는 반려묘이기에 세심하게 살펴주는 가장 가까운 주치의로써의 관찰 능력은 필수!<br>
                        <b>나의 주치의력을 테스트 해 보시고 반려묘의 신호는 물론 무료 건강검진권 당첨의 기회도 잡으세요!</b>
                    </p>
                    <div class="date-block">
                        <p>참여기간  : 2020. 07. 30 ~ 08. 30  /  당첨자 확인 : 2020. 09. 30 </p>
                    </div>
                    <div class="bg-graph">
                        <img src="./images/section_03_group.png" alt="" class="img-group">
                        <div class="prize">
                            <div class="health">
                                <img src="./images/main_03_health_prize.png" alt="">
                                <span>10만원 상당의<br /><b>건강검진권</b></span>
                                <button type="button" data-popup="#reward1-popup">건강검진권 사용안내</button>
                            </div>
                            <div class="hema">
                                <img src="./images/main_03_hema_prize.png" alt="">
                                <span>혈뇨검출 체외진단기<br /><b>헤마츄리아 디텍션</b></span>
                                <button type="button" data-popup="#reward2-popup">헤마츄리아 사용법</button>
                            </div>
                        </div>
                    </div>
                    <a href="./gate.php" class="type-01" id="go-sub">시작하기</a>
                </div>
            </section>
            <section class="section _04" id="section4">
                <!-- <img src="./images/section_04_cutie.png" alt="고양이" class="cute"> -->
                <div class="title-block">
                    <img src="./images/project_logo.svg" alt="고양이 주치의 프로젝트" class="project-logo">
                    <p class="prj-title">
                        <span class="text">
                            <em>주치의</em><img src="./images/icon_power2.png" alt="력" class="icon2"><em>업그레이드 TIPS</em>
                        </span>
                    </p>
                </div>
                <div class="tab-container-wrap">
                    <ul class="tab-container" data-video-target="tips">
                        <li>
                            <button type="button" class="tab-trigger is-active" data-key="SauuYLbs_FI">
                                <img src="./images/tips_tab_icon_01_active.png" alt="" class="icon thumb" style="width:27px">
                                <span>동물병원 쉽게<br />데려가는 방법</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="tab-trigger" data-key="nBBb6CvKJ5s">
                                <img src="./images/tips_tab_icon_02_common.png" alt="" class="icon thumb" style="width:24px">
                                <span>반려묘에게<br />치명적인 질병은?</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="tab-trigger" data-key="nBBb6CvKJ5s">
                                <img src="./images/tips_tab_icon_03_common.png" alt="" class="icon thumb" style="width:26px">
                                <span>체중관리가 필요할 때<br />보이는 행동 5</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="tab-trigger" data-key="coy3EAxcrv0">
                                <img src="./images/tips_tab_icon_04_common.png" alt="" class="icon thumb" style="width:28px">
                                <span>반려묘의 소화기<br />위험신호</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="tab-trigger" data-key="hdhT-xC3byo">
                                <img src="./images/tips_tab_icon_05_common.png" alt="" class="icon thumb" style="width:32px">
                                <span>신장 관리<br />적색 신호</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="tab-trigger" data-key="8JscdpO7oeg">
                                <img src="./images/tips_tab_icon_06_common.png" alt="" class="icon thumb" style="width:20px">
                                <span>반려묘의<br />스트레스 신호</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="tab-trigger" data-key="hmiCvnEDckA">
                                <img src="./images/tips_tab_icon_07_common.png" alt="" class="icon thumb" style="width:29px">
                                <span>반려묘의<br />요로계 위험신호</span>
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
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.royalcanin.com/kr/cats/health-and-wellbeing/keeping-your-cat-at-a-healthy-weight" target="_blank">
                            <img src="./images/article_img_02.png" alt="" class="thumb">
                            <span class="text">
                                <span>체중 유지 방법</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.royalcanin.com/kr/cats/health-and-wellbeing/my-cat-is-losing-its-hair" target="_blank">
                            <img src="./images/article_img_03.png" alt="" class="thumb">
                            <span class="text">
                                <span>털이 빠지는 이유</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.royalcanin.com/kr/cats/health-and-wellbeing/common-illnesses-in-older-cats" target="_blank">
                            <img src="./images/article_img_04.png" alt="" class="thumb">
                            <span class="text">
                                <span>노령묘 질환</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.royalcanin.com/kr/cats/health-and-wellbeing/how-your-cats-diet-affects-its-urinary-health" target="_blank">
                            <img src="./images/article_img_05.png" alt="" class="thumb">
                            <span class="text">
                                <span>요로기계 건강이 중요한 이유</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.royalcanin.com/kr/cats/health-and-wellbeing/what-makes-a-cats-digestive-system-healthy" target="_blank">
                            <img src="./images/article_img_06.png" alt="" class="thumb">
                            <span class="text">
                                <span>소화기계</span>
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
        // $(window).on('load', function(){
        //     console.log('aaa');
        //     $("body").addClass("is-load");
        // })
        // $(window).load(function () {
        // });
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


        $(window).on('scroll', function(e) {
            var curTop = $(this).scrollTop();
            var headerHeight = $('#header').height();
            if(curTop < $('#section2').offset().top-headerHeight) {
                // 스크롤 현재 위치 섹션 1
                $(".menu li").removeClass("active");
                $('.menu li').eq(0).addClass("active");
            } else if(curTop >= $('#section2').offset().top-headerHeight && curTop < $('#section3').offset().top-headerHeight) {
                // 스크롤 현재 위치 섹션 2
                $(".menu li").removeClass("active");
                $('.menu li').eq(1).addClass("active");
            // } else if(curTop >= $('#section3').offset().top-headerHeight && curTop < $('#section4').offset().top-headerHeight - ($(window).height()-($('#section4').height()+$('#footer').height()))) {
            } else if(curTop >= $('#section3').offset().top-headerHeight && curTop < $('#section4').offset().top-headerHeight) {
                console.log("scroll3");
                // 스크롤 현재 위치 섹션 3
                $(".menu li").removeClass("active");
                $('.menu li').eq(2).addClass("active");
            } else  {
                console.log("scroll4");
                // 스크롤 현재 위치 섹션 4
                $(".menu li").removeClass("active");
                $('.menu li').eq(3).addClass("active");
            }
        });
        
        $(".menu li a").on("click", function(){
            // 스크롤로 헤더 메뉴 상태 제어시 아래 두줄 삭제 - 준우
            // $(".menu li").removeClass("active");
            // $(this).parent('li').addClass("active");
            var targetURL = $(this).attr('data-url');
            sectionMove(targetURL);
        })
        
        // 섹션 이동
        function sectionMove(target) {
            gsap.to(window, {duration: 1, scrollTo: { y: target, offsetY: 80 }, ease: "power2"});
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
                // var $img = $(el).find('img');
                var $img        = $(el).children('.thumb');
                var $playBtn    = $(el).children('.play-btn');
                if($(el).is($this)) {
                    $(el).addClass('is-active');
                    $img.attr('src', $img.attr('src').replace('common', 'active'));
                    if(targetVideo == 'infl')
                        $playBtn.attr('src', $playBtn.attr('src').replace('common', 'active'));
                } else {
                    $(el).removeClass('is-active');
                    $img.attr('src', $img.attr('src').replace('active', 'common'));
                    if(targetVideo == 'infl')
                        $playBtn.attr('src', $playBtn.attr('src').replace('active', 'common'));
                }
            });

            if(targetVideo == 'infl') {
                if(targetKey == '') {
                    playerInfl.stopVideo();
                    $('#player-infl').css('opacity', '0');
                    $('.comming-soon').show();
                } else {
                    $('#player-infl').css('opacity', '1');
                    playerInfl.cueVideoById({
                        'videoId': targetKey,
                        'startSeconds': 0,
                        'suggestedQuality': 'large'
                    });
                }
            } else {
                playerTips.cueVideoById({
                    'videoId': targetKey,
                    'startSeconds': 0,
                    'suggestedQuality': 'large'
                });
            }
        });


    </script>
</body>
</html>