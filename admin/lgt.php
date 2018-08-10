<?php
namespace cliqs\hbillingsystem\logout;

	include_once('../include/settings.php');
	include_once('../class/users.php');
	
	use cliqs\hbillingsystem\users\user as me;
	use cliqs\hbillingsystem\users\connect as connectme;
	use cliqs\hbillingsystem\users\performance as ivalid;
	
	$me=new me();
	
	$me->logout();

?>