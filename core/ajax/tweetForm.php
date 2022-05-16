<?php 
	include '../init.php';
	$getFromU->preventAccess($_SERVER['REQUEST_METHOD'], realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

?>
 <!-- POPUP TWEET-FORM WRAP -->
<div class="popup-tweet-wrap">
		<div class="wrap">
		
		<div class="popwrap-inner">
			<div class="popwrap-header">
				<div class="popwrap-h-left">
					<h4></h4>
				</div>
				<span class="popwrap-h-right">
					<label class="closeTweetPopup" for="pop-up-tweet" ><i class="fa fa-times" aria-hidden="true" style="outline:none;"></i></label>
				</span>
			</div>
			<div class="popwrap-full tweet_body">
<!--
			<div class='left-tweet'>
                             PROFILE-IMAGE 
                            <img class="ml-3" src="<?php echo $user->profileImage; ?>" style="width: 53px;height:53px;border-radius:50%;" />
                        </div>
-->
			 <form id="popupForm" method='post' enctype='multipart/form-data'>
                                <textarea class='status' maxlength='141' name='status' placeholder="What's happening?" rows='3' cols='100%'style="font-size:17px;"></textarea>
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
			</div>
		</div>
	</div>
</div>
<!-- POPUP TWEET-FORM END -->
