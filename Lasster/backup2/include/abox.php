<?php
/*
 * 2017-14-02 : Create New Authenication System : Todsaporn S.
 * 
 */
class abox extends oceanos{
	public $auth = null;
	
	function __construct($dbc) {
		global $_SESSION;
		$this->dbc = $dbc;
		if(isset($_SESSION['auth'])){
			if($_SESSION['auth']['user_id']==0){
				$this->auth = $this->getAuthInfo(0);
			}else{
				$this->auth = $this->getAuthInfo($_SESSION['auth']['user_id']);
			}
		}else{
			$this->auth = null;
		}
	}
	
	function getAuthInfo($id){
		if($id != 0){
			$user = $this->dbc->GetRecord("users","*","id=".$id);
			$group = $this->dbc->GetRecord("groups","*","id=".$user['gid']);
			$contact = $this->dbc->GetRecord("contacts","*","id=".$user['contact']);
			$address = $this->dbc->GetRecord("address","*","contact=".$contact['id']);
			$setting = json_decode($user['setting'],true);
			
			if($contact['avatar']==""){
				$avatar = "img/default/user.png";
			}else{
				$avatar = $contact['avatar'];
			}
			
			$display_name = $user['name'];
			if($contact['name']!="")$display_name = $contact['name'];
			if($contact['surname']!="")$display_name .= " ".$contact['surname'];
			
			$auth = array(
				"id" => intval($user['id']),
				"username" => $user['name'],
				"gid" => $group['id'],
				"group" => $group['name'],
				"name" => $contact['name'],
				"title" => $contact['title'],
				"dob" => $contact['dob'],
				"gender" => $contact['gender'],
				"surname" => $contact['surname'],
				"email" => $contact['email'],
				"phone" => $contact['phone'],
				"mobile" => $contact['mobile'],
				"skype" => $contact['skype'],
				"avatar" => $avatar,
				"display" => $display_name,
				"setting" => $setting,
				"contact" => $contact,
				"address" => $address
			);
		}
		else{
			$auth = array(
				"id" => 0,
				"username" => "SYSTEM",
				"gid" => 0,
				"group" => "SYSTEM",
				"name" => "SYSTEM",
				"title" => "",
				"dob" => "",
				"gender" => "",
				"surname" => "SYSTEM",
				"email" => "support@maewnam.com",
				"phone" => "",
				"mobile" => "",
				"skype" => "",
				"avatar" => "img/default/user.png",
				"display" => "SYSTEM",
				"setting" => "",
				"contact" => "",
				"address" => ""
			);
		}
		return $auth;
	}	
}
?>