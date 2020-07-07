<?php
    include_once "../include/autoload.php";
    $mnv_f 			= new mnv_function();
    $my_db      = $mnv_f->Connect_MySQL();
    $mobileYN      = $mnv_f->MobileCheck();

    $siteURL = parse_url($mnv_f->siteURL());
    if ($mobileYN == "PC")
    {
		if(isset($siteURL['query'])) {
			echo "<script>location.href='../index.php?".$siteURL['query']."';</script>";
		} else {
			echo "<script>location.href='../index.php';</script>";
		}
    }else{
		$saveMedia     = $mnv_f->SaveMedia();
		$rs_tracking   = $mnv_f->InsertTrackingInfo($mobileYN);
		// print_r($rs_tracking);
    }

    include_once "./head.php";
?>
<body>
    <div id="container">
        <div id="menu-layer">
            <div class="inner">
                <ul>
                    <li>
                        <a href="#" data-url="#section1">
                            <span class="p-name">메인</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-url="#section2">
                            <span class="p-name">제품소개</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-url="#section3" onclick="lbReload('RCK_2020CCN_BTN_menu_gotoEvent','','','');">
                            <span class="p-name">셀프 견강 체크</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-url="#section4" onclick="lbReload('RCK_2020CCN_BTN_menu_gotoPromo','','','');">
                            <span class="p-name">100% 증정 이벤트</span>
                        </a>
                    </li>
                </ul>
                <img src="./images/menu_dog.png" alt="" class="dog">
            </div>
        </div>
        <div class="menu-transition-layer"></div>
        <div id="header">
            <a href="./" class="logo">
                <img src="./images/logo.png" alt="로얄캐닌 홈으로">
            </a>
            <button type="button" class="gnb-toggle">
                <div class="wrapper">
                    <div class="line _01"></div>
                    <div class="line _02"></div>
                    <div class="line _03"></div>
                </div>
            </button>
        </div>
        <div class="content _main">
            <section class="section _01" id="section1">
                <h1 class="title-img">
                    <img src="./images/main_01_title.png" alt="건강을 생각한다면 작은 신호도 지나치지 마세요" class="resize-elm title" data-width="0.43">
                </h1>
                <img src="./images/main_01_pome.png" alt="포메라니안" class="pome resize-elm" data-width="0.34">
                <img src="./images/main_01_product.png" alt="제품 목록" class="product resize-elm" data-width="0.468">
                <div class="button-wrap">
                    <button type="button" class="sec1-btn type-01 with-icon icon-req" onclick="sectionMove('#section3');lbReload('RCK_2020CCN_BTN_Sampling','','','');return false;">무료체험 신청</button>
                    <button type="button" class="sec1-btn type-01 with-img img-feedbox link-btn" data-url="https://smartstore.naver.com/petcore2018/products/4811682558" onclick="lbReload('RCK_2020CCN_BTN_SpecialBenefit','','','');">특별한 구매혜택</button>
                </div>
            </section>
            <section class="section _02" id="section2">
                <!-- 활성탭에 따른 컨텐츠 변경 -->
                <!-- json ajax -->
                <div class="title-object">제품소개</div>
                <h2 class="sec-title">반려견 건강 기능 사료 추천</h2>
                <p class="sec-sub"><b>건강상태에 꼭 맞는 건강기능사료</b>를 만나보세요</p>
                <ul class="tab-container">
                    <li>
                        <button type="button" class="tab-trigger" data-key="skin">피부</button>
                    </li>
                    <li>
                        <button type="button" class="tab-trigger" data-key="weight">체중</button>
                    </li>
                    <li>
                        <button type="button" class="tab-trigger" data-key="digest">소화</button>
                    </li>
                    <li>
                        <button type="button" class="tab-trigger" data-key="neutral">중성화</button>
                    </li>
                    <li>
                        <button type="button" class="tab-trigger" data-key="fur">털</button>
                    </li>
                    <li>
                        <button type="button" class="tab-trigger" data-key="stress">안정감</button>
                    </li>
                </ul>
                <div class="product-container" data-key="className">
                    <div class="title-block" style="position:relative;display:block">
                        <div>
                            <div class="title">
                                <span data-key="title"></span>
                                <span>로얄캐닌 <em data-key="productName"></em></span>
                            </div>
                            <img class="prd-img" data-key="productImage" src="./images/main_02_product_skin.png" alt="더마 컴포트">
                            <video playsinline controlslist="nodownload" class="video-player video-js vjs-matrix vjs-big-play-centered" data-key="video" id="video-player">
                                <!-- <source src="./images/video_skin.mp4" type="video/mp4"> -->
                            </video>
                        </div>
                        <div>
                            <div class="title">
                                <span data-key="title"></span>
                                <span>로얄캐닌 <em data-key="productName"></em></span>
                            </div>
                            <img class="prd-img" data-key="productImage" src="./images/main_02_product_skin.png" alt="더마 컴포트">
                            <video playsinline controlslist="nodownload" class="video-player video-js vjs-matrix vjs-big-play-centered" data-key="video" id="video-player">
                                <!-- <source src="./images/video_skin.mp4" type="video/mp4"> -->
                            </video>
                        </div>
                    </div>
                    <div class="button-wrap" data-key="buttonUrl">
                        <button type="button" class="type-01 with-img img-feedbox link-btn" data-url="https://smartstore.naver.com/petcore2018/products/4811682558" onclick="lbReload('RCK_2020CCN_BTN_Sampling','','','');">특별한 구매혜택</button>
                        <button type="button" class="type-01 with-icon icon-magni link-btn" data-link-type="_self">제품 보러 가기</button>
                    </div>
                    <div class="review-block">
                        <div class="title"><em data-key="productName"></em> 급여 후기</div>
                        <div class="slick-container review-swiper">
                            <ul class="slick-wrapper" data-key="reviewList"></ul>
                        </div>
                    </div>
                    <div class="article-block">
                        <div class="title"><em class="" data-key="issue"></em> 위한 TIPS</div>
                        <ul class="list" data-key="articleList"></ul>
                    </div>
                </div>
            </section>
            <section class="section _03" id="section3">
                <!-- 체크리스트 1단계 -->
                <!-- 선택값에 따른 링크값 변경 -->
                <div class="title-object">셀프 견강 체크</div>
                <h2 class="sec-title">가장 걱정되는 ‘견’강 문제가 있나요?</h2>
                <p class="sec-sub"><b>건강상태를 체크</b>해 보시고<br><b>추천받는 건강기능 사료를 체험</b>해 보세요!</p>
                <div class="checklist">
                    <div class="row">
                        <button type="button" class="check-circle chk-trigger" data-key="skin">
                            <div class="inner">
                                <!-- <img class="object svg" src="./images/checklist_obj_skin.svg" alt="피부 건강"> -->
                                <div class="object"></div>
                                <span>피부건강관리</span>
                            </div>
                        </button>
                        <button type="button" class="check-circle chk-trigger" data-key="weight">
                            <div class="inner">
                                <div class="object"></div>
                                <span>체중관리</span>
                            </div>
                        </button>
                    </div>
                    <div class="row">
                        <button type="button" class="check-circle chk-trigger" data-key="digest">
                            <div class="inner">
                                <div class="object"></div>
                                <span>변 상태 관리</span>
                            </div>
                        </button>
                        <button type="button" class="check-circle chk-trigger" data-key="neutral">
                            <div class="inner">
                                <div class="object"></div>
                                <span>중성화 체중관리</span>
                            </div>
                        </button>
                    </div>
                    <div class="row">
                        <button type="button" class="check-circle chk-trigger" data-key="fur">
                            <div class="inner">
                                <div class="object"></div>
                                <span>털 관리</span>
                            </div>
                        </button>
                        <button type="button" class="check-circle chk-trigger" data-key="stress">
                            <div class="inner">
                                <div class="object"></div>
                                <span>안정감 유지</span>
                            </div>
                        </button>
                    </div>
                </div>
                <div class="next-step">
                    <button type="button" class="type-01" id="go-sub" onclick="lbReload('RCK_2020CCN_BTN_CONV1_checklist','','','');">다음 단계로</button>
                    <span>* 최대 2개 선택 가능</span>
                </div>
            </section>
            <section class="section _04" id="section4">
                <div class="title-object">100% 증정 이벤트</div>
                <h2 class="sec-title">건강 관리의 첫 단계를 위한<br><b>로얄캐닌 건강기능 사료</b></h2>
                <img src="./images/main_promo_img.png" alt="사료구매시 사료통, 샘플 증정" class="promo-img">
                <button type="button" class="type-01 link-btn" data-url="https://smartstore.naver.com/petcore2018/products/4811682558" onclick="lbReload('RCK_2020CCN_BTN_SpecialBenefit','','','');">구매 혜택 받기</button>
            </section>
        </div>
        <div id="footer">
            <span class="for-a11y">Copyright © 2020. ROYAL CANIN all rights reserved.</span>
        </div>
    </div>
    <script src="../js/slick.min.js"></script>
    <!-- <script src="https://vjs.zencdn.net/7.8.2/video.js"></script> -->
    <script src="https://vjs.zencdn.net/7.6.0/video.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.3/ScrollToPlugin.min.js"></script>
    <script>
        var paramObj = {};
        var paramValArr = [];
        var player;
        var checklist = [];
        var defaultKey = 'skin';
        $(document).ready(function() {
            paramObj = get_query();
            // paramValArr = Object.values(paramObj);
            paramValArr = get_param_arr(paramObj);

            // 메인 섹션 1 한화면에 보일 수 있도록 조정
            var winwidth = $(window).width();
            var vh = $(window).height();
            $('.section._01 .resize-elm').each(function() {
                var wid = vh*$(this).attr('data-width');
                $(this).attr('style', 'width:'+(wid/winwidth)*100+'%');  
            })
            $('.menu-transition-layer').css({
                'width': winwidth*4,
                'height': winwidth*4,
                'top': -winwidth+'px',
                'right': -winwidth+'px',
            })

            if(paramObj.it_key) {
                defaultKey = paramObj.it_key;
                $(window).scrollTop($('#section2').offset().top-56.5);
            }
            // 제품영역 정보 불러오기
            getProductInfo(defaultKey);

            player = videojs('video-player', {
                controls: true,
                controlBar: {
                    PictureInPictureToggle: false,
                    fullscreenToggle: true,
                },
                muted: true,
                autoplay: false,
                loop: false,
                responsive: true,
                // poster: './images/poster_skin.jpg',
                preload: 'auto',
                // src: './images/video_skin.mp4',
                // width: $(window).width()-40,
                height: $('#video-player').width()*9/16
            });

            $('.title-block').slick({
                infinite: true,
                slidesToShow: 1,
                centerMode: true,
                // initialSlide: initialSlideVal,
                centerPadding: '84px',
                variableWidth: true,
                arrows: false,
                dots: false,
            });

            // main animation
            // var mainTl = gsap.timeline({});
            
            // console.log('main timeline start');
            // mainTl
            //     .to($('#section1 .title'), {duration: 0.7, opacity: 1, delay: 1})
            //     .to($('#section1 .product'), {duration: 0.55, y: 0, opacity: 1, ease: "power4.out"}, "-=0.7")
            //     .to($('#section1 .sec1-btn'), {duration: 0.45, y: 0, opacity: 1, ease: "sine"}, "-=0.55")
                // .to($('.menu-transition-layer'), {duration: 0.45, scale: 0, ease: "sine"}, "-=0.3")

            if(paramObj.event == 'Y') {
                setTimeout(function() {
                    sectionMove('#section3');
                }, 200);
            }
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
                        .to($('#menu-layer .dog'), {duration: 0.1, y: 5, autoAlpha: 0, rotation: -2})
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
                        .to($('#menu-layer .dog'), {duration: 0.1, y: 0, autoAlpha: 1}, "-=0.3")
                        .to($('#menu-layer .dog'), {duration: 0.2, rotation: 0, ease: "linear"}, "-=0.3")
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
            var targetKey = $(this).attr('data-key');
            if($this.hasClass('is-active')) {
                return;
            }
            $('.tab-container .tab-trigger').not($this).removeClass('is-active');
            // $this.addClass('is-active');
            getProductInfo(targetKey);
        });

        // 서브페이지로 이동
        $(document).on('click', '#go-sub', function() {
            if(checklist.length<1) {
                alert('1~2개 선택 필요');
                return false;
            }
            var param = checklist.length>1 ? "?param1="+checklist[0]+"&param2="+checklist[1] : "?param1="+checklist[0];
            location.href = "./sub.php"+param;
        });

        // 체크리스트 1단계 이벤트
        $(document).on('click', '.check-circle', function() {
            var $this = $(this);
            var targetKey = $(this).attr('data-key');
            if(checklist.indexOf(targetKey) !== -1) {
                // 있으므로 삭제
                checklist.splice(checklist.indexOf(targetKey), 1);
                $this.removeClass('is-active');
            } else {
                if(checklist.length > 1) {
                    alert('2개까지 선택 가능합니다!');
                    return;
                }
                checklist.push(targetKey);
                $this.addClass('is-active');
            }
        });

        // 제품영역 정보 불러오기
        function getProductInfo(key, init) {
            $('.tab-trigger[data-key="'+key+'"]').addClass('is-active');
            if($('.slick-wrapper').hasClass('slick-initialized')) {
                $('.slick-wrapper').slick('unslick');
            }
            $.ajax({
                url: "../product_info.json",
                // cache: false,
                dataType: "json",
                type: 'get',
                beforeSend: function() {
                },
                success: function (data) {
                    var object = data;
                    var reviewElem = "";
                    var reviewCount = 0;
                    var articleElem = "";
                    $('.section._02 [data-key="className"]').removeClass('_skin _weight _digest _neutral _fur _stress').addClass(object[key].className);
                    $('.section._02 [data-key="productName"]').text(object[key].productName);
                    $('.section._02 [data-key="title"]').text(object[key].title);
                    $('.section._02 [data-key="productImage"]').attr({
                        'src': object[key].productImage,
                        'alt': object[key].productName,
                    });
                    $('.section._02 [data-key="buttonUrl"] button').each(function(idx, el) {
                        $(this).attr('data-url', object[key].buttonUrl[idx]);
                        $(this).attr('onclick', object[key].trackingCode[idx]);
                    });
                    
                    object[key].review.forEach(function(item) {
                        var el = "<li class='review-slide' data-key='review' style='width: 183px;'>";
                            el += "<a href='"+item.url+"' data-key='url' target='_blank'>";
                            el += "<div class='img'><img src='"+item.img+"' alt='"+item.text2+"' class='' data-key='img'></div>";
                            el += "<div class='text'><div class='tt' data-key='text1'>"+item.text1+"</div><div class='sub' data-key='text2'>"+item.text2+"</div></div>";
                            el += "</a></li>";
                        reviewElem += el;
                        reviewCount++;
                    });
                    if(reviewCount<1) {
                        $('.review-block').hide();
                    } else {
                        $('.review-block').show();
                    }
                    $('.section._02 [data-key="reviewList"]').empty().html(reviewElem);
                    if(object[key].issue) {
                        $('.article-block').show();
                        $('.section._02 [data-key="issue"]').text(object[key].issue);
                        object[key].article.forEach(function(item) {
                            var txt = "<div class='text'>"+item.text+"</div>";
                            var btn = "<span>보기</span>";
                            // var btn = "<a href='"+item.url+"' target='_blank' onclick=lbReload(\'RCK_2020CCN_BTN_Tips\',\'\',\'\',\'\');>보기</a>";
                            articleElem += "<a href='"+item.url+"' target='_blank' onclick=lbReload(\'RCK_2020CCN_BTN_Tips\',\'\',\'\',\'\');><li>"+txt+btn+"</li></a>";
                        });
                        $('.section._02 [data-key="articleList"]').empty().html(articleElem);
                    } else {
                        $('.article-block').hide();
                    }
                    reviewSwiperSetting(reviewCount);
                    
                    // if(!init) {
                    player.poster(object[key].video.poster);
                    player.src({
                        type: 'video/mp4',
                        src: object[key].video.src
                    });
                    setTimeout(function() {
                        player.play();
                    }, 1500);
                        // var videoId = object[key].video.src;
                        // player.loadVideoById(videoId, 0);
                    // }
                },
                error: function(jqXHR, errMsg) {
                    // Handle error
                    alert(errMsg);
                }
            });
        }

        // 제품영역 리뷰 세팅
        function reviewSwiperSetting(count) {
            var reviewCount = Number(count);
            var infiniteVal = false,
                dotsVal = true,
                initialSlideVal = 0;

            
            if(reviewCount<2) {
                dotsVal = false;
                $('.review-slide').css('opacity', '1');
            }
            if(reviewCount<3) {
                infiniteVal = false;
            }
            if(reviewCount>2) {
                infiniteVal = false;
                initialSlideVal = 1;
            }
            $('.slick-wrapper').slick({
                infinite: infiniteVal,
                slidesToShow: 1,
                centerMode: true,
                initialSlide: initialSlideVal,
                centerPadding: '84px',
                variableWidth: true,
                arrows: false,
                dots: dotsVal,
            });
        }
        
    </script>
</body>
</html>