<?php
	ini_set('html_errors',false);
	function Parameter($ParameterKey,$DefaultValue) {
		if(isset($_GET[$ParameterKey])) { return $_GET[$ParameterKey]; }
		else if(isset($_POST[$ParameterKey])) { return $_POST[$ParameterKey]; }
		else { return null; } }
	$Configuration = parse_ini_file('../Configuration/Sira.ini',true);
	$Connection = mysqli_connect($Configuration['MySQL']['Host'],$Configuration['MySQL']['User'],$Configuration['MySQL']['Pass']);
	if(($ConnectionError=mysqli_connect_errno($Connection))) {
		header("$_SERVER[SERVER_PROTOCOL] 500 Internal Server Error");
		if($Configuration['MySQL']['VerboseError']) {
			header('Content-Type: text/plain');
			echo "MySQL connection error: $ConnectionError"; }
		exit(1); }
	// $Document = new DOMDocument('1.0','utf-8');
	// $APIDocument = $Document->createElement('APIDocument');
	// $Connection = mysqli_connect('localhost',)
	// $Document->appendChild($APIDocument);
	// echo $Document->saveXML();
?>
