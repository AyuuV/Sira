<?php
$_SIRA = parse_ini_file('../Configuration/Sira.ini',true);
$MySQL = new mysqli($_SIRA['MYSQL']['HOST'],$_SIRA['MYSQL']['USER'],$_SIRA['MYSQL']['PASS']);
if($MySQL->connect_error) {
	http_response_code(intval($_SIRA['RESPONSE']['CONNECT_FAIL']));
	echo 'MySQL Connection Failure: ';
	echo $MySQL->connect_errno;
	echo ', ';
	echo $MySQL->connect_error;
	exit(intval($_SIRA['FAILURE']['CONNECT'])); }

if($_SERVER['REQUEST_METHOD']==='POST'&&isset($_POST)) {
	if(isset($_POST[$_SIRA['REQUEST']['INITIALISE']])) {
		if(!($DatabaseName=$MySQL->escape_string($_SIRA['MYSQL']['DATABASE']))) {
			http_response_code(intval($_SIRA['RESPONSE']['CONFIGURATION_FAIL']));
			echo 'Invalid MySQL Database Name Configuration: ';
			echo $_SIRA['MYSQL']['DATABASE'];
			$MySQL->close();
			exit(intval($_SIRA['FAILURE']['CONFIGURATION'])); }
		if(!($Initialisation=json_decode($_POST[$_SIRA['REQUEST']['INITIALISE']],true))) {
			http_response_code(intval($_SIRA['RESPONSE']['JSON_PARSE_FAIL']));
			echo 'JSON Parse Failure: ';
			echo json_last_error();
			echo ', ';
			echo json_last_error_msg();
			$MySQL->close();
			exit(intval($_SIRA['FAILURE']['PARSE'])); }
		if(!(($ImageTableStructure=file_get_contents('../Configuration/Image Table Structure.txt',false,null,37))&&
				($LinkTableStructure=file_get_contents('../Configuration/Link Table Structure.txt',false,null,36))&&
				($TagTableStructure=file_get_contents('../Configuration/Tag Table Structure.txt',false,null,35))&&
				($UserTableStructure=file_get_contents('../Configuration/User Table Structure.txt',false,null,36)))) {
			http_response_code(intval($_SIRA['RESPONSE']['FILE_READ_FAIL']));
			echo 'Table Structure Files Read Failure';
			$MySQL->close();
			exit(intval($_SIRA['FAILURE']['FILE_READ'])); }
		if(!($MySQL->query("DROP DATABASE IF EXISTS `$DatabaseName`")&&
				$MySQL->query("CREATE DATABASE `$DatabaseName`")&&
				$MySQL->query("USE `$DatabaseName`")&&
				$MySQL->query("CREATE TABLE $ImageTableStructure")&&
				$MySQL->query("CREATE TABLE $LinkTableStructure")&&
				$MySQL->query("CREATE TABLE $TagTableStructure")&&
				$MySQL->query("CREATE TABLE $UserTableStructure"))) {
			http_response_code(intval($_SIRA['RESPONSE']['DATABASE_MODIFICATION_FAIL']));
			echo 'MySQL Database Modification Failure: ';
			echo $MySQL->errno;
			echo ', ';
			echo $MySQL->error;
			$MySQL->close();
			exit(intval($_SIRA['FAILURE']['MYSQL_QUERY'])); }
		if(isset($Initialisation['Identifier'])) {
			$Initialisation['Identifier'] = intval($Initialisation['Identifier']);
			if(isset($Initialisation['Name'])) { $Initialisation['Name'] = $MySQL->escape_string($Initialisation['Name']); }
			else { $Initialisation['Name'] = $MySQL->escape_string($_SIRA['DEFAULT_ADMIN']['NAME']); }
			if(isset($Initialisation['Pass'])) { $Initialisation['Pass'] = $MySQL->escape_string($Initialisation['Pass']); }
			else { $Initialisation['Pass'] = $MySQL->escape_string($_SIRA['DEFAULT_ADMIN']['PASS']); }
			if(isset($Initialisation['EmailAddress'])) { $Initialisation['EmailAddress'] = $MySQL->escape_string($Initialisation['EmailAddress']); }
			else { $Initialisation['EmailAddress'] = $MySQL->escape_string($_SIRA['DEFAULT_ADMIN']['MAIL']); }
			if(!($MySQL->query("INSERT INTO U (I,N,P,EMA,AC) VALUES ($Initialisation[Identifier],'$Initialisation[Name]','$Initialisation[Pass]','$Initialisation[EmailAddress]',18446744073709551615)"))) {
				http_reponse_code(intval($_SIRA['RESPONSE']['USER_MODIFICATION_FAIL']));
				echo 'MySQL User Modification Failure: ';
				echo $MySQL->errno;
				echo ', ';
				echo $MySQL->error;
				$MySQL->close();
				exit(intval($_SIRA['FAILURE']['MYSQL_QUERY'])); } } }
}
else {
	http_response_code(intval($_SIRA['RESPONSE']['INVALID_REQUEST_METHOD']));
	echo "Invalid Request Method: $_SERVER[REQUEST_METHOD]";
	exit(intval($_SIRA['FAILURE']['INVALID_METHOD'])); }

$MySQL->close();
exit($_SIRA['SYSTEM']['SUCCESS_RETURN_VALUE']);
?>
