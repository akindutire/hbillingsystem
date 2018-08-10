<?php
namespace cliqs\hbillingsystem\users;


/*	
	Encryption Type: AES
	Database Salt: cliqsdiamond
	App Provider: Cliqs Team
	User Website: realcliqs.com
	Author: Akindutire Ayomide Samuel
	Email: cliqsapp@gmail.com or akindutire33@gmail.com
	GPL Free Licience
	Contact: 08107926083
	Database Encrypted, System Trial Flag Available, And Personalized Script
	
*/


define('EXKIT','../images/exp.bmp');
define('UPKIT','../conn/update.txt');
define('SIKIT','../include/silent.bmp');
define('RELOCATEKITDIRECTORY','../images/silent.bmp');
define('X',101);

$link=mysqli_connect('localhost','root','','hbillingsystem');


class connect{
	
	public function iconnect(){
		
			global $link;
			
			if($link){
				echo "";
			}else{
				die("System Currently Not Available, Try Again Later");
				}
		}
	
}

/*This Class Checks The System Integrity*/


class performance{
	
	
	public function checkSys(){
		
		global $link;
		
		$sql=mysqli_query($link,"SELECT * FROM performancetab WHERE st='1'") or die('101xFc: Unknown Reference');
		list($id,$start,$exp,$istatus,$lastmin)=mysqli_fetch_row($sql);
	
		if(mysqli_num_rows($sql)==0 && file_exists(EXKIT)==false){ 
			
			$trial=3;
			
			$this->createTrial($trial);
		

		}else if(file_exists(EXKIT)==false){
		
		
			$this->repairTrial($exp,$lastmin);
		
		}else if($exp=='LP'){
		
			echo '';
		
		}else{
		
			$this->updateTrial($exp,$lastmin);
		
			}
	}
	
	//Inter Fc
	
	private function createTrial($trial){
		global $link;
		
		//@Db Salt;
		$salt='cliqsdiamond';
		
		
		$start=date(time());
		$exp=date(strtotime("+ $trial year"));
		
		$fd=fopen(EXKIT,'w+');
		fwrite($fd,$exp);
		
		mysqli_query($link,"INSERT INTO performancetab(id,ifr,tg,st,lm) VALUES('NULL','$start','$exp',1,'$start')");

	}
	
	private function repairTrial($exp,$lastmin){
		
		global $link;
		
		$fd=fopen(EXKIT,'w+');
		fwrite($fd,$exp);
		mysqli_query($link,"UPDATE performancetab SET lm='$lastmin' WHERE id=1 and st=1");

		
		}
	
	private function updateTrial($exp,$lastmin){
		
		global $link;
		
		$inow=date('d M Y, H:i a',time());
		
		$now=date(time());
		
			if($lastmin>$now){
				die('System/PC Time Inaccurate, Please Adjust Your Date,$inow');
			
			}else if($now>=$lastmin){
				
				file_exists(SIKIT)?'':die('Application Error: Some Modules Unable To Load');
				
				if($now>$exp){
							
					@rename(SIKIT,RELOCATEKITDIRECTORY);
					die('Unexpected Reference 101xF, Strongly Recommend Contacting App Provider.');
						
				}else{
					$new_min=date(time());
					mysqli_query($link,"UPDATE performancetab SET lm='$new_min' WHERE id=1 and st=1");
				}	
				
			}
		}
	
	
	//End Inter Fc
		
}//End Class SysPerformance



class user{
	
	/***************Basic User Function************************/
	
	
	public function login($usr,$pwd){
		global $link;
		
		$sql=mysqli_query($link,"SELECT * FROM users WHERE mail='".mysqli_real_escape_string($link,$usr)."' AND password='".mysqli_real_escape_string($link,$pwd)."' AND bk='0'");
		
		if(mysqli_num_rows($sql)==1){
			
			
			$_SESSION['iusr']=$usr;
			$_SESSION['ipwd']=$pwd;
			
			echo X;
		}else{
			echo "<img src='../images/cancel.png' width='auto' height='14px'>&nbsp;Invalid Combination";
			}
		
		}
		
	public function getdata(){
		global $link;
		
			$usr=$_SESSION['iusr'];
			$pwd=$_SESSION['ipwd'];
		
		
			$sql=mysqli_query($link,"SELECT id,role FROM users WHERE mail='".mysqli_real_escape_string($link,$usr)."' AND password='".mysqli_real_escape_string($link,$pwd)."'");
		
			list($id,$role)=mysqli_fetch_row($sql);
			$_SESSION['role']=$role;
			
			return $id;
		}
		
		
	public function logout(){
		global $link;
		
			
			$_SESSION[]=array();
			session_unset();
			session_destroy();
			
			header("location:../");
			
		}	
		
	
	public function verifylogin($role){
		global $link;
		$usr_id=$this->getdata();
		$role=ucfirst($role);
		if($_SESSION['role']==$role){
			echo '';
		}else{
			header('location:lgt.php');
			}		
		}
		
