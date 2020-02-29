<?php 
include('configure/configure.php');
include('auth.php');
$hotel_id = $_REQUEST['hotel_id'];
if($hotel_id != '' && is_numeric($hotel_id))
{
/*
pre($_POST);
exit;
*/
	$hotel_detail = get_hotels_detail($hotel_id);
	
	$hotel_name 				= $hotel_detail['hotel_name'];
	//$hotel_price 				= $hotel_detail['hotel_price'];
	$hotel_category			= $hotel_detail['hotel_category'];
	$hotel_category_0			= $hotel_detail['hotel_category_0'];
	//$hotel_category_1			= $hotel_detail['hotel_category_1'];
	$hotel_image				= $hotel_detail['hotel_image'];
	//$hotel_image1				= $hotel_detail['hotel_image1'];
	//$hotel_brief 				= $hotel_detail['hotel_brief'];
	$hotel_description 			= $hotel_detail['hotel_description'];
	//$hotel_video 				= $hotel_detail['hotel_video'];
	$hotel_file 				= $hotel_detail['hotel_file'];
	$hotel_status 			= $hotel_detail['hotel_status'];
	//$hotel_featured 			= $hotel_detail['hotel_featured'];
	//$nonpress_description 			= $hotel_detail['nonpress_description'];
	//$press_description 			= $hotel_detail['press_description'];
	
	
	//$member_details 			= get_feature_detail($hotel_id);
//	pre($member_details);
}
else
{
	header('location:hotels.php');
	exit;
}
$error_message = '';
$error = 0;	
if(count($_POST) > 0)
{

//exit;

//pre($_POST);
//exit;
/*
	$memberdetails[] = $_POST;
//pre($memberdetails);
	$member_option_details = $_POST['member_details'];
	$member_option_image   = $_FILES['member_image'];

	
	if(count($_POST['set_opt']) > 0)
	{
		$memberoption_name = array();
		$memberoption_name = $_POST['set_opt'];
	//	pre($memberoption_name);
	//	exit();

		//pre($memberoption_name);
		
		$set_options_loop   = $_FILES['newmember_image'];
		unset($_POST['set_options']);
	}

*/
	if($error == 1)
	{
		$error_message = ' <div>
                                <span class="notification n-error">Please fillup all required information.</span>
                            </div>';
	}
	else
		{
		$image_arr = explode(',',$hotel_image);
			
			for($i = 0;$i<count($image_arr) ; $i++)
			{
				$org_image = $image_arr[$i];
				if(!in_array($org_image,$_POST['old_images']))
				{
					if(file_exists(HOTELPATH.$org_image))
					{
						unlink(HOTELPATH.$org_image);
						if(file_exists(HOTEL_THUMBPATH.$org_image))
						{
							unlink(HOTEL_THUMBPATH.$org_image);
						}
					}	
				}
				else
				{
					$new_arr[] = $org_image;
				}
			}
			 
			$_POST['hotel_image'] = implode(',',$new_arr);
			$_POST['hotel_image'] = $_POST['hotel_image'].',';
			
			$image_count = count($_FILES['hotel_image']['name']);
			for($i = 0; $i< $image_count ; $i++)
			{
				if(trim($_FILES['hotel_image']['name'][$i]) != '')
				{
					$_FILES['HOTEL_IMAGES_NEW']['name'] = $_FILES['hotel_image']['name'][$i];
					$_FILES['HOTEL_IMAGES_NEW']['tmp_name'] = $_FILES['hotel_image']['tmp_name'][$i];
					$_FILES['HOTEL_IMAGES_NEW']['type'] = $_FILES['hotel_image']['type'][$i];
					$_FILES['HOTEL_IMAGES_NEW']['error'] = $_FILES['hotel_image']['error'][$i];
					$_FILES['HOTEL_IMAGES_NEW']['size'] = $_FILES['hotel_image']['size'][$i];
					
					$image_name = upload_image($_FILES['HOTEL_IMAGES_NEW'],HOTELPATH,HOTEL_THUMBPATH);
					if($image_name) 
					{
						$_POST['hotel_image'] .= $image_name.',';	
					}
				}
			}
			
			$_POST['hotel_image'] = trim($_POST['hotel_image'],','); 
			unset($_POST['old_images']);
		
					
			if($_FILES['hotel_file']['name'] != '')
			{			
				{
				if($_FILES['hotel_file']['type'] == 'application/pdf')
					{
						$image_name1 = upload_file($_FILES['hotel_file'],HOTELPATH);
						if($image_name1) 
						{
							$_POST['hotel_file'] = $image_name1;	
						}
						 
						if(file_exists(HOTELPATH.$hotel_file))
						{
							unlink(HOTELPATH.$hotel_file);
						}	
					}
		
				}
				
			}	
			
			
			
	
	
					$_POST['hotel_created_date'] = $current_date;
					$_POST['hotel_slug'] = create_url_slug($_POST['hotel_name']);	
	
					$update_id = update_data('hotels',$_POST,'hotel_id ='.$hotel_id);
					
				
			header('location:hotels.php');
					exit;
			}
		
	}

 
