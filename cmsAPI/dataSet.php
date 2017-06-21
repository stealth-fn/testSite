<?php
	#start our user session
	if(!isset($_SESSION) && !headers_sent()){
		session_start();
		$_SESSION['CREATED'] = time();  // update creation time
		include_once($_SERVER['DOCUMENT_ROOT']."/cmsAPI/cmsSettings.php");
	}
	if (!isset($_SESSION['CREATED'])) {
	    $_SESSION['CREATED'] = time();
	} else if (time() - $_SESSION['CREATED'] > 60*60*12) {
	    // session started more than 12 hours ago
	    session_regenerate_id(true);    // change session ID for the current session an invalidate old session ID
	    $_SESSION['CREATED'] = time();  // update creation time
	}
	
	$dbCon = false;

	class dataSet {		
	
		protected function __construct($isAjax){
			global $dbCon;
			#connect to database if connection doesn't already exist
			if(!$dbCon) $this->openConn();
		}
		
		protected function openConn(){
			global $dbCon;

			//$dbCon = mysql_connect("mysql.stealthwd.ca","ospreydevdb","He8ofRH0oeVVtlH");
			//mysql_select_db("stealth_osprey_dev", $dbCon);
			
			$dbCon = mysql_connect("mysql.stealthwd.ca","stealthospreyliv","04o1lW552y9T3Py");
			mysql_select_db("stealth_osprey_live", $dbCon);
			
			return $dbCon;
		}
	}
?>