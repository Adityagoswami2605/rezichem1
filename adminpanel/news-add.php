<?php 
include('configure/configure.php');
include('auth.php');

$error_message = '';
$error = 0;	
if(count($_POST) > 0)
{
//pre($_POST);
//exit;
	$image_count = count($_FILES['news_image']['name']);
	if($image_count <= 0 || $_FILES['news_image']['name'][0] == '')
	{
		$news_image_error = '<span class="notification-input ni-error">This field is required.</span>';	
		$error = 1;
	}
	
/*	$image_count1 = count($_FILES['news_image1']['name']);
	if($image_count1 <= 0 || $_FILES['news_image1']['name'][0] == '')
	{
		$news_image1_error = '<span class="notification-input ni-error">This field is required.</span>';	
		$error = 1;
	}
	*/
	/*
	if(count($_POST['set_options']) > 0)
	{
		
		$memberoption_name = array();
		$memberoption_name = $_POST['set_options'];
		$set_options_loop   = $_FILES['set_options'];
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
		
		$_POST['news_image'] = '';
			for($i = 0; $i < $image_count ; $i++)
			{
				if(trim($_FILES['news_image']['name'][$i]) != '')
				{
					$_FILES['news_image_new']['name'] = $_FILES['news_image']['name'][$i];
					$_FILES['news_image_new']['tmp_name'] = $_FILES['news_image']['tmp_name'][$i];
					$_FILES['news_image_new']['type'] = $_FILES['news_image']['type'][$i];
					$_FILES['news_image_new']['error'] = $_FILES['news_image']['error'][$i];
					$_FILES['news_image_new']['size'] = $_FILES['news_image']['size'][$i];
					
					$image_name = upload_image($_FILES['news_image_new'],NEWSPATH,NEWS_THUMBPATH);
					if($image_name) 
					{
						$_POST['news_image'] .= $image_name.',';	
					}
				}
			}
		$_POST['news_image'] = trim($_POST['news_image'],','); 
	

		if($error != 1)
			{	
		$_POST['news_created_date'] = $current_date;
//pre($_POST);			
//exit;

			$insert_id = insert_data('news',$_POST);
		//exit;	
			if($insert_id)
			{
				header('location:news.php');
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
<title>Updates Add</title>
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
					  
					  /*var cat_parent1 = $('.RESUME_CATEGORY_1').val(); 
					  $.post(ajax_category_url,{cat_parent:cat_parent1,level:1}, function(data) {
							  if(data != '')
								  $('.RESUME_CATEGORY_2').html(data);
					  });	  */
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
	newTBDiv.innerHTML = "<div class='module' style='border:1px solid; padding:10px;' id='" + intTextBox + "'><h4><span>Add Feature</span></h4><div class='module-body'><p><label>Features For (*)</label><select name='set_options[" + intTextBox + "][feature_for]'><option value='0'>Select</option><option value='1'>Non Pressurised </option><option value='2'>Pressurised </option></select><p><label>Name (*)</label><input class='input-short' size='30' type='text'  name='set_options[" + intTextBox + "][name]' /></p><p><label>Description(*)</label><textarea rows='7' cols='90' class='form-control ckeditor' name='set_options[" + intTextBox + "][desc]'>  </textarea></p><p ><label>Image (*)</label><input class='input-short' type='file'  name='set_options[" + intTextBox + "][member_image]' /></p></div></div>";
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
 <script>
function showUser(str) {
  if (str=="") {

	document.getElementById("txtHint").innerHTML="";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
	
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
  
 
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
  
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","getuser1.php?n="+str,true);
  xmlhttp.send();
}
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
                            Add Updates
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" enctype="multipart/form-data" method="post" action="news-add.php">
								<?=$error_message;?>
                                <div class="form-group">
                                    <label>Update Date</label>
                                    <input type="text" id="datepicker" class="form-control"  placeholder="Enter News Date" name="news_date" value="<?=$_POST['news_date']?>">
									
                                </div>
                                <div class="form-group">
                                    <label>Updates Name</label>
                                    <input type="text" class="form-control"  placeholder="Enter news name" name="news_name" value="<?=$_POST['news_name']?>">
									<p class="help-block"><?=$news_name_error;?></p>
                                </div>
                          <!--    <div class="form-group" id="cat-subcat-list">
									<label>Category</label>
                                   <select class="form-control input-lg m-bot15 news_category" name="news_category" data-rel="1"  onClick="showUser(this.value)">
										<option value="0">Main Category</option>
										<?php 
										/*
										$category_options = get_cat_options();
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
										}	
										*/ ?>
									</select>
									<p class="help-block"><?=$news_category_error;?></p>
                                </div> -->
                              <!--   <div class="form-group" id="cat-subcat-list">
									<label>Sub Category</label>
                                   <select class="form-control input-lg m-bot15 news_category_0" name="news_category_0" data-rel="1">
										   <option value="0">Select</option>
										
									</select>
									<p class="help-block"><?=$news_category_0_error;?></p>
                                </div>
                              -->
								<div class="form-group">
									<label>Description</label>
									<div class="col-sm-15">
									<textarea class="form-control wysiwyg" rows="6" name="news_content"><?=$_POST['news_content']?></textarea>
									</div>
									<p class="help-block"><?=$news_desc_error;?></p>
								</div>
                               <div class="form-group">
                                    <label>Upload Image</label>
                                    <input type="file" class="multi" name="news_image[]" maxlength="1" />
                                   
									<p class="help-block"><?php echo $news_image_error;?></p>
                                </div>  
                                
                             <!--    <div class="form-group">
                                    <label>Upload Sub news Image</label>
                                    <input type="file" class="multi" name="news_image1[]" maxlength="5" />
                                    <p class="help-block"></p>
									<p class="help-block"><?php echo $news_image_error;?></p>
                                </div>
                                -->
                           <!--   <div class="form-group">
                                    <label>Upload Pdf File</label>
                                    <input type="file" class="input-short" name="news_file"/>
                                 
									<p class="help-block"><?php /* echo $news_file_error; */ ?></p>
                                </div>  -->
					<!--  <div id="txtHint"></div> -->
                       <!--
                      
                        <fieldset>
                               <label>Add Feature Detail</label>
									<input type="button" onClick="addElement()" value="Add"> 
                                     <input type="button" onClick="removeElement()" value="Remove">
                            </fieldset>
                           
                         
                             <fieldset> <div id="content"></div></fieldset>  
                                 --> 
			<?php /*  ?>			<header class="panel-heading btn-primary">
							SEO Details
						</header>
						 <div class="form-group">
                                    <label>Title[Set news title for google search]</label>
                                    <input type="text" class="form-control" name="news_seo_title"  value="<?=$_POST['news_seo_title']?>">
                          </div>
						  <div class="form-group">
									<label>Description [Enter news description for google search.] </label>
									<div class="col-sm-15">
										<textarea class="form-control" rows="6" name="news_seo_description"><?=$_POST['news_seo_description']?></textarea>
									</div>
							</div>
							<div class="form-group">
									<label>Keywords [Enter keywords "," separated for google search.]</label>
									<div class="col-sm-15">
										<textarea class="form-control" rows="6" name="news_seo_keywords"><?=$_POST['news_seo_keywords']?></textarea>
									</div>
							</div>   <?php  */ ?>
							<div class="form-group">
									<label>Status</label>
									<div class="radio">
										<label>
											<input id="optionsRadios1" type="radio" name="news_status" value="1" checked="checked" >
											Publish
										</label>
									</div>
									<div class="radio">
										<label>
											<input id="optionsRadios1" type="radio" name="news_status" value="2">
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