	public function haveexternalrights(){
		global $link;
		
		$usr_id=$this->getdata();
		$sql=mysqli_query($link,"SELECT extrights FROM users WHERE id='$usr_id'");
		list($ex)=mysqli_fetch_row($sql);
			
			return $ex;
		}


	/**************************************************End Basic User Function*********************************/

	
	//Add Client
	public function adduser($fullname,$tel,$dob,$addr,$nextofkin,$addrnextofkin,$sex,$rel){
		global $link;
		
		/*------------------------	Checking Book Existence	-------------------------------------------*/
		
		//No Account Limit
		
		
		/*------------------------------Registering Client by Preparing A Query-----------*/
		
		$sql=mysqli_prepare($link,"INSERT INTO client(id,fname,addr,dob,tel,addrnextofkin,nextofkin,sex,rel,pix,cardno) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
		
		$e='';
		$photo=$_SESSION['funame'];
		
		mysqli_stmt_bind_param($sql,'issssssssss',$e,$fullname,$addr,$dob,$tel,$addrnextofkin,$nextofkin,$sex,$rel,$photo,$e);
		if(mysqli_stmt_execute($sql)){
			$c=mysqli_stmt_insert_id($sql);
			@rename("../uploads/pix/del/$photo","../uploads/pix/$photo");
			
			$rand=$c.(rand(100,999))-(rand(15,800));
			
			$cardno="JJ".$rand;
			
			mysqli_stmt_close($sql);
			
			mysqli_query($link,"UPDATE client SET cardno='$cardno' WHERE id='$c'");
			echo X;
			$_SESSION['msg']=$c;
		}else{
				echo "<img src='../images/cancel.png' width='auto' height='14px'>&nbsp;Registration FAILED ,Please Retry";
				}

		}






	//Add to Test
	public function addbill($category,$isection,$node,$item){
		global $link;

			if($isection==1){
				//lab
				$sql=mysqli_query($link,"INSERT INTO tests(id,category,test,charges) VALUES('NULL','$node','$item','')") or die('System Error');
				if($sql){
					header('location:../admin/bills.php');
					}
				
			}else if($isection==2){
				//disease
				$sql=mysqli_query($link,"INSERT INTO diagnostics(id,cat_id,disease,charges) VALUES('NULL','$category','$item','')");
				
					if($sql){
						header('location:../admin/bills.php');
						}
				
				
				}

		}
		
		
	public function addsubclass($classid,$sbname,$acr){
		global $link;
		

		
		}

	public function deleteabook($bk){
		global $link;
	

	}
	
	
}//End Class User


class records{
	
	public function profiledata(){
		global $link;
		
		$usr_id=user::getdata();
		
		$sql=mysqli_query($link,"SELECT * FROM users WHERE id='$usr_id'");
		list($e,$role,$name,$mail,$pwd,$passport,$sex,$bk,$dpt,$bk)=mysqli_fetch_row($sql);
		$role=strtoupper($role);
		echo "
		
        <p style='font-family:amble; color:green; font-size:14px;'><a><b>$role</b></a></p>
		 
        <p style='font-family:amble; color:blue;'><a>$name</a></p>
        <p style='font-family:amble; color:blue;'><a>$mail</a></p>
        <p style='font-family:amble; color:blue;'><a>$sex</a></p>
        <p style='font-family:amble; color:blue;'><a>$dpt</a></p>
		
        
		
		";
		
		}
	public function profilepic(){
		global $link;
		
		$usr_id=user::getdata();
		
		$sql=mysqli_query($link,"SELECT * FROM users WHERE id='$usr_id'");
		list($e,$role,$name,$mail,$pwd,$passport,$sex,$bk,$dpt,$bk)=mysqli_fetch_row($sql);
		$role=strtoupper($role);
		echo "
		
        <a><img src='../uploads/pix/$passport' width='100%;' height='auto'></a>
		 
        
		";
		
		}
	
