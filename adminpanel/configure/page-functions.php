
<?php 
/****************************************
	Page Functions
*****************************************/
function get_pages()
{
	$sql = "select * from pages where P_STATUS !=3";
	$results = get_results($sql);
	return $results;
}
function get_page_detail($id)
{
	$sql = "select * from pages where P_ID=".$id;
	$results = get_row($sql);
	return $results;
}
function get_pages_count()
{
	$sql = "SELECT COUNT(*) FROM pages where P_STATUS !=3 ";
	$results = get_row($sql);
	return $results['COUNT(*)'];
}
function get_page_id($id)
{
		$sql	= 	"select * from pages where page_id=".$id;
		$results = get_count($sql);
		return $results;
}
function search_pages($status)
{
	$sql = "select * from pages where page_status=".$status;
	$results = get_results($sql);
	return $results;
}
function get_index_viewer()
{
	$sql = "select setting_value from settings where setting_field ='elala_total_visits'";
	$results = get_row($sql);
	return $results['setting_value'];
}

?>