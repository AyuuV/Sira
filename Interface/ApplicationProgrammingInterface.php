<?php

	$Configuration = parse_ini_file('../Configuration/Sira.ini',true);
	$Connection = mysqli_connect($Configuration['MySQL']['Host'],$Configuration['MySQL']['User'],$Configuration['MySQL']['Pass']);

	function Error($ResponseString='500 Internal Server Error',$ErrorString='Error',$ReturnValue=null) {
		global $Configuration;
		header("$_SERVER[SERVER_PROTOCOL] $ResponseString");
		if($Configuration['Error']['Display']) {
			header('Content-Type: text/plain');
			echo $ErrorString; }
		return $ReturnValue; }
	function Parameter($ParameterKey,$DefaultValue=null) {
		if(isset($_GET[$ParameterKey])) { return $_GET[$ParameterKey]; }
		else if(isset($_POST[$ParameterKey])) { return $_POST[$ParameterKey]; }
		else { return null; } }

	if(($ConnectionError=mysqli_connect_errno($Connection))) { exit(Error('500 Internal Server Error',"MySQL Connection Error Number: $ConnectionError",1)); }

	if(Parameter('Action',null)==='Initialise'&&$Configuration['MySQL']['Initialisable']) {

	}
	else { exit(Error('501 Not Implemented',"Invalid Action",2)); }
	mysqli_close($Connection);
?>
