var $win = $(window),
	$doc = $(document),
	$html = $('html'),
	$body = $('body');

window.royalcaninUI = {};

// 레이어 팝업
royalcaninUI.popup = {
	bind: function () {
		$doc
			.on('click', '[data-popup]', function (e) {
				var $this = $(this),
					$html = $('html'),
					val = $this.attr('data-popup');

				if (val.match('@close')) {
					royalcaninUI.popup.close($this.closest('.popup'));
				} else {
					royalcaninUI.popup.show($(val));
				}

				if ($this.is('a')) {
					e.preventDefault();
				}
			})
			.on('click', '[data-popup-close]', function (e) {
				var $this = $(this),
					val = $this.attr('data-popup-close');

				royalcaninUI.popup.close($(val));

				if ($this.is('a')) {
					e.preventDefault();
				}
			});
	},
	show: function ($popup) {
		if ($popup.length) {
			var $wrap = $popup.parent(),
				$html = $('html');


			if (!$wrap.hasClass('popup-wrap')) {
				$popup.wrap('<div class="popup-wrap"></div>');
				$wrap = $popup.parent();
			}

			if (!$wrap.hasClass('is-opened')) {
				$wrap
					.stop().fadeIn(100, function () {
						$popup.trigger('afterPopupOpened', $wrap);
					})
					.addClass('is-opened');
			}

			if (!$html.hasClass('popup-opened')) {
				$html.addClass('popup-opened');
			}

			$popup.trigger('popupOpened', $wrap);
		}
	},
	close: function ($popup) {
		if ($popup.length) {
			var $wrap = $popup.parent(),
				$html = $('html');

			$wrap.stop().fadeOut(100, function () {
				$wrap.removeClass('is-opened');

				if (!$('.popup-wrap.is-opened').length) {
					$html.removeClass('popup-opened');
				}
				// console.log("close");
				checklist = {};
				checklistEl = "";
				$('.checklist.step2').html("");

				//					$popup.trigger('afterpopupClosed', $wrap);
			});

			$popup.trigger('popupClosed', $wrap);
		}
	}
};
royalcaninUI.popup.bind();

$win.load(function () {
	$("body").addClass("is-load");
});

// var paramObj = {};
// var paramValResultArr = [];
// $(document).ready(function() {
// 	// issue=digest&counseling=N
// 	paramObj = get_query();
// 	paramValResultArr = Object.values(paramObj);

// 	getResultInfo(resultIssue);
// });

function get_query(){
	var url = document.location.href;
	var qs = url.substring(url.indexOf('?') + 1).split('&');
	for(var i = 0, result = {}; i < qs.length; i++){
		qs[i] = qs[i].split('=');
		result[qs[i][0]] = decodeURIComponent(qs[i][1]);
	}
	return result;
}
function get_param_arr(obj) {
	var arr = [];
	for (var key in obj) {
		arr.push(obj[key]);
	}
	return arr;
}


$doc.ready(function() {
	$('.link-btn').on('click', function () {
		var targetURL = $(this).attr('data-url');
		var type = $(this).attr('data-link-type');
		setTimeout(function() {
			if (type == "_self") {
				location.href = targetURL;
			} else {
				var win = window.open(targetURL, '_blank');
				win.focus();
			}
		}, 200);
	});
});