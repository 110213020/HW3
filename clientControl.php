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
case "login": // 登入
	$account=$_REQUEST['account'];
	$pwd=$_REQUEST['pwd'];
	//verify with DB

	$role = login($account,$pwd); //use the login function in userModel
	//setcookie('loginRole',$role,httponly:true); //another way to restrict the cookie visibility
	setcookie('loginRole',$role); //another way to restrict the cookie visibility
	if ($role > 0) {
		$msg=[
			"msg" => "OK",
			"role" => $role
		];
	} else {
		$msg=[
			"msg" => "NO",
			"role" => 'none'
		];
	}
	echo json_encode($msg);
	return;

case 'showInfo':
	//檢查是否已登入
	$loginRole=$_COOKIE['loginRole'];
	if ($loginRole>0) {
		$msg="You've logged in. Your role is $loginRole.";
	} else {
		$msg="You need login to use this funtion.";
	}
	echo $msg;
	break;
case 'logout':
	//setcookie('loginRole',0,httponly:true);
	setcookie('loginRole',0);
	break;
case 'addRole': // 註冊
	$account=$_REQUEST['account'];
	$pwd=$_REQUEST['pwd'];
	$role=(int)$_REQUEST['role'];
	$condition=addRole($account,$pwd,$role);
	if ($condition > 0) {
		$msg=[
			"msg" => "OK",
		];
	} else {
		$msg=[
			"msg" => "fail",
		];
	}
	echo json_encode($msg);
	return ;

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
