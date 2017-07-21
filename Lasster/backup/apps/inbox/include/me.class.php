<?php
class meClass{
	private $dbc = null;
	
	function __construct($dbc=null){
		$this->dbc = $dbc;
	}
	
	function PageHeader($active){
		echo '<div id="breadcrumb">';
			echo '<ul class="breadcrumb">';
				echo ' <li><i class="fa fa-home"></i><a href="?"> Home</a></li>';
				echo ' <li><i class="fa fa-home"></i><a href="?"> Profile</a></li>';
			echo '</ul>';
		echo '</div>';
				
	}

}
?>
