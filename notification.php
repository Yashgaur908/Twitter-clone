<?php 
	include 'core/init.php';
 	$user_id = $_SESSION['user_id'];
	$user    = $getFromU->userData($user_id);
	$getFromM->notificationViewed($user_id);
	$notify  = $getFromM->getNotificationCount($user_id);
	if($getFromU->loggedIn() === false){
		header('Location: index.php');
	}
	$notification  = $getFromM->notification($user_id);
 
 ?>

<!DOCTYPE html>
<html>

<head>
    <title>Notifications - Twitter</title>
    <meta charset="UTF-8" />
    
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL; ?>assets/images/bird.svg">

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"/>

   <script src='<?php echo BASE_URL;?>assets/js/jquery-3.1.1.min.js'></script>
    <link rel='stylesheet' href='<?php echo BASE_URL;?>assets/css/style.css' />
    <link rel='stylesheet' href='<?php echo BASE_URL;?>assets/css/font-awesome.css' />
    <link rel='stylesheet' href='<?php echo BASE_URL;?>assets/css/bootstrap.css' />   
    <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/style-complete.css" />
</head>

<body>
    <div class="grid-container">

        <?php require 'left-sidebar.php' ?>


        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/search.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/like.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/retweet.js"></script>


        <div class="main">
<!--            <div class="in-center">-->
<!--                <div class="in-center-wrap">-->

                    <!--NOTIFICATION WRAPPER FULL WRAPPER-->
                    <p class="page_title mb-0">Notifications</p>
                    <div class="notification-full-wrapper">

                        <div class="notification-full-head">
                            <div>
                                <a href="#">All</a>
                            </div>
                            <div>
                                <a href="#">Mention</a>
                            </div>
                            <div>
                                <a href="#">settings</a>
                            </div>
                        </div>
                        <?php foreach($notification as $data) :?>
                        <?php if($data->type == 'follow') :?>
                        <!-- Follow Notification -->
                        <!--NOTIFICATION WRAPPER-->
                        <div class="notification-wrapper">
                            <div class="notification-inner">
                                <div class="notification-header">

                                    <div class="notification-img">
                                        <span class="follow-logo">
                                            <i class="fa fa-child" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="notification-name">
                                        <div>
                                            <img src="<?php echo BASE_URL.$data->profileImage;?>" />
                                        </div>

                                    </div>
                                    <div class="notification-tweet">
                                        <a href="<?php echo BASE_URL.$data->username;?>" class="notifi-name"><?php echo $data->screenName;?></a><span> Followed you - <span><?php echo $getFromU->timeAgo($data->time);?></span>

                                    </div>

                                </div>

                            </div>
                            <!--NOTIFICATION-INNER END-->
                        </div>
                        <!--NOTIFICATION WRAPPER END-->
                        <!-- Follow Notification -->
                        <?php endif;?>

                        <?php if($data->type == 'like') :?>
                        <!-- Like Notification -->
                        <!--NOTIFICATION WRAPPER-->
                        <div class="notification-wrapper">
                            <div class="notification-inner">
                                <div class="notification-header">
                                    <div class="notification-img">
                                        <span class="heart-logo">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="notification-name">
                                        <div>
                                            <img src="<?php echo BASE_URL.$data->profileImage;?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="notification-tweet">
                                    <a href="<?php echo BASE_URL.$data->profileImage;?>" class="notifi-name"><?php echo $data->screenName;?></a><span> liked your <?php if($data->tweetBy === $user_id){echo 'Tweet';}else{echo 'Retweet';}?> - <span><?php echo $getFromU->timeAgo($data->time);?></span>
                                </div>
                                <div class="notification-footer">
                                    <div class="noti-footer-inner">
                                        <div class="noti-footer-inner-left">
                                            <div class="t-h-c-name">
                                                <span><a href="<?php echo BASE_URL.$user->username;?>"><?php echo $user->username;?></a></span>
                                                <span>@<?php echo $user->username;?></span>
                                                <span><?php echo $getFromU->timeAgo($data->postedOn);?></span>
                                            </div>
                                            <div class="noti-footer-inner-right-text">
                                                <?php echo $getFromT->getTweetlinks($data->status);?>
                                            </div>
                                        </div>
                                        <?php if(!empty($data->tweetImage)) :?>
                                        <div class="noti-footer-inner-right">
                                            <img src="<?php echo BASE_URL.$data->tweetImage;?>" />
                                        </div>
                                        <?php endif;?>

                                    </div>
                                    <!--END NOTIFICATION-inner-->
                                </div>
                            </div>
                        </div>
                        <!--NOTIFICATION WRAPPER END-->
                        <!-- Like Notification -->
                        <?php endif;?>

                        <?php if($data->type == 'retweet') :?>
                        <!-- Retweet Notification -->
                        <!--NOTIFICATION WRAPPER-->
                        <div class="notification-wrapper">
                            <div class="notification-inner">
                                <div class="notification-header">

                                    <div class="notification-img">
                                        <span class="retweet-logo">
                                            <i class="fa fa-retweet" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="notification-tweet">
                                        <a href="<?php echo BASE_URL.$data->username;?>" class="notifi-name"><?php echo $data->screenName;?></a><span> retweet your <?php if($data->tweetBy === $user_id){echo 'Tweet';}else{echo 'Retweet';}?> - <span><?php echo $getFromU->timeAgo($data->time);?></span>
                                    </div>
                                    <div class="notification-footer">
                                        <div class="noti-footer-inner">

                                            <div class="noti-footer-inner-left">
                                                <div class="t-h-c-name">
                                                    <span><a href="<?php echo BASE_URL.$user->username;?>"><?php echo $user->screenName;?></a></span>
                                                    <span>@<?php echo $user->username;?></span>
                                                    <span><?php echo $getFromU->timeAgo($data->postedOn);?></span>
                                                </div>
                                                <div class="noti-footer-inner-right-text">
                                                    <?php echo $getFromT->getTweetLinks($data->status)?>
                                                </div>
                                            </div>


                                            <?php if(!empty($data->tweetImage)) :?>
                                            <div class="noti-footer-inner-right">
                                                <img src="<?php echo BASE_URL.$data->tweetImage;?>" />
                                            </div>
                                            <?php endif;?>

                                        </div>
                                        <!--END NOTIFICATION-inner-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--NOTIFICATION WRAPPER END-->
                        <!-- Retweet Notification -->
                        <?php endif;?>

                        <?php if($data->type == 'mention') :?>
                        <?php 
			$tweet = $data;
			$likes        = $getFromT->likes($user_id, $tweet->tweetID);
			$retweet      = $getFromT->checkRetweet($tweet->tweetID, $user_id);
    			echo '<div class="all-tweet-inner">
					<div class="t-show-wrap">	
					 <div class="t-show-inner"> 
							<div class="t-show-popup" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'">
								<div class="t-show-head">
									<div class="t-show-img">
										<img src="'.BASE_URL.$tweet->profileImage.'"/>
									</div>
									<div class="t-s-head-co	ntent">
										<div class="t-h-c-name">
											<span><a href="'.BASE_URL.$tweet->username.'">'.$tweet->screenName.'</a></span>
											<span>Mentioned you - </span>
											<span>'.$getFromT->timeAgo($tweet->postedOn).'</span>
										</div>
										<div class="t-h-c-dis">
											'.$getFromT->getTweetLinks($tweet->status).'
										</div>
									</div>
								</div>'.

						 ((!empty($tweet->tweetImage)) ?  
					       '<div class="t-show-body">
								  <div class="t-s-b-inner">
									   <div class="t-s-b-inner-in">
									     <img src="'.BASE_URL.$tweet->tweetImage.'" class="imagePopup" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"/>
									   </div>
								  </div>	
							   </div>' : '' ) .'
						
				       </div>
						<div class="t-show-footer">
							<div class="t-s-f-right">
								<ul> 
									<li><button><i class="fa fa-share" aria-hidden="true"></i></button></li>	
									<li>'.(((isset($retweet['retweetID'])) ? $tweet->tweetID === $retweet['retweetID'] OR $user_id === $retweet['retweetBy'] : '') ? '<button class="retweeted" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount">'.(($tweet->retweetCount > 0) ? $tweet->retweetCount : '').'</span></button>' : '<button class="retweet" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount">'.(($tweet->retweetCount > 0) ? $tweet->retweetCount : '').'</span></button>').'</li>
									<li>'.(((isset($likes['likeOn'])) ?$likes['likeOn'] == $tweet->tweetID : '') ? '<button class="unlike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-heart" aria-hidden="true"></i><span class="likesCounter">'.(($tweet->likesCount > 0) ? $tweet->likesCount : '').'</span></button>' : '<button class="like-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="likesCounter">'.(($tweet->likesCount > 0) ? $tweet->likesCount : '').'</span></button>').'</li>
									'.(($tweet->tweetBy === $user_id) ? ' 
									<li>
										<a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
										<ul> 
										  <li><label class="deleteTweet" data-tweet="'.$tweet->tweetID.'">Delete Tweet</label></li>
										</ul>
									</li>' : '').'
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>';		 
			?>
                        <?php endif;?>
                        <?php endforeach;?>
                    </div>
                    <!--NOTIFICATION WRAPPER FULL WRAPPER END-->

                    <div class="loading-div">
                        <img id="loader" src="<?php echo BASE_URL;?>assets/images/loading.svg" style="display: none;" />
                    </div>
                    <div class="popupTweet"></div>
                    <!--Tweet END WRAPER-->
                    <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/popuptweets.js"></script>
                    <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/hashtag.js"></script>
                    <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/delete.js"></script>
                    <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/popupForm.js"></script>
                    <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/messages.js"></script>
                    <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/postMessage.js"></script>
                    <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/notification.js"></script>
                </div><!-- in left wrap-->
<!--            </div> in center end -->
<!--        </div>-->

        <script type='<?php echo BASE_URL;?>text/javascript' src='assets/js/search.js'></script>
        <script type='<?php echo BASE_URL;?>text/javascript' src='assets/js/hashtag.js'></script>

        <?php require 'right-sidebar.php' ?>

        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/follow.js'></script>

        <script src='<?php echo BASE_URL;?>assets/js/jquery-3.1.1.min.js'></script>
        <script src='<?php echo BASE_URL;?>assets/js/popper.min.js'></script>
        <script src='<?php echo BASE_URL;?>assets/js/bootstrap.min.js'></script>

</body>

</html>
