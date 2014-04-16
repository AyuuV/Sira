<?php
	ini_set('html_errors',false);
	function Parameter($ParameterKey,$DefaultValue) {
		if(isset($_GET[$ParameterKey])) { return $_GET[$ParameterKey]; }
		else if(isset($_POST[$ParameterKey])) { return $_POST[$ParameterKey]; }
		else { return null; } }
	$Configuration = parse_ini_file('../Configuration/Sira.ini');
	// $Document = new DOMDocument('1.0','utf-8');
	// $APIDocument = $Document->createElement('APIDocument');
	// $Connection = mysqli_connect('localhost',)
	// $Document->appendChild($APIDocument);
	// echo $Document->saveXML();
?>