$styles 	 = include_styles('style.css,style-responsive.css,bootstrap.min.css,assets/jquery-ui/jquery-ui-1.10.1.custom.min.css,bootstrap-reset.css,font-awesome.css,jquery-jvectormap-1.2.2.css,css3clock/css/style.css,morris-chart/morris.css,DT_bootstrap.css,demo_page.css,demo_table.css,jquery.wysiwyg.css');
$javascripts = include_js('lib/jquery.js,lib/jquery-1.8.3.min.js,bootstrap.min.js,accordion-menu/jquery.dcjqaccordion.2.7.js,scrollTo/jquery.scrollTo.min.js,nicescroll/jquery.nicescroll.js,scripts.js,gritter/gritter.js,jquery.MultiFile.js,jquery.wysiwyg.js');
?>
<?=DOCTYPE;?>
<?=XMLNS;?>
<head>
<?=CONTENTTYPE;?>
<title>Hotel Edit</title>
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
		<?php if($_POST['hotel_shipping'] == 0) { ?>
			$(".shipping_class").hide();
		<?php } ?>
		$("[name=hotel_shipping]").change(function(){
			$(".shipping_class").toggle();
		});
		
});
</script>
<script language="javascript" type="text/javascript">
$(document).ready(function(){
var ajax_category_url = 'ajax-category-dropdown.php';
		//var ajax_category_variation_url = 'ajax-category-variation.php';
		$('.hotel_category').live('change',function(){
				
				var cat_parent = $(this).val(); 
				var thisNode = $(this); 
				var data_rel = $(this).attr('data-rel'); 
				$.post(ajax_category_url,{cat_parent:cat_parent,level:0,data_rel:data_rel}, function(data) {
					  if(data != '')
						  $('.first_'+data_rel).remove();
						  thisNode.parent().after(data);
					  $('.hotel_category_0').trigger('change');
				});
				for (var i=Number(data_rel);i<20;i++)
				{
					$('.first_'+i).remove();
				}
				/*$.post(ajax_category_variation_url,{cat_parent:cat_parent,level:0}, function(data) {
						  $('.left-part').html(data);
				});*/
		});
	
});
</script>
<script language="Javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
var intTextBox=0;
var intTextBox1=0;


