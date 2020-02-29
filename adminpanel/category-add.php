<?php 
include('configure/configure.php');
include('auth.php');

$error_message = '';
$error = 0;	
if(count($_POST) > 0)
{
	if(trim($_POST['category_name']) == '')
	{
		$category_name_error = '<label class="alert-danger fade in">This field is required.</label>';	
		$error = 1;
	}
	/*else if(check_cat_duplicate($_POST['category_name']) != '0')
	{
		$category_name_error = '<label class="alert-danger fade in">This category already exists.</label>';	
		$error = 1;
		echo mysql_error();
	}*/
	/********************category Icon******************************************11111**************** */
			
	
	if($_POST['product_category']){
		$last_cat = end($_POST['product_category']);
		if(!$last_cat){
			$last_cat = current(array_slice($_POST['product_category'], -2));
		}
		$_POST['category_parent_id'] =  $last_cat;
		unset($_POST['product_category']);
	}
	$image_count = count($_FILES['category_image']['name']);

	/*if($image_count <= 0 || $_FILES['CAT_IMAGES']['name'][0] == '')

	{

		$cat_image_error = '<span class="notification-input ni-error">This field is required.</span>';	

		$error = 1;

	}*/
	if($error == 1)
	{
		$error_message = ' <div>
                                <label class="alert alert-block alert-danger fade in col-lg-11 col-sm-6">Please fillup all required information.</label>
                            </div>';
	}
	
	else
	{
			
		$_POST['category_image'] = '';
			for($i = 0; $i < $image_count ; $i++)
			{
				if(trim($_FILES['category_image']['name'][$i]) != '')
				{
					$_FILES['category_image_new']['name'] = $_FILES['category_image']['name'][$i];
					$_FILES['category_image_new']['tmp_name'] = $_FILES['category_image']['tmp_name'][$i];
					$_FILES['category_image_new']['type'] = $_FILES['category_image']['type'][$i];
					$_FILES['category_image_new']['error'] = $_FILES['category_image']['error'][$i];
					$_FILES['category_image_new']['size'] = $_FILES['category_image']['size'][$i];
					
					$image_name = upload_image($_FILES['category_image_new'],CATEGORYPATH,CATEGORY_THUMBPATH);
					if($image_name) 
					{
						$_POST['category_image'] .= $image_name.',';	
					}
				}
			}
		$_POST['category_image'] = trim($_POST['category_image'],','); 
			
			$_POST['category_date'] = $current_date;
			$_POST['category_slug'] = create_url_slug($_POST['category_name']);	
			$insert_id = insert_data('category',$_POST);
			if($insert_id)
			{
				update_categories_variation($insert_id,$pc_data);
				header('location:categories.php');
				exit;
			}
			else
			{
				echo mysql_error();
			}
	}	
}

$styles 	 = include_styles('style.css,style-responsive.css,bootstrap.min.css,assets/jquery-ui/jquery-ui-1.10.1.custom.min.css,bootstrap-reset.css,font-awesome.css,jquery-jvectormap-1.2.2.css,css3clock/css/style.css,morris-chart/morris.css,DT_bootstrap.css,demo_page.css,demo_table.css,jquery.wysiwyg.css');
$javascripts = include_js('lib/jquery.js,lib/jquery-1.8.3.min.js,bootstrap.min.js,accordion-menu/jquery.dcjqaccordion.2.7.js,scrollTo/jquery.scrollTo.min.js,nicescroll/jquery.nicescroll.js,scripts.js,gritter/gritter.js,jquery.MultiFile.js,jquery.wysiwyg.js');
?>
<?=DOCTYPE;?>
<?=XMLNS;?>
<head>
<?=CONTENTTYPE;?>
<title>Add Category</title>
<?=$styles?>
<?=$javascripts?>
	


<script type="text/javascript">
	$(function()
	{
		$('.wysiwyg').wysiwyg(
		{
		controls : {
		separator01 : { visible : true },
		separator03 : { visible : true },
		separator04 : { visible : true },
		separator00 : { visible : true },
		separator07 : { visible : false },
		separator02 : { visible : false },
		separator08 : { visible : false },
		insertOrderedList : { visible : true },
		insertUnorderedList : { visible : true },
		undo: { visible : true },
		redo: { visible : true },
		justifyLeft: { visible : true },
		justifyCenter: { visible : true },
		justifyRight: { visible : true },
		justifyFull: { visible : true },
		subscript: { visible : true },
		superscript: { visible : true },
		underline: { visible : true },
		increaseFontSize : { visible : false },
		decreaseFontSize : { visible : false }
		}
		} );
	});
