<div class="sub-header">
    <a href="javascript:void(0)" id="go-before" onclick="gtag('event', 'GNB', {'event_category': '서브ALL페이지', 'event_label': '이전으로'});"></a>
    <a href="javascript:void(0)" id="go-index" onclick="gtag('event', 'GNB', {'event_category': '서브ALL페이지', 'event_label': '홈으로'});"></a>
</div>
<script>
    $(document).on('click', '#go-before', function(e) {
        if(typeof catTest !== 'undefined') {
            // 체크리스트일시 catTest 함수 태움
            return false;
        } else {
            history.go(-1);
        }
    });
    $(document).on('click', '#go-index', function() {
        var confirm = window.confirm('메인으로 돌아가시겠습니까? 처음부터 참여하셔야합니다.');
        if(confirm) {
            location.href = "./index.php";
        } else {
            return;
        }
    });
    
</script>