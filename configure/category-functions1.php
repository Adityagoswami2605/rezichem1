<?php 
/****************************************
	Category Functions
*****************************************/
function get_categories()
{
	$sql = "select * from category where category_status != 3 " ;
	$results = get_results($sql);
	return $results;
}
function get_category_detail($id)
{
	$sql = "select * from category where category_id=".$id;
	$results = get_row($sql);
	return $results;
}

function get_cat_name($id)
{
	$sql = "select category_name from category where category_id=".$id;
	$results = get_row($sql);
	return $results['category_name'];
}

function get_cat_options()
{
	$sql = "select category_id,category_name from category where category_status != 3 and category_parent_id = 0";
	$results = get_results($sql);
	return $results;
}
function get_sub_cat_options()
{
	$sql = "select category_id,category_name from category where category_status != 3 and category_parent_id != 0";
	$results = get_results($sql);
	return $results;
}
function get_multicat_options($parent='23')
{
	$sql = "select category_id,category_name from category where category_status != 3 AND category_parent_id=".$parent;
	$results = get_results($sql);
	return $results;
}

function product_cat_options_brand()
{
	$sql = "select category_id,category_name from category where category_status != 3 and category_parent_id = 0";
	$results = get_results($sql);
	return $results;
}

/*function product_cat_options_cat()
{
	$sql = "select CAT_ID,CAT_NAME from category where CAT_STATUS != 3 and CAT_PARENT_ID = 1";
	$results = get_results($sql);
	return $results;
}
*/
function product_cat_options_cat($parent='1')
{
	$sql = "select category_id,category_name from category where category_status != 3 AND category_parent_id=".$parent;
	$results = get_results($sql);
	return $results;
}


function get_product_cat_options($parent='0')
{
	$sql = "select category_id,category_name from category where category_status != 3 AND category_parent_id=".$parent;
	$results = get_results($sql);
	return $results;
}


function check_cat_duplicate($name)
{
	$sql = "select category_id from category where category_name='".$name."'";
	$results = get_row($sql);
	
	if($results['category_id'] != '')
	{
		return 1;
	}
	else
	{
		return 0;
	}
}
function get_catfeature_detail($id)
{
	$sql = "select * from catfeature where category_id=".$id;
	$results = get_results($sql);
	return $results;
}
function catoption_delete_id($option_id)
{
	$sql = "delete from catfeature where catfeature_id =".$option_id;
  $results	= db_query($sql);
}

function get_subcategory()
{
	$sql = "select * from subcategory where subcategory_status = 1 " ;
	$results = get_results($sql);
	return $results;
}
function get_subcategory_detail($id)
{
	$sql = "select * from subcategory where subcategory_id=".$id;
	$results = get_row($sql);
	return $results;
}
function get_category_name($id)
{
	$sql = "select category_name from category where category_id=".$id;
	$results = get_row($sql);
	return $results['category_name'];
}
?>
