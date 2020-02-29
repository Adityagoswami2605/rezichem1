<?php 

include('configure/configure.php');



if($_POST['action_type'] != '')

{

	switch($_POST['action_module'])	

	{

		case 'pages': 

					 $update_arr['P_STATUS'] = $_POST['action_type'];

					 $condition = 'P_ID in ('.$_POST['actions_ids'].')';

					 update_data($_POST['action_module'],$update_arr,$condition);

					 break;

		case 'banner': 

					 $update_arr['banner_status'] = $_POST['action_type'];

					 $condition = 'banner_id in ('.$_POST['actions_ids'].')';

					 update_data($_POST['action_module'],$update_arr,$condition);

					 break;
					 
	
			case 'packagecategory': 

					 $update_arr['packagecategory_status'] = $_POST['action_type'];

					 $condition = 'packagecategory_id in ('.$_POST['actions_ids'].')';

					 update_data($_POST['action_module'],$update_arr,$condition);

					 break;			 
		case 'package': 

					 $update_arr['package_status'] = $_POST['action_type'];

					 $condition = 'package_id in ('.$_POST['actions_ids'].')';

					 update_data($_POST['action_module'],$update_arr,$condition);

					 break;			 
					 
			case 'airport': 

					 $update_arr['airport_status'] = $_POST['action_type'];

					 $condition = 'airport_id in ('.$_POST['actions_ids'].')';

					 update_data($_POST['action_module'],$update_arr,$condition);

					 break;		
		
		
			case 'hotelcategory': 

					 $update_arr['hotelcategory_status'] = $_POST['action_type'];

					 $condition = 'hotelcategory_id in ('.$_POST['actions_ids'].')';

					 update_data($_POST['action_module'],$update_arr,$condition);

					 break;			 
		case 'hotels': 

					 $update_arr['hotel_status'] = $_POST['action_type'];

					 $condition = 'hotel_id in ('.$_POST['actions_ids'].')';

					 update_data($_POST['action_module'],$update_arr,$condition);

					 break;	
		
					 		
				case 'certificate': 

					 $update_arr['certificate_status'] = $_POST['action_type'];

					 $condition = 'certificate_id in ('.$_POST['actions_ids'].')';

					 update_data($_POST['action_module'],$update_arr,$condition);

					 break;				 
		
		case 'category': 

					 $update_arr['category_status'] = $_POST['action_type'];

					 $condition = 'category_id in ('.$_POST['actions_ids'].')';
					 
					 


					 update_data($_POST['action_module'],$update_arr,$condition);

					 break;
		case 'products': 

					 $update_arr['product_status'] = $_POST['action_type'];

					 $condition = 'product_id in ('.$_POST['actions_ids'].')';

					 update_data($_POST['action_module'],$update_arr,$condition);

					 break;
		

		case 'gallery': 

					 $update_arr['gallery_status'] = $_POST['action_type'];

					 $condition = 'gallery_id in ('.$_POST['actions_ids'].')';

					 update_data($_POST['action_module'],$update_arr,$condition);

					 break;
		
		case 'clients': 

					 $update_arr['clients_status'] = $_POST['action_type'];

					 $condition = 'clients_id in ('.$_POST['actions_ids'].')';

					 update_data($_POST['action_module'],$update_arr,$condition);

					 break;

		case 'event': 

					 $update_arr['event_status'] = $_POST['action_type'];

					 $condition = 'event_id in ('.$_POST['actions_ids'].')';

					 update_data($_POST['action_module'],$update_arr,$condition);

					 break;
		case 'news': 

					 $update_arr['news_status'] = $_POST['action_type'];

					 $condition = 'news_id in ('.$_POST['actions_ids'].')';

					 update_data($_POST['action_module'],$update_arr,$condition);

					 break;
		case 'services': 

					 $update_arr['service_status'] = $_POST['action_type'];

					 $condition = 'service_id in ('.$_POST['actions_ids'].')';

					 update_data($_POST['action_module'],$update_arr,$condition);

					 break;
		case 'weekend': 

					 $update_arr['W_STATUS'] = $_POST['action_type'];

					 $condition = 'W_ID in ('.$_POST['actions_ids'].')';

					 update_data($_POST['action_module'],$update_arr,$condition);

					 break;
		case 'users': 

					 $update_arr['user_status'] = $_POST['action_type'];

					 $condition = 'user_id in ('.$_POST['actions_ids'].')';

					 update_data($_POST['action_module'],$update_arr,$condition);

					 break;

		case 'portfolio': 

					 $update_arr['portfolio_status'] = $_POST['action_type'];

					 $condition = 'portfolio_id in ('.$_POST['actions_ids'].')';

					 update_data($_POST['action_module'],$update_arr,$condition);

					 break;			 
					 
		case 'industrial': 

					 $update_arr['industrial_status'] = $_POST['action_type'];

					 $condition = 'industrial_id in ('.$_POST['actions_ids'].')';

					 update_data($_POST['action_module'],$update_arr,$condition);

					 break;

			case 'blogreply':
		 
					 $update_arr['reply_status'] = $_POST['action_type'];
					  $update_arr['reply_approve'] = $_POST['action_type'];
					 
					 $condition = 'reply_id in ('.$_POST['actions_ids'].')';
					 
					 update_data($_POST['action_module'],$update_arr,$condition);
					 break;	

		case 'complain': 

					 $update_arr['complain_status'] = $_POST['action_type'];

					 $condition = 'complain_id in ('.$_POST['actions_ids'].')';

					 update_data($_POST['action_module'],$update_arr,$condition);

					 break;			 				 			 



		case 'updates': 

					 $update_arr['updates_status'] = $_POST['action_type'];

					 $condition = 'updates_id in ('.$_POST['actions_ids'].')';

					 update_data($_POST['action_module'],$update_arr,$condition);

					 break;
									

	}

}

?>