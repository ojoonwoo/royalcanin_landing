<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>RoyalCanin</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/font.css">
    <link rel="stylesheet" href="./css/slick.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/slick.min.js"></script>
</head>
<body>
    <div id="container">
        <div class="content _sub __result">
            <a href="javascript:history.back()" id="go-before"></a>
            <div class="title-block">
                <!-- 수의사 상담 필요 메시지 -->
                <div class="need-doctor msg1-doctor">
                    <span data-key="text1_doctor"></span>
                </div>
                <!-- end 수의사 상담 필요 메시지 -->
                <div class="title">
                    반려견의 <em data-key="issue"></em><br><b data-key="statusMsg"></b>
                </div>
                <!-- 수의사 상담 불필요 메시지 -->
                <div class="needless-doctor">
                    <span class="product-subtitle" data-key="subTitle"></span>
                </div>
                <!-- end 수의사 상담 불필요 메시지 -->
            </div>
            <div class="product-area">
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
            <!-- 수의사 상담 필요 메시지 -->
            <div class="need-doctor msg2-doctor">
                <div class="product-title">
                    <span data-key="productTitle"></span>
                </div>
                <span class="product-subtitle" data-key="subTitle"></span>
            </div>
            <!-- end 수의사 상담 필요 메시지 -->
            <div class="button-wrap" data-key="buttonUrl">
                <button type="button" class="type-01 with-icon icon-req link-btn">무료체험 신청</button>
                <button type="button" class="type-01 with-img img-feedbox link-btn">지금 구매하면<br>특별 사료통 증정</button>
            </div>
        </div>
    </div>
    <script>
        var paramObj = {};
        var paramValArr = [];
        $(document).ready(function() {
            paramObj = get_query();
            // paramValArr = Object.values(paramObj);
            paramValArr = get_param_arr(paramObj);

            getResultInfo(paramValArr[0]);
        });
        function getResultInfo(key) {
            $.ajax({
                url: "./result_info.json",
                // cache: false,
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
                    });
                },
                error: function(jqXHR, errMsg) {
                    // Handle error
                    alert(errMsg);
                }
            });
        }
        function get_query(){
            var url = document.location.href;
            var qs = url.substring(url.indexOf('?') + 1).split('&');
            for(var i = 0, result = {}; i < qs.length; i++){
                qs[i] = qs[i].split('=');
                result[qs[i][0]] = decodeURIComponent(qs[i][1]);
            }
            return result;
        }
    </script>
</body>
</html>