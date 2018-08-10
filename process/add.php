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
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$pid=(int)$_POST['pid'];
	
	
		if($pid==1){
			
			//1	-Add Client
			
			
								
								
							$sname=stripslashes(strip_tags(trim($_POST['sname'])));
							$oname=stripslashes(strip_tags(trim($_POST['oname'])));
							$tel=stripslashes(strip_tags(trim($_POST['tel'])));
							$dob=stripslashes(strip_tags(trim($_POST['dob'])));
							$addr=stripslashes(strip_tags(trim($_POST['addr'])));
							$nextofkin=stripslashes(strip_tags(trim($_POST['nextofkin'])));
							$addrnextofkin=stripslashes(strip_tags(trim($_POST['addrnextofkin'])));
							$sex=stripslashes(strip_tags(trim($_POST['sex'])));
							$rel=stripslashes(strip_tags(trim($_POST['rel'])));

							$fullname=$sname.', '.$oname;
							$me->adduser($fullname,$tel,$dob,$addr,$nextofkin,$addrnextofkin,$sex,$rel);
							
							
								
			
		}else if($pid==2){
			//2	-Add Lab Test/Disease
			
			 
							$category=stripslashes(strip_tags(trim($_POST['icat'])));
							$isection=stripslashes(strip_tags(trim($_POST['isection'])));
							$node=stripslashes(strip_tags(trim($_POST['inode'])));
							$item=ucwords(stripslashes(strip_tags(trim($_POST['new']))));
							
							
							$me->addbill($category,$isection,$node,$item);
							
		}else if($pid==3){
			//3	-Add User
							$name=stripslashes(strip_tags(trim($_POST['name'])));
							$tel=stripslashes(strip_tags(trim($_POST['tel'])));
							$sex=stripslashes(strip_tags(trim($_POST['sex'])));

							
							$me->addsystemuser($name,$tel,$sex);
			
			}
	}
	exit();
?>