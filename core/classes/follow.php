<?php
 class Follow extends User{
 	protected $message;

    public function __construct($pdo){
        $this->pdo = $pdo;
		$this->message = new Message($this->pdo);

 
    }

	public function checkFollow($followerID, $user_id){
		$stmt = $this->pdo->prepare("SELECT * FROM `follow` WHERE `sender` = :user_id  AND `receiver` = :followerID");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->bindParam(":followerID", $followerID, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);

	}

	public function followBtn($profileID, $user_id, $followID){
		$data = $this->checkFollow($profileID, $user_id);
		if($this->loggedIn()===true){

			if($profileID != $user_id){
				if(isset($data['receiver']) && $data['receiver'] === $profileID){
					//Following btn
					return "<button class='f-btn following-btn follow-btn' data-follow='".$profileID."' data-profile='".$followID."' style='outline:none;'>Following</button>";
				}else{
					//Follow button
					return "<button class='f-btn follow-btn' data-follow='".$profileID."' data-profile='".$followID."' style='outline:none;'><i class='fa fa-user-plus'></i>Follow</button>";
				}
			}else{
				//edit button
				return "<button class='new-btn' onclick=location.href='".BASE_URL."profileEdit.php' style='outline:none;'>Edit Profile</button>";
			}
		}else{
			return "<button style='outline:none;' class='f-btn' onclick=location.href='".BASE_URL."index.php'><i class='fa fa-user-plus'></i>Follow</button>";
		}
	}

	public function follow($followID, $user_id, $profileID){
		$date = date("Y-m-d H:i:s");
		$this->create('follow', array('sender' => $user_id, 'receiver' => $followID, 'followOn' => $date));
		$this->addFollowCount($followID, $user_id);
		$stmt = $this->pdo->prepare('SELECT `user_id`, `following`, `followers` FROM `users` LEFT JOIN `follow` ON `sender` = :user_id AND CASE WHEN `receiver` = :user_id THEN `sender` = `user_id` END WHERE `user_id` = :profileID');
		$stmt->execute(array("user_id" => $user_id,"profileID" => $profileID));
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		echo json_encode($data);
  		$this->message->sendNotification($followID, $user_id, $user_id, 'follow');
 
  	}

	public function unfollow($followID, $user_id, $profileID){
		$this->delete('follow', array('sender' => $user_id, 'receiver' => $followID));
		$this->removeFollowCount($followID, $user_id);
		$stmt = $this->pdo->prepare('SELECT `user_id`, `following`, `followers` FROM `users` LEFT JOIN `follow` ON `sender` = :user_id AND CASE WHEN `receiver` = :user_id THEN `sender` = `user_id` END WHERE `user_id` = :profileID');
		$stmt->execute(array("user_id" => $user_id,"profileID" => $profileID));
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		echo json_encode($data);
	}

	public function addFollowCount( $followID, $user_id){
		$stmt = $this->pdo->prepare("UPDATE `users` SET `following` = `following` + 1 WHERE `user_id` = :user_id; UPDATE `users` SET `followers` = `followers` + 1 WHERE `user_id` = :followID");
		$stmt->execute(array("user_id" => $user_id, "followID" => $followID));
	}

	public function removeFollowCount($followID, $user_id){
		$stmt = $this->pdo->prepare("UPDATE `users` SET `following` = `following` - 1 WHERE `user_id` = :user_id; UPDATE `users` SET `followers` = `followers` - 1 WHERE `user_id` = :followID");
		$stmt->execute(array("user_id" => $user_id, "followID" => $followID));
	}

	public function followingList($profileID, $user_id, $followID){
		$stmt = $this->pdo->prepare("SELECT * FROM `users` LEFT JOIN `follow` ON `receiver` = `user_id` AND CASE WHEN `sender` = :profileID THEN `receiver` = `user_id` END WHERE `sender` IS NOT NULL ");
		$stmt->bindParam(":profileID", $profileID, PDO::PARAM_INT);
		$stmt->execute();
		$followings = $stmt->fetchAll(PDO::FETCH_OBJ);
		foreach ($followings as $following) {
			echo '<div class="following-box">
                <div class="follow-unfollow-box">
					<div class="follow-unfollow-inner">
						
						<div class="follow-person-button-img mt-2">
							<div class="follow-person-img mr-4"> 
							 	<img src="'.BASE_URL.$following->profileImage.'"/>
							</div>
                            <div class="follow-person-name mt-2">
								<a href="'.BASE_URL.$following->username.'">'.$following->screenName.'</a>
							</div>
							<div class="follow-person-tname">
								<a href="'.BASE_URL.$following->username.'">@'.$following->username.'</a>
							</div>
							<div class="follow-person-button">
								 '.$this->followBtn($following->user_id, $user_id, $followID).'
						    </div>
						</div>
						<div class="follow-person-bio ml-5 mb-3">
							<div class="follow-person-dis ml-4">
								'.Tweet::getTweetLinks($following->bio).'
							</div>
						</div>
					</div>
				</div></div>';
		}
        echo '<div class="space"style="height:10px; width:100%; background:rgba(230, 236, 240, 0.5);"></div>';
	}

	public function followersList($profileID, $user_id, $followID){
		$stmt = $this->pdo->prepare("SELECT * FROM `users` LEFT JOIN `follow` ON `sender` = `user_id` AND CASE WHEN `receiver` = :profileID THEN `sender` = `user_id` END WHERE `user_id` and `receiver` IS NOT NULL");
		$stmt->bindParam(":profileID", $profileID, PDO::PARAM_INT);
		$stmt->execute();
		$followings = $stmt->fetchAll(PDO::FETCH_OBJ);
		foreach ($followings as $following) {
			echo '<div class="following-box">
                <div class="follow-unfollow-box">
					<div class="follow-unfollow-inner">
						<div class="follow-person-button-img mt-2">
							<div class="follow-person-img mr-4"> 
							 	<img src="'.BASE_URL.$following->profileImage.'"/>
							</div>
                            <div class="follow-person-name mt-2">
								<a href="'.BASE_URL.$following->username.'">'.$following->screenName.'</a>
							</div>
							<div class="follow-person-tname">
								<a href="'.BASE_URL.$following->username.'">@'.$following->username.'</a>
							</div>
							<div class="follow-person-button">
								 '.$this->followBtn($following->user_id, $user_id, $followID).'
						    </div>
						</div>
						<div class="follow-person-bio ml-5 mb-3">
							<div class="follow-person-dis ml-4">
								'.Tweet::getTweetLinks($following->bio).'
							</div>
						</div>
					</div>
				</div></div>';
		}
        echo '<div class="space"style="height:10px; width:100%; background:rgba(230, 236, 240, 0.5);"></div>';
	}

	public function whoToFollow($user_id, $profileID){
		$stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE `user_id` != :user_id AND `user_id` NOT IN (SELECT `receiver` FROM `follow` WHERE `sender` = :user_id) ORDER BY rand() LIMIT 3");
		$stmt->execute(array("user_id" => $user_id));
		$users = $stmt->fetchAll(PDO::FETCH_OBJ);
		echo '<div class="trends_container"><div class="trends_box"><div class="trends_header"><p>Who to follow</p></div>';
		foreach ($users as $user) {
			echo '<div class="follow-body trend">
					<div class="follow-img media-inner">
					  <img src="'.BASE_URL.$user->profileImage.'"/>
				    </div>
					<div class="media-inner">
						<div class="fo-co-head media-body">
							<a href="'.BASE_URL.$user->username.'">'.$user->screenName.'</a><br><span>@'.$user->username.'</span>
						</div>
						<!-- FOLLOW BUTTON -->
						'.$this->followBtn($user->user_id, $user_id, $profileID).'
					</div>
				</div>';
		}
		echo '<div class="trends_show-more">
                    <a href="">Show more</a>
                </div></div></div>';
	}

}
?>