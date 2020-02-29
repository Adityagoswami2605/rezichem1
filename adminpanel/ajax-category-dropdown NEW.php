<?php /*
include('configure/configure.php');
$cat_parent = $_POST['cat_parent'];

if($cat_parent != '')
{
	echo '<option value="0">Select</option>';
	if($cat_parent != '0')
	{
		$cat_options = get_multicat_options($cat_parent);
		if(count($cat_options) > 0 )
		{
			foreach($cat_options as $cat)
			{
				echo '<option value="'.$cat['category_id'].'">'.$cat['category_name'].'</option>';
			}
		}	
	}	
}	*/
?>


<?php 
include_once('configure/configure.php');
$cat_parent = $_POST['cat_parent'];
$data_rel = $_POST['data_rel'];
if($cat_parent != '')
{
	
	if($cat_parent != '0')
	{

		$cat_options = get_multicat_options($cat_parent);
		if(count($cat_options) > 0 )
		{
			echo '<div class="form-group col-sm-13 first_'.$data_rel.'">';
			$data_rel++;
			echo '<select class="form-control child-cat product_category" data-rel="'.$data_rel.'" name="product_category[]">';
			echo '<option value="0" selected = "selected">Select</option>';
			foreach($cat_options as $cat)
			{
				echo '<option value="'.$cat['category_id'].'">'.$cat['category_name'].'</option>';
			}
		}	
		echo "</select></div>";	
	}
	
}	
?>