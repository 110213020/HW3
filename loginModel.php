<?php
require("dbconfig.php");

function login($account, $pwd) { // 登入
	global $db;

	$sql = "select role from users where account=? and password=?;";
	$stmt = mysqli_prepare($db, $sql );
	mysqli_stmt_bind_param($stmt, "ss", $account, $pwd);
	
	mysqli_stmt_execute($stmt); //執行SQL
	$result = mysqli_stmt_get_result($stmt); //取得查詢結果
	if($r = mysqli_fetch_assoc($result)) {
		return $r['role'];
	} else {
		return 0;
	}
}
function addRole($newAccount,$pwd,$role) { // 註冊
	global $db;
	$sql = "select `id` from users where account=?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "s", $newAccount);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 0) {
		$sql = "insert into users (account, password, role) values (?, ?, ?)"; //SQL中的 ? 代表未來要用變數綁定進去的地方
		$stmt = mysqli_prepare($db, $sql); //prepare sql statement
		mysqli_stmt_bind_param($stmt, "ssi", $newAccount, $pwd, $role); //bind parameters with variables, with types "sss":string, string ,string
		mysqli_stmt_execute($stmt);  //執行SQL
		return 1;
	} else {
		return 0;
	}

}

?>