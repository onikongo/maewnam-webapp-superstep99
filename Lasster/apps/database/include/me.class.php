<?php
class meClass extends widgeteer{
	private $app = "database";
	private $view = "country";
	private $dbc = null;
	
	function __construct($dbc=null){
		$this->dbc = $dbc;
	}
	
	private $header_meta = array(
		array('country'		,"Country",		'fa fa-lg fa-globe'),
		array('city'		,"City",		'fa fa-lg fa-building'),
		array('district'	,"District",	'fa fa-lg fa-train'),
		array('subdistrict'	,"Subdistrict",	'fa fa-lg fa-road'),
		//array('industry'	,"Industry",	'fa fa-lg fa-industry'),
		//array('unit'		,"Unit",		'fa fa-lg fa-cubes')
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
		echo '<span> > Database</span> ';
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
			$active = $header[0]==$this->view?true:false;
			echo '<li'.($active?' class="active"':'').'>';
				echo '<a href="#apps/database/index.php?view='.$header[0].'" '.($active?'':'rel="tooltip" title="'.$header[1].'"').'>';
					echo '<i class="'.$header[2].'" ></i>';
					if($active)echo '<span class="hidden-mobile hidden-tablet"> '.$header[1].' </span>';
				echo '</a>';
			echo '</li>';
		}
		echo '</ul>';
	}
				
	function widgetBody(){
		echo '<div class="tab-content">';
			echo '<div class="tab-pane fade in active" id="'.$this->app.'_'.$this->view.'">';
			foreach($this->header_meta as $header){
				if($header[0] == $this->view){
					include_once "view/page.".$header[0].".php";
				}
			}
			echo '</div>';
		echo '</div>';
	}
}
?>