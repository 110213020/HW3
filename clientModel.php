<?php
require('dbconfig.php');

function addOrder($account)
{
	global $db;
	$sql = "select `name`,`number`,`total` from shopping where uid=?;";
	$stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "s", $account);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
	$commodity = '';
	$total=0;
	while($r = mysqli_fetch_assoc($result))
	{
		$commodity .= $r['name'] . ' * ' . $r['number'] .','; //將此筆資料新增到字串中
		$total+= (int)$r['total'];
	}

	$sql = "insert into `order` (commodity, total, userid) values (?, ?, ?)";
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_bind_param($stmt,"sis",$commodity, $total, $account);
	mysqli_stmt_execute($stmt);
	return true;
}
function delCart($account)
{
	global $db;
	$sql = "delete from shopping where uid=?;";
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_bind_param($stmt,"s", $account);
	mysqli_stmt_execute($stmt);
	return true;
}
function getJobList() // 商品
{
	global $db;
	$sql = "select * from shop;";
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

function getJobList1($account) // 購物車
{
	global $db;

	$sql = "select * from shopping where uid=?;";
	$stmt = mysqli_prepare($db, $sql ); //precompile sql指令，建立statement 物件，以便執行SQL
	mysqli_stmt_bind_param($stmt, "s", $account);
	mysqli_stmt_execute($stmt); //執行SQL
	$result = mysqli_stmt_get_result($stmt); //取得查詢結果

	$rows = array(); //要回傳的陣列
	while($r = mysqli_fetch_assoc($result))
	{
		$rows[] = $r; //將此筆資料新增到陣列中
	}
	return $rows;
}

function getOrder($account) 
{
	global $db;
	$sql = "select * from `order` where userid=?;";
	$stmt = mysqli_prepare($db, $sql );
	mysqli_stmt_bind_param($stmt,"s", $account);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$rows = array();
	while($r = mysqli_fetch_assoc($result))
	{
		$rows[] = $r;
	}
	return $rows;
}

function addJob($name, $price, $content, $number,$account) // 加入購物車
{
    global $db;

    $sql = "select `number` from shopping where name=? and uid=?;";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $name,$account);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 0) {
        $total = $number * $price;
        $sql = "insert into shopping (name, price, content, number, total, uid) values (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "sisiis", $name, $price, $content, $number, $total, $account);
        mysqli_stmt_execute($stmt);
        return true;
    } else {
        $row = mysqli_fetch_assoc($result);
        $newNumber = $row['number'] + $number;
		$total = $newNumber * $price;
        $sql = "update `shopping` set number=?, total=? where name=? and uid=?";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "iiss", $newNumber, $total, $name, $account);
        mysqli_stmt_execute($stmt);
        return true;
    }

    //return false;
}

function delJob($id) // 刪除購物車品項
{
	global $db;

	$sql = "delete from shopping where id=?;"; //SQL中的 ? 代表未來要用變數綁定進去的地方
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "i", $id); //bind parameters with variables, with types "sss":string, string ,string
	mysqli_stmt_execute($stmt);  //執行SQL
	return True;
}
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
function addRole($account,$pwd,$role) { // 註冊
	global $db;

	$sql = "insert into users (account, password, role) values (?, ?, ?)"; //SQL中的 ? 代表未來要用變數綁定進去的地方
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "ssi", $account, $pwd, $role); //bind parameters with variables, with types "sss":string, string ,string
	mysqli_stmt_execute($stmt);  //執行SQL
	return True;
}

/*
function updateJob($id, $name,$price,$content)
{
	global $db;

	$sql = "update list set name=?, price=?, content=? where id=?"; //SQL中的 ? 代表未來要用變數綁定進去的地方
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "sisi", $name, $price,$content, $id); //bind parameters with variables, with types "sss":string, string ,string
	mysqli_stmt_execute($stmt);  //執行SQL
	return True;
}
*/

?>