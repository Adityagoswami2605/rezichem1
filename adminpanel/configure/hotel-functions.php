<?php 
/****************************************
	hotels Functions
*****************************************/
function get_hotels()
{
	$sql = "select * from hotels where hotel_status !=3 order by hotel_created_date desc";
	$results = get_results($sql);
	return $results;
}
function get_hotel_name($id)
{
	$sql = "select hotel_name from hotels where hotel_id = ".$id." AND hotel_status !=3 order by hotel_created_date desc";
	$results = get_row($sql);
	return $results;
}

function get_hotel_count()
{
	$sql = "SELECT COUNT(*) FROM hotels where hotel_status !=3 ";
	$results = get_row($sql);
	return $results['COUNT(*)'];
}


function get_pending_hotels()
{
	$sql = "select * from hotels where hotel_status !=3  and hotel_admin_status = 0 order by hotel_created_date desc";
	$results = get_results($sql);
	return $results;
}

function update_hotel_seq($hotel_id,$value)
{
	$sql = 'UPDATE hotels SET hotel_seq = '.$value.' WHERE `hotels`.`hotel_id` ='.$hotel_id.'';
	$results = get_results($sql);
	return $results;
}

function hotel_seq_duplicate($hotel_id,$hotel_seq)
{
	$condition = '';
	if($hotel_id != '')
	{
		$condition = 'AND hotel_id != '.$hotel_id;
	}
	$sql = "select count(*) as total from hotels where hotel_seq = '".$hotel_seq."' ".$condition;
	$results = get_row($sql);
	return $results['total'];
}

function get_hotels_detail($id)
{
	$sql = "select * from hotels where hotel_id=".$id;
	$results = get_row($sql);
	return $results;
}
function update_hotel_categories($id,$pc_data=array())
{
	$sql = "delete from hotel_categories where pc_hotel_id=".$id;
	$results = db_query($sql);
	foreach($pc_data as $key => $value)
	{
		if($value != ''){
		$data = array();
		$data['pc_cat_id'] = $value;
		$data['pc_hotel_id'] = $id;
		insert_data('hotel_categories',$data);
		}
	}	
}
function search_hotels($params = array())
{
	$where = '';
	if($params)
	{
		foreach($params as $param_key => $param_value)
		{
			if($param_value != '')
			{
				if($param_key == 'hotel_name')
				{
					$where .= $param_key.' like "%'.$param_value.'%" AND ';
				}
				else
					$where .= $param_key.'="'.$param_value.'" AND ';
				
			}	
		}
	}
	if($where != '')
	{
		$where = ' where '.$where;
		$where = trim($where,' AND ');
	}
	
	$sql = "select * from hotels ".$where;
	$results = get_results($sql);
	return $results;
}
function sethotel_slug($hotelname)
{
	 $hotelname=$oldhotelname = create_slug($hotelname);
	 $i=1;
	 while(comparehotel_slug($hotelname)>0)
		 {
		 	$hotelname = $oldhotelname.'-'.$i;
			$i++;
		 }
	 return $hotelname;	 
}
function comparehotel_slug($hotelname)
{
	$sql = "select count(*) as total from hotels where hotel_slug='".$hotelname."'";
	$results = get_row($sql);
	return $results['total'];
}
function send_hotel_approved_email($hotel_ids = array())
{
	foreach($hotel_ids as $key => $hotel_id)
	{
		$hotel_detail = get_hotel_detail($hotel_id);
		$hotel_name   = $hotel_detail['hotel_name'];
		$hotel_store  = $hotel_detail['hotel_store'];
		$store_detail   = get_store_detail($hotel_store);
		$store_email    = $store_detail['store_email'];
		
		include('email/approved-email.php');
		
		$subject = 'hotel Approval Status from E-lala!';
		
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		
		// Mail it
		mail($store_email, $subject, $html, $headers);
	}	
}
function send_hotel_rejected_email($hotel_ids = array())
{
	foreach($hotel_ids as $key => $hotel_id)
	{
		$hotel_detail = get_hotel_detail($hotel_id);
		$hotel_name   = $hotel_detail['hotel_name'];
		$hotel_store  = $hotel_detail['hotel_store'];
		$store_detail   = get_store_detail($hotel_store);
		$store_email    = $store_detail['store_email'];
		$store_fullname    = $store_detail['store_fullname'];
		
		include('email/rejected-email.php');
		
		$subject = 'hotel Approval Status from Purchasekaro!';
		
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		
		// Mail it
		mail($store_email, $subject, $html, $headers);
	}	
}

?>