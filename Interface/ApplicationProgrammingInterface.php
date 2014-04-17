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

$CurrentDate = mysqli_real_escape_string($Connection,date('Y-m-d H:i:s'));
$Database = mysqli_real_escape_string($Connection,$Configuration['MySQL']['Database']);

if(Parameter('Initialise',null)&&$Configuration['MySQL']['Initialisable']) {

	$EMail = mysqli_real_escape_string($Connection,$_SERVER['SERVER_ADMIN']);
	$Password = mysqli_real_escape_string($Connection,$Configuration['MySQL']['Pass']);
	$Username = mysqli_real_escape_string($Connection,$Configuration['MySQL']['User']);

	if(!($ImageTableStructure=file_get_contents('../Configuration/Image Table Structure.txt',false,null,37))) { exit(Error('500 Internal Server Error','Image Table Structure Access Failure',3)); }
	if(!($LinkTableStructure=file_get_contents('../Configuration/Link Table Structure.txt',false,null,36))) { exit(Error('500 Internal Server Error','Link Table Structure Access Failure',4)); }
	if(!($TagTableStructure=file_get_contents('../Configuration/Tag Table Structure.txt',false,null,35))) { exit(Error('500 Internal Server Error','Tag Table Structure Access Failure',5)); }
	if(!($UserTableStructure=file_get_contents('../Configuration/User Table Structure.txt',false,null,36))) { exit(Error('500 Internal Server Error','User Table Structure Access Failure',6)); }

	function Initialise($QueryString,$Description,$ErrorCode) {
		global $Connection;
		if(!mysqli_real_query($Connection,$QueryString)) {
			Error('500 Internal Server Error',"$Description Failure: ",null);
			echo mysqli_error($Connection);
			exit($ErrorCode); } }

	Initialise("DROP DATABASE IF EXISTS `$Database`;","Database $Database Drop",7);
	Initialise("CREATE DATABASE `$Database`;","Database $Database Creation",8);
	Initialise("USE `$Database`","Database $Database Usage",9);
	Initialise("CREATE TABLE $TagTableStructure;","Tag Table Structure Creation ($TagTableStructure)",12);
	Initialise("CREATE TABLE $UserTableStructure;","User Table Structure Creation ($UserTableStructure)",13);
	Initialise("CREATE TABLE $ImageTableStructure;","Image Table Structure Creation ($ImageTableStructure)",10);
	Initialise("CREATE TABLE $LinkTableStructure;","Link Table Structure Creation ($LinkTableStructure)",11);
	Initialise("INSERT INTO `U` (I,N,P,EMA,AC,CDT) VALUES (0,'$Username','$Password','$EMail',18446744073709551615,'$CurrentDate');","Administrator $Username Creation",14); }

if(Parameter('Query',null)==='Download') { }

else { exit(Error('501 Not Implemented',"Invalid Query Action",2)); }

mysqli_close($Connection);

?>
