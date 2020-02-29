<?php 
/****************************************
	Galleries Functions
*****************************************/
function get_certificate()
{
	$sql = "select * from certificate where certificate_status =1";
	$results = get_results($sql);
	return $results;
}
function get_certificate_detail($id)
{
	$sql = "select * from certificate where certificate_id=".$id;
	$results = get_row($sql);
	return $results;
}
function get_certificate_count()
{
	$sql = "SELECT COUNT(*) FROM certificate where certificate_status =1 ";
	$results = get_row($sql);
	return $results['COUNT(*)'];
}

?>
