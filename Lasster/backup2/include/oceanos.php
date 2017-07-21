<?php

/*
 * 2016-02-16 : Created New System : Todsaporn S.
 * 2017/04/14 : Save and Load Variable : Todsaporn S.
 * 
 */

class oceanos{
	protected $dbc = null;
	protected $allow_upload_file = array('gif','png','jpg','svg');
	private $user_id = null;
	private $group_id = null;
	
	function __construct($dbc) {
		$this->dbc = $dbc;
	}
	
	
	
	function set_upload_allow($ext){
		$this->allow_upload_file(explode(",",$ext));
	}
	
	function upload($file,$target){
		$allowed =  $this->allow_upload_file;
		if(!isset($file)){
			return array(
				'success' => false,
				'msg' => "No File Upload!"
			);
		}else{
			$filename = $file['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			if(!in_array($ext,$allowed)) {
				return array(
					'success'=>false,
					'msg' => "File (.".$ext.") is not support!"
				);
			}else{
				if(move_uploaded_file($file['tmp_name'],$target)){
					return array(
						'success' => true
					);
				}else{
					return array(
						'success' => false,
						'msg' => "Cannot Upload!"
					);
				}

			}
		}
	}
	
	//number,string,json,base64
	function load_variable($name,$type="number"){
		$dbc = $this->dbc;
		if($dbc->HasRecord("variable","name LIKE '$name'")){
			$line = $dbc->GetRecord("variable","value","name='$name'");
			return $line['value'];
		}else{
			switch($type){
				case "number":
					$value = 0;
					break;
				case "string":
					$value = "";
					break;
				case "json":
					$value = json_encode(array());
					break;
				case "base64":
					$value = base64_encode("");
					break;
			}
			$dbc->Insert("variable",array(
				"#id" => "DEFAULT",
				"name" => $name,
				"value" => $value,
				"#updated" => "NOW()"
			));
			return $value;
		}
	}
	
	function save_variable($name,$value){
		$dbc = $this->dbc;
		if($dbc->HasRecord("variable","name LIKE '$name'")){
			$dbc->Update("variable",array(
				"value" => $value,
				"#updated" => "NOW()"
			),"name='$name'");
		}else{
			$dbc->Insert("variable",array(
				"#id" => "DEFAULT",
				"name" => $name,
				"value" => $value,
				"#updated" => "NOW()"
			));
		}
	}
	
	
	function allow($app,$action){
		global $_SESSION;
		if(isset($_SESSION['auth'])){
			if($_SESSION['auth']['group_id']==0){
				return true;
			}else if($_SESSION['auth']['user_id']==1){
				return true;
			}else{
				return $this->dbc->HasRecord("permissions","name='$app' AND action = '$action' AND gid=".$_SESSION['auth']['group_id']);
			}
		}else{
			return false;
		}
	}
	function save_log(
		$user_type,
		$user_id,
		$action,
		$value,
		$data
	){
		global $_SERVER,$_SESSION;
		if($user_id==null)$user_id=$_SESSION['auth']['user_id'];
		$data = array(
			"#log_id" => "DEFAULT",
			"#log_datetime" => "NOW()",
			"#log_user_type" => $user_type,
			"#log_user" => $user_id,
			"log_action" => $action,
			"log_value" => $value,
			"log_location" => $_SERVER['REMOTE_ADDR'],
			"log_data" => json_encode($data)
		);
		$this->dbc->Insert("logs",$data);
	}
	
	
	function make_combobox($name,$dbname,$value,$caption,$where=1,$initval="",$id="",$class="form-control"){
		$dbc = $this->dbc;
		$out = '';
		$out .= '<select name="'.$name.'" class="'.$class.'">';
		$sql = "SELECT $value,$caption FROM $dbname WHERE $where";
		$rst = $dbc->Query($sql);
		while($line = $dbc->fetch($rst)){
			$out .= '<option value="'.$line[0].'"';
			if($initval!=""){
				if($line[0]==$initval){
					$out .= ' selected'; 
				}
			}
			$out .= '>';
			$out .= $line[1];
			$out .= '</option>';
		}
		$out .= '</select>';
		return $out;
	}
	
	function GetDocumentID($document,$method,$param){
		
		
	}
	
	
	function SaveDocument(){
		
	}
	
	
	function GetDocumentRevision($document,$number=null){
		$dbc = $this->dbc;
		if(is_null($number)){
			if($dbc->HasRecord("document_code_counter","document LIKE '".$document."'")){
				$line = $dbc->GetRecord("document_code_counter","number","document LIKE '".$document."' ORDER BY number DESC");
				$number = $line['number']+1;
				return array(
					"num" => $number,
					"rev" => 1
				);
			}else{
				return array(
					"num" => 1,
					"rev" => 1
				);
			}
		}else{
			$line = $dbc->GetRecord("document_code_counter","number,counter","document LIKE '".$document."' AND number=".$number);
			$rev = $line['counter']+1;
			return array(
				"num" => $number,
				"rev" => $rev
			);
		}
	}
	
	function SaveDoucmentRevision($document,$number,$rev){
		$dbc = $this->dbc;
		if($dbc->HasRecord("document_code_counter","document LIKE '".$document."' AND number=".$number)){
			$line = $dbc->GetRecord("document_code_counter","id","document LIKE '".$document."' AND number=".$number);
			$data = array(
				"#counter" => $rev,
				"#updated" => "NOW()"
			);
			$dbc->Update("document_code_counter",$data,"id=".$line['id']);
		}else{
			$data = array(
				"#id" => "DEFAULT",
				"document" => $document,
				"#number" => $number,
				"#counter" => $rev,
				"#created" => "NOW()",
				"#updated" => "NOW()"
			);
			$dbc->Insert("document_code_counter",$data);
			
		}
	}
	
	
	function TimeElapsed($time,$tokens=null){
		 $time = time() - $time; // to get the time since that moment
		$time = ($time<1)? 1 : $time;
		if($tokens == null){
			$tokens = array (
				31536000 => 'year',
				2592000 => 'month',
				604800 => 'week',
				86400 => 'day',
				3600 => 'hour',
				60 => 'minute',
				1 => 'second'
			);
		}
		
		foreach ($tokens as $unit => $text) {
			if ($time < $unit) continue;
			$numberOfUnits = floor($time / $unit);
			return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
		}
	}
	
	function InverseColor($color){
		$color = str_replace('#', '', $color);
		if (strlen($color) != 6){ return '000000'; }
		$rgb = '';
		for ($x=0;$x<3;$x++){
			$c = 255 - hexdec(substr($color,(2*$x),2));
			$c = ($c < 0) ? 0 : dechex($c);
			$rgb .= (strlen($c) < 2) ? '0'.$c : $c;
		}
		return '#'.$rgb;
	}	
}

?>