<?php 
/****************************************
	hotelcategory Functions
*****************************************/
function get_hotelcategories()
{
	$sql = "select * from hotelcategory where hotelcategory_status != 3";
	$results = get_results($sql);
	return $results;
}
function get_hotelcategory_detail($id)
{
	$sql = "select * from hotelcategory where hotelcategory_id=".$id;
	$results = get_row($sql);
	return $results;
}
function get_hotelcategory_count()
{
	$sql = "SELECT COUNT(*) FROM hotelcategory where hotelcategory_status !=3 ";
	$results = get_row($sql);
	return $results['COUNT(*)'];
}

function get_hotelcat_name($id)
{
	$sql = "select hotelcategory_name from hotelcategory where hotelcategory_id=".$id;
	$results = get_row($sql);
	return $results['hotelcategory_name'];
}
function get_hotelcat_options()
{
	$sql = "select hotelcategory_id,hotelcategory_name from hotelcategory where hotelcategory_status != 3";
	$results = get_results($sql);
	return $results;
}
function get_multihotelcat_options($parent='0')
{
	$sql = "select hotelcategory_id,hotelcategory_name from hotelcategory where hotelcategory_status != 3 AND hotelcategory_parent_id=".$parent;
	$results = get_results($sql);
	return $results;
}

function check_hotelcat_duplicate($name)
{
	$sql = "select hotelcategory_id from hotelcategory where hotelcategory_name='".$name."' and hotelcategory_parent_id = 0";
	$results = get_row($sql);
	if($results['hotelcategory_id'] != '')
	{
		return 1;
	}
	else
	{
		return 0;
	}
}
function search_hotelcategories($params = array())
{
	$where = '';
	if($params)
	{
		foreach($params as $param_key => $param_value)
		{
			if($param_value != '')
				$where .= $param_key.'="'.$param_value.'" AND ';
		}
	}
	if($where != '')
	{
		$where = ' where '.$where;
		$where = trim($where,' AND ');
	}
	
	$sql = "select * from hotelcategory ".$where;
	$results = get_results($sql);
	return $results;
}
function update_hotelcategory_commision($hotelcategory_id,$value)
{
	$sql = 'UPDATE hotelcategory SET hotelcategory_commision = '.$value.' WHERE `hotelcategory`.`hotelcategory_id` ='.$hotelcategory_id.'';
	$results = get_results($sql);
	return $results;
}
function get_hotelcat_details($id)
{
	$query = mysql_query("SELECT * FROM hotelcategory where hotelcategory_id=".$id);
	if(mysql_num_rows($query) > 0)
	{
	  $i = 0;
	  while($temp = mysql_fetch_array($query))
	  {
	        $data[$i] = $temp;
			$i++;
	  }
	  return $data;
	}
	else return 0;  
}
function get_hotelcategory_by_id($id){
	/*$sql = "select hotelcategory_id,hotelcategory_name,hotelcategory_parent_id from hotelcategory where hotelcategory_status = 1 && hotelcategory_parent_id=".$cat_id;
	$results = get_results($sql);
	
	foreach($results as $result){
		$results1 .= '<option value="'.$result['hotelcategory_id'].'" >&nbsp;&nbsp;&nbsp;&nbsp;'.$result['hotelcategory_name'].'</option>';
	}
	
	return $results1;*/
	$query = mysql_query("SELECT * FROM hotelcategory where hotelcategory_parent_id=".$id);
	 
	if(mysql_num_rows($query) > 0)
	{
	  $i = 0;
	  while($temp = mysql_fetch_array($query))
	  {
	        $data[$i] = $temp;
			$i++;
	  }
	  return $data;
	}
	else
	{
	  return 0;
	}
}

?>
