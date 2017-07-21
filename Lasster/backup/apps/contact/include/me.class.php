<?php
class meClass{
	private $app = "contact";
	private $dbc = null;
	
	function __construct($dbc=null){
		$this->dbc = $dbc;
	}
	
	private $header_meta = array(
		array('customer',	"Customer",		'fa fa-flag'),
		array('group',		"Group",			'fa fa-map-marker'),
		array('organization',	"Organization",		'fa fa-road')
	);
	
	function PageHeader($active){
		echo '<div id="breadcrumb">';
			echo '<ul class="breadcrumb">';
				echo ' <li></i><a href="?app='.$this->app.'"> Contact</a></li>';
				foreach($this->header_meta as $header){
				if($header[0]==$active){
						echo '<li class="active">'.$header[1].'</li>';;
					}
				}	
			echo '</ul>';
		echo '</div>';
				
	}
	
	function PageTabPanel($active){
		echo '<ul class="tab-bar">';
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