//FUNCTION TO ADD TEXT BOX ELEMENT
function addElement()
{
	intTextBox = intTextBox + 1;
	var contentID = document.getElementById("content");
	var newTBDiv = document.createElement("div");
	newTBDiv.setAttribute("id","strText"+intTextBox);
	newTBDiv.innerHTML = "<div class='module' style='border:1px solid; padding:10px;' id='" + intTextBox + "'><h4><span>Add Feature</span></h4><div class='module-body'><p><label>Features For (*)</label><select name='set_opt[feature_for][" + intTextBox + "]'><option value='0'>Select</option><option value='1'>Non Pressurised </option><option value='2'>Pressurised </option></select><p><label>Name (*)</label><input class='input-short' size='30' type='text'  name='set_opt[feature_name][" + intTextBox + "]' /></p><p><label>Description(*)</label><textarea rows='7' cols='90' class='ckeditor' name='set_opt[feature_desc][" + intTextBox + "]'>  </textarea></p><p ><label>Image (*)</label><input class='input-short' type='file'  name='newmember_image[" + intTextBox + "][]' /></p></div></div>";
	contentID.appendChild(newTBDiv);
}
<?php /* ?><select input class='input-short'><option name='set_options[" + intTextBox + "][marital]'  value='0' />Select<option name='set_options[" + intTextBox + "][marital]'  value='1' />single<option name='set_options[" + intTextBox + "][marital]'  value='2' />Married<select></p><?php  */?>
//FUNCTION TO REMOVE TEXT BOX ELEMENT
function removeElement()
{
	if(intTextBox != 0)
	{
		var contentID = document.getElementById("content");
		contentID.removeChild(document.getElementById("strText"+intTextBox));
		intTextBox = intTextBox-1;
	}
}
//FUNCTION TO REMOVE TEXT BOX ELEMENT
</script>


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
                            Edit hotel  
                        </header>
                        <div class="panel-body">
                        	<div class="position-center">
                              
                                <form role="form" enctype="multipart/form-data" method="post" action="hotel-edit.php?hotel_id=<?=$hotel_id;?>">
								<?=$error_message;?>
								
							<div class="form-group" id="cat-subcat-list">
									<label>Category</label>
                                   <select class="form-control input-lg m-bot15 hotel_category" name="hotel_category" data-rel="1" onClick="showUser(this.value)">
										<option value="">Main Category</option>
									     <?php 
                                    $cat_options = get_hotelcat_options();
                                    if(count($cat_options) > 0 )
                                    {
                                        foreach($cat_options as $cat)
                                        {
                                            $selected = '';
                                             
                                            if($hotel_category == $cat['hotelcategory_id'])
                                            {
                                                $selected = 'selected="selected"';
                                            }
                                            echo '<option value="'.$cat['hotelcategory_id'].'" '.$selected.'>'.$cat['hotelcategory_name'].'</option>';
                                        }
                                    }	
                                    ?>
									</select>
									<p class="help-block"><?=$hotel_category_error;?></p>
                                </div>	
								
                                <div class="form-group">
                                <label>Hotel Name</label>
                               <input type="text" class="form-control"  placeholder="Enter hotel name" name="hotel_name" value="<?=$hotel_name?>">
									<p class="help-block"><?=$hotel_name_error;?> </p>
                                </div>
                               
                       
                       
                       
								<div class="form-group">
									<label>Description</label>
									<div class="col-sm-15">
										<textarea class="form-control ckeditor" rows="6" name="hotel_description"><?=$hotel_description?></textarea>
									</div>
									<p class="help-block"><?=$blog_desc_error;?></p>
								</div>
                                
                             <!--   
                                <p>
                                <label>Photos (*)</label>
                                <input type="file" maxlength="1" class="multi input-short" name="hotel_image">
								
                            </p>
				
							<p>
                                <?php  /*
								$images = explode(',',$user_image);
								for($i = 0; $i < count($images) ; $i++)
								{
								*/ ?>
									<img src="<?=hotel_THUMBURL.$hotel_image?>" width="100" height="100">
						<!--			<input type="checkbox" name="old_images[]" value="<?php echo $images[$i]; ?>" checked="checked">  
								<?php /*
						} 
							*/	?>
                            </p> -->
                               
                              
							  <div class="form-group">
                                    <label>Upload Image </label>
                                    <input type="file" class="multi" name="hotel_image[]" maxlength="5" <span class="not" style="font-size:14px; font-weight:400;"> [For Edit hotel Image First remove check box click and then Select Browse Button And Then Submit]  </span> 
									<p class="help-block"><?php echo $hotel_image_error;?></p>
									<?php 
										$images = explode(',',$hotel_image);
										for($i = 0; $i < count($images) ; $i++)
										{
										?>
											<img src="<?=HOTEL_THUMBURL.$images[$i]?>" height="100" width="100">
											<p class="help-block" style="padding-left:15px;"><input type="checkbox" name="old_images[]" value="<?php echo $images[$i]; ?>" checked="checked"> </p>
										<?php 
										}
										?>
                                </div>
								
								
                                
                              
                               <!--    <p>
                                <label>pdf (*)</label>
                                <input type="file" maxlength="3" class="multi input-short" name="hotel_file">
								
                            </p> 
							<p>
								 <p class="help-block"><?php echo $hotel_file;?></p>
                            </p>
							  
                                -->
                                
							<?php /*	  <div class="form-group">
                                    <label>Upload Pdf File</label>
                                    <input type="file" class="multi" name="hotel_file"  />
                                    <p class="help-block"></p><?php echo $hotel_file;?></p>
									<p class="help-block"><?php echo $hotel_file_error;?></p>
                                </div>  */?>
							<?php /*
							if($hotel_category == 1)
							{
							
							?>
                            
                            	<div class="form-group">
									<label>Non Pressurised Description</label>
									<div class="col-sm-15">
										<textarea class="form-control wysiwyg" rows="6" name="nonpress_description"><?=$nonpress_description?></textarea>
									</div>
									<p class="help-block"><?=$hotel_desc_error;?></p>
								</div>
                                <div class="form-group">
									<label>Pressurised Description</label>
									<div class="col-sm-15">
										<textarea class="form-control wysiwyg" rows="6" name="press_description"><?=$press_description?></textarea>
									</div>
									<p class="help-block"><?=$hotel_desc_error;?></p>
								</div>
                                
                              
                             
                             
                            <?php
							}
							else
							{
								echo "";
							}
							*/ ?> 
                            <!--
                             
                             
                               <fieldset>
                               <label><h2>Edit Feature Detail</h2></label>
								<input type="button" onClick="addElement()" value="Add"> 
                                     <input type="button" onClick="removeElement()" value="Remove">
                            </fieldset>
                           
                          
                             <fieldset> <div id="content">
                             
                            	<?php	/*	
							for($i =0; $i < count($member_details) ; $i++)
							{
								$memberoptionid = $member_details[$i]['feature_id'];
							*/	
							?>
								<div id="strText<?=$i?>">
								<div class="module" id="<?=$i?>" style="border:1px solid; padding:10px; margin-bottom:15px;">
									<h4><span>Edit Feature Details</span></h4>
									<div class="module-body">
										<p>
                                         <label> Feature For(*)</label>
										
                                        <select name="member_details[<?=$memberoptionid?>][feature_for]">
                                        <option value="0">Select</option>
                                        
                                        <option value="1" <?php /* if($member_details[$i]['feature_for'] == 1) echo 'selected="selected"'; */ ?> > Non Pressurised</option>
                                        <option value="2" <?php /* if($member_details[$i]['feature_for'] == 2) echo 'selected="selected"'; */ ?> > Pressurised</option>
                                        </select>	
                                         </p>
                                        <p>
                                         <label>Name (*)</label>
											<input class='input-short' type='text'  name='member_details[<?=$memberoptionid?>][feature_name]' value="<?php echo $member_details[$i]['feature_name']?>" />
                                        </p>
                                        <p>
                                         <label>Description(*)</label>
									<div class="col-sm-15">
										<textarea class="form-control ckeditor" rows="6" name="member_details[<?=$memberoptionid?>][feature_desc]"><?php echo $member_details[$i]['feature_desc']?></textarea>
									</div>
                                        </p>
                                            <p>
                                             <label>Image(*)</label>
                                            <input type="file" class="multi input-short" maxlength="1" name="member_image[<?=$memberoptionid?>][]"/>
                                            <BR>
                                      <img src="<?=hotel_THUMBURL.$member_details[$i]['feature_image']?>" width="100">
												   </p>
 							Want To Remove Feature ? <input type="checkbox"  name="deleteoptions[]" value="<?=$memberoptionid?>">
 							
