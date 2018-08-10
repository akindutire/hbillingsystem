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
	
	$order=$_GET['did'];
	$sect=$_GET['sect'];
	
	if(@$_SESSION['jk']==1){
		
		header('location:placeorder.php');
		}
	
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
<title>Joe Jane| Print details</title>
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
<body onload="javascript:df()">
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
      <li><a href="lgt.php">Logout</a></li>
       <li><a onclick="window.print()">Print</a></li>
      <li><a onclick="window.close()">Close</a></li>
    </ul>
  </div>
 <!-- <div id="header-search">
    <form method="get" action="">
      <fieldset>
      <input type="text" id="header-search-text" name="s" value="" disabled="disabled" />
      <input type="submit" id="header-search-submit" value="Search" disabled="disabled"/>
      </fieldset>
    </form>rgba(202, 202, 255, 0.91);
  </div>-->
  <!-- end div#menu -->
  <div id="page">
    <div id="page-bgtop">
      <div id="content" style="margin-left:15%;">
       
       
       
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
                  	
      <div id="feedback" style="background:transparent; color:white; font-size:18px; padding:1px; margin:1% 32% 2px 32%; height:auto; width:350px; text-align:center; border-radius:3px;"></div>
	<style>
		form .all{
			width:650px;
		}
		.all label{
			width:230px;
		}
	</style>
    
	<center>
    	<h1 style="font-family:amble;">Client Order Details</h1>
        <hr></hr><br>
        
        
        <?php $record->clientorder($_SESSION['imsg'],$order,$sect); ?>
        
        
      
    </center>
	
        
      </div>
      <!-- end div#content -->
      <!-- end div#sidebar -->
<div style="clear: both; height: 1px"></div>
    </div>
  </div>
  <!-- end div#page -->
  <div id="footer" style="font-family:amble;">
    <p>2015 ,realcliqs.com</p>
    <p id="links">&nbsp;</p>
  </div>
  <!-- end div#footer -->
</div>
<!-- end div#wrapper -->
<div align=center></div></body>
</html>
