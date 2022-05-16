<?php
include 'core/init.php';
 if (isset($_GET['username']) === true && empty($_GET['username']) === false) {
  $username = $getFromU->checkInput($_GET['username']);
  $profileId = $getFromU->userIdByUsername($username);
  $profileData = $getFromU->userData($profileId);
  $user_id = @$_SESSION['user_id'];
  $user = $getFromU->userData($user_id);
  $notify  = $getFromM->getNotificationCount($user_id);

 
  if (!$profileData) {
    header('Location: '.BASE_URL.'index.php');
  }
}

?>

<!doctype html>
<html>

<head>
    <title><?php echo $profileData->screenName.' (@'.$profileData->username.')'; ?></title>
    <meta charset="UTF-8" />
    
    <link rel="shortcut icon" type="image/x-icon" href="./assets/images/bird.svg">
    
      	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"/>
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/style-complete.css' />
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/style.css' />
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/font-awesome.css' />
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/bootstrap.css' />
    <script src="<?php echo BASE_URL; ?>assets/js/jquery-3.1.1.min.js"></script>
      	<script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="grid-container">

        <?php require 'left-sidebar.php' ?>

        <!--Profile cover-->
        <div class="main">
            <div class=''>
                <div class=''>
                    <!--TWEET WRAPPER-->
                    <p class="page_title mb-0"><i class="fa fa-arrow-left mr-4" style="color:#50b7f5;"></i><?php echo $profileData->username; ?></p>
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
                                    <h5 class="mb-1 mt-2"><b><?php echo $profileData->screenName; ?></b></h5>
                                    <h6 class="mt-0" style="color:rgb(91, 112, 131);"><?php echo '@' . $profileData->username; ?></h6>
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
                                    <h6 class="mr-3"style="font-weight: 700;"><?php echo $profileData->followers; ?>
                                    <a href="<?php echo BASE_URL.$profileData->username; ?>/followers"style="color:rgb(91, 112, 131);">
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

                    <!--Tweet SHOW WRAPPER-->
                    <div class='tweets'>
                        <?php $getFromT->tweets( $user_id, 100 );
                        ?>
                    </div>
                    <!--TWEETS SHOW WRAPPER-->

                    <div class='loading-div'>
                        <img id='loader' src='assets/images/loading.svg' style='display: none;' />
                    </div>
                    <div class='popupTweet'></div>
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

</body>

</html>
