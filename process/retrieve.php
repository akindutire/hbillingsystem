<?php
	
	namespace cliqs\hbillingsystem\retrieve;
	
	
	
	include_once('../include/settings.php');
	include_once('../class/users.php');
	
	
	use cliqs\hbillingsystem\users\user as me;
	use cliqs\hbillingsystem\users\connect as connectme;
	use cliqs\hbillingsystem\users\performance as ivalid;
	use cliqs\hbillingsystem\users\records as record;
	
	
	
	$me=new me();
	$connectme=new connectme();
	$checkme=new ivalid();
	$record=new record();
	
	$me->verifylogin('Staff');
	
		$connectme->iconnect();
		$checkme->checkSys();
	
	$rid=(int)$_POST['rtid'];
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		//1	-Get All Subsystem of A System
		
		if($rid==1){
			
				$section=(int)$_POST['section'];
				$cat=(int)$_POST['cat'];
				$record->node($section,$cat);
		}else if($rid==2){
		
			//2	-Verify Card No.
			$a=$_POST['cardno'];
			$record->vcard($a);
			
		
		}else{
			echo "";
			}
		
	}
	exit();
?>