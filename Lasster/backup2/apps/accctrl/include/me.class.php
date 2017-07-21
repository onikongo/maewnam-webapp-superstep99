<?php
class meClass extends widgeteer{
	private $app = "accctrl";
	private $view = "user";
	private $dbc = null;
	
	function __construct($dbc=null){
		$this->dbc = $dbc;
	}
	
	private $header_meta = array(
		array('group'	,"Group",		'fa fa-lg fa-group'),
		array('user'	,"User",		'fa fa-lg fa-user'),
		//array('team'	,"Sales Team",	'fa fa-lg fa-users'),
		//array('role'	,"Sales Role",	'fa fa-lg fa-tasks')
	);
	
	function setView($view){
		$this->view = $view;
	}
	function getView(){
		return $this->view;
	}
	
	function PageBreadcrumb(){
		echo '<h1 class="page-title txt-color-blueDark"> ';
		echo '<i class="fa-fw fa fa-home"></i> Home ';
		echo '<span> > Access Control</span> ';
		foreach($this->header_meta as $header){
			if($header[0]==$this->view){
				echo '<span> > '.$header[1].'</span>';
			}
		}
		echo '</h1>';
	}
	
	function widgetHeader(){
		echo '<ul class="nav nav-tabs">';
		foreach($this->header_meta as $header){
			echo '<li'.($header[0]==$this->view?' class="active"':'').'>';
				echo '<a href="#apps/accctrl/index.php?view='.$header[0].'">';
					echo '<i class="'.$header[2].'"></i>';
					echo '<span class="hidden-mobile hidden-tablet"> '.$header[1].' </span>';
				echo '</a>';
			echo '</li>';
		}
		echo '</ul>';
	}
				
	function widgetBody(){
		echo '<div class="tab-content">';
			echo '<div class="tab-pane fade in active" id="'.$this->app.'_'.$this->view.'">';
			switch($this->view){
				case "group":
					include_once "view/page.group.php";
					break;
				case "user":
					include_once "view/page.user.php";
					break;
				case "team":
					include_once "view/page.team.php";
					break;
				case "role":
					include_once "view/page.role.php";
					break;
			}
			echo '</div>';
		echo '</div>';
	}
}
?>