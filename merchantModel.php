<?php
require('dbconfig.php');

function getJobList($account) {
	global $db;
	$sql = "select * from shop where Mid = ?;";
	$stmt = mysqli_prepare($db, $sql ); //precompile sql指令，建立statement 物件，以便執行SQL
	mysqli_stmt_bind_param($stmt, "s", $account);
	mysqli_stmt_execute($stmt); //執行SQL
	$result = mysqli_stmt_get_result($stmt); //取得查詢結果

	$rows = array(); //要回傳的陣列
	while($r = mysqli_fetch_assoc($result)) {
		$rows[] = $r; //將此筆資料新增到陣列中
	}
	return $rows;
}
function getOrderList($account) {
	global $db;
	$sql = "select * from `order` where Mid = ?;";
	$stmt = mysqli_prepare($db, $sql ); //precompile sql指令，建立statement 物件，以便執行SQL
	mysqli_stmt_bind_param($stmt, "s", $account);
	mysqli_stmt_execute($stmt); //執行SQL
	$result = mysqli_stmt_get_result($stmt); //取得查詢結果

	$rows = array(); //要回傳的陣列
	while($r = mysqli_fetch_assoc($result)) {
		$rows[] = $r; //將此筆資料新增到陣列中
	}
	return $rows;
}
function addJob($name,$price,$content,$account) {
	global $db;

	$sql = "insert into shop (name, price, content,Mid) values (?, ?, ?, ?)"; //SQL中的 ? 代表未來要用變數綁定進去的地方
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "siss", $name, $price,$content,$account); //bind parameters with variables, with types "sss":string, string ,string
	mysqli_stmt_execute($stmt);  //執行SQL
	return True;
}

function updateJob($id, $name,$price,$content) {
	global $db;

	$sql = "update shop set name=?, price=?, content=? where id=?"; //SQL中的 ? 代表未來要用變數綁定進去的地方
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "sisi", $name, $price,$content, $id); //bind parameters with variables, with types "sss":string, string ,string
	mysqli_stmt_execute($stmt);  //執行SQL
	return True;
}

function delJob($id) {
	global $db;

	$sql = "delete from shop where id=?;"; //SQL中的 ? 代表未來要用變數綁定進去的地方
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "i", $id); //bind parameters with variables, with types "sss":string, string ,string
	mysqli_stmt_execute($stmt);  //執行SQL
	return True;
}
function toMark1($id){
    global $db;
	
	$sql1 = "select status from `order` where id=?;";
	$stmt1 = mysqli_prepare($db, $sql1 ); //precompile sql指令，建立statement 物件，以便執行SQL
	mysqli_stmt_bind_param($stmt1, "i", $id);
	mysqli_stmt_execute($stmt1); //執行SQL
	$result1 = mysqli_stmt_get_result($stmt1); //取得查詢結果
    $rows = ''; //要回傳的陣列
	while($r = mysqli_fetch_assoc($result1)) {
		$rows = $r['status']; //將此筆資料新增到陣列中
	}
	if ( $rows == '未處理') {
		$status = '處理中';
		$sql = "UPDATE `order` SET status=? WHERE id=?";
		$stmt = mysqli_prepare($db, $sql);
		mysqli_stmt_bind_param($stmt, "si", $status, $id);
		mysqli_stmt_execute($stmt);
	}
    return True;
}
function toMark2($id){
    global $db;
	
	$sql1 = "select status from `order` where id=?;";
	$stmt1 = mysqli_prepare($db, $sql1 ); //precompile sql指令，建立statement 物件，以便執行SQL
	mysqli_stmt_bind_param($stmt1, "i", $id);
	mysqli_stmt_execute($stmt1); //執行SQL
	$result1 = mysqli_stmt_get_result($stmt1); //取得查詢結果
    $rows = ''; //要回傳的陣列
	while($r = mysqli_fetch_assoc($result1)) {
		$rows = $r['status']; //將此筆資料新增到陣列中
	}
	if ( $rows == '處理中') {
		$status = '寄送中';
		$sql = "UPDATE `order` SET status=? WHERE id=?";
		$stmt = mysqli_prepare($db, $sql);
		mysqli_stmt_bind_param($stmt, "si", $status, $id);
		mysqli_stmt_execute($stmt);
	}
    return True;
}
?>
