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

$Database = mysqli_real_escape_string($Connection,$Configuration['MySQL']['Database']);

if(Parameter('Action',null)==='Initialise'&&$Configuration['MySQL']['Initialisable']) {
	$EMail = mysqli_real_escape_string($_SERVER['SERVER_ADMIN']);
	$Password = mysqli_real_escape_string($Connection,$Configuration['MySQL']['Pass']);
	$Username = mysqli_real_escape_string($Connection,$Configuration['MySQL']['User']);
	if(!($ImageTableStructure=file_get_contents('../Configuration/Image Table Structure.txt',false,null,37))) { exit(Error('500 Internal Server Error','Image Table Structure Access Failure',3)); }
	if(!($LinkTableStructure=file_get_contents('../Configuration/Link Table Structure.txt',false,null,36))) { exit(Error('500 Internal Server Error','Link Table Structure Access Failure',4)); }
	if(!($TagTableStructure=file_get_contents('../Configuration/Tag Table Structure.txt',false,null,35))) { exit(Error('500 Internal Server Error','Tag Table Structure Access Failure',5)); }
	if(!($UserTableStructure=file_get_contents('../Configuration/User Table Structure.txt',false,null,36))) { exit(Error('500 Internal Server Error','User Table Structure Access Failure',6)); }
	if(!mysqli_query("DROP DATABASE IF EXISTS $Database;")) { exit(Error('500 Internal Server Error',"Failed to Drop Database: $Database",7)); }
	else if(!mysqli_query("CREATE DATABASE $Database;")) { exit(Error('500 Internal Server Error',"Failed to Create Database: $Database",8)); }
	else if(!mysqli_query("USE $Database")) { exit(Error('500 Internal Server Error',"Failed to Use Database: $Database",9)); }
	else if(!mysqli_query("CREATE TABLE $ImageTableStructure;")) { exit(Error('500 Internal Server Error',"Failed to Create Table: $ImageTableStructure",10)); }
	else if(!mysqli_query("CREATE TABLE $LinkTableStructure;")) { exit(Error('500 Internal Server Error',"Failed to Create Table: $LinkTableStructure",11)); }
	else if(!mysqli_query("CREATE TABLE $TagTableStructure;")) { exit(Error('500 Internal Server Error',"Failed to Create Table: $TagTableStructure",12)); }
	else if(!mysqli_query("CREATE TABLE $UserTableStructure;")) { exit(Error('500 Internal Server Error',"Failed to Create Table: $UserTableStructure",13)); }
	else if(!mysqli_query("INSERT INTO U (I,N,P,EMA,AC) VALUES (0,'$Username','$Password','$EMail',0);")) { exit(Error('500 Internal Server Error',"Failed to Insert User: $Username",14)); } }
else { exit(Error('501 Not Implemented',"Invalid Action",2)); }
mysqli_close($Connection);

?>
