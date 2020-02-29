<?php 
/****************************************
	Galleries Functions
*****************************************/
function get_clients()
{
	$sql = "select * from clients where clients_status =1";
	$results = get_results($sql);
	return $results;
}
function get_clients_detail($id)
{
	$sql = "select * from clients where clients_id=".$id;
	$results = get_row($sql);
	return $results;
}
function get_clients_count()
{
	$sql = "SELECT COUNT(*) FROM clients where clients_status =1 ";
	$results = get_row($sql);
	return $results['COUNT(*)'];
}
?>
