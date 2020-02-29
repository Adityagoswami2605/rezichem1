<?php 
/****************************************
	Galleries Functions
*****************************************/
function get_gallery()
{
	$sql = "select * from gallery where gallery_status !=3";
	$results = get_results($sql);
	return $results;
}
function get_gallery_detail($id)
{
	$sql = "select * from gallery where gallery_id=".$id;
	$results = get_row($sql);
	return $results;
}
function get_gallery_count()
{
	$sql = "SELECT COUNT(*) FROM gallery where gallery_status !=3 ";
	$results = get_row($sql);
	return $results['COUNT(*)'];
}
?>
