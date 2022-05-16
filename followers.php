<?php 
 	if(isset($_GET['username']) === true && empty($_GET['username']) === false){
		include 'core/init.php';
		$username    = $getFromU->checkInput($_GET['username']);
		$profileId   = $getFromU->userIdByUsername($username);
		$profileData = $getFromU->userData($profileId);
		$user_id 	 = $_SESSION['user_id'];
		$user 		 = $getFromU->userData($user_id);
        $notify  = $getFromM->getNotificationCount($user_id);

 		if($getFromU->loggedIn() === false){
			header('Location:'.BASE_URL.'index.php');
		}

		if(!$profileData){
			header('Location:'.BASE_URL.'index.php');
		}

	}else{
		header('Location:'.BASE_URL.'index.php');
	}
?>

<!doctype html>
<html>

<head>
    <title>People following <?php echo $profileData->screenName. ' (@'.$profileData->username.')';?></title>
    <meta charset="UTF-8" />
    
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL; ?>assets/images/bird.svg">
    
    		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"/>
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/font-awesome.css' />
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/bootstrap.css' />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style-complete.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css" />
    <script src="<?php echo BASE_URL; ?>assets/js/jquery-3.1.1.min.js"></script>
    		<script src="https://code.jquery.com/jquery-3.1.1.min.js"  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="grid-container">

        <?php require 'left-sidebar.php' ?>

        <div class="main">
            <div class=''>
                <div class=''>
                    <!--TWEET WRAPPER-->
                    <p class="page_title mb-0"><i class="fa fa-arrow-left mr-4" style="color:#50b7f5;"></i><?php echo $user->username; ?></p>
                    <div class='profile-box'>
                        <div class='profile-cover mt-0'>
                            <!-- PROFILE-IMAGE -->
                            <img src="<?php echo BASE_URL.$profileData->profileCover; ?>" />
                        </div>
                        <div class='profile-body'>
                            <div class="profile-header">
                                <div class="profile-image">
                                    <img src="<?php echo BASE_URL.$profileData->profileImage; ?>" />
                                </div>
                                <div class="edit-button">
                                    <span>
                                        <?php echo $getFromF->followBtn($profileId, $user_id, $profileData->user_id); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="profile-text">
                                <div class="profile-name">
                                    <h5 class="mb-1 mt-2"><b><?php echo $user->screenName; ?></b></h5>
                                    <h6 class="mt-0" style="color:rgb(91, 112, 131);"><?php echo '@' . $user->username; ?></h6>
                                </div>
                                <div class="profile-bio">
                                    <h5><?php echo $getFromT->getTweetLinks($profileData->bio); ?></h5>
                                </div>
                                <div class="profile-link d-flex mt-3">
                                    <?php if(!empty($profileData->website)){ ?>
                                    <h6><i class="fa fa-link mr-2"></i><a class="mr-4" href="<?php echo $profileData->website; ?>" target="_blank" style="color:rgba(29,161,242,1.00);">
                                            <?php echo $profileData->website; ?></a></h6>
                                    <?php } ?>
                                    <?php if(!empty($profileData->country)){ ?>
                                    <h6 style="color:rgb(91, 112, 131);"><i class="fa fa-map-marker mr-2"></i><?php echo $profileData->country; ?></h6>
                                    <?php } ?>
                                </div>
                                <div class="profile-follow mt-2 d-flex">
                                    <h6 class="mr-3 ml-1" style="font-weight: 700;"><?php echo $profileData->following; ?>
                                        <a href="<?php echo BASE_URL.$profileData->username; ?>/following">
                                            <a href="<?php echo BASE_URL.$profileData->username; ?>/following" style="color:rgb(91, 112, 131);">Following</a>
                                        </a></h6>
                                    <h6 class="mr-3" style="font-weight: 700;"><?php echo $profileData->followers; ?>
                                        <a href="<?php echo BASE_URL.$profileData->username; ?>/followers" style="color:rgb(91, 112, 131);">
                                            Followers
                                        </a></h6>
                                    <h6 style="font-weight: 700;">
                                        <?php echo $getFromT->countTweets($profileId); ?>
                                        <a style="color:rgb(91, 112, 131);">Tweets</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="space" style="height:10px; width:100%; background:rgba(230, 236, 240, 0.5);">
                    </div>
                    <!--TWEET WRAP END-->

                    <div class="following-box">
                        <?php $getFromF->followersList($profileId, $user_id, $profileData->user_id);?>
                    </div>

                    <div class="popupTweet"></div>

                    <!--Tweet END WRAPER-->
                    <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/like.js'></script>
                    <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/retweet.js'></script>
                    <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/popuptweets.js'></script>
                    <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/delete.js'></script>
                    <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/comment.js'></script>
                    <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/popupForm.js'></script>
                    <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/fetch.js'></script>
                    <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/messages.js'></script>
                    <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/notification.js'></script>
                    <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/postMessage.js'></script>

                </div><!-- in left wrap-->
            </div><!-- in center end -->
        </div>

        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/search.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/hashtag.js'></script>

        <?php require 'right-sidebar.php' ?>

        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/follow.js'></script>

        <script src='<?php echo BASE_URL;?>assets/js/jquery-3.1.1.min.js'></script>
        <script src='<?php echo BASE_URL;?>assets/js/popper.min.js'></script>
        <script src='<?php echo BASE_URL;?>assets/js/bootstrap.min.js'></script>

    </div>
</body>

</html>
