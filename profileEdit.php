<?php 
	include 'core/init.php';
	if($getFromU->loggedIn() === false){
		header('Location: index.php');
	}

	$user_id = $_SESSION['user_id'];
	$user    = $getFromU->userData($user_id);
	$notify  = $getFromM->getNotificationCount($user_id);

 
	if(isset($_POST['screenName'])){
		if(!empty($_POST['screenName'])){
			$screenName  = $getFromU->checkInput($_POST['screenName']);
			$profileBio  = $getFromU->checkInput($_POST['bio']);
			$country     = $getFromU->checkInput($_POST['country']);
			$website     = $getFromU->checkInput($_POST['website']);

			if(strlen($screenName) > 20){
				$error  = "Name must be between in 6-20 characters";
			}else if(strlen($profileBio) > 120){
				$error = "Description is too long";
			}else if(strlen($country) > 80){
				$error = "Country name is too long";
			}else {
				 $getFromU->update('users', $user_id, array('screenName' => $screenName, 'bio' => $profileBio, 'country' => $country, 'website' => $website));
				 header('Location:'.$user->username);
			}
		}else{
			$error = "Name field can't be blank";
		}
	}

	if(isset($_FILES['profileImage'])){
		if(!empty($_FILES['profileImage']['name'][0])){
			$fileRoot  = $getFromU->uploadImage($_FILES['profileImage']);
			$getFromU->update('users', $user_id, array('profileImage' => $fileRoot));
			header('Location: profileEdit.php');
		}
	}


	if(isset($_FILES['profileCover'])){
		if(!empty($_FILES['profileCover']['name'][0])){
			$fileRoot  = $getFromU->uploadImage($_FILES['profileCover']);
			$getFromU->update('users', $user_id, array('profileCover' => $fileRoot));
			header('Location: profileEdit.php');
		}
	}
?>
<!doctype html>
<html>

<head>
    <title>Edit Profile - Twitter</title>
    <meta charset="UTF-8" />
    
    <link rel="shortcut icon" type="image/x-icon" href="./assets/images/bird.svg">
    
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"/>
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/font-awesome.css' />
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/bootstrap.css' />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style-complete.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css" />
    <script src="<?php echo BASE_URL; ?>assets/js/jquery-3.1.1.min.js"></script>
    	<script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="grid-container">

        <?php require 'left-sidebar.php' ?>


        <div class="main">

            <p class="page_title mb-0"><i class="fa fa-pencil-square-o mr-4" style="color:#50b7f5;"></i>Edit Profile</p>

            <div class='profile-box'>
                <div class='profile-cover mt-0'>
                    <!-- PROFILE-IMAGE -->
                    <img src="<?php echo BASE_URL.$user->profileCover; ?>" />
                    <div class="img-upload-button-wrap">
                        <div class="img-upload-button1">
                            <label for="cover-upload-btn">
                                <i class="fa fa-camera" aria-hidden="true"></i>
                            </label>
                            <span class="span-text1">
                                Change your profile photo
                            </span>
                            <input id="cover-upload-btn" type="checkbox" />
                            <div class="img-upload-menu1">
                                <span class="img-upload-arrow"></span>
                                <form method="post" enctype="multipart/form-data">
                                    <ul>
                                        <li>
                                            <label for="file-up">
                                                Upload photo
                                            </label>
                                            <input type="file" onchange="this.form.submit();" name="profileCover" id="file-up" />
                                        </li>
                                        <li>
                                            <label for="cover-upload-btn">
                                                Cancel
                                            </label>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='profile-body'>
                    <div class="profile-header">
                        <div class="profile-image">
                            <img src="<?php echo BASE_URL.$user->profileImage; ?>" />
                            <div class="img-upload-button-wrap1">
                                <div class="img-upload-button">
                                    <label for="img-upload-btn">
                                        <i class="fa fa-camera" aria-hidden="true"></i>
                                    </label>
                                    <!--
                                    <span class="span-text">
                                        Change your profile photo
                                    </span>
-->
                                    <input id="img-upload-btn" type="checkbox" />
                                    <div class="img-upload-menu">
                                        <span class="img-upload-arrow"></span>
                                        <form method="post" enctype="multipart/form-data">
                                            <ul>
                                                <li>
                                                    <label for="profileImage">
                                                        Upload photo
                                                    </label>
                                                    <input id="profileImage" type="file" onchange="this.form.submit();" name="profileImage" />

                                                </li>
                                                <li><a href="#">Remove</a></li>
                                                <li>
                                                    <label for="img-upload-btn">
                                                        Cancel
                                                    </label>
                                                </li>
                                            </ul>
                                        </form>
                                    </div>
                                </div>
                                <!-- img upload end-->
                            </div>
                        </div>
                        <div class="edit-button d-flex">
                            <span>
                                <button class="new-btn mr-3" type="button" onclick="window.location.href='<?php echo BASE_URL.$user->username;?>'" value="Cancel" style="outline:none;">Cancel</button>
                            </span>
                            <span>
                                <button class="new-btn" type="submit" id="save" value="Save Changes" style="outline:none;">Save</button>
                            </span>

                        </div>
                    </div>
                    <div class="profile-text">

                        <form id="editForm" method="post" enctype="multipart/Form-data" autocomplete="off">
                            <?php if(isset($imgError)){echo '<li>'.$imgError.'</li>';}?>
                            <div class="profile-name-wrap">
                                <div class="form-group">
                                    <label class="ml-1">Name</label>
                                    <input type="text" class="form-control" name="screenName" value="<?php echo $user->screenName;?>" />
                                </div>
                                <!--
                                <div class="profile-tname">
                                    @<?php echo $user->username;?>
                                </div>
-->
                            </div>

                            <div class="form-group">
                               <label class="ml-1">Location</label>
                                <input class="form-control" id="cn" type="text" name="country" placeholder="Country" value="<?php echo $user->country;?>" />
                            </div>


                            <div class="form-group">
                               <label class="ml-1">Website</label>
                                <input class="form-control" type="text" name="website" placeholder="Website" value="<?php echo $user->website;?>" />
                            </div>

                            <div class="profile-bio-wrap">
                                <div class="form-group">
                                    <label class="ml-1">Bio</label>
                                    <textarea class="status form-control" name="bio"><?php echo $user->bio;?></textarea>
                                    <div class="hash-box">
                                        <ul>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                           
                           
                           
                            <?php if(isset($error)){echo '<li>'.$error.'</li>';}?>
                        </form>
                        <script type="text/javascript">
                            $('#save').click(function() {
                                $('#editForm').submit();
                            });

                        </script>


                    </div>
                </div>
            </div>
        
        </div>


        <div class="popupTweet"></div>

        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/search.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/hashtag.js'></script>

        <?php require 'right-sidebar.php' ?>

        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/follow.js'></script>

        <script src='<?php echo BASE_URL;?>assets/js/jquery-3.1.1.min.js'></script>
        <script src='<?php echo BASE_URL;?>assets/js/popper.min.js'></script>
        <script src='<?php echo BASE_URL;?>assets/js/bootstrap.min.js'></script>

        <!-- SCRIPTS -->
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/comment.js'></script>
        <script type='text/javascript' src='<?php echo BASE_URL;?>assets/js/fetch.js'></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/popuptweets.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/delete.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/popupForm.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/retweet.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/like.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/hashtag.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/search.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/follow.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/messages.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/notification.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/postMessage.js"></script>


</body>

</html>
