<?php
require('clientModel.php');

$act=$_REQUEST['act'];
switch ($act)
{
case 'evaluate':
	$jsonStr = $_POST['dat'];
	$job = json_decode($jsonStr);
	evaluate($job->id, $job->evaluate);
	return;
case "addOrder":
	$account=$_REQUEST['account'];
	addOrder($account);
	return;
case "delCart":
	$account=$_REQUEST['account'];
	delCart($account);
	return;
case "loadOrder":
	$account=$_REQUEST['account'];
	$jobs=getOrder($account);
	echo json_encode($jobs);
	return;
case "listJob": // 商品
  $jobs=getJobList();
  echo json_encode($jobs);
  return;
case "addJob": // 加入購物車
	$account=$_REQUEST['account'];
	$jsonStr = $_POST['dat'];
	$job = json_decode($jsonStr);
	//should verify first
	addJob($job->name,$job->price,$job->content,$job->number,$account,$job->Mid);
	return;
case "delJob": // 刪除購物車品項
	$id=(int)$_REQUEST['id']; //$_GET, $_REQUEST
	//verify
	delJob($id);
	return;
case "listshopping": // 購物車
	$account=$_REQUEST['account'];
	$jobs=getJobList1($account);
	echo json_encode($jobs);
	return;

default:
/*
case "updateJob":

	$id=(int)$_REQUEST['id'];
	$jsonStr = $_POST['dat'];
	$job = json_decode($jsonStr);
	updateJob($id,$job->name,$job->price,$job->content);
	return;
*/
}
?>
