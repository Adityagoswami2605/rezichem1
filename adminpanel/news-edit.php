<?php 
include('configure/configure.php');
include('auth.php');
$news_id = $_REQUEST['news_id'];
if($news_id != '' && is_numeric($news_id))
{
/*
pre($_POST);
exit;
*/
	$news_detail = get_news_detail($news_id);
	
	$news_name 				= $news_detail['news_name'];
	$news_date 				= $news_detail['news_date'];
	//$news_price 				= $news_detail['news_price'];
	//$news_category			= $news_detail['news_category'];
	//$news_title			    = $news_detail['news_title'];
	//$news_category_0			= $news_detail['news_category_0'];
	//$news_category_1			= $news_detail['news_category_1'];
	$news_image				= $news_detail['news_image'];
	//$news_image1				= $news_detail['news_image1'];
	//$news_brief 				= $news_detail['news_brief'];
	$news_description 			= $news_detail['news_content'];
	//$news_video 				= $news_detail['news_video'];
	//$news_file 				= $news_detail['news_file'];
	$news_status 			= $news_detail['news_status'];
	//$news_featured 			= $news_detail['news_featured'];
	//$nonpress_description 			= $news_detail['nonpress_description'];
	//$press_description 			= $news_detail['press_description'];
	
	
	//$member_details 			= get_feature_detail($news_id);
//	pre($member_details);
}
else
{
	header('location:news.php');
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
		
		$image_arr = explode(',',$news_image);
			
			for($i = 0;$i<count($image_arr) ; $i++)
			{
				$org_image = $image_arr[$i];
				if(!in_array($org_image,$_POST['old_images']))
				{
					if(file_exists(NEWSPATH.$org_image))
					{
						unlink(NEWSPATH.$org_image);
						if(file_exists(NEWS_THUMBPATH.$org_image))
						{
							unlink(NEWS_THUMBPATH.$org_image);
						}
					}	
				}
				else
				{
					$new_arr[] = $org_image;
				}
			}
			 
			$_POST['news_image'] = implode(',',$new_arr);
			$_POST['news_image'] = $_POST['news_image'].',';
			
			$image_count = count($_FILES['news_image']['name']);
			for($i = 0; $i< $image_count ; $i++)
			{
				if(trim($_FILES['news_image']['name'][$i]) != '')
				{
					$_FILES['NEWS_IMAGES_NEW']['name'] = $_FILES['news_image']['name'][$i];
					$_FILES['NEWS_IMAGES_NEW']['tmp_name'] = $_FILES['news_image']['tmp_name'][$i];
					$_FILES['NEWS_IMAGES_NEW']['type'] = $_FILES['news_image']['type'][$i];
					$_FILES['NEWS_IMAGES_NEW']['error'] = $_FILES['news_image']['error'][$i];
					$_FILES['NEWS_IMAGES_NEW']['size'] = $_FILES['news_image']['size'][$i];
					
					$image_name = upload_image($_FILES['NEWS_IMAGES_NEW'],NEWSPATH,NEWS_THUMBPATH);
					if($image_name) 
					{
						$_POST['news_image'] .= $image_name.',';	
					}
				}
			}
			
			$_POST['news_image'] = trim($_POST['news_image'],','); 
			unset($_POST['old_images']);
			
			
					$_POST['news_created_date'] = $current_date;
					$update_id = update_data('news',$_POST,'news_id ='.$news_id);
//exit;			
			header('location:news.php');
					exit;
			}
			//pre($_POST);
		//	$update_id = update_data('newss',$_POST,'news_id='.$news_id);
		//	header('location:newss.php');
		//	exit;
	}

 
$styles 	 = include_styles('style.css,style-responsive.css,bootstrap.min.css,assets/jquery-ui/jquery-ui-1.10.1.custom.min.css,bootstrap-reset.css,font-awesome.css,jquery-jvectormap-1.2.2.css,css3clock/css/style.css,morris-chart/morris.css,DT_bootstrap.css,demo_page.css,demo_table.css,jquery.wysiwyg.css');
$javascripts = include_js('lib/jquery.js,lib/jquery-1.8.3.min.js,bootstrap.min.js,accordion-menu/jquery.dcjqaccordion.2.7.js,scrollTo/jquery.scrollTo.min.js,nicescroll/jquery.nicescroll.js,scripts.js,gritter/gritter.js,jquery.MultiFile.js,jquery.wysiwyg.js');
?>
<?=DOCTYPE;?>
<?=XMLNS;?>
<head>
<?=CONTENTTYPE;?>
<title>News Edit</title>
<?=$styles?>
	
