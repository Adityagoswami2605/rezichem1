<?php 
include('configure/configure.php');
include('auth.php');



$error_message = '';
$error = 0;	
if(count($_POST) > 0)
{
//pre($_POST);
//exit;
	$image_count = count($_FILES['product_image']['name']);
	if($image_count <= 0 || $_FILES['product_image']['name'][0] == '')
	{
	//	$product_image_error = '<span class="alert-danger fade in">This field is required.</span>';	
	//	$error = 1;
	}
	

	if($error == 1)
	{
		$error_message = ' <div>
                                <span class="alert-danger fade in">Please fillup all required information.</span>
                            </div>';
	}
	else
	{
		
		$_POST['product_image'] = '';
			for($i = 0; $i < $image_count ; $i++)
			{
				if(trim($_FILES['product_image']['name'][$i]) != '')
				{
					$_FILES['product_image_new']['name'] = $_FILES['product_image']['name'][$i];
					$_FILES['product_image_new']['tmp_name'] = $_FILES['product_image']['tmp_name'][$i];
					$_FILES['product_image_new']['type'] = $_FILES['product_image']['type'][$i];
					$_FILES['product_image_new']['error'] = $_FILES['product_image']['error'][$i];
					$_FILES['product_image_new']['size'] = $_FILES['product_image']['size'][$i];
					
					$image_name = upload_image($_FILES['product_image_new'],PRODUCTPATH,PRODUCT_THUMBPATH);
					if($image_name) 
					{
						$_POST['product_image'] .= $image_name.',';	
					}
				}
			}
		$_POST['product_image'] = trim($_POST['product_image'],','); 
	
/*	$_POST['product_image1'] = '';
			for($i = 0; $i < $image_count1 ; $i++)
			{
				if(trim($_FILES['product_image1']['name'][$i]) != '')
				{
					$_FILES['product_image1_new']['name'] = $_FILES['product_image1']['name'][$i];
					$_FILES['product_image1_new']['tmp_name'] = $_FILES['product_image1']['tmp_name'][$i];
					$_FILES['product_image1_new']['type'] = $_FILES['product_image1']['type'][$i];
					$_FILES['product_image1_new']['error'] = $_FILES['product_image1']['error'][$i];
					$_FILES['product_image1_new']['size'] = $_FILES['product_image1']['size'][$i];
					
					$image_name = upload_image($_FILES['product_image1_new'],PRODUCTPATH,PRODUCT_THUMBPATH);
					if($image_name) 
					{
						$_POST['product_image1'] .= $image_name.',';	
					}
				}
			}
	
	*/
	
			if($_FILES['product_file']['name'] != '')
			{
				if($_FILES['product_file']['type'] == 'application/pdf')
				{
					$image_name = upload_file($_FILES['product_file'],PRODUCTPATH);
					if($image_name) 
					{
						$_POST['product_file'] = $image_name;	
					}
				}
				else
				{
					$product_file_error = '<span class="alert-danger fade in">This field is required.</span>';	
					$error = 1;
				}	
				
			}	 
				
		
		
			
			
	
		if($error != 1)
			{	
		$_POST['product_created_date'] = $current_date;
		
		$_POST['product_slug'] = create_url_slug($_POST['product_name']);	

			$insert_id = insert_data('products',$_POST);
		
		
		
			if($insert_id)
			{
			
				$_POST['product_seq'] = $insert_id ;
		
		
				header('location:products.php');
				exit;
			}
			}
			else
			{
				$error_message = ' <div>
                                <span class="notification n-error">Please fillup all required information.</span>
                            </div>';
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
<title>Product Add</title>
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

<!--
<script language="javascript" type="text/javascript">
$(document).ready(function(){
		var limitcharacters = $('.limitcharacters').length;
		if(limitcharacters > 0)
		{
			$('.limitcharacters').keypress(function(){
					var maxlengthchar = $(this).attr('title');
					if($(this).val().length > maxlengthchar)
					{
						return false;
					}
			});
		}	
		<?php if($_POST['product_shipping'] == 0) { ?>
			$(".shipping_class").hide();
		<?php } ?>
		$("[name=product_shipping]").change(function(){
			$(".shipping_class").toggle();
		});
		
});
</script>
-->
<script language="javascript" type="text/javascript">
$(document).ready(function(){
var ajax_category_url = 'ajax-category-dropdown.php';
		//var ajax_category_variation_url = 'ajax-category-variation.php';
		$('.product_category').live('change',function(){
				
				var cat_parent = $(this).val(); 
				var thisNode = $(this); 
				var data_rel = $(this).attr('data-rel'); 
				$.post(ajax_category_url,{cat_parent:cat_parent,level:0,data_rel:data_rel}, function(data) {
					  if(data != '')
						  $('.first_'+data_rel).remove();
						  thisNode.parent().after(data);
					  $('.product_category_0').trigger('change');
				});
				for (var i=Number(data_rel);i<20;i++)
				{
					$('.first_'+i).remove();
				}
				/*$.post(ajax_category_variation_url,{cat_parent:cat_parent,level:0}, function(data) {
						  $('.left-part').html(data);
				});*/
		});
		/*$(".add-new-vari").live("click", function(){
			var txt_obj = $(this).parents('.variation-field').find("input");
			var txt_new_val = txt_obj.val();
			var vari_data_id = txt_obj.attr('data-variation-id');
			var data_id_pk = txt_obj.attr('data-id-pk');
			//if($(".right-part").hasClass('vari-val-'+vari_data_id)){
			var chk_class = $('.right-part .vari-val-'+vari_data_id).length;
			//}
			//alert('.right-part vari-val-'+vari_data_id);
			//$(this).parents('.variation-field').clone().insertBefore($(this).parents('.variation-field'));
			//alert(vari_data_id);
			if(txt_new_val == ""){
				alert("Please Enter Value");
			} else {
				if(chk_class == 0){
					$('.right-part').append('<span class="vari-val-'+vari_data_id+'"><input class="input-short" readonly type="text" value="'+txt_new_val+'" name="variation_data['+vari_data_id+'][]" /><button class="delete-vari">X</button></span>')
				} else {
					$('.right-part .vari-val-'+vari_data_id+':last').after('<span class="vari-val-'+vari_data_id+'"><input class="input-short" readonly type="text" value="'+txt_new_val+'" name="variation_data['+vari_data_id+'][]" /><button class="delete-vari">X</button></span>')
				}
			}
		});
		$(".delete-vari").live("click", function(){
			var par_class = $(this).parent().attr('class');
			var chk_class =$('.right-part '+par_class).length;
			//alert(chk_class);
			var txt_obj = $(this).parents('span').remove();
			
		});*/
		
		
			var characters = 60;
		$("#counter_summary").append("You have <strong>"+  characters+"</strong> characters remaining");
		$("#product_text").keyup(function(){
			if($(this).val().length > characters){
				$(this).val($(this).val().substr(0, characters));
			}
			var remaining = characters -  $(this).val().length;
			$("#counter_summary").html("You have <strong>"+  remaining+"</strong> characters remaining");
			if(remaining <= 10)
			{
				$("#counter_summary").css("color","red");
			}
			else
			{
				$("#counter_summary").css("color","black");
			}
		});
		
		
			var characters1 = 70;
		$("#counter_summary1").append("You have <strong>"+  characters1+"</strong> characters remaining");
		$("#product_keyword").keyup(function(){
			if($(this).val().length > characters1){
				$(this).val($(this).val().substr(0, characters));
			}
			var remaining = characters1 -  $(this).val().length;
			$("#counter_summary1").html("You have <strong>"+  remaining+"</strong> characters remaining");
			if(remaining <= 10)
			{
				$("#counter_summary1").css("color","red");
			}
			else
			{
				$("#counter_summary1").css("color","black");
			}
		});
		
			var characters3 = 160;
		$("#counter_summary3").append("You have <strong>"+  characters3+"</strong> characters remaining");
		$("#product_description").keyup(function(){
			if($(this).val().length > characters3){
				$(this).val($(this).val().substr(0, characters));
			}
			var remaining = characters3 -  $(this).val().length;
			$("#counter_summary3").html("You have <strong>"+  remaining+"</strong> characters remaining");
			if(remaining <= 10)
			{
				$("#counter_summary3").css("color","red");
			}
			else
			{
				$("#counter_summary3").css("color","black");
			}
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
                            Add Product
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" enctype="multipart/form-data" method="post" action="product-add.php">
								<?=$error_message;?>
						
				 <div class="form-group" id="cat-subcat-list">
									<label>Category</label>
                                   <select class="form-control input-lg m-bot15 product_category" name="product_category" data-rel="1"  onClick="showUser(this.value)">
										<option value="0">Main Category</option>
										<?php 
										
										$category_options = get_cat_options();
										if(count($category_options) > 0)
										{
											foreach($category_options as $category)
											{
												$selected = '';
												if($_POST['category_id'] == $category['category_id'])
												{
													$selected = 'selected=selected';
												}
												echo '<option value="'.$category['category_id'].'" '.$selected.'>'.$category['category_name'].'</option>';
											}
										}	 
										 ?>
									</select>
									<p class="help-block"><?=$product_category_error;?></p>
                                </div>
                
                                <div class="form-group">
                                    <label>Product Name [Enter Product Name]</label>
                                    <input type="text" class="form-control"  placeholder="Enter Product name" name="product_name" value="<?=$_POST['product_name']?>">
									<p class="help-block"><?=$product_name_error;?></p>
                                </div>
									
									 <div class="form-group">
                                    <label>Product Short Description [Enter Product Content]</label>
                                    <input type="text" class="form-control"  placeholder="Enter Product Content" name="product_description" value="<?=$_POST['product_description']?>">
								
                                </div>
                     
                           <!--      <div class="form-group" id="cat-subcat-list">
									<label>Sub Category</label>
                                   <select class="form-control input-lg m-bot15 product_category_0" name="product_category_0" data-rel="1">
										   <option value="0">Select</option>
										
									</select>
									<p class="help-block"><?=$product_category_0_error;?></p>
                                </div>
                             -->
						<!--		<div class="form-group">
									<label>Description [Enter Short Description] </label>
									<div class="col-sm-15">
										<textarea class="form-control ckeditor"  rows="6" name="product_description" ><?=$_POST['product_description']?></textarea>
									</div>
									<p class="help-block"><?=$product_desc_error;?></p>
								</div>  -->
                           <!--    <div class="form-group">
                                    <label>Upload Image [ For Add Product Image Click Browse Button]   </label>
                                    <input type="file" class="multi" name="product_image[]" maxlength="1" />
                                   
									<p class="help-block"><?php echo $product_image_error;?></p>
                                </div> 
                             -->
                        
                  <!--      
						<header class="panel-heading btn-primary">
							SEO Details
						</header>
						 <div class="form-group">
                                    <label>Title[Set product title for google search]<span id="counter_summary"></span></label>
                                    <input type="text" class="form-control" id="product_text" name="product_seo_title"  value="<?=$_POST['product_seo_title']?>">
                          </div>
						  <div class="form-group">
									<label>Description [Enter product description for google search.] <span id="counter_summary3"></span> </label>
									<div class="col-sm-15">
										<textarea class="form-control" rows="6" id="product_description" name="product_seo_description"><?=$_POST['product_seo_description']?></textarea>
									</div>
							</div>
							<div class="form-group">
									<label>Keywords [Enter keywords "," separated for google search.] <span id="counter_summary1"></span></label>
									<div class="col-sm-15">
										<textarea class="form-control" rows="6" id="product_keyword" name="product_seo_keywords"><?=$_POST['product_seo_keywords']?></textarea>
									</div>
							</div> 
                            -->
                              
							<div class="form-group">
									<label>Status</label>
									<div class="radio">
										<label>
											<input id="optionsRadios1" type="radio" name="product_status" value="1" checked="checked" >
											Publish
										</label>
									</div>
									<div class="radio">
										<label>
											<input id="optionsRadios1" type="radio" name="product_status" value="2">
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
