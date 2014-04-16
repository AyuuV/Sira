<?php
	function Parameter($ParameterKey,$DefaultValue) {
		if(isset($_GET[$ParameterKey])) { return $_GET[$ParameterKey]; }
		else if(isset($_POST[$ParameterKey])) { return $_POST[$ParameterKey]; }
		else { return null; } }
?>