<script src="//code.jquery.com/jquery-1.10.2.js"></script>	
	 
	
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
		<?php if($_POST['news_shipping'] == 0) { ?>
			$(".shipping_class").hide();
		<?php } ?>
		$("[name=news_shipping]").change(function(){
			$(".shipping_class").toggle();
		});
		
});
</script>
<script language="javascript" type="text/javascript">
$(document).ready(function(){
		var ajax_category_url = 'ajax-category-dropdown.php';
		$('.news_category').change(function(){
				
				var cat_parent = $(this).val(); 
				$.post(ajax_category_url,{cat_parent:cat_parent,level:0}, function(data) {
					  if(data != '')
						  $('.news_category_0').html(data);

					  $('.news_category_0').trigger('change');
				});
		});
		$('.news_category_0').change(function(){
				
				var cat_parent = $(this).val(); 
				$.post(ajax_category_url,{cat_parent:cat_parent,level:1}, function(data) {
					  if(data != '')
						  $('.news_category_1').html(data);
				});
		});
		
		
		var characters = 100;
		$("#counter_summary").append("You have <strong>"+  characters+"</strong> characters remaining");
		$("#news_brief").keyup(function(){
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script>
$(function() {
$( "#datepicker" ).datepicker();
});
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
                            Edit News  
                        </header>
                        <div class="panel-body">
                        	<div class="position-center">
                              
                                <form role="form" enctype="multipart/form-data" method="post" action="news-edit.php?news_id=<?=$news_id;?>">
								<?=$error_message;?>
                           <div class="form-group">
                           <label>News Date</label>
                           <input type="text" id="datepicker" class="form-control"  placeholder="Enter news Date" name="news_date" value="<?=$news_date?>">
								
                                </div>
                                <div class="form-group">
                                <label>News Name</label>
                               <input type="text" class="form-control"  placeholder="Enter news name" name="news_name" value="<?=$news_name?>">
									<p class="help-block"><?=$news_name_error;?> </p>
                                </div>
                               
                          <!--    <div class="form-group" id="cat-subcat-list">
									<label>Category</label>
                                   <select class="form-control input-lg m-bot15 news_category" name="news_category" data-rel="1" onClick="showUser(this.value)">
										<option value="0">Main Category</option>
									     <?php 
										 /*
                                    $cat_options = get_news_cat_options(0);
                                    if(count($cat_options) > 0 )
                                    {
                                        foreach($cat_options as $cat)
                                        {
                                            $selected = '';
                                             
                                            if($news_category == $cat['category_id'])
                                            {
                                                $selected = 'selected="selected"';
                                            }
                                            echo '<option value="'.$cat['category_id'].'" '.$selected.'>'.$cat['category_name'].'</option>';
                                        }
                                    }	
                                    */ ?>
									</select>
									<p class="help-block"><?=$news_category_error;?></p>
                                </div> -->
								<!--
                                  <div class="form-group" id="cat-subcat-list">
									<label>Sub Category</label>
                                   <select class="form-control input-lg m-bot15 news_category_0" name="news_category_0" data-rel="1">
										   <option value="0">Select</option>
									         <?php /*
									$cat_options = get_news_cat_options($news_category);
									if(count($cat_options) > 0 )
									{
										foreach($cat_options as $cat)
										{
											$selected = '';
											 
											if($news_category_0 == $cat['category_id'])
											{
												$selected = 'selected="selected"';
											}
											echo '<option value="'.$cat['category_id'].'" '.$selected.'>'.$cat['category_name'].'</option>';
										}
									}	
									*/ ?>	
									</select>
									<p class="help-block"><?=$news_category_0_error;?></p>
                                </div>
                              	-->
								<div class="form-group">
									<label>Description</label>
									<div class="col-sm-15">
										<textarea class="form-control wysiwyg" rows="6" name="news_content"><?=$news_description?></textarea>
									</div>
									<p class="help-block"><?=$news_desc_error;?></p>
								</div>
                                
                             
                         
                             
							  <div class="form-group">
                                    <label>Upload Image </label>
                                    <input type="file" class="multi" name="news_image[]" maxlength="5" />
									<p class="help-block"><?php echo $news_image_error;?></p>
									<?php  
										$images = explode(',',$news_image);
										for($i = 0; $i < count($images) ; $i++)
										{
										?>
											<img src="<?=NEWS_THUMBURL.$images[$i]?>" height="100" width="100">
											<p class="help-block" style="padding-left:15px;"><input type="checkbox" name="old_images[]" value="<?php echo $images[$i]; ?>" checked="checked"> </p>
										<?php 
										}
										 ?>
                                </div>
							
                            
                             
                             
                             
	<?php /*  ?>					<header class="panel-heading btn-primary">
							SEO Details
						</header>
						 <div class="form-group">
                                    <label>Title[Set news title for google search]</label>
                                    <input type="text" class="form-control" name="news_seo_title"  value="<?=$news_seo_title?>">
                          </div>
						  <div class="form-group">
									<label>Description [Enter news description for google search.] </label>
									<div class="col-sm-15">
										<textarea class="form-control" rows="6" name="news_seo_description"><?=$news_seo_description?></textarea>
									</div>
							</div>
							<div class="form-group">
									<label>Keywords [Enter keywords "," separated for google search.]</label>
									<div class="col-sm-15">
										<textarea class="form-control" rows="6" name="news_seo_keywords"><?=$news_seo_keywords?></textarea>
									</div>
							</div>
							<?php */ ?>
							
							
							<div class="form-group">
									<label>Status</label>
									<div class="radio">
										<label>
											<input id="optionsRadios1" type="radio" name="news_status" value="1" <?php if($news_status == 1) echo 'checked="checked"'; ?>>
											Publish
										</label>
									</div>
									<div class="radio">
										<label>
											<input id="optionsRadios1" type="radio" name="news_status" value="2" <?php if($news_status == 2) echo 'checked="checked"'; ?>>
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
 
