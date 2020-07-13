$(function(){

	window.royalcaninCat = {};

	var $win = $(window),
		$doc = $(document),
		$html = $('html'),
		$body = $('body');
	

	var locationArray = location.href.split('/');
	var currentLocation = locationArray[locationArray.length-1].split('.')[0];

	royalcaninCat.popup = {
		bind : function(){
			$doc
				.on('click', '[data-popup]', function(e){
				var $this = $(this),
					$html = $('html'),
					val = $this.attr('data-popup');

				if (val.match('@close')){
					royalcaninCat.popup.close($this.closest('.popup'));
				} else {
					royalcaninCat.popup.show($(val));
				}

				if ($this.is('a')){
					e.preventDefault();
				}
			})
				.on('click', '[data-popup-close]', function(e){
				var $this = $(this),
					val = $this.attr('data-popup-close');

					royalcaninCat.popup.close($(val));

				if ($this.is('a')){
					e.preventDefault();
				}
			})
				.on('click', '.popup-wrap.is-opened .out-area', function(e) {
					// var $target = $(e.target);
					var $this = $(this);
					royalcaninCat.popup.close($this.siblings('.popup'));
					// if(e.target)
			});
		},
		show : function($popup){
			if ($popup.length){
				var $wrap = $popup.parent(),
					$html = $('html');


				if (!$wrap.hasClass('popup-wrap')){
					$popup.wrap('<div class="popup-wrap"></div>');
					$wrap = $popup.parent();
					$wrap.append('<div class="out-area"></div>');
				}

				if (!$wrap.hasClass('is-opened')){
					$wrap
						.stop().fadeIn(10, function(){
						$popup.trigger('afterPopupOpened', $wrap);
					})
						.addClass('is-opened');
				}

				if (!$html.hasClass('popup-opened')){
					$html.addClass('popup-opened');
				}
				$popup.trigger('popupOpened', $wrap);
			}
		},
		close : function($popup){
			if ($popup.length){
				var $wrap = $popup.parent(),
					$html = $('html');

				$wrap.stop().fadeOut(10, function(){
					$wrap.removeClass('is-opened');

					if (!$('.popup-wrap.is-opened').length){
						$html.removeClass('popup-opened');
					}

					//					$popup.trigger('afterpopupClosed', $wrap);
				});
				// if($popup.attr('data-popup-info')) {
				// 	click_tracking($popup.attr('data-popup-info')+' 팝업 클로즈');
				// }
				$popup.trigger('popupClosed', $wrap);
			}
		}
	};
	royalcaninCat.popup.bind();

	// 버튼 링크
	$('.link-btn').on('click', function() {
		var targetURL = $(this).attr('data-url');
		var type = $(this).attr('data-link-type');
		setTimeout(function() {
			if(type == '_self') {
				location.href = targetURL;
			} else {
				window.open(targetURL, '_blank');
			}
		}, 200);
	});

	// 모바일 전용 체크리스트 클릭 이벤트
	$doc.on('touchstart', '.chk-trigger', function() {
		$(this).addClass('fake-active');
	});
	$doc.on('touchend', '.chk-trigger', function() {
		$(this).removeClass('fake-active');
	});
});
// url query parsing
function get_query(){
	var url = document.location.href;
	var qs = url.substring(url.indexOf('?') + 1).split('&');
	for(var i = 0, result = {}; i < qs.length; i++){
		qs[i] = qs[i].split('=');
		result[qs[i][0]] = decodeURIComponent(qs[i][1]);
	}
	return result;
}
// Object.values IE 불가로 함수 만듦
function get_param_arr(obj) {
	var arr = [];
	for (var key in obj) {
		arr.push(obj[key]);
	}
	return arr;
}
