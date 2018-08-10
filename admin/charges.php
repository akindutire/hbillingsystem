<?php

namespace cliqs\hbillingsystem\mypanel;
	
	
	
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
	
	
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Title      : Component
Version    : 1.0
Released   : 20091030
Description: A two-column fixed-width template suitable for small websites.

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Joe Jane| Charges</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link rel="shortcut icon" href="../images/hbill.png">
<script src="../js/jquery-1.9.0.min.js" type="application/javascript"></script>
<script src="../js/check.js" type="application/javascript"></script>
<style>
@import "../css/default.css";
@import "../css/forms.css";
@import "../css/interim.css";
@import "../css/table.css";

#content form{
	width:500px;
	margin:1%;
	}



</style>

</head>
<body>
<div id="wrapper">
  <div id="header">
    <div id="logo">
      <blockquote>
        <h1><a href="index.php"><img src="../images/app4.png" height="30px" width="auto">&nbsp;Joe-Jane Medical Centre</a></h1>
      </blockquote>
<h2><a href="index.php">To Live Is To Serve</a></h2>
    </div>
    <!-- end div#logo -->
  </div>
  <!-- end div#header -->
  <div id="menu">
    <ul>
      <li class="active"><a href="index.php">Home</a></li>
      <li><a href="bills.php">Back</a></li>
    </ul>
  </div>
 <!-- <div id="header-search">
    <form method="get" action="">
      <fieldset>
      <input type="text" id="header-search-text" name="s" value="" disabled="disabled" />
      <input type="submit" id="header-search-submit" value="Search" disabled="disabled"/>
      </fieldset>
    </form>
  </div>-->
  <!-- end div#menu -->
  <div id="page">
    <div id="page-bgtop">
      <div id="content">
       
       <hr></hr>
       
        <!--<div class="post">
          <h2 class="title"><a href="#">Fusce ultrices fringilla</a></h2>
          <p class="byline">Posted by FreeCssTemplates</p>
          <div class="entry">
            <p>Curabitur tellus. Phasellus tellus turpis, iaculis in, faucibus lobortis, posuere in, lorem. Donec a ante. Donec neque purus, adipiscing id, eleifend a, cursus vel, odio. Vivamus varius justo sit amet leo. Morbi sed libero. Vestibulum blandit augue at mi. Praesent fermentum lectus eget diam. Nam cursus, orci sit amet porttitor iaculis, ipsum massa aliquet nulla, non elementum mi elit a mauris.</p>
          </div>
          <div class="meta">
            <p class="links"><a href="#" class="comments">Comments (32)</a></p>
          </div>
        </div>-->
                  	
      <div id="feedback" style="background:transparent; color:black; font-size:12px; padding:1px; margin:1% 32% 2px 32%; height:auto; width:350px; text-align:center; border-radius:3px;"></div>

    <form>
	<table style="font-size:16px;">
    <tr>
    	
        <th>Disease/Test Category</th>
        <th>Disease/Test</th>
        <th>Charges(N)</th>
    
    </tr>
    
    <?php
    
	$category=(int)$_POST['cat'];
	$section=(int)$_POST['section'];
	$node=(int)$_POST['node'];
	
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		if($section==1){
			//Lab Charges
			
			$sql=mysqli_query($link,"SELECT * FROM tests WHERE category='$node'");
			while(list($id,$testcat,$testname,$charges)=mysqli_fetch_row($sql)){
				
				$s=mysqli_query($link,"SELECT name FROM testcat WHERE id='$node'");
				list($scat)=mysqli_fetch_row($s);
				
				
				echo "<tr>
						
						<td>$scat</td>
						<td>$testname</td>
						<td><input type='number' id='upcharge' data-utype='1' data-ctid='$id' name='charges'  value='$charges'></td>
				
				</tr>";
				
				
				
				}
			
		}else if($section==2){
			//Disease Charges
			
			$sql=mysqli_query($link,"SELECT * FROM diagnostics WHERE cat_id='$category'");
			while(list($id,$cat_id,$dname,$charges)=mysqli_fetch_row($sql)){
				
				$s=mysqli_query($link,"SELECT cat FROM category WHERE id='$cat_id'");
				list($scat)=mysqli_fetch_row($s);
				
				echo "<tr>
						
						<td>$scat</td>
						<td>$dname</td>
						<td><input type='number' id='upcharge' data-utype='2' data-ctid='$id' name='charges'  value='$charges'></td>
				
				</tr>";
				
				
				}
			
			}
		
		}
	
	
	?>
    
    
    </table>
	
	</form>
    
    
    <form action="../process/add.php" method="post">
    <div class="all"><label></label><input style="height:auto; font-size:12px;" type="text" name="new" id="new" placeholder="Type something"></div>
    <input type="hidden" name="pid" value="2">
    
    <input type="hidden" name="icat" value="<?php echo $category; ?>">
    <input type="hidden" name="isection" value="<?php echo $section; ?>">
    <input type="hidden" name="inode" value="<?php echo $node; ?>">
    
    
    <button type="submit" style="font-size:15px; height:auto;">Add New Bill</button></form>
        
      </div>
      <!-- end div#content -->
      <div id="sidebar">
        <ul>
          <li id="search">
            <h2>Search</h2>
            <form method="get" action="">
              <fieldset>
              <input type="text" id="search-text" name="s" value="" disabled/>
              <input type="submit" id="search-submit" value="Search" disabled/>
              </fieldset>
            </form>
          </li>
          <li>
            <h2>FAQs</h2>
            <ul>
              <li><a  style="color:hsl(342, 83%, 68%);" href="#">Fusce dui neque fringilla</a></li>
              <li><a style="color:hsl(342, 83%, 68%);" href="#">Eget tempor eget nonummy</a></li>
              <li><a style="color:hsl(342, 83%, 68%);" href="#">Magna lacus bibendum mauris</a></li>
              
            </ul>
          </li>
          
        </ul>
      </div>
      <!-- end div#sidebar -->
      <div style="clear: both; height: 1px"></div>
    </div>
  </div>
  <!-- end div#page -->
  <div id="footer">
    <p>2015 ,realcliqs.com</p>
    <p id="links">&nbsp;</p>
  </div>
  <!-- end div#footer -->
</div>
<!-- end div#wrapper -->
<div align=center></div></body>
</html>
