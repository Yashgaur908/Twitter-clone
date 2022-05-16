<?php 
	include '../init.php';
 
	if(isset($_POST['comment']) && !empty($_POST['comment'])){
		$comment = $getFromU->checkInput($_POST['comment']);
		$user_id = $_SESSION['user_id'];
		$tweetID = $_POST['tweet_id'];

		$getFromU->create('comments', array('comment' => $comment, 'commentOn' => $tweetID, 'commentBy' => $user_id));
		$comments = $getFromT->comments($tweetID);
		$tweet = $getFromT->tweetPopup($tweetID);

		foreach ($comments as $comment) {
	 			echo '<div class="tweet-show-popup-comment-box">
						<div class="tweet-show-popup-comment-inner">
							<div class="tweet-show-popup-comment-head">
								<div class="tweet-show-popup-comment-head-left">
									 <div class="tweet-show-popup-comment-img">
									 	<img src="'.BASE_URL.$comment->profileImage.'">
									 </div>
								</div>
								<div class="tweet-show-popup-comment-head-right">
									  <div class="tweet-show-popup-comment-name-box">
									 	<div class="tweet-show-popup-comment-name-box-name"> 
									 		<a href="'.BASE_URL.$comment->username.'">'.$comment->screenName.'</a>
									 	</div>
									 	<div class="tweet-show-popup-comment-name-box-tname">
									 		<a href="'.BASE_URL.$comment->username.'">@'.$comment->username.'</a>
									 	</div>
									 </div>
									 <div class="tweet-show-popup-comment-right-tweet">
									 		<p><a href="'.BASE_URL.$tweet->username.'">@'.$tweet->username.'</a> '.$comment->comment.'</p>
									 </div>
								 	<div class="tweet-show-popup-footer-menu">
										<ul>
											<li><button><i class="fa fa-share" aria-hidden="true"></i></button></li>
											<li><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
											'.(($comment->commentBy === $user_id) ?  
											'<li>
												<a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
												<ul> 
												  <li><label class="deleteComment" data-tweet="'.$tweet->tweetID.'" data-comment="'.$comment->commentID.'">Delete Tweet</label></li>
												</ul>
											</li>' : '').'
										</ul>
									</div>
								</div>
							</div>
						</div>
						<!--TWEET SHOW POPUP COMMENT inner END-->
						</div>
						';
	 		}
	}
?>