<?php /* ?>										<input type="button" onClick="removeElement_id(<?=$i?>)" value="Remove"> <?php  */ ?>
                                            
										</p>
									</div>
								</div>
								</div>
							<?php /* 
							}
						*/	?>  
                             
                             
                             
                             
                             </div></fieldset>  
                             
                             -->
                             
                             
                             
                             
	<?php /*  ?>					<header class="panel-heading btn-primary">
							SEO Details
						</header>
						 <div class="form-group">
                                    <label>Title[Set hotel title for google search]</label>
                                    <input type="text" class="form-control" name="hotel_seo_title"  value="<?=$hotel_seo_title?>">
                          </div>
						  <div class="form-group">
									<label>Description [Enter hotel description for google search.] </label>
									<div class="col-sm-15">
										<textarea class="form-control" rows="6" name="hotel_seo_description"><?=$hotel_seo_description?></textarea>
									</div>
							</div>
							<div class="form-group">
									<label>Keywords [Enter keywords "," separated for google search.]</label>
									<div class="col-sm-15">
										<textarea class="form-control" rows="6" name="hotel_seo_keywords"><?=$hotel_seo_keywords?></textarea>
									</div>
							</div>
							<?php */ ?>
							
							
							<div class="form-group">
									<label>Status</label>
									<div class="radio">
										<label>
											<input id="optionsRadios1" type="radio" name="hotel_status" value="1" <?php if($hotel_status == 1) echo 'checked="checked"'; ?>>
											Publish
										</label>
									</div>
									<div class="radio">
										<label>
											<input id="optionsRadios1" type="radio" name="hotel_status" value="2" <?php if($hotel_status == 2) echo 'checked="checked"'; ?>>
											Draft
										</label>
									</div>
                               </div>
						  
						  
						  
                                <button type="submit" class="btn btn-info">Submit</button>
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
 