	public function client($c){
		global $link;
		
				$sql=mysqli_query($link,"SELECT * FROM client WHERE id='$c'");
		
		
			
		list($id,$fullname,$addr,$dob,$tel,$addrnextofkin,$nextofkin,$sex,$rel,$photo,$card)=mysqli_fetch_row($sql);
			
/*           $in_sql=mysqli_query($link,"SELECT * FROM diagnosis WHERE client_id='$id'"); 
			 list($did,$client_id,$date,$car,$fault,$status)=mysqli_fetch_row($in_sql);
*/			 
			 
        echo "<div id='left' style='float:left; clear:left; width:30%;'>
    	
        <img src='../uploads/pix/$photo' width='200px' height='auto'>
        
        </div>";

		
		
		$fullname=ucwords($fullname);
		$addr=ucwords($addr);
		$nextofkin=ucwords($nextofkin);
		$addrnextofkin=ucwords($addrnextofkin);
		
		
		
		echo "<div id='right' style='float:right; color:black; text-align:start; font-size:15px; clear:right; margin-right:10%; font-family:amble;width:50%;'>
    	<p style='margin-top:2px; margin-bottom:4px; font-size:17px;'>Card No: <b>$card</b></p>
        <p style='margin-top:2px; margin-bottom:2px;'>$fullname</p>
        <p style='margin-top:2px; margin-bottom:2px;'>$addr</p>
        <p style='margin-top:2px; margin-bottom:2px;'>$tel</p>
		<p style='margin-top:2px; margin-bottom:2px;'>$rel</p>
		<p style='margin-top:2px; margin-bottom:2px;'>$dob</p>
        <p style='margin-top:2px; margin-bottom:2px;'>$sex</p>
		<p style='margin-top:2px; margin-bottom:2px;'>$nextofkin</p>
        <p style='margin-top:2px; margin-bottom:2px;'>$addrnextofkin</p>
        </div>";
			
		}

	
	public function clientorder($c,$i,$s){
		global $link;
		
		$sql=mysqli_query($link,"SELECT * FROM client WHERE cardno='$c'");
		list($id,$fullname,$addr,$dob,$tel,$addrnextofkin,$nextofkin,$sex,$rel,$photo,$card)=mysqli_fetch_row($sql);
		
		if($s==1){
			$rr=mysqli_query($link,"SELECT * FROM tests WHERE id='$i'");
			list($id,$testcat,$dname,$charges)=mysqli_fetch_row($rr);
			$task='Laboratory Test';
			
		}else if($s==2){
			$rr=mysqli_query($link,"SELECT * FROM diagnostics WHERE id='$i'");
			list($id,$cat_id,$dname,$charges)=mysqli_fetch_row($rr);
			$task='Disease';
		}
			$date=date('D M Y, H:i a');
			
			
			$dt=$dname;
			$bill=$charges;
			
			$sqlins=mysqli_query($link,"INSERT INTO corder(id,client_id,date,task,dt,bill) VALUES('NULL','$id','$date','$task','$dt','$bill')") or die('System Error');
		
		
			 
        echo "<div id='left' style='float:left; clear:left; width:30%;'>
    	
        <img src='../uploads/pix/$photo' width='200px' height='auto'>
        
        </div>";

		
		
		$fullname=ucwords($fullname);
		$addr=ucwords($addr);
		$nextofkin=ucwords($nextofkin);
		$addrnextofkin=ucwords($addrnextofkin);
		
		
		
		echo "<div id='right' style='float:right; color:black; text-align:start; font-size:15px; clear:right; margin-right:10%; font-family:amble;width:50%;'>
    	<p style='margin-top:2px; margin-bottom:2px;'>Doctor:&nbsp;_________________</p>
		
		<p style='margin-top:2px; margin-bottom:4px; font-size:17px;'>Card No: <b>$card</b></p>
        <p style='margin-top:2px; margin-bottom:2px;'>$fullname</p>
        <p style='margin-top:2px; margin-bottom:2px;'>$addr</p>
		<p style='margin-top:2px; margin-bottom:2px;'>$rel</p>
		<p style='margin-top:2px; margin-bottom:2px;'>$dob</p>
        <p style='margin-top:2px; margin-bottom:2px;'>$sex</p>
		<br>
		<hr></hr>
		<p style='margin-top:2px; margin-bottom:2px;'>Diagnose Type:&nbsp;$task</p>
		<p style='margin-top:2px; margin-bottom:2px;'>Disease/Test:&nbsp;$dname</p>
		<p style='margin-top:2px; margin-bottom:2px;'>Bill:&nbsp;N$bill</p>
		<p style='margin-top:2px; margin-bottom:2px;'>Ordered On:&nbsp;$date</p>
		
        </div>";
			@$_SESSION['jk']=1;
			unset($_SESSION['msg']);
		}

	
	public function node($a,$b){
		global $link;
		
		if($a==1){
		
			$sql=mysqli_query($link,"SELECT * FROM testcat WHERE mcat='$b' ORDER BY id");
			
			while(list($id,$name,$mcat)=mysqli_fetch_row($sql)){
				
				echo "<option value='$id'>$name</option>";
				
				}
			
		
		}else if($a==2){
			
			
				
				echo "";
				
				

			
			}
		}

	

	public function vcard($a){
		global $link;
		$a=strtoupper($a);
		
		$sql=mysqli_query($link,"SELECT cardno FROM client WHERE cardno='$a'");
		list($c)=mysqli_fetch_row($sql);
		
		if(mysqli_num_rows($sql)==1){
			$_SESSION['imsg']=$a;
			echo X;
		}else{
				echo "Can not Proceed, Card no Invalid, Suggest: You register as a new Client";
				}
		
		} 



	public function staff(){
		global $link;

		$sql=mysqli_query($link,"SELECT id,mail,");


		}
	
	public function librarysbclass($class){

		global $link;
		


		}
	
	public function shelf($class,$sbclass){
		global $link;
		



		}
		
	public function requests(){
		global $link;
		
		
		
		}

	public function pendingrequests(){
		global $link;
		
		
		
		
		}
	
	public function borrowers(){
		global $link;
			
		
		
				}
		


}//End Of Records




?>