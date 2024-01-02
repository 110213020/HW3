<?php
require('dbconfig.php');

function getOrderList() //列出客戶訂單
{
	global $db;
	$sql = "select * from `order`;";
	$stmt = mysqli_prepare($db, $sql ); //precompile sql指令，建立statement 物件，以便執行SQL
	mysqli_stmt_execute($stmt); //執行SQL
	$result = mysqli_stmt_get_result($stmt); //取得查詢結果

	$rows = array(); //要回傳的陣列
	while($r = mysqli_fetch_assoc($result))
    {
		$rows[] = $r; //將此筆資料新增到陣列中
	}
	return $rows;
}

function markOrderDelivered($id) //已送達
{
    global $db;
    $status = '已送達';
    $sql = "UPDATE `order` SET status=? WHERE id=?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "si", $status, $id);
    mysqli_stmt_execute($stmt);
    return true;
}

function getJobList() //列出商家貨物
{
	global $db;
	$sql = "select * from `shop`;";
	$stmt = mysqli_prepare($db, $sql ); //precompile sql指令，建立statement 物件，以便執行SQL
	mysqli_stmt_execute($stmt); //執行SQL
	$result = mysqli_stmt_get_result($stmt); //取得查詢結果

	$rows = array(); //要回傳的陣列
	while($r = mysqli_fetch_assoc($result))
    {
		$rows[] = $r; //將此筆資料新增到陣列中
	}
	return $rows;
}

function markOrderShipped($id) //已寄送
{
    global $db;
    $status = '已寄送';
    $sql = "UPDATE `order` SET status=? WHERE id=?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "si", $status, $id);
    mysqli_stmt_execute($stmt);
    return true;
}

?>