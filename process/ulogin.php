<?php
	
	namespace cliqs\hbillingsystem\login;
	
	
	
	include_once('../include/settings.php');
	include_once('../class/users.php');
	
	
	use cliqs\hbillingsystem\users\user as me;
	use cliqs\hbillingsystem\users\connect as connectme;
	use cliqs\hbillingsystem\users\performance as ivalid;
	
	
	
	$me=new me();
	$connectme=new connectme();
	$checkme=new ivalid();
	//echo 'good';
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		$mail=stripslashes(strip_tags(trim($_POST['usr'])));
		$pwd=sha1(stripslashes(strip_tags($_POST['pwd'])));
		
	
		if(is_string($mail) && is_string($pwd)){
			
			$connectme->iconnect();
			$checkme->checkSys();
			$me->login($mail,$pwd);
			
		}else{
			echo "<img src='../images/cancel.png' width='auto' height='14px'>&nbsp;Incorrect Field Format";
		}
	}
	exit();
?>