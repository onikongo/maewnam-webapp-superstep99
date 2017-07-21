<?php
class meClass{
	private $app = "accctrl";
	private $dbc = null;
	
	function __construct($dbc=null){
		$this->dbc = $dbc;
	}
	
	private $header_meta = array(
		array('group'	,"Group",	'fa fa-group'),
		array('user'	,"User",	'fa fa-user')
	);
	
	function PageHeader($active){
		echo '<div id="breadcrumb">';
			echo '<ul class="breadcrumb">';
				echo ' <li></i><a href="?app='.$this->app.'"> Administration</a></li>';
				echo ' <li></i><a href="?app='.$this->app.'"> Access Control</a></li>';
				foreach($this->header_meta as $header){
				if($header[0]==$active){
						echo '<li class="active">'.$header[1].'</li>';;
					}
				}	
			echo '</ul>';
		echo '</div>';
				
	}
	//tab-bar
	function PageTabPanel($active){
		echo '<ul class="nav nav-tabs">';
		foreach($this->header_meta as $header){
			echo '<li'.($header[0]==$active?' class="active"':'').'>';
				echo '<a href="?app='.$this->app.'&view='.$header[0].'">';
					echo '<i class="'.$header[2].'"></i>';
					echo ' '.$header[1];
				echo '</a>';
			echo '</li>';
		}
		echo '</ul>';	
	}
	
	
	
	
	
	
}
?>
