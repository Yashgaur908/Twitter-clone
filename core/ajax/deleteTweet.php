<?php 
    include '../init.php';
    if(isset($_POST['deleteTweet']) && !empty($_POST['deleteTweet'])){
      $tweet_id  = $_POST['deleteTweet'];
      $user_id   = $_SESSION['user_id'];
      //get tweet data from tweet id
      $tweet     = $getFromT->tweetPopup($tweet_id);
      //create link for tweet image to delete from
      $imageLink = '../../'.$tweet->tweetImage;
      //delete the tweet from database
      $getFromT->delete('tweets', array('tweetID' => $tweet_id, 'tweetBy' => $user_id));
      //check if tweet has image
      if(!empty($tweet->tweetImage)){
        //delete the file
        unlink($imageLink);
      }
     }

    if(isset($_POST['showpopup']) && !empty($_POST['showpopup'])){
       $tweet_id  = $_POST['showpopup'];
       $user_id   = $_SESSION['user_id'];
       $tweet     = $getFromT->tweetPopup($tweet_id);
    
?>
<div class="retweet-popup">
  <div class="wrap5">
    <div class="retweet-popup-body-wrap">
      <div class="retweet-popup-heading">
        <h3>Are you sure you want to delete this Tweet?</h3>
        <span><button class="close-retweet-popup"><i class="fa fa-times" aria-hidden="true"></i></button></span>
      </div>
       <div class="retweet-popup-inner-body">
        <div class="retweet-popup-inner-body-inner">
          <div class="retweet-popup-comment-wrap">
             <div class="retweet-popup-comment-head">
              <img src="<?php echo BASE_URL.$tweet->profileImage;?>"/>
             </div>
             <div class="retweet-popup-comment-right-wrap">
               <div class="retweet-popup-comment-headline">
                <a><?php echo $tweet->screenName;?> </a><span>‏@<?php echo $tweet->username . ' ' . $tweet->postedOn;?></span>
               </div>
               <div class="retweet-popup-comment-body">
                 <?php echo $tweet->status . ' ' .$tweet->tweetImage;?>
               </div>
             </div>
          </div>
         </div>
      </div>
      <div class="retweet-popup-footer"> 
        <div class="retweet-popup-footer-right">
          <button class="cancel-it f-btn">Cancel</button><button class="delete-it" data-tweet="<?php echo $tweet->tweetID;?>" type="submit">Delete</button>
        </div>
      </div>
    </div>
  </div>
</div>
<?php }?>
