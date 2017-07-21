<?php
class meClass extends widgeteer{
	private $app = "dashbaord";
	private $view = "overview";
	private $dbc = null;
	
	function __construct($dbc=null){
		$this->dbc = $dbc;
	}
	
	private $header_meta = array(
		array('group'	,"Group",		'fa fa-lg fa-group'),
		array('user'	,"User",		'fa fa-lg fa-user'),
		array('team'	,"Sales Team",	'fa fa-lg fa-group'),
		array('role'	,"Sales Role",	'fa fa-lg fa-user')
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
		foreach($this->header_meta as $header){
			if($header[0]==$this->view){
				echo '<span> > '.$header[1].'</span>';
			}
		}
		echo '</h1>';
	}
	
	
}
?>