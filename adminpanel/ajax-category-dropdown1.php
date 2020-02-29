<?php 
include('configure/configure.php');
$cat_parent = $_POST['cat_parent'];
$data_rel = $_POST['data_rel'];
if($cat_parent != '')
{
	
	if($cat_parent != '0')
	{

		$cat_options = get_multicat_options($cat_parent);
		if(count($cat_options) > 0 )
		{
			echo '<div class="form-group first_'.$data_rel.'">';
			$data_rel++;
			echo '<select class="form-control child-cat product_category" data-rel="'.$data_rel.'" name="product_category[]">
			<option value="0">Select</option>';
			foreach($cat_options as $cat)
			{
				echo '<option value="'.$cat['category_id'].'">'.$cat['category_name'].'</option>';
			}
		}	
		echo "</select></div>";	
	}
	
}	
?>