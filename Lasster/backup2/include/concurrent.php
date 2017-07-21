<?php
/*
 * 2016-11-01 : Created New System : Todsaporn S.
 * 
 */
 
class concurrent{
	private $dbc = null;
	private $user_id = null;
	private $group_id = null;
	
	function __construct($dbc) {
		$this->dbc = $dbc;
	}
	/*
	function create(){
		global $_SESSION;
		$session_id = session_id();
		
		$data = array(
			"#id" => "DEFAULT",
			"user_id" => $_SESSION['auth']['user_id'],
			"user_name" => $_SESSION['auth']['user'],
			"session_id" => $session_id,
			"#status" => 1,
			"#created" => "NOW()",
			"#updated" => "NOW()"
		);

		$this->dbc->Insert("concurrents",$data);
		$_SESSION['concurrent'] = array(
			"id" => $this->dbc->GetID(),
			"created" => time(),
			"updated" => time()
		);
	}
	*/
	function update(){
		global $_SESSION;
		$session_id = session_id();
		
		$data = array(
			"#updated" => "NOW()"
		);
		
		$this->dbc->Update("concurrents",$data,"session_id LIKE '".$session_id."'");
		$_SESSION['concurrent']['updated'] = time();
	}
	
	function allow(){
		global $_SESSION;
		$dbc = $this->dbc;
		
		// Unallocated Event();
		$data = array(
			"#status" => 0,
			"#session_id" => "NULL",
			"#user_id" => "NULL",
			"#user_name" => "NULL",
			"#device" => "NULL",
			"#login" => "NULL",
			"#connected" => "NULL"
		);
		$this->dbc->Update("concurrents",$data,"connected < DATE_SUB(NOW(),INTERVAL 5 SECOND)");
		
		$line = $dbc->GetRecord("concurrents","COUNT(id)","status = 0");
		if($line[0] == 0){
			return false;
		}else{
			return true;
		}
		
	}
	
	function allocate(){
		global $_SESSION;
		$dbc = $this->dbc;
		$line = $dbc->GetRecord("concurrents","token","status = 0 LIMIT 0,1");
		return $line['token'];
	}
	
	function occupy($token,$device){
		global $_SESSION;
		$session_id = session_id();
		
		$data = array(
			"#status" => 1,
			"session_id" => $session_id,
			"user_id" => $_SESSION['auth']['user_id'],
			"user_name" => $_SESSION['auth']['user'],
			"device" => $device,
			"#login" => "NOW()",
			"#connected" => "NOW()"
		);

		$this->dbc->Update("concurrents",$data,"token='".$token."'");
	}
	
	function unallocate(){
		global $_SESSION;
		$session_id = session_id();
		
		$data = array(
			"#status" => 0,
			"#session_id" => "NULL",
			"#user_id" => "NULL",
			"#user_name" => "NULL",
			"#device" => "NULL",
			"#login" => "NULL",
			"#connected" => "NULL"
		);

		$this->dbc->Update("concurrents",$data,"session_id='".$session_id."'");
	}

	
}