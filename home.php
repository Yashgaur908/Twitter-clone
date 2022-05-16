<?php
include 'core/init.php';
$user_id = $_SESSION['user_id'];
$user = $getFromU->userData( $user_id );
$notify  = $getFromM->getNotificationCount( $user_id );

if ( $getFromU->loggedIn() === false ) {
    header( 'Location: '.BASE_URL.'index.php' );
}

if ( isset( $_POST['tweet'] ) ) {
    $status = $getFromU->checkinput( $_POST['status'] );
    $tweetImage = '';

    if ( !empty( $status ) or !empty( $_FILES['file']['name'][0] ) ) {
        if ( !empty( $_FILES['file']['name'][0] ) ) {
            $tweetImage = $getFromU->uploadImage( $_FILES['file'] );
        }

        if ( strlen( $status ) > 1000 ) {
            $error = 'The text of your tweet is too long';
        }
        $tweet_id = $getFromU->create( 'tweets', array( 'status' => $status, 'tweetBy' => $user_id, 'tweetImage' => $tweetImage, 'postedOn' => date( 'Y-m-d H:i:s' ) ) );
        preg_match_all( '/#+([a-zA-Z0-9_]+)/i', $status, $hashtag );

        if ( !empty( $hashtag ) ) {
            $getFromT->addTrend( $status );
        }
        $getFromT->addMention( $status, $user_id, $tweet_id );
        header( 'Location: home.php' );
    } else {
        $error = 'Type or choose image to tweet';
    }
}
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Home - Twitter</title>
    <meta charset='UTF-8' />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="./assets/images/bird.svg">
    <link rel = 'stylesheet' href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css'/>
    
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/style-complete.css' />
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/style.css' />
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/font-awesome.css' />
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/bootstrap.css' />
    <script src='<?php echo BASE_URL; ?>assets/js/jquery-3.1.1.min.js'></script>

    <script src = 'https://code.jquery.com/jquery-3.2.1.min.js'></script>


</head>

<body>

    <div class="grid-container">
        <!--    <div class='wrapper'>-->

        <?php require 'left-sidebar.php' ?>

        <div class="main">
            <div class=''>
                <div class=''>
                    <!--TWEET WRAPPER-->
                    <p class="page_title mb-0">Home</p>
                    <div class='tweet_box tweet_add'>
                        <div class='left-tweet ml-3'>
                            <!-- PROFILE-IMAGE -->
                            <img class="mr-3" src="<?php echo $user->profileImage; ?>" style="width: 53px;height:53px;border-radius:50%;" />
                        </div>
                        
                        <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/search.js'></script>
                        <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/hashtag.js'></script>

                        <div class='tweet_body'>
                            <form method='post' enctype='multipart/form-data'>
                                <textarea class='status' maxlength='1000' name='status' placeholder="What's happening?" rows='3' cols='100%' style="font-size:17px;"></textarea>
                                <div class='hash-box'>
                                    <ul>
                                    </ul>
                                </div>

                                <div class='tweet_icons-wrapper'>
                                    <div class='t-fo-left tweet_icons-add'>
                                        <ul>
                                            <input type='file' name='file' id='file' />
                                            <li><label for='file'><i class='fa fa-image' aria-hidden='true'></i></label>
                                                <i class="fa fa-bar-chart"></i>
                                                <i class="fa fa-smile-o"></i>
                                                <i class="fa fa-calendar-o"></i>
                                            </li>
                                            <span class='tweet-error'><?php if ( isset( $error ) ) {
                                                echo $error;
                                            } else if ( isset( $imgError ) ) {
                                                echo '<br>' . $imgError;
                                            }
                                            ?></span>
                                            <!--<i class="fa fa-image"></i>-->

                                        </ul>
                                    </div>
                                    <div class='t-fo-right'>
                                        <!--<span id='count'>140</span>-->
                                        <!--<input type='submit' name='tweet' value='tweet' />-->

                                        <button class="button_tweet" type="submit" name="tweet" style="outline:none;">Tweet</button>

                                    </div>
                            </form>
                        </div>
                        <!--</div>-->
                    </div>
                </div>
                <div class="space" style="height:10px; width:100%; background:rgba(230, 236, 240, 0.5);">
                </div>
                <!--TWEET WRAP END-->

                <!--Tweet SHOW WRAPPER-->
                <div class='tweets'>
                    <?php $getFromT->tweets( $user_id, 20 );
                    ?>
                </div>
                <!--TWEETS SHOW WRAPPER-->

                <div class='loading-div'>
                    <img id='loader' src='assets/images/loading.svg' style='display: none;' />
                </div>
                <div class='popupTweet'></div>
                <!--Tweet END WRAPER-->
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/like.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/retweet.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/popuptweets.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/delete.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/comment.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/popupForm.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/fetch.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/messages.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/notification.js'></script>
                <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/postMessage.js'></script>

            </div><!-- in left wrap-->
        </div><!-- in center end -->
    </div>

    

    <?php require 'right-sidebar.php' ?>

    <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/follow.js'></script>

    <script src='<?php echo BASE_URL; ?>assets/js/jquery-3.1.1.min.js'></script>
    <script src='<?php echo BASE_URL; ?>assets/js/popper.min.js'></script>
    <script src='<?php echo BASE_URL; ?>assets/js/bootstrap.min.js'></script>

</body>

</html>