</script>
	
	
<script language="javascript" type="text/javascript">

$(document).ready(function(){

		var ajax_category_url = 'ajax-category-dropdown.php';

		$('.product_category').live('change',function(){

				

				var cat_parent = $(this).val(); 
				var thisNode = $(this); 
				var data_rel = $(this).attr('data-rel'); 

				$.post(ajax_category_url,{cat_parent:cat_parent,level:0,data_rel:data_rel}, function(data) {

					  if(data != '')
					  	//alert('.first_'+cat_parent);
						  $('.first_'+data_rel).remove();
						  //thisNode.attr('data-rel',1);
						  thisNode.parent().after(data);
						  //alert(thisNode.after());
						  //thisNode.remove('product_category');
							
		

					  $('.product_category_0').trigger('change');

				});

		});
});
</script>
	
<script language="Javascript" src="ckeditor/ckeditor.js"></script>	
	
</head>
<body>
<section id="container">
    <!--header start-->
<?php  	include('header.php');?>
    <!--header end-->
    <!--sidebar start-->
<?php include('sidebar.php');?>
    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
		<section class="wrapper">
			<div class="row">
		        <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading btn-primary">
                            Add Category
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" method="post" action="category-add.php" enctype="multipart/form-data">
								 <?=$error_message;?>
								<div class="form-group">
                                    <label>Category Name  [Add Category Name] (*)</label>
                                    <input type="text" class="form-control"  placeholder="Enter Category name" name="category_name" value="<?=$_POST['category_name']?>"  />
									 <p class="help-block"><?=$category_name_error;?></p>
                            	</div>
                            <!--   <div class="form-group">
                                    <label>Parent Category [select category]  </label>
									<select class="form-control input-lg m-bot15 product_category" name="category_parent_id" data-rel="1"> 
										<option value="0">Main Category</option>
										<?php  /*
										$category_options = get_multicat_options();
										// pre($category_options);
										if(count($category_options) > 0)
										{
											foreach($category_options as $category)
											{
												$selected = '';
												if($_POST['category_parent_id'] == $category['category_id'])
												{
													$selected = 'selected=selected';
												}
												echo '<option value="'.$category['category_id'].'" '.$selected.'>'.$category['category_name'].'</option>';
											}
										}	 */
										?>
									</select>
							</div>
							-->
					
							<!--			<div class="form-group">
								<label>Short Description  [Enter Short Description] </label>
                              <textarea rows="7" cols="90" class="form-control ckeditor" name="category_short"><?=$_POST['category_short']?></textarea>
							</div> -->
									<div class="form-group">
								<label>Description  [Enter Short Description] </label>
                              <textarea rows="7" cols="90" class="form-control ckeditor" name="category_summary"><?=$_POST['category_summary']?></textarea>
							</div>
					 <div class="form-group">
                                    <label>Upload Image [ For Add Product Image Click Browse Button]   </label>
                                    <input type="file" class="multi" name="category_image[]" maxlength="1" />
                                   
									<p class="help-block"><?php echo $category_image_error;?></p>
                                </div> 
                             
								
								<div class="form-group">
								<label>Status</label>
								<div class="radio">
									<label>
										<input type="radio" name="category_status" value="1" checked="checked" >
										Publish
									</label>
								</div>
								<div class="radio">
									<label>
										<input  type="radio" name="category_status" value="2">
										Draft
									</label>
								</div>
                             </div>
                                	<input type="submit" class="btn btn-info" value="Submit">
                            	</form>
							</div>
                        </div>
                    </section>
            	</div>
			</div>
		</section>
    </section>
    <!--main content end-->
	<!--right sidebar start-->
	<div class="right-sidebar">
		<div class="search-row">
			<input type="text" placeholder="Search" class="form-control">
		</div>
	</div>
	<!--right sidebar end-->
</section>
</body>
</html>
