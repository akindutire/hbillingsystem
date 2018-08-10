<?php
	
	namespace cliqs\hbillingsystem\update;
	
	
	
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
	
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
	$upid=(int)$_POST['upid'];	
		
	//1	-Update Charges
	
			if($upid==1){
				
				if($_POST['utype']==1){
					//1.1	-Update Lab. Test Bills
					
					$charge=$_POST['charges'];
					$row=$_POST['rowid'];
					$sql=mysqli_query($link,"UPDATE tests SET charges='$charge' WHERE id='$row'");
					if($sql){
						echo "Updated";
						}
					
				}else if($_POST['utype']==2){
					//1.2	-Update Disease Bills	
					
					$charge=$_POST['charges'];
					$row=$_POST['rowid'];
					$sql=mysqli_query($link,"UPDATE diagnostics SET charges='$charge' WHERE id='$row'");
					if($sql){
						echo "Updated";
						}
					}
				
				
				}
			
			
			$sql=mysqli_query($link,"UPDATE diagnostics SET charges='$charge' WHERE id='$id'");
			
			
		if($rid==1){
			
				$section=(int)$_POST['section'];
				$cat=(int)$_POST['cat'];
				$record->node($section,$cat);
		}else{
			echo "";
			}
		
	}
	exit();
?>