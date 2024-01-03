<?php
require('merchantModel.php');

$act=$_REQUEST['act'];
switch ($act) {
case "listJob":
  $jobs=getJobList();
  echo json_encode($jobs);
  return;  
case "sOrder":
  $jobs=getOrderList();
  echo json_encode($jobs);
  return; 
case "addJob":
	
	$jsonStr = $_POST['dat'];
	$job = json_decode($jsonStr);
	//should verify first
	addJob($job->name,$job->price,$job->content);
	return;
case "updateJob":

	$id=(int)$_REQUEST['id'];
	$jsonStr = $_POST['dat'];
	$job = json_decode($jsonStr);
	updateJob($id,$job->name,$job->price,$job->content);
	return;
case "delJob":
	$id=(int)$_REQUEST['id']; //$_GET, $_REQUEST
	//verify
	delJob($id);
	return;
case "mark1":
    $id = (int)$_REQUEST['id'];
    toMark1($id);
    break;
case "mark2":
    $id = (int)$_REQUEST['id'];
    toMark2($id);
    break;
default:
  
}

?>