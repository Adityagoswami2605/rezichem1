<?php 
/****************************************
	news Functions
*****************************************/
function get_news()
{
	$sql = "select * from news where news_status !=3 order by news_created_date asc";
	$results = get_results($sql);
	return $results;
}
function get_news_detail($id)
{
	$sql = "select * from news where news_id=".$id;
	$results = get_row($sql);
	return $results;
}
function get_news_limit($limit='1')
{
	$sql = "select * from news where news_status = 1 limit " .$limit;
	$results = get_results($sql);
	return $results;
}
/*
function get_servflavor($news_id,$flavor_id)
{
	$news_detail = get_news_detail($news_id);
	$flavors 		= $news_detail['news_flavors'];
	
	if($flavors != '')
	{
		$flavors = unserialize($flavors);

		if(array_key_exists($flavor_id,$flavors))
		{
			return $flavors[$flavor_id];
		}	
	}
	else
	{
		return 'N/A';
	}
}
*/
function get_news_count()
{
	$sql = "SELECT COUNT(*) FROM news where news_status !=3 ";
	$results = get_row($sql);
	return $results['COUNT(*)'];
}
?>
