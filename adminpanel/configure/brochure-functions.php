<?php 
/****************************************
	Users Functions
*****************************************/
function get_brochure()
{
	$sql = "select * from brochure where brochure_status !=3 ";
	$results = get_results($sql);
	return $results;

}
function get_brochure_detail($brochure_id)
{
	$sql = "select * from brochure where brochure_id = ".$brochure_id;
	$results = get_row($sql);
	return $results;
}
function get_brochure_count()
{
	$sql = "SELECT COUNT(*) FROM brochure where brochure_status !=3 ";
	$results = get_row($sql);
	return $results['COUNT(*)'];
}
/*
function brochure_exists($cname,$pwd)
{
	$sql = "select * from brochure where brochure_name = '".$cname."' AND brochure_password = '".$pwd."'";
	$results = get_row($sql);
	return $results;
}
function brochure_duplicate($cname,$brochure_id='')
{
	$condition = '';
	if($brochure_id != '')
	{
		$condition = 'AND brochure_id != '.$brochure_id;
	}
	$sql = "select count(*) as total from brochure where brochure_name = '".$cname."' ".$condition;
	$results = get_row($sql);
	return $results['total'];
}
function brochure_duplicate_email($email,$brochure_id='')
{
	$condition = '';
	if($brochure_id != '')
	{
		$condition = 'AND brochure_id != '.$brochure_id;
	}
	$sql = "select count(*) as total from brochure where brochure_email = '".$email."' ".$condition;
	$results = get_row($sql);
	return $results['total'];
}
function get_brochurename($brochure_id)
{
	$sql = "select * from brochure where brochure_id = ".$brochure_id;
	$results = get_row($sql);
	return $results['brochure_name'];
}*/
function get_brochure_name($id)
{
	$sql = "select brochure_name from brochure where brochure_id = ".$id;
	$results = get_row($sql);
	return $results['brochure_name'];

}
?>