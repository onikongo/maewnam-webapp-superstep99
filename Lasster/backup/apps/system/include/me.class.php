<?php
class meClass{
	private $app = "system";
	private $dbc = null;
	
	function __construct($dbc=null){
		$this->dbc = $dbc;
	}
	
	private $header_meta = array(
		array('overview'	,"Overview",	'fa fa-home fa-2x')
	);
	
	function PageHeader($active){
		echo '<div id="breadcrumb">';
			echo '<ul class="breadcrumb">';
				echo ' <li></i><a href="?app='.$this->app.'"> Home</a></li>';
				echo ' <li></i><a href="?app='.$this->app.'"> System</a></li>';
				foreach($this->header_meta as $header){
				if($header[0]==$active){
						echo '<li class="active">'.$header[1].'</li>';;
					}
				}	
			echo '</ul>';
		echo '</div>';
				
	}
	
	
	function PageTabBar($active){
		echo '<ul class="tab-bar grey-tab">';
		foreach($this->header_meta as $header){
			echo '<li'.($header[0]==$active?' class="active"':'').'>';
				echo '<a href="?app='.$this->app.'&view='.$header[0].'">';
					echo '<span class="block text-center">';
					echo '<i class="'.$header[2].'"></i>';
					echo '</span>';
					echo ' '.$header[1];
				echo '</a>';
			echo '</li>';
		}
		echo '</ul>';	
	}

	
	
}
?>
