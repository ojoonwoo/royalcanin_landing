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

// 쿠키 생성 함수
function setCookie(cName, cValue, cDay){
	var expire = new Date();
	expire.setDate(expire.getDate() + cDay);
	cookies = cName + '=' + escape(cValue) + '; path=/ '; // 한글 깨짐을 막기위해 escape(cValue)를 합니다.
	if(typeof cDay != 'undefined') cookies += ';expires=' + expire.toGMTString() + ';';
	document.cookie = cookies;
}
	
	
	
// 쿠키 가져오기 함수
function getCookie(cName) {
	cName = cName + '=';
	var cookieData = document.cookie;
	var start = cookieData.indexOf(cName);
	var cValue = '';
	if(start != -1) {
		start += cName.length;
		var end = cookieData.indexOf(';', start);
		if(end == -1) end = cookieData.length;
		cValue = cookieData.substring(start, end);
	}
	return unescape(cValue);
}

function shuffle(arr) { // randomly rearanges the items in an array
	const result = [];
	for (let i = arr.length-1; i >= 0; i--) {
		// picks an integer between 0 and i:
		const r = Math.floor(Math.random()*(i+1));   // NOTE: use a better RNG if cryptographic security is needed
		// inserts the arr[i] element in the r-th free space in the shuffled array:
		for(let j = 0, k = 0; j <= arr.length-1; j++) {
		if(result[j] === undefined) {
			if(k === r) {
			result[j] = arr[i];    // NOTE: if array contains objects, this doesn't clone them! Use a better clone function instead, if that is needed. 
			break;
			}
			k++;
		}
		}
	}
	return result;
}