<?php 

/****************************************

	faq Functions

*****************************************/

function get_faq()

{

	$sql = "select * from faqs where faq_status !=3";

	$results = get_results($sql);

	return $results;

}

function get_faq_detail($id)

{

	$sql = "select * from faqs where faq_id=".$id;

	$results = get_row($sql);

	return $results;

}

function get_allcat_faq_by_count() 

{

	$sql = "select count(*) as total from faqs where faq_status !=3 order by faq_id asc";

   $results = get_row($sql);

	return $results['total'];

}



function get_allcat_faq_by($start=0,$limit=5)

{

	

	$sql = "select * from faqs where faq_status !=3 order by faq_id asc limit ".$start.','.$limit;

	$results = get_results($sql);

	return $results;

}

function get_faq_count()
{
	$sql = "SELECT COUNT(*) FROM faqs where faq_status !=3";
	$results = get_row($sql);
	return $results['COUNT(*)'];
}




?>

