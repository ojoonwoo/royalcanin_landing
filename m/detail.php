<?php
    include_once "./head.php";
    $it_key = $_REQUEST['it_key'];
?>
<body>
    <!-- Google Tag Manager (noscript) -->

    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5TSHTM5"

    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

    <!-- End Google Tag Manager (noscript) -->
    <div id="container">
        <div class="content _sub __detail">
        
            <a href="./index.php?it_key=<?=$it_key?>" id="go-before"></a>
            <a href="./" id="go-index"></a>
            <div class="title-block">
                <h1>로얄캐닌 <em data-key="productName"></em></h1>
                <p>반려견의 <em data-key="issue"></em> 위한<br><b>로얄캐닌의 맞춤형 영양 솔루션</b></p>
            </div>
            <div class="product-area">
                <div class="bg"></div>
                <div class="inner">
                    <video loop controls playsinline controlslist="nodownload" class="video-player video-js vjs-matrix" data-key="video" id="video-player">
                        <!-- <source src="./images/video_skin.mp4" type="video/mp4"> -->
                    </video>
                    <img class="prd-img" data-key="productImage" src="./images/main_02_product_skin.png" alt="더마 컴포트">
                    <p class="msg">동일한 제품의 견식과 습식 혼합 급여는 영양학적 효과를 높여줍니다</p>
                </div>
            </div>
            <div class="desc-area">
                <p data-key="productTxt"></p>
                <ul data-key="productDesc"></ul>
                <div class="button-wrap" data-key="buttonUrl">
                    <button type="button" class="type-01 with-icon icon-req link-btn" data-link-type="_self" onclick="lbReload('RCK_2020CCN_BTN_Sampling','','','');gtag('event', 'GA_RCK_2020CCN_BTN_Sampling');">견강체크 후<br>무료체험</button>
                    <button type="button" class="type-01 with-img img-feedbox link-btn" onclick="lbReload('RCK_2020CCN_BTN_SpecialBenefit','','','');gtag('event', 'GA_RCK_2020CCN_BTN_SpecialBenefit');">특별한 구매혜택</button>
                </div>
            </div>
            <div class="tip-area">
                <div class="title">
                    <span data-key="tipsTitle"></span> 위한 TIPS
                </div>
                <ul data-key="productTips"></ul>
            </div>
        </div>
    </div>
    <script src="https://vjs.zencdn.net/7.6.0/video.js"></script>
    <script>
        var player;
        var paramObj = {};
        var paramValArr = [];
        $(document).ready(function() {
            paramObj = get_query();
            // paramValArr = Object.values(paramObj);
            paramValArr = get_param_arr(paramObj);

            getProductDetail(paramValArr[0]);

            player = videojs('video-player', {
                controlBar: {
                    PictureInPictureToggle: false,
                    fullscreenToggle: true,
                },
                autoplay: false,
                muted: true,
                loop: false,
                responsive: true,
                preload: 'auto',
                height: $('#video-player').width()*9/16
            });
        });
        function getProductDetail(key) {
            $.ajax({
                url: "../product_detail.json",
                cache: false,
                dataType: "json",
                type: 'get',
                success: function (data) {
                    var object = data;
                    $('.__detail').addClass(object[key].className);
                    $('[data-key="productName"]').text(object[key].productName);
                    $('[data-key="issue"]').text(object[key].issue);
                    $('[data-key="tipsTitle"]').text(object[key].tipsTitle);
                    $('[data-key="productTxt"]').html(object[key].productTxt);
                    $('[data-key="productImage"]').attr({
                        'src': object[key].productImage,
                        'alt': object[key].productName
                    });
                    var prdDesc = "";
                    object[key].summary.forEach(function(item) {
                        var el = "<li>";
                            el += "<div class='icon'><img src='"+item.img+"'></div>";
                            el += "<p>"+item.text+"</p>";
                            el += "</li>";
                        prdDesc += el;
                    });
                    $('[data-key="productDesc"]').html(prdDesc);
                    var prdTips = "";
                    object[key].tips.forEach(function(item) {
                        var el = "<li>";
                            el += "<div class='icon'><img src='"+item.img+"'></div>";
                            el += "<p>"+item.text+"</p>";
                            el += "</li>";
                        prdTips += el;
                    });
                    $('[data-key="productTips"]').html(prdTips);
                    
                    $('[data-key="buttonUrl"] button').each(function(idx, el) {
                        $(this).attr('data-url', object[key].buttonUrl[idx]);
                    });

                    player.poster(object[key].video.poster);
                    player.src({
                        type: 'video/mp4',
                        src: object[key].video.src
                    });
                    setTimeout(function() {
                        player.play();
                    }, 1500);
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