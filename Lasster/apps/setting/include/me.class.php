<?php
class meClass extends widgeteer{
	private $dbc = null;
	private $abox = null;
	private $app = "setting";
	private $view = "overview";
	
	function __construct($dbc,$abox){
		$this->dbc = $dbc;
		$this->abox = $abox;
	}
	
	private $header_meta = array(
		array('overview'	,"Overview",	'fa fa-group'),
		array('profile'		,"My Profile",	'fa fa-user'),
		array('company'		,"My Company",	'fa fa-user'),
		array('system'		,"System",		'fa fa-user')
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
		echo '<span> > Setting</span> ';
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
				echo '<a href="#apps/setting/index.php?view='.$header[0].'">';
					echo '<i class="'.$header[2].'"></i>';
					echo '<span class="hidden-mobile hidden-tablet"> '.$header[1].' </span>';
				echo '</a>';
			echo '</li>';
		}
		echo '</ul>';
	}
	
	function widgetBody(){
		$dbc=$this->dbc;
		$abox=$this->abox;
		echo '<div class="tab-content">';
			echo '<div class="tab-pane fade in active" id="'.$this->app.'_'.$this->view.'">';
			switch($this->view){
				case "overview":
					include_once "view/page.overview.php";
					break;
				case "profile":
					include_once "../profile/view/page.overview.php";
					break;
				case "company":
					include_once "view/page.company.php";
					break;
				case "system":
					include_once "view/page.system.php";
					break;
			}
			echo '</div>';
		echo '</div>';
	}
}
?>