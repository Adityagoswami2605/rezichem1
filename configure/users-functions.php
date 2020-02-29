<?php 
/****************************************
	Users Functions
*****************************************/
function user_exists($uname,$pwd)
{
	$sql = "select * from users where username = '".$uname."' AND password = '".$pwd."'";
	$results = get_row($sql);
	return $results;
}
function user_duplicate($uname,$user_id='')
{
	$condition = '';
	if($user_id != '')
	{
		$condition = 'AND user_id != '.$user_id;
	}
	$sql = "select count(*) as total from users where username = '".$uname."' ".$condition;
	$results = get_row($sql);
	return $results['total'];
}
function user_duplicate_email($email,$user_id='')
{
	$condition = '';
	if($user_id != '')
	{
		$condition = 'AND user_id != '.$user_id;
	}
	$sql = "select count(*) as total from users where email = '".$email."' ".$condition;
	$results = get_row($sql);
	return $results['total'];
}
function get_users()
{
	$sql = "select * from users where user_status != 3";
	$results = get_results($sql);
	return $results;

}
function get_user_detail($user_id)
{
	$sql = "select * from users where user_id = ".$user_id;
	$results = get_row($sql);
	return $results;
}
function get_username($user_id)
{
	$sql = "select * from users where user_id = ".$user_id;
	$results = get_row($sql);
	return $results['user_name'];
}

function get_user_detail_by_emails($email)
{
	$email   = mysql_escape_string($email);
	$sql 	 = "select password from users where email = '".$email."'";
	$results = get_row($sql);
	return $results['password'];
}

?>
