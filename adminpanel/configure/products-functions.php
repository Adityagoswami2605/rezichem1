<?php 
/****************************************
	Products Functions
*****************************************/
function get_products()
{
	$sql = "select * from products where product_status !=3 order by product_created_date desc";
	$results = get_results($sql);
	return $results;
}
function get_product_name($id)
{
	$sql = "select product_name from products where product_id = ".$id." AND product_status !=3 order by product_created_date desc";
	$results = get_row($sql);
	return $results;
}

function get_product_count()
{
	$sql = "SELECT COUNT(*) FROM products where product_status !=3 ";
	$results = get_row($sql);
	return $results['COUNT(*)'];
}


function get_pending_products()
{
	$sql = "select * from products where product_status !=3  and product_admin_status = 0 order by product_created_date desc";
	$results = get_results($sql);
	return $results;
}

function update_product_seq($product_id,$value)
{
	$sql = 'UPDATE products SET product_seq = '.$value.' WHERE `products`.`product_id` ='.$product_id.'';
	$results = get_results($sql);
	return $results;
}

function product_seq_duplicate($product_id,$product_seq)
{
	$condition = '';
	if($product_id != '')
	{
		$condition = 'AND product_id != '.$product_id;
	}
	$sql = "select count(*) as total from products where product_seq = '".$product_seq."' ".$condition;
	$results = get_row($sql);
	return $results['total'];
}

function get_products_detail($id)
{
	$sql = "select * from products where product_id=".$id;
	$results = get_row($sql);
	return $results;
}
function update_product_categories($id,$pc_data=array())
{
	$sql = "delete from product_categories where pc_product_id=".$id;
	$results = db_query($sql);
	foreach($pc_data as $key => $value)
	{
		if($value != ''){
		$data = array();
		$data['pc_cat_id'] = $value;
		$data['pc_product_id'] = $id;
		insert_data('product_categories',$data);
		}
	}	
}
function search_products($params = array())
{
	$where = '';
	if($params)
	{
		foreach($params as $param_key => $param_value)
		{
			if($param_value != '')
			{
				if($param_key == 'product_name')
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
	
	$sql = "select * from products ".$where;
	$results = get_results($sql);
	return $results;
}
function setproduct_slug($productname)
{
	 $productname=$oldproductname = create_slug($productname);
	 $i=1;
	 while(compareproduct_slug($productname)>0)
		 {
		 	$productname = $oldproductname.'-'.$i;
			$i++;
		 }
	 return $productname;	 
}
function compareproduct_slug($productname)
{
	$sql = "select count(*) as total from products where product_slug='".$productname."'";
	$results = get_row($sql);
	return $results['total'];
}
function send_product_approved_email($product_ids = array())
{
	foreach($product_ids as $key => $product_id)
	{
		$product_detail = get_product_detail($product_id);
		$product_name   = $product_detail['product_name'];
		$product_store  = $product_detail['product_store'];
		$store_detail   = get_store_detail($product_store);
		$store_email    = $store_detail['store_email'];
		
		include('email/approved-email.php');
		
		$subject = 'Product Approval Status from E-lala!';
		
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		
		// Mail it
		mail($store_email, $subject, $html, $headers);
	}	
}
function send_product_rejected_email($product_ids = array())
{
	foreach($product_ids as $key => $product_id)
	{
		$product_detail = get_product_detail($product_id);
		$product_name   = $product_detail['product_name'];
		$product_store  = $product_detail['product_store'];
		$store_detail   = get_store_detail($product_store);
		$store_email    = $store_detail['store_email'];
		$store_fullname    = $store_detail['store_fullname'];
		
		include('email/rejected-email.php');
		
		$subject = 'Product Approval Status from Purchasekaro!';
		
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		
		// Mail it
		mail($store_email, $subject, $html, $headers);
	}	
}

?>