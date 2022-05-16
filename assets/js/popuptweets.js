$(function(){
	$(document).on('click', '.t-show-popup', function(){
		var tweet_id = $(this).data('tweet');
		var user_id  = $(this).data('user');

		$.post('http://localhost/twitter/core/ajax/popuptweets.php', {showpopup:tweet_id,user_id:user_id}, function(data){
			$('.popupTweet').html(data);
			$('.tweet-show-popup-box-cut').click(function(){
				$('.tweet-show-popup-wrap').hide();
			});
		});
	});
	$(document).on('click','.imagePopup', function(e){
		e.stopPropagation();
		var tweet_id = $(this).data('tweet');
		var user_id  = $(this).data('user');

		$.post('http://localhost/twitter/core/ajax/imagePopup.php', {showImage:tweet_id,user_id:user_id}, function(data){
			$('.popupTweet').html(data);
			$('.close-imagePopup').click(function(){
				$('.img-popup').hide();
			});

		});
	});
});