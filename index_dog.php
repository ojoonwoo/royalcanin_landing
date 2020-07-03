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

    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5TSHTM5"

    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

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
                            <a href="javascript:void(0)" data-url="#section2">제품소개</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" data-url="#section3" onclick="lbReload('RCK_2020CCN_BTN_menu_gotoEvent','','','');gtag('event', 'GA_RCK_2020CCN_BTN_menu_gotoEvent');">셀프견강체크&무료체험</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" data-url="#section4" onclick="lbReload('RCK_2020CCN_BTN_menu_gotoPromo','','','');gtag('event', 'GA_RCK_2020CCN_BTN_menu_gotoPromo');">100% 증정 이벤트</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="content _main">
            <section class="section _01" id="section1">
                <div class="inner">
                    <h1 class="title-img">
                        <img src="./images/main_01_title.png" alt="건강을 생각한다면 작은 신호도 지나치지 마세요">
                    </h1>
                    <div class="main-obj">
                        <div class="product">
                            <img src="./images/main_01_product.png" alt="제품 목록">
                        </div>
                        <div class="pome">
                            <img src="./images/main_01_pome.png" alt="포메라니안">
                        </div>    
                    </div>
                    <div class="button-wrap">
                        <button type="button" class="type-01 with-icon icon-req" onclick="sectionMove('#section3');lbReload('RCK_2020CCN_BTN_Sampling','','','');gtag('event', 'GA_RCK_2020CCN_BTN_Sampling');return false;">견강체크 후 무료체험</button>
                        <button type="button" class="type-01 with-img img-feedbox link-btn" data-url="https://smartstore.naver.com/petcore2018/products/4811682558" onclick="lbReload('RCK_2020CCN_BTN_SpecialBenefit','','','');gtag('event', 'GA_RCK_2020CCN_BTN_SpecialBenefit');">특별한 구매혜택</button>
                    </div>
                </div>
            </section>
            <section class="section _02" id="section2">
                <!-- 활성탭에 따른 컨텐츠 변경 -->
                <!-- json ajax -->
                <div class="title-object _1">제품소개</div>
                <h2 class="sec-title">반려견 건강 기능 사료 추천</h2>
                <p class="sec-sub"><b>건강상태에 꼭 맞는 건강기능사료</b>를 만나보세요</p>
                <ul class="tab-container">
                    <li>
                        <button type="button" class="tab-trigger skin" data-key="skin">피부</button>
                    </li>
                    <li>
                        <button type="button" class="tab-trigger weight" data-key="weight">체중</button>
                    </li>
                    <li>
                        <button type="button" class="tab-trigger digest" data-key="digest">소화</button>
                    </li>
                    <li>
                        <button type="button" class="tab-trigger neutral" data-key="neutral">중성화</button>
                    </li>
                    <li>
                        <button type="button" class="tab-trigger fur" data-key="fur">털</button>
                    </li>
                    <li>
                        <button type="button" class="tab-trigger stress" data-key="stress">안정감</button>
                    </li>
                </ul>
                <div class="product-container" data-key="className">
                    <div class="title-block">
                        <div class="inner">
                            <div class="title">
                                <span data-key="title"></span>
                                <span>로얄캐닌 <em data-key="productName"></em></span>
                            </div>
                            <img class="prd-img" data-key="productImage" src="./images/main_02_product_skin.png" alt="더마 컴포트">
                            <video playsinline controlslist="nodownload" class="video-player video-js vjs-matrix vjs-big-play-centered" data-key="video" id="video-player">
                                <!-- <source src="./images/video_skin.mp4" type="video/mp4"> -->
                            </video>
                            <div class="navi">
                                <span id="current-num">1</span>
                                <span>/</span>
                                <span>6</span>
                                <div class="arrow">
                                    <a href="javascript:void(0)"><img src="./images/slider_arrow.png" alt="" class="move-arrow pre-slide"></a>
                                    <a href="javascript:void(0)"><img src="./images/slider_arrow.png" alt="" class="move-arrow next-slide"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-wrap" data-key="buttonUrl">
                        <button type="button" class="type-01 with-img img-feedbox2 link-btn" data-url="https://smartstore.naver.com/petcore2018/products/4811682558">특별한 구매혜택</button>
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
                <div class="">

                </div>
                <!-- 체크리스트 1단계 -->
                <!-- 선택값에 따른 링크값 변경 -->
                <!-- <div class="title-object _2">셀프 견강 체크</div> -->
                <div class="title-object _2">셀프견강체크&무료체험</div>
                <h2 class="sec-title">가장 걱정되는 ‘견’강문제가 있나요?</h2>
                <p class="sec-sub"><b>건강상태를 체크</b>해 보시고<br><b>추천받는 건강기능 사료를 체험</b>해 보세요!</p>
                <div class="product">
                    <img src="./images/main_03_step1_product.png" alt="">
                </div>
                <div class="checklist">
                    <div class="row">
                        <button type="button" class="check-circle" data-key="skin">
                            <div class="inner">
                                <!-- <img class="object svg" src="./images/checklist_obj_skin.svg" alt="피부 건강"> -->
                                <div class="object"></div>
                                <span>피부건강관리</span>
                            </div>
                        </button>
                        <button type="button" class="check-circle" data-key="weight">
                            <div class="inner">
                                <div class="object"></div>
                                <span>체중관리</span>
                            </div>
                        </button>
                        <button type="button" class="check-circle" data-key="digest">
                            <div class="inner">
                                <div class="object"></div>
                                <span>변상태 관리</span>
                            </div>
                        </button>
                    </div>
                    <div class="row">
                        <button type="button" class="check-circle" data-key="neutral">
                            <div class="inner">
                                <div class="object"></div>
                                <span>중성화 체중관리</span>
                            </div>
                        </button>
                        <button type="button" class="check-circle" data-key="fur">
                            <div class="inner">
                                <div class="object"></div>
                                <span>털 관리</span>
                            </div>
                        </button>
                        <button type="button" class="check-circle" data-key="stress">
                            <div class="inner">
                                <div class="object"></div>
                                <span>안정감 유지</span>
                            </div>
                        </button>
                    </div>
                </div>

                <div class="next-step">
                    <!-- <button type="button" class="type-02" id="go-sub" data-popup="#step2-layer">다음 단계로</button> -->
                    <button type="button" class="type-02" id="go-sub" onclick="lbReload('RCK_2020CCN_BTN_CONV1_checklist','','','');gtag('event', 'GA_RCK_2020CCN_BTN_CONV1_checklist');">다음 단계로</button>
                    <span>* 최대 2개 선택 가능</span>
                </div>
            </section>
            <section class="section _04" id="section4">
                <div class="title-object _4">100% 증정 이벤트</div>
                <!-- <h2 class="sec-title">건강 관리의 첫 단계를 위한<br><b>로얄캐닌 건강기능 사료</b></h2> -->
                <h2 class="sec-title">건강기능 사료로 <b>견강 찾고!</b><br>최대 2만원 상당 한정판 <b>선물 받고!</b></h2>
                <img src="./images/main_promo_img.png" alt="사료구매시 사료통, 샘플 증정" class="promo-img">
                <button type="button" class="type-01 link-btn" data-url="https://smartstore.naver.com/petcore2018/products/4811682558" onclick="lbReload('RCK_2020CCN_BTN_SpecialBenefit','','','');gtag('event', 'GA_RCK_2020CCN_BTN_SpecialBenefit');">지금 구매하기</button>
            </section>
        </div>
        <div id="footer">
            <span class="for-a11y">Copyright © 2020. ROYAL CANIN all rights reserved.</span>
        </div>
    </div>
    <div class="popup" id="step2-layer">
        <div class="inner">
            <div id="container">
                <div class="content _sub __checklist">
                    <button type="button" class="popup-prev"  data-popup="@close"></button>
                    <div class="title-block">
                        <h1>발견하셨나요?</h1>
                        <p>강아지의 <b>신호를 1개 이상 선택</b>해주세요</p>
                    </div>
                    <ul class="checklist step2"></ul>
                    <button type="button" class="type-01" id="go-result" onclick="lbReload('RCK_2020CCN_BTN_CONV2_checklist','','','');gtag('event', 'GA_RCK_2020CCN_BTN_CONV2_checklist');">결과 확인</button>
                </div>
            </div>
        </div>
    </div>
    <div class="popup" id="result-layer">
        <div class="inner">
            <div id="container">
                <div class="content _sub __result">
                    <button type="button" class="popup-close"  data-popup="@close"></button>
                    <div class="title-block">
                        <div class="title">
                            반려견의 <em data-key="issue"></em><br><b data-key="statusMsg"></b>
                        </div>
                        <!-- 수의사 상담 필요 메시지 -->
                        <div class="need-doctor msg1-doctor">
                            <img src='./images/result_doctor_icon.png'>
                            <span data-key="text1_doctor"></span>
                        </div>
                        <!-- end 수의사 상담 필요 메시지 -->
                    </div>
                    <div class="product-area">
                        <div class="info-wrap">
                            <div class="img">
                                <img src="" alt="" data-key="productResultImage">
                            </div>
                            <div class="desc">
                                <!-- 수의사 상담 필요 메시지 -->
                                <div class="need-doctor msg2-doctor">
                                    <span class="product-subtitle _doctor" data-key="subTitle"></span>
                                    <div class="product-title">
                                        <span data-key="productTitle"></span>
                                    </div>
                                </div>
                                <!-- end 수의사 상담 필요 메시지 -->
                                <!-- 수의사 상담 불필요 메시지 -->
                                <div class="needless-doctor product-title">
                                    <span data-key="productTitle"></span>
                                </div>
                                <!-- 수의사 상담 불필요 메시지 -->
                                <div class="needless-doctor">
                                    <span class="product-subtitle" data-key="subTitle"></span>
                                </div>
                                <!-- end 수의사 상담 불필요 메시지 -->
                                <!-- end 수의사 상담 불필요 메시지 -->
                                <ul data-key="productInfo"></ul>
                            </div>
                        </div>
                    </div>
                    <div class="button-wrap" data-key="buttonUrl">
                        <button type="button" class="type-01 with-icon icon-req link-btn">무료체험 신청</button>
                        <button type="button" class="type-01 with-img img-feedbox link-btn" data-url="https://smartstore.naver.com/petcore2018/products/4811682558">특별한 구매혜택</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/slick.min.js"></script>
    <script src="https://vjs.zencdn.net/7.8.2/video.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.3/ScrollToPlugin.min.js"></script>
    <script>
        var paramObj = {};
        var paramValArr = [];
        var checklistEl = "";
        var checklist_step1 = [];
        var checklist2 = {};
        var counselingFlag = "N";
        var current_product_type = "skin";
        var player;
        var defaultKey = 'skin';
        $(document).ready(function () {
            paramObj = get_query();
            paramValArr = get_param_arr(paramObj);
            // console.log(paramValArr);

            if(paramObj.it_key) {
                defaultKey = paramObj.it_key;
                current_product_type = defaultKey;
                $(window).scrollTop($('#section2').offset().top-82);
            }
            // 제품영역 정보 불러오기
            getProductInfo(defaultKey, 'init');

            player = videojs('video-player', {
                controls: true,
                controlBar: {
                    PictureInPictureToggle: false,
                    fullscreenToggle: true,
                },
                // autoplay: 'muted',
                muted: true,
                autoplay: false,
                loop: false,
                // fluid: true,
                responsive: true,
                // aspectRatio: '16:9',
                // poster: './images/sample_poster.jpg',
                preload: 'auto',
                // src: './images/video_skin.mp4',
                // width: 568,
                height: $('#video-player').width() * 9 / 16
            });

            if(paramObj.event && paramObj.event.toLowerCase() == 'y') {
                setTimeout(function() {
                    sectionMove('#section3');
                }, 200);
            }

            
        });
        // backup code - 준우
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
            } else if(curTop >= $('#section3').offset().top-headerHeight && curTop < $('#section4').offset().top-headerHeight - ($(window).height()-($('#section4').height()+$('#footer').height()))) {
                // 스크롤 현재 위치 섹션 3
                $(".menu li").removeClass("active");
                $('.menu li').eq(2).addClass("active");
            } else  {
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

        // 상품영역 탭 이벤트
        $(document).on('click', '.tab-trigger', function () {
            var $this = $(this);
            var targetKey = $(this).attr('data-key');
            if ($this.hasClass('is-active')) {
                return;
            }
            $('.tab-container .tab-trigger').not($this).removeClass('is-active');
            // $this.addClass('is-active');
            getProductInfo(targetKey);
            current_product_type = targetKey;
        });
        // 상품영역 화살표 클릭 이벤트
        $(document).on('click', '.move-arrow', function () {
            var prev_targetKey = "";
            var next_targetKey = "";
            // 현재 위치
            switch (current_product_type) {
                case "skin":
                    prev_targetKey = "stress";
                    next_targetKey = "weight";
                    break;
                case "weight":
                    prev_targetKey = "skin";
                    next_targetKey = "digest";
                    break;
                case "digest":
                    prev_targetKey = "weight";
                    next_targetKey = "neutral";
                    break;
                case "neutral":
                    prev_targetKey = "digest";
                    next_targetKey = "fur";
                    break;
                case "fur":
                    prev_targetKey = "neutral";
                    next_targetKey = "stress";
                    break;
                case "stress":
                    prev_targetKey = "fur";
                    next_targetKey = "skin";
                    break;
            }

            if ($(this).hasClass('pre-slide'))
                var targetKey = prev_targetKey;
            else
                var targetKey = next_targetKey;
            $('.tab-container .tab-trigger').removeClass('is-active');
            $('.' + targetKey).addClass('is-active');

            current_product_type = targetKey;

            getProductInfo(targetKey);
        });

        // 체크리스트 1단계 이벤트
        $(document).on('click', '.check-circle', function () {
            var $this = $(this);
            var targetKey = $(this).attr('data-key');
            if (checklist_step1.indexOf(targetKey) !== -1) {
                // 있으므로 삭제
                checklist_step1.splice(checklist_step1.indexOf(targetKey), 1);
                $this.removeClass('is-active');
            } else {
                if (checklist_step1.length > 1) {
                    alert('2개까지 선택 가능합니다!');
                    return;
                }
                checklist_step1.push(targetKey);
                $this.addClass('is-active');
                console.log(checklist_step1);
            }
        });

        $(document).on('click', '#go-sub', function () {
            if (checklist_step1.length < 1) {
                alert('최대 2개까지의 항목을 선택해 주세요!');
                return false;
            }
            // var param = checklist_step1.length>1 ? "?param1="+checklist_step1[0]+"&param2="+checklist_step1[1] : "?param1="+checklist_step1[0];
            // location.href = "./sub.php"+param;
            $.ajax({
                url: "./checklist_info.json",
                cache: false,
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
                        if (key == checklist_step1[0] || key == checklist_step1[1]) {
                            checklist2[key] = {};
                            checklist2[key].order = object[key].order;
                            object[key].list.forEach(function (item) {
                                var el = "<li>";
                                el += "<button type='button' class='chk-trigger' data-key='" + key + "' data-counseling='" + item.counseling + "'>";
                                el += "<span class='chk-shape'></span>";
                                el += "<span class='text'>" + item.question + "</span>";
                                el += "</button>";
                                el += "</li>";

                                checklistEl += el;
                            });
                        }
                    }
                    $('.checklist.step2').html(checklistEl);
                    royalcaninUI.popup.show($("#step2-layer"));

                },
                error: function (jqXHR, errMsg) {
                    // Handle error
                    alert(errMsg);
                }
            });

        });



        // 섹션 이동
        function sectionMove(target) {
            gsap.to(window, {duration: 1, scrollTo: { y: target, offsetY: 80 }, ease: "power2"});
        }

        function getProductInfo(key, init) {
            // if($('.slick-wrapper').hasClass('slick-initialized')) {
            //     $('.slick-wrapper').slick('unslick');
            // }
            $('.tab-trigger[data-key="'+key+'"]').addClass('is-active');
            $.ajax({
                url: "./product_info.json",
                cache: false,
                dataType: "json",
                type: 'get',
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
                    $('.section._02 [data-key="buttonUrl"] button').each(function (idx, el) {
                        $(this).attr('data-url', object[key].buttonUrl[idx]);
                        $(this).attr('onclick', object[key].trackingCode[idx]+""+object[key].gaTrackingCode[idx]);
                    });
                    var i = 1;
                    object[key].review.forEach(function (item) {
                        var el = "<li class='review-slide' data-key='review' style='width: 322px;'>";
                        el += "<a href='" + item.url + "' data-key='url' target='_blank' onclick=\"gtag(\'event\', \'GA_RCK_2020CCN_BTN_Review_"+key+'_'+i+"\');\">";
                        if (object[key].review.length > 2 ) {
                            if (i == 2) {
                                el += "<div class='img'><img src='images/main_02_review_0" + i + "_hover_" + key + ".jpg' alt='" + item.text2 + "' class='' data-key='img'><div class='img2'><img src='images/main_02_review_0" + i + "_hover_" + key + ".jpg' alt='" + item.text2 + "' class=''></div></div>";
                            }else{
                                el += "<div class='img'><img src='" + item.img + "' alt='" + item.text2 + "' class='' data-key='img'><div class='img2'><img src='images/main_02_review_0" + i + "_hover_" + key + ".jpg' alt='" + item.text2 + "' class=''></div></div>";
                            }
                        }else{
                            el += "<div class='img'><img src='images/main_02_review_0" + i + "_hover_" + key + ".jpg' alt='" + item.text2 + "' class='' data-key='img'><div class='img2'><img src='images/main_02_review_0" + i + "_hover_" + key + ".jpg' alt='" + item.text2 + "' class=''></div></div>";
                        }
                        el += "<div class='text'><div class='tt' data-key='text1'>" + item.text1 + "</div><div class='sub' data-key='text2'>" + item.text2 + "</div></div>";
                        el += "</a></li>";
                        reviewElem += el;
                        reviewCount++;
                        i++;
                    });
                    if (reviewCount < 1) {
                        $('.review-block').hide();
                    } else {
                        $('.review-block').show();
                    }
                    $('.section._02 [data-key="reviewList"]').empty().html(reviewElem);
                    if (object[key].issue) {
                        $('.article-block').show();
                        $('.section._02 [data-key="issue"]').text(object[key].issue);
                        object[key].article.forEach(function (item, index) {
                            var txt = "<div class='icon'><img src='" + item.img + "' alt='" + item.text + "'></div>";
                            txt += "<div class='text'><span>" + item.text + "</span>";
                            // var btn = "<a href='" + item.url + "' target='_blank' onclick=lbReload(\'RCK_2020CCN_BTN_Tips\',\'\',\'\',\'\');>보기</a></div>";
                            var btn = "<span class='outBtn'>보기</span></div>";
                            articleElem += "<a href='" + item.url + "' target='_blank' onclick=\"lbReload(\'RCK_2020CCN_BTN_Tips\',\'\',\'\',\'\');gtag(\'event\', \'GA_RCK_2020CCN_BTN_Tips_"+key+'_'+(index+1)+"\');\"><li>" + txt + btn + "</li></a>";
                        });
                        $('.section._02 [data-key="articleList"]').empty().html(articleElem);
                    } else {
                        $('.article-block').hide();
                    }

                    var current_num = 1;
                    // 현재 위치
                    switch (key) {
                        case "skin":
                            current_num = 1;
                            break;
                        case "weight":
                            current_num = 2;
                            break;
                        case "digest":
                            current_num = 3;
                            break;
                        case "neutral":
                            current_num = 4;
                            break;
                        case "fur":
                            current_num = 5;
                            break;
                        case "stress":
                            current_num = 6;
                            break;
                    }
                    $("#current-num").html(current_num);
                    // reviewSwiperSetting(reviewCount);

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
                error: function (jqXHR, errMsg) {
                    // Handle error
                    alert(errMsg);
                }
            });
        }

        function reviewSwiperSetting(count) {
            var reviewCount = Number(count);
            var infiniteVal = false,
                dotsVal = true,
                initialSlideVal = 0;


            if (reviewCount < 2) {
                dotsVal = false;
                $('.review-slide').css('opacity', '1');
            }
            if (reviewCount < 3) {
                infiniteVal = false;
            }
            if (reviewCount > 2) {
                infiniteVal = true;
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

        // var resultIssue = "";
        $(document).on('click', '.chk-trigger', function() {
            var $this = $(this);
            $this.toggleClass('is-active');
        });

        $(document).on('click', '#go-result', function() {
            // 초기화
            var resultIssue = "";
            counselingFlag = "N";
            for(var i = 0; i < checklist_step1.length; i++) {
                var key = checklist_step1[i];
                checklist2[key].list = [];
            }

            // $('.chk-trigger.is-active').each(function(idx, el) {
            $('.chk-trigger').each(function(idx, el) {
                var key = $(this).attr('data-key');
                var question = $(this).find('.text').text();
                // var pushVal = {"question": question, "checked": "Y"};
                var pushVal = {"question": question, "checked": $(el).hasClass('is-active') ? "Y" : "N"};
                checklist2[key].list.push(pushVal);
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
            
            var key1 = checklist_step1[0],
                key2 = checklist_step1[1];

            for (var key in checklist2) {
                var len = 0;
                checklist2[key].list.forEach(function(item) {
                    if(item.checked == 'Y') {
                        len++;
                    }
                });
                checklist2[key].checkedLength = len;
                console.log(checklist2[key].checkedLength);
                // console.log('key:', key);
                // console.log('length:', len);
            }

            if(checklist_step1.length > 1) {
                var num = (Number(checklist2[key1].checkedLength) - Number(checklist2[key2].checkedLength));
                if (num > 0) {
                    // 1번키의 리스트 개수가 많음
                    resultIssue = key1;
                } else if (num < 0) {
                    // 2번키의 리스트 개수가 많음
                    resultIssue = key2;
                } else {
                    // 개수 동률 우선순위값으로 result 산출
                    // console.log(key1+' order:', Number(checklist2[key1].order));
                    // console.log(key2+' order:', Number(checklist2[key2].order));
                    resultIssue = (Number(checklist2[key1].order) < Number(checklist2[key2].order)) ? key1 : key2;
                }

                if (Number(checklist2[key1].checkedLength) < 1 && Number(checklist2[key2].checkedLength) < 1) {
                    alert('해당하는 항목을 1개 이상 선택해 주세요!');
                    return false;
                }

                // 불필요 값 삭제
                // delete checklist2[key2].order;
                // delete checklist2[key2].checkedLength;
            } else {
                resultIssue = checklist_step1[0];

                if (Number(checklist2[key1].checkedLength) < 1) {
                    alert('해당하는 항목을 1개 이상 선택해 주세요!');
                    return false;
                }
            }

            // 불필요 값 삭제
            // delete checklist2[key1].order;
            // delete checklist2[key1].checkedLength;
            // var param = "?issue="+resultIssue+"&counseling="+counselingFlag;
            // location.href = "./result.php"+param;
            // console.log(resultIssue);

            $.ajax({
                url: "./main_exec.php",
                type: 'POST',
                data: {
                    "exec"          : "insert_checked_data",
                    "check-data"    : JSON.stringify(checklist2)
                },
                // data: JSON.stringify(checkedList),
                success: function (response) {
                    // console.log(response);
                    getResultInfo(resultIssue);
                    royalcaninUI.popup.close($("#step2-layer"));

                    setTimeout(function() {
                        royalcaninUI.popup.show($("#result-layer"));
                        checklist2 = {};
                    }, 350);
                    
                    // royalcaninUI.popup.show($("#result-layer"));
                },
                error: function(jqXHR, errMsg) {
                    // Handle error
                    alert(errMsg);
                }
            });
        });
        // $(document).on('popupClosed', function(e) {
        //     console.log(e);
        //     if(e.target.id == 'step2-layer') {
        //         setTimeout(function() {
                    
        //         }, 350);
        //     }
        // });

        function getResultInfo(key) {
            $.ajax({
                url: "./result_info.json",
                cache: false,
                dataType: "json",
                type: 'get',
                success: function (data) {
                    var object = data;
                    $('.__result').removeClass('_skin _weight _digest _neutral _fur _stress _counseling-Y _counseling-N').addClass(object[key].className+ ' _counseling-'+counselingFlag);
                    counselingFlag = counselingFlag == 'Y' ? true : false;
                    if(counselingFlag) {
                        $('.content.__result [data-key="text1_doctor"]').html(object[key].text1_doctor);
                        $('.content.__result .needless-doctor').hide();
                        $('.content.__result .need-doctor').show();
                    } else {
                        $('.content.__result .need-doctor').hide();
                        $('.content.__result .needless-doctor').show();
                    }
                    var statusMsg = counselingFlag ? object[key].status_doctor : object[key].status;
                    $('.content.__result [data-key="statusMsg"]').text(statusMsg);
                    if (counselingFlag === false)
                        $('.content.__result [data-key="statusMsg"]').parent('div').attr("style","padding-bottom:50px");
                    else
                        $('.content.__result [data-key="statusMsg"]').parent('div').attr("style","");

                    $('.content.__result [data-key="issue"]').text(object[key].issue);
                    $('.content.__result [data-key="productResultImage"]').attr({
                        'src': object[key].productImage,
                        'alt': object[key].productTitle
                    });
                    var prdDesc = "";
                    object[key].productDesc.forEach(function(item) {
                        var el = "<li>";
                            el += "<div class='icon'><img src='"+item.icon+"'></div>";
                            el += "<div class='desc'>"+item.desc+"</div>";
                            el += "</li>";
                        prdDesc += el;
                    });
                    $('.content.__result [data-key="productInfo"]').html(prdDesc);
                    $('.content.__result [data-key="productTitle"]').html(object[key].productTitle);
                    var subTitle = counselingFlag ? object[key].subTitle_doctor : object[key].subTitle;
                    $('.content.__result [data-key="subTitle"]').html(subTitle);
                    $('.content.__result [data-key="buttonUrl"] button').each(function(idx, el) {
                        $(this).attr('data-url', object[key].buttonUrl[idx]);
                        $(this).attr('onclick', object[key].trackingCode[idx]+""+object[key].gaTrackingCode[idx]);
                    });
                },
                error: function(jqXHR, errMsg) {
                    // Handle error
                    alert(errMsg);
                }
            });
        }
    </script>
</body>
</html>