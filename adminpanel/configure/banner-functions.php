<?php 
/****************************************
	Banner Functions
*****************************************/
function get_banner()
{
	$sql = "select * from banner where banner_status !=3";
	$results = get_results($sql);
	return $results;
}
function get_banner_detail($id)
{
	$sql = "select * from banner where banner_id=".$id;
	$results = get_row($sql);
	return $results;
}
function get_banner_count()
{
	$sql = "SELECT COUNT(*) FROM banner where banner_status !=3 ";
	$results = get_row($sql);
	return $results['COUNT(*)'];
}

/*
function get_allotments()
{
	$sql = "select * from allotment where ALl_STATUS !=3";
	$results = get_results($sql);
	return $results;
}
function get_allotement_detail($id)
{
	$sql = "select * from allotment where ALL_ID=".$id;
	$results = get_row($sql);
	return $results;
}


function get_allotement_show_detail($id)
{
	$sql = "select * from allotment where product_id=".$id;
	$results = get_row($sql);
	return $results;
}

function get_allotement_type_detail($id)
{
	$sql = "select * from allotment where  product_id=".$id;
	$results = get_results($sql);
	return $results;
}


function get_allotement_product_stock($id)
{
	
	$sql = "select ALL_STOCK from allotment where ALL_STATUS !=3 and SP_PARENT_ID=" .$id;
	$results = get_row($sql);
	return $results['ALL_STOCK'];
}
function get_product_order_detail($id)
{
	$sql = "select * from products where  product_id = ".$id;
	$results = get_row($sql);
	return $results;
}
*/

function update_banner_seq($banner_id,$value)
{
	$sql = 'UPDATE banner SET banner_seq = '.$value.' WHERE `banner`.`banner_id` ='.$banner_id.'';
	$results = get_results($sql);
	return $results;
}

function banner_seq_duplicate($banner_id,$banner_seq)
{
	$condition = '';
	if($banner_id != '')
	{
		$condition = 'AND banner_id != '.$banner_id;
	}
	$sql = "select count(*) as total from banner where banner_seq = '".$banner_seq."' ".$condition;
	$results = get_row($sql);
	return $results['total'];
}

?>
