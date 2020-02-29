<?php 

include('configure/configure.php');

include('auth.php');

$error_message = '';
$error = 0;	
if(count($_POST) > 0)
{
	
	
//	pre($_POST);
//	exit();
	if(trim($_POST['P_NAME']) == '')
	{
		$P_NAME_error = '<span class="notification-input ni-error">This field is required page.</span>';	
		$error = 1;
	}
	if(trim($_POST['P_CONTENT']) == '')
	{
		$P_CONTENT_error = '<span class="notification-input ni-error">This field is required content.</span>';	
		$error = 1;
	}
	
	
 $image_count = count($_FILES['P_IMAGE']['name']);
	
	if($error == 1)
	{
		$error_message = ' <div>
                                <span class="notification n-error">Please fillup all required information.</span>
                            </div>';
	}
	else
	{
		
		$_POST['P_IMAGE'] = '';
			for($i = 0; $i < $image_count ; $i++)
			{
				if(trim($_FILES['P_IMAGE']['name'][$i]) != '')
				{
					$_FILES['P_IMAGE_NEW']['name'] = $_FILES['P_IMAGE']['name'][$i];
					$_FILES['P_IMAGE_NEW']['tmp_name'] = $_FILES['P_IMAGE']['tmp_name'][$i];
					$_FILES['P_IMAGE_NEW']['type'] = $_FILES['P_IMAGE']['type'][$i];
					$_FILES['P_IMAGE_NEW']['error'] = $_FILES['P_IMAGE']['error'][$i];
					$_FILES['P_IMAGE_NEW']['size'] = $_FILES['P_IMAGE']['size'][$i];
					
					$image_name = upload_image($_FILES['P_IMAGE_NEW'],PAGEPATH,PAGE_THUMBPATH);
					if($image_name) 
					{
						$_POST['P_IMAGE'] .= $image_name.',';	
					}
				}
			}
	
	/*		if($_FILES['P_FILE']['name'] != '')
			{
				if($_FILES['P_FILE']['type'] == 'application/pdf')
				{
					$image_name = upload_file($_FILES['P_FILE'],PAGEPATH);
					if($image_name) 
					{
						$_POST['P_FILE'] = $image_name;	
					}
				}
				else
				{
						
					$error = 1;
				}	
				
			}	 
				
		*/
			$_POST['P_IMAGE'] = trim($_POST['P_IMAGE'],','); 
					
			$_POST['P_CREATED_DATE'] = $_POST['P_MODIFY_DATE'] = $current_date;
			
			
			$insert_id = insert_data('pages',$_POST);
			
			if($insert_id)
			{
				header('location:pages.php');
				exit;
			}
	}	

}


$styles 	 = include_styles('style.css,style-responsive.css,bootstrap.min.css,assets/jquery-ui/jquery-ui-1.10.1.custom.min.css,bootstrap-reset.css,font-awesome.css,jquery-jvectormap-1.2.2.css,css3clock/css/style.css,morris-chart/morris.css,jquery.wysiwyg.css');

$javascripts = include_js('lib/jquery.js,lib/jquery-1.8.3.min.js,bootstrap.min.js,accordion-menu/jquery.dcjqaccordion.2.7.js,scrollTo/jquery.scrollTo.min.js,nicescroll/jquery.nicescroll.js,scripts.js,gritter/gritter.js,easypiechart/jquery.easypiechart.js,sparkline/jquery.sparkline.js,flot-chart/jquery.flot.js,flot-chart/jquery.flot.tooltip.min.js,flot-chart/jquery.flot.resize.js,flot-chart/jquery.flot.pie.resize.js,jquery.wysiwyg.js');

?>

<?=DOCTYPE;?>

<?=XMLNS;?>

<head>

<?=CONTENTTYPE;?>

<title>Page Add</title>

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
		$("#page_text").keyup(function(){
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
		$("#page_keyword").keyup(function(){
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
		$("#page_description").keyup(function(){
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

                            Add Pages

                        </header>

                        <div class="panel-body">

                            <div class="position-center">

                                <form role="form" enctype="multipart/form-data" method="post">

								 <?=$error_message;?>

                                <div class="form-group">

                                    <label>Page Name (*)</label>

                                    <input type="text" class="form-control"  placeholder="Enter Page name" name="P_NAME" value="<?=$_POST['P_NAME']?>">

									<p class="help-block"><?=$P_NAME_error;?></p>

                                </div>

                               <div class="form-group">

									<label>Description</label>

									<div class="col-sm-15">

										<textarea class="form-control ckeditor" rows="6" name="P_CONTENT"><?=$_POST['P_CONTENT']?></textarea>

									</div>

								</div>
                                
                             <div class="form-group">
                                    <label>Upload Image</label>
                                    <input type="file" class="multi" name="P_IMAGE[]" maxlength="3" />
                                   
									<p class="help-block"><?php echo $news_image_error;?></p>
                                </div>    

		<!--	<header class="panel-heading btn-primary">
							SEO Details
						</header>
						 <div class="form-group">
                                    <label>Title[Set Page title for google search]<span id="counter_summary"></span></label>
                                    <input type="text" class="form-control" id="page_text" name="P_SEO_TITLE"  value="<?=$_POST['P_SEO_TITLE']?>">
                          </div>
						  <div class="form-group">
									<label>Description [Enter Page description for google search.] <span id="counter_summary3"></span> </label>
									<div class="col-sm-15">
										<textarea class="form-control" rows="6" id="page_description" name="P_SEO_DESCRIPTION"><?=$_POST['P_SEO_DESCRIPTION']?></textarea>
									</div>
							</div>
							<div class="form-group">
									<label>Keywords [Enter keywords "," separated for google search.] <span id="counter_summary1"></span></label>
									<div class="col-sm-15">
										<textarea class="form-control" rows="6" id="page_keyword" name="P_SEO_KEYWORDS"><?=$_POST['P_SEO_KEYWORDS']?></textarea>
									</div>
							</div> -->

							<div class="form-group">

								<label>Status</label>

								<div class="radio">

									<label>

										<input id="optionsRadios1" type="radio" name="P_STATUS" value="1" checked="checked" >

										Publish

									</label>

								</div>

								<div class="radio">

									<label>

										<input id="optionsRadios1" type="radio" name="P_STATUS" value="2">

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
<?php include('footer.php');?>
</body>

</html>
