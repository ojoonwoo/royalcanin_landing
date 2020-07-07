<?php
    include_once "./head.php";
?>
<body>
    <!-- Google Tag Manager (noscript) -->

    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5TSHTM5"

    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

    <!-- End Google Tag Manager (noscript) -->
    <div id="container">
        <div class="content _sub __result">
            <?php
                include_once "./sub_header.php";
            ?>
            <div class="title-block">
                <div class="title">
                    반려견의 <em data-key="issue"></em><br><b data-key="statusMsg"></b>
                </div>
                <!-- 수의사 상담 필요 메시지 -->
                <div class="need-doctor msg1-doctor">
                    <span data-key="text1_doctor"></span>
                </div>
                <!-- end 수의사 상담 필요 메시지 -->
                <!-- 수의사 상담 불필요 메시지 -->
                <div class="needless-doctor">
                    <span class="product-subtitle" data-key="subTitle"></span>
                </div>
                <!-- end 수의사 상담 불필요 메시지 -->
            </div>
            <div class="product-area">
                <!-- 수의사 상담 필요 메시지 -->
                <div class="need-doctor msg2-doctor">
                    <span class="product-subtitle" data-key="subTitle"></span>
                    <div class="product-title">
                        <span data-key="productTitle"></span>
                    </div>
                </div>
                <!-- end 수의사 상담 필요 메시지 -->
                <!-- 수의사 상담 불필요 메시지 -->
                <div class="needless-doctor product-title">
                    <span data-key="productTitle"></span>
                </div>
                <!-- end 수의사 상담 불필요 메시지 -->
                <div class="info-wrap">
                    <img src="" alt="" data-key="productImage">
                    <ul data-key="productInfo"></ul>
                </div>
            </div>
            <div class="button-wrap" data-key="buttonUrl">
                <button type="button" class="type-01 with-icon icon-req link-btn">무료체험 신청</button>
                <button type="button" class="type-01 with-img img-feedbox link-btn">특별한 구매혜택</button>
            </div>
        </div>
    </div>
    <script>
        var keyPool = ['skin', 'weight', 'digest', 'neutral', 'fur', 'stress'];
        var paramObj = {};
        var paramValArr = [];
        $(document).ready(function() {
            paramObj = get_query();
            // paramValArr = Object.values(paramObj);
            paramValArr = get_param_arr(paramObj);

            if($.inArray(paramValArr[0], keyPool) == -1) {
                alert('정상적으로 참여해주세요!');
                location.href = './index.php';
                // paramValArr.splice(paramValArr.indexOf(paramValArr[i]), 1);
                // if(paramValArr.length)
                // console.log(paramValArr.length);
            }

            getResultInfo(paramValArr[0]);

        });
        function getResultInfo(key) {
            $.ajax({
                url: "../result_info.json",
                cache: false,
                dataType: "json",
                type: 'get',
                success: function (data) {
                    var object = data;
                    $('.__result').addClass(object[key].className+ ' _counseling-'+paramValArr[1]);
                    var counselingFlag = paramValArr[1] == 'Y' ? true : false;
                    if(counselingFlag) {
                        $('[data-key="text1_doctor"]').html(object[key].text1_doctor);
                        $('.need-doctor').show();
                    } else {
                        $('.needless-doctor').show();
                    }
                    var statusMsg = counselingFlag ? object[key].status_doctor : object[key].status;
                    $('[data-key="statusMsg"]').text(statusMsg);
                    $('[data-key="issue"]').text(object[key].issue);
                    $('[data-key="productImage"]').attr({
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
                    $('[data-key="productInfo"]').html(prdDesc);
                    $('[data-key="productTitle"]').html(object[key].productTitle);
                    var subTitle = counselingFlag ? object[key].subTitle_doctor : object[key].subTitle;
                    $('[data-key="subTitle"]').html(subTitle);
                    $('[data-key="buttonUrl"] button').each(function(idx, el) {
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