<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class User extends MY_Controller {

		public function __construct() {
			parent::__construct();
		}

		public function index() {
			if (!$this->session->has_userdata('uid')) {
		        redirect('site/');
		    	}
		    $this->update_timesheet();	
			}

		public function update_timesheet() {
			if (!$this->session->has_userdata('uid')) {
		        redirect('site/');
		    }
		    $uid = $this->session->userdata('uid');


		    $this->load->model('Project');
		    if ($this->session->userdata('user_type') == 0) {
		    	$data['project_list'] = $this->Project->get_project_list(0,'select');
		    	}
		    else{
			    $data['project_list'] = $this->Project->get_project_list($uid,'select');
		    	}
		    $this->load->model('Timesheet');
		    $data['my_sheet'] = $this->Timesheet->get_all_by_uid($uid);

		    $data['title'] = "Welcome to Proactive by Stractive";

		    $data['content'] = "pages/update_timesheet";
		    $data['local'] =  "pages/update_timesheet_local";

				$this->load->view($this->layout, $data);
		}

		public function update_work()
		{
			$success = 0;
			
			$this->load->model('Timesheet');

			//load the dates in variables and remove from posted array
			$Sunday = $_POST['Sunday'];		unset($_POST['Sunday']);
			$Monday = $_POST['Monday'];		unset($_POST['Monday']);
			$Tuesday = $_POST['Tuesday'];		unset($_POST['Tuesday']);
			$Wednesday = $_POST['Wednesday'];		unset($_POST['Wednesday']);
			$Thursday = $_POST['Thursday'];		unset($_POST['Thursday']);
			$Friday = $_POST['Friday'];		unset($_POST['Friday']);
			$Saturday = $_POST['Saturday'];		unset($_POST['Saturday']);

			// for each row in UI, load the hours in respective date variable if project is not null 
			for ($i=0; $i < count($_POST)/9; $i++) { 
				$inp = $i + 1;
			if (!empty($_POST['project'.$inp])) {

			$inputRow[$Sunday] = $_POST['hourSunday'.$inp];
			$inputRow[$Monday] = $_POST['hourMonday'.$inp];
			$inputRow[$Tuesday] = $_POST['hourTuesday'.$inp];
			$inputRow[$Wednesday] = $_POST['hourWednesday'.$inp];
			$inputRow[$Thursday] = $_POST['hourThursday'.$inp];
			$inputRow[$Friday] = $_POST['hourFriday'.$inp];
			$inputRow[$Saturday] = $_POST['hourSaturday'.$inp];
			//for each column in current UI row, add a SQL row
				foreach ($inputRow as $currentDay => $workDone) {
					// if ($workDone != 0) {
					$this->Timesheet->tm_resid = $this->session->userdata('uid');
					$this->Timesheet->tm_proid = $_POST['project'.$inp];
					$this->Timesheet->tm_approved = '0';
					$this->Timesheet->tm_description = $_POST['description'.$inp];
					$this->Timesheet->tm_date_modified = date('Y-m-d H:i:s');

					$date = new DateTime($Wednesday);
					$this->Timesheet->tm_week = $date->format("Y").$date->format("W");

					$date = new DateTime($currentDay);
					$this->Timesheet->tm_day = $date->format("l");
					$this->Timesheet->tm_date = $date->format("Y-m-d");
					$this->Timesheet->tm_hours = $workDone;
					$this->Timesheet->tm_approved = '0';
					$this->Timesheet->tm_approval_by = '0';

					$old_row = $this->Timesheet->isWorkExists(); // returns empty for new entry

					if ((count($old_row) > 0)) {
						$this->Timesheet->tm_id = $old_row[0]['tm_id'];
						$this->Timesheet->tm_date_created = $old_row[0]['tm_date_created'];
						// if($old_row[0]['tm_description'] == $_POST['description'.$inp] &&  )
						// 	$this->Timesheet->tm_description = $_POST['description'.$inp];
						// else{
						// 	$this->Timesheet->tm_description = $old_row[0]['tm_description']." ".$_POST['description'.$inp];
						// 	$this->Timesheet->tm_hours += $old_row[0]['tm_hours'];

						// }

					}
					else
						{
							$this->Timesheet->tm_date_created = date('Y-m-d H:i:s');
							unset($this->Timesheet->tm_id);
						}

						if($this->Timesheet->save()) {
							$success++;
							$this->Timesheet->blank_history();
						 unset($this->Timesheet->tm_id);}
					// echo " ".$this->Timesheet->tm_date." ".$workDone;
					// }
				}

			}
			
			} // end of for
			$this->Timesheet->clean_entries();
		 	echo $success; // return count of insertion		
		}

		public function approve_timesheet($current_id = 0, $search = "") {
			if (!$this->session->has_userdata('uid')) {
		        redirect('site/');
		    }
		    $uid = $this->session->userdata('uid');
		    $data['search'] = "";
		    $this->load->model('Project');
		    $this->load->model('Timesheet');

		    if ($current_id > 0 && $search == "Approved") {
		    	$this->Timesheet->tm_proid = $current_id;
		    	$this->Timesheet->tm_approved = '1';

		    	$pro_data = $this->Project->get_one($current_id);
		    	// die(var_dump($pro_data));
		    	$data['pname'] = $pro_data[0]['pro_title'];
		    	$data['pclient'] = $pro_data[0]['pro_client'];
		    	$data['click_pid'] = $current_id;
		    	$data['search'] = str_replace('_', ' ', $search);
		    	$data['cond_data'] = $this->Timesheet->getFilteredEntries();
		    	$data['content'] = "pages/conditional_timesheet";
				$data['local'] = "pages/conditional_timesheet_local";
		    }
		    else{
		    	$data['click_pid'] = 0;
		    	$data['content'] = "pages/approve_timesheet";
				$data['local'] = "pages/approve_timesheet_local";
			    }

		    if ($this->session->userdata('user_type') == 0) {
			    $data['my_projects'] = $this->Project->get_projects_by_uid(0);
				}
			else {
			    $data['my_projects'] = $this->Project->get_projects_by_uid($uid);
				}	
		    $data['title'] = "Welcome to Proactive by Stractive";

		    
			    
				
				$this->load->view($this->layout, $data);
		}
		public function view_timesheet($search = "") {
			if (!$this->session->has_userdata('uid')) {
		        redirect('site/');
		    }
		    $uid = $this->session->userdata('uid');
		    if ($search != '') {
		    	$data['search'] = str_replace('_', ' ', $search);
		    }

		    $this->load->model('Project');
		    if ($this->session->userdata('user_type') == 0) {
			    $data['my_projects'] = $this->Project->get_projects_by_uid(0);
				}
			else {
			    $data['my_projects'] = $this->Project->get_projects_by_uid($uid);
				}	
		    $data['title'] = "Welcome to Proactive by Stractive";

		    $data['content'] = "pages/view_timesheet";
			$data['local'] = "pages/view_timesheet_local";
	
				$this->load->view($this->layout, $data);
		}


		public function profile() {
				if (!$this->session->has_userdata('uid')) {
		        redirect('site/');
		    }

		    $data['title'] = "Welcome ".$this->session->userdata('fullname')." - Manage your profile - Proactive by Stractive";

		    $data['content'] = "pages/user_profile";

			$this->load->view($this->layout, $data);
		}

		public function change_password() {
			if ($this->input->post("newPass") == $this->input->post("confirm") && $this->input->post("newPass") != "") {
				$this->load->model('Resource');
				$status = $this->Resource->update_password($this->session->userdata("uid"), md5($this->input->post("newPass")));

				if ($status) {
					$this->session->set_userdata("password","Changed");
					redirect('site/sign_out');
				} 
				else {
				$data['title'] = "Password Updation Failed - Stractive Proactive";
				$data['error_status'] = 0;
				$data['content'] = 'pages/password_message';
				$this->load->view($this->layout, $data);
				}
			}
			else{
					redirect('site/sign_out');
			}
		}

		public function update_profile_data() {
			$this->load->model('Usermodel');

			$status = $this->Usermodel->update_profile_id($this->input->post('uid'), $this->input->post('col_name'), $this->input->post('col_value'));

			if ($status) {
				echo 1;
			} else {
				echo 0;
			}
		}

		public function describe_project()
		{
			$uid = $this->input->post('uid');
			if($this->input->post('approve')) $approve = $this->input->post('approve');
			else $approve = 0;
			if ($this->session->userdata('user_type') == 0) {
				$uid = 0;
			}
			$pid = $this->input->post('pid');
			
			$this->load->model('Resource');
			$all_res = array("0"=>"");
			$raw_res = $this->Resource->get_resource_list("raw");
			foreach ($raw_res as $r) {
				$e_name = substr($r['res_name']." ",0, strpos($r['res_name']." ", " "));
				$all_res[$r['res_id']] = $e_name;
			}
			$this->load->model('Timesheet');

			if ($this->input->post('week')) {
				$week = $this->input->post('week');
				$approval_list = $this->Timesheet->get_project_history_in_week($uid,$pid,$week,$approve);
				foreach ($approval_list as $indx => $row) {
					if(isset($row['tm_approval_by']))
					$approval_list[$indx]['tm_approval_by'] = $all_res[$row['tm_approval_by']];
				}
				echo json_encode($approval_list);
			}
			else
				$this->Timesheet->get_project_history_with_week($uid,$pid,$approve); 
		}

		public function approve_entry()
		{
			$this->load->model('Resource');
			$all_res = array("0"=>"");
			$raw_res = $this->Resource->get_resource_list("raw");
			foreach ($raw_res as $r) {
				$e_name = substr($r['res_name']." ",0, strpos($r['res_name']." ", " "));
				$all_res[$r['res_id']] = $e_name;
			}

			$this->load->model('Timesheet');
			$uid = $this->session->userdata('uid');
			$flag = $this->input->post('flag'); 
			$eid = $this->input->post('eid');
			$pid = $this->input->post('pid');
			$week = $this->input->post('week');
			$reason = $this->input->post('reason');

			$this->Timesheet->approve_entry($eid, $flag, $reason);
			$approval_list = $this->Timesheet->get_project_history_in_week($uid,$pid,$week,1);
				foreach ($approval_list as $indx => $row) {
					if(isset($row['tm_approval_by']))
					$approval_list[$indx]['tm_approval_by'] = $all_res[$row['tm_approval_by']];
				}
				echo json_encode($approval_list);
		}

		public function approve_expenses()
		{

			$this->load->model('Expenses');
			$flag = $this->input->post('flag'); 
			$eid = $this->input->post('eid');
			$reason = $this->input->post('reason');

			$this->Expenses->approve_entry($eid, $flag, $reason);
			// $approval_list = $this->Timesheet->get_project_history_in_week($uid,$pid,$week,1);
				// foreach ($approval_list as $indx => $row) {
					// if(isset($row['tm_approval_by']))
					// $approval_list[$indx]['tm_approval_by'] = $all_res[$row['tm_approval_by']];
				// }
				// echo json_encode($approval_list);
		}
		

		public function insert_expenses()
		{
			$success = 0;

			$this->load->model('Project');
		    if ($this->session->userdata('user_type') == 0) {
		    	$data['project_list'] = $this->Project->get_project_list(0,'select');
		    	}
		    else{
			    $data['project_list'] = $this->Project->get_project_list($this->session->userdata('uid'),'select');
		    	}
			
			$this->load->model('Expenses');

			// for each row in UI
			// for ($i=0; $i < count($_POST)/7; $i++) {
			$i = 0;
			while ($i < $_POST['lastid']) { // while loop and lastid added to cope up with random ids
				$inp = $i + 1;
			if (isset($_POST['amount'.$inp]) && !empty($_POST['amount'.$inp]) && isset($_POST['project'.$inp]) && !empty($_POST['project'.$inp]) )  {
				
			$inputRow[$i]["title"] = $_POST['title'.$inp];
			$inputRow[$i]["head"] = $_POST['head'.$inp];
			$inputRow[$i]["amount"] = $_POST['amount'.$inp];
			$inputRow[$i]["frequency"] = $_POST['frequency'.$inp];
			$inputRow[$i]["project"] = $_POST['project'.$inp];
			$inputRow[$i]["resource"] = isset($_POST['resource'.$inp])? $_POST['resource'.$inp] : $this->session->userdata('uid');
			$inputRow[$i]["date"] = $_POST['date'.$inp];

			//for each column in current UI row, add a SQL row
				foreach ($inputRow as $index => $currentRow) {
					if ($currentRow["amount"] > 0) {
					$this->Expenses->ex_resid = $currentRow['resource'];
					$this->Expenses->ex_proid = $currentRow['project'];
					$this->Expenses->ex_title = $currentRow['title'];
					$this->Expenses->ex_head = $currentRow['head'];
					$this->Expenses->ex_frequency = $currentRow['frequency'];
					// $this->Expenses->ex_approved = '0';
					$this->Expenses->ex_description = "NA";
					$this->Expenses->ex_date_modified = date('Y-m-d H:i:s');
					$dtarr = explode("-", $currentRow['date']);	
					$this->Expenses->ex_date = implode("-", array_reverse($dtarr));
					$this->Expenses->ex_amount = $currentRow['amount'];

					$old_row = $this->Expenses->isWorkExists(); // returns empty for new entry
					// die(va);
					if ((count($old_row) > 0)) {
						$this->Expenses->ex_id = $old_row[0]['ex_id'];
						$this->Expenses->ex_date_created = $old_row[0]['ex_date_created'];
						// $this->Expenses->tm_approved = '0';
						// $this->Expenses->
					}
					else
						{
							$this->Expenses->ex_date_created = date('Y-m-d H:i:s');
							unset($this->Expenses->ex_id);
						}

					
						if($this->Expenses->save()) {$success++; unset($this->Expenses->ex_id);}
					// echo " ".$this->Expenses->tm_date." ".$workDone;
					}
				}

			}
			$i++;
			} // end of for

		 	echo $success; // return count of insertion		
		}

		public function insert_invoices()
		{
			$success = 0;

			$this->load->model('Expenses');
			// die(var_dump($_POST));
			// for each row in UI, load the hours in respective date variable if project is not null 
			for ($i=0; $i < count($_POST)/4; $i++) { 
				$inp = $i + 1;
			if (!empty($_POST['amount'.$inp]) && $_POST['project'.$inp] != "") {
				
			$inputRow[$i]["date"] = $_POST['date'.$inp];
			$inputRow[$i]["project"] = $_POST['project'.$inp];
			$inputRow[$i]["amount"] = $_POST['amount'.$inp];
			$inputRow[$i]["description"] = $_POST['description'.$inp];

			//for each column in current UI row, add a SQL row
				foreach ($inputRow as $index => $currentRow) {
					if ($currentRow["amount"] > 0) {
					$this->Expenses->ex_proid = $currentRow['project'];
					$this->Expenses->ex_amount = $currentRow['amount'];
					$this->Expenses->ex_description = $currentRow['description'];
					$this->Expenses->ex_resid = 0;
					$this->Expenses->ex_approved = 1;
					$this->Expenses->ex_approval_by = 0;
					$this->Expenses->ex_title = "NA";
					$this->Expenses->ex_head = "Invoice";
					$this->Expenses->ex_frequency = "Invoice";
					$this->Expenses->ex_date_modified = date('Y-m-d H:i:s');
					$dtarr = explode("-", $currentRow['date']);	
					$this->Expenses->ex_date = implode("-", array_reverse($dtarr));

					$old_row = $this->Expenses->isInvoiceExists(); // returns empty for new entry
					// die(va);
					if ((count($old_row) > 0)) {
						$this->Expenses->ex_id = $old_row[0]['ex_id'];
						$this->Expenses->ex_date_created = $old_row[0]['ex_date_created'];
					}
					else
						{
							$this->Expenses->ex_date_created = date('Y-m-d H:i:s');
							unset($this->Expenses->ex_id);
						}
					
						if($this->Expenses->save()) {$success++; unset($this->Expenses->ex_id);}
					}
				}

			}
			
			} // end of for
			// die(var_dump($this->Expenses));
		 	echo $success; // return count of insertion		
		}

		public function duplicate_project()
		{
				$this->load->model('Project');
					$this->Project->pro_title = $_POST['project_name'];
					$old_row = $this->Project->isWorkExists(); // returns empty for new entry
					if (count($old_row) > 0) {
						echo "Duplicate Project";
					}
					else{
						echo "0";
					}
			
		}
		public function create_project()
		{
			$success = 0;
			// die(var_dump($_POST));
			$this->load->model('Project');
			//for each column in current UI row, add a SQL row
					$this->Project->pro_title = $_POST['project_name'];
					$this->Project->pro_client = $_POST['client_name'];
					$this->Project->pro_description = $_POST['description'];
					$this->Project->pro_billable = (isset($_POST['bonus']))?1:0;
					$this->Project->pro_allow_exp = (isset($_POST['expense']))?1:0;
					$this->Project->pro_start = $_POST['start_date'];
					$this->Project->pro_end = $_POST['end_date'];
					$this->Project->pro_days = $_POST['days'];
					$this->Project->pro_onsite_start = $_POST['on_start_date'];
					$this->Project->pro_onsite_end = $_POST['on_end_date'];
					$this->Project->pro_onsite_days = $_POST['ondays'];
					$this->Project->pro_offshore_start = $_POST['off_start_date'];
					$this->Project->pro_offshore_end = $_POST['off_end_date'];
					$this->Project->pro_offshore_days = $_POST['offdays'];
					$this->Project->pro_expertise = $_POST['expertise'];

					$this->Project->pro_date_modified = date('Y-m-d H:i:s');

					$old_row = $this->Project->isWorkExists(); // returns empty for new entry

					if (count($old_row) > 0) {
						$this->Project->pro_id = $old_row[0]['pro_id'];
						$this->Project->pro_date_created = $old_row[0]['pro_date_created'];
					}
					else
						{
							$this->Project->pro_date_created = date('Y-m-d H:i:s');
							unset($this->Project->pro_id);
						}

						$save = $this->Project->save(); 
						if($save && count($old_row) > 0) {
							$this->session->set_userdata("current_project",$old_row[0]['pro_id']);
							echo 2;
						}
						else if($save){
							$last = $this->Project->last_id();
							$this->session->set_userdata("current_project",$last[0]['last']);
							echo 1;
						}
						else{
							echo 0;
						}
		}

		public function get_timesheet(){
			$uid = 0;
			$date = new DateTime($_POST['wed']);
			$week = $date->format('Y').$date->format('W');

			// if ($this->session->userdata('user_type') > 0) {
				$uid = $this->session->userdata('uid');
			// }

			$this->load->model('Timesheet');
			echo json_encode($this->Timesheet->get_timesheet_by_week($week, $uid));
		}

		public function add_expenses() {
			if (!$this->session->has_userdata('uid')) {
		        redirect('site/');
		    }
		    $uid = $this->session->userdata('uid');


		    $this->load->model('Project');
		    if ($this->session->userdata('user_type') == 0) {
		    	$data['project_list'] = $this->Project->get_project_list(0,'select');
		    	}
		    else{
			    $data['project_list'] = $this->Project->get_project_list_expense($uid,'select');
		    	}
		    $this->load->model('Expenses');
		    $data['my_expenses'] = $this->Expenses->get_all_by_uid($uid);

		    $data['title'] = "Welcome to Proactive by Stractive";

		    $data['content'] = "pages/add_expenses";
		    $data['local'] =  "pages/add_expenses_local";

				$this->load->view($this->layout, $data);
		}

		public function add_resource($id = 0){
			if (!$this->session->has_userdata('user_type') 
				|| $this->session->userdata('user_type') != 0) {
		        redirect('user/');
		    }
		    $this->load->model('Resource');
		    $uid = $this->session->userdata('uid');
		    if ($id > 0) {
				$raw_data = $this->Resource->get_resource_by_id($id);	
				$raw_data = $raw_data[0];	    	
				$edit_data = array();
				$edit_data['user'] = $raw_data['res_user'];
				$edit_data['name'] = $raw_data['res_name'];
				$edit_data['password'] = "";
				$edit_data['designation'] = $raw_data['res_designation'];
				$edit_data['role'] = $raw_data['res_type'];
				$edit_data['expertise'] = $raw_data['res_expertise'];
				$edit_data['salary'] = $raw_data['res_base'];
				$edit_data['bonus'] = $raw_data['res_bonus'];

				$data['edit_data'] = $edit_data;
		    }
		    $data['title'] = "Welcome to Proactive by Stractive";

		    $data['content'] = "pages/add_resource";
		    $data['local'] =  "pages/add_resource_local";

				$this->load->view($this->layout, $data);
		}

		public function create_resource()
		{
			$success = 0;

			$this->load->model('Resource');

			//for each column in current UI row, add a SQL row
					$this->Resource->res_user = $_POST['user'];
					$this->Resource->res_password = md5($_POST['password']);
					$this->Resource->res_name = $_POST['name'];
					$this->Resource->res_designation = $_POST['designation'];
					$this->Resource->res_base = $_POST['salary'];
					$this->Resource->res_bonus = $_POST['bonus'];
					$this->Resource->res_type = $_POST['role'];
					$this->Resource->res_expertise = $_POST['expertise'];

					$this->Resource->res_date_modified = date('Y-m-d H:i:s');

					$old_row = $this->Resource->isUserExists(); // returns empty for new entry

					if (count($old_row) > 0) {
						$this->Resource->res_id = $old_row[0]['res_id'];
						$this->Resource->res_date_created = $old_row[0]['res_date_created'];
						if ($this->Resource->res_password == "") {
							$this->Resource->res_password = $old_row[0]['res_password'];
						}
					}
					else
						{
							$this->Resource->res_date_created = date('Y-m-d H:i:s');
							unset($this->Resource->res_id);
						}

						$save = $this->Resource->save(); 
						if($save && count($old_row) > 0) {
							echo 2;
						}
						else if($save){
							echo 1;
						}
						else{
							echo 0;
						}
		}

		public function view_resources() {
			if (!$this->session->has_userdata('uid')) {
		        redirect('site/');
		    }
		    $uid = $this->session->userdata('uid');

		    $this->load->model('Resource');
			$my_resources = $this->Resource->get_resources_with_description();
			//////prepare list of all resources in a project
			foreach ($my_resources as $res_details) {
				$e_name = $res_details['res_name'];
				  
				}
			
			$data['my_resources'] = $my_resources;
		    $data['title'] = "Welcome to Proactive by Stractive";
		    $data['content'] = "pages/view_resources";
			$data['local'] = "pages/view_resources_local";
	
				$this->load->view($this->layout, $data);
		}


		public function add_project($id = 0) {
			if (!$this->session->has_userdata('user_type') 
				|| $this->session->userdata('user_type') != 0) {
		        redirect('user/');
		    }
		    $this->load->model('Project');
		    $uid = $this->session->userdata('uid');
		    if ($id > 0) {
				$edit_data = $this->Project->get_project_by_id($id);		    	
				$data['edit_data'] = $edit_data[0];
		    }
		    $data['title'] = "Welcome to Proactive by Stractive";

		    $data['content'] = "pages/add_project";
		    $data['local'] =  "pages/add_project_local";

				$this->load->view($this->layout, $data);
		}

		public function view_projects() {
			if (!$this->session->has_userdata('uid')) {
		        redirect('site/');
		    }
		    $uid = $this->session->userdata('uid');

		    $hum_res = array();
		    $approvers = array();
		    $this->session->set_userdata("current_project", 0);
		    $this->load->model('Project');
			$my_projects = $this->Project->get_projects_with_description();
			//////prepare list of all resources in a project
			foreach ($my_projects as $pro_details) {
				$pro_details['res_name'] .= " ";
				$e_name = substr($pro_details['res_name'],0, strpos($pro_details['res_name'], " "));
				  if (!isset($hum_res[$pro_details['pro_id']])){ 
					$hum_res[$pro_details['pro_id']] = $e_name;
					$approvers[$pro_details['pro_id']] = ($pro_details['prore_approver'] == 1)?$e_name:"";
					}
				  else {
				  	$hum_res[$pro_details['pro_id']] .= ",".$e_name;
					$approvers[$pro_details['pro_id']] .= ($pro_details['prore_approver'] == 1)?",".$e_name:"";
					}
				}
				/////end of listing
				$formatted_projects = array();
				// die(var_dump($my_projects));
		    	foreach ($my_projects as $key => $pro_details) { //for all rows add res list as last column
				    if ($this->session->userdata('user_type') == 0) { // if admin
				    		$my_projects[$key]["res_list"] = implode(",",array_unique(explode(",", $hum_res[$pro_details['pro_id']])));
				    		$my_projects[$key]["approver_list"] = implode(",",array_unique(explode(",", $approvers[$pro_details['pro_id']])));
							$formatted_projects[$pro_details['pro_id']] = $my_projects[$key];	
						}
					else if ($this->session->userdata('uid') == $pro_details['res_id']){ // if allocated 
				    		$my_projects[$key]["res_list"] = implode(",",array_unique(explode(",", $hum_res[$pro_details['pro_id']])));
				    		$my_projects[$key]["approver_list"] = implode(",",array_unique(explode(",", $approvers[$pro_details['pro_id']])));
				    		// $my_projects[$key]["res_list"] = $hum_res[$pro_details['pro_id']];
				    		// $my_projects[$key]["approver_list"] = $approvers[$pro_details['pro_id']];
							$formatted_projects[$pro_details['pro_id']] = $my_projects[$key];	
						}
					else { // unset extra projects if not admin
						unset($my_projects[$key]);
					}	
					// $tmp = explode(",", $my_projects[$key]["res_list"]);
					// $tmp = array_unique($tmp);
					// $my_projects[$key]["res_list"] = implode(",", $tmp);

					// $tmp = explode(",", $my_projects[$key]["approver_list"]);
					// $tmp = array_unique($tmp);
					// $my_projects[$key]["approver_list"] = implode(",", $tmp);
		    	} // end of for all rows
			$data['my_projects'] = $formatted_projects;
		    $data['title'] = "Welcome to Proactive by Stractive";
		    $data['content'] = "pages/view_projects";
			$data['local'] = "pages/view_projects_local";
	
				$this->load->view($this->layout, $data);
		}

		public function map_resources() {
			if (!$this->session->has_userdata('user_type') 
				|| $this->session->userdata('user_type') != 0) {
		        redirect('user/');
		    }
		    $uid = $this->session->userdata('uid');

		    $pid = $this->session->userdata('current_project');

		    $this->load->model('Project');
		    $this->Project->pro_id = $pid; // set pro_id for this project
		    $data['existing_resources'] = $this->Project->get_existing_resources($pid);
		    $data['project'] = $this->Project->get_current_project();

		    $this->load->model('Resource');
		    $data['resources'] = $this->Resource->get_resource_list("select");

		    $data['title'] = "Welcome to Proactive by Stractive";

		    $data['content'] = "pages/map_resources";
		    $data['local'] =  "pages/map_resources_local";

				$this->load->view($this->layout, $data);
		}

		public function add_mapping()
		{
			$inputRow = array();

			$this->load->model('Project');
			// for each row in UI, load the data 
			for ($i=0; $i < count($_POST)/4; $i++) { 
				$inp = $i + 1;
			if (!empty($_POST['days'.$inp]) && !empty($_POST['resource'.$inp])) {
			$inputRow[$i]["prore_resid"] = $_POST['resource'.$inp];
			$inputRow[$i]["prore_days"] = $_POST['days'.$inp];
			$inputRow[$i]["prore_type"] = $_POST['type'.$inp];
			$inputRow[$i]["prore_approver"] = $_POST['approve'.$inp];
			$inputRow[$i]["prore_proid"] = $this->session->userdata("current_project");
			$inputRow[$i]["prore_date_added"] = date('Y-m-d H:i:s');
			$inputRow[$i]["prore_date_modified"] = date('Y-m-d H:i:s');
			//for each column in current UI row, add a SQL row
			}
			
			} // end of for

			if($this->Project->insert_mapping($inputRow)) echo 1;
			else echo 0; 	
		}

		public function add_invoices($search = '') {
			if (!$this->session->has_userdata('uid')) {
		        redirect('site/');
		    }
		    $uid = $this->session->userdata('uid');
		    if ($search != '') {
		    	$data['search'] = str_replace('_', ' ', $search);
		    }

		    $this->load->model('Project');
		    if ($this->session->userdata('user_type') == 0) {
		    	$data['project_list'] = $this->Project->get_project_list(0,'select');
		    	}
		    $this->load->model('Expenses');
		    $data['my_expenses'] = $this->Expenses->get_all_invoices();

		    $data['title'] = "Welcome to Proactive by Stractive";

		    $data['content'] = "pages/add_invoices";
		    $data['local'] =  "pages/add_invoices_local";

				$this->load->view($this->layout, $data);
		}

		public function view_expenses($search = "") {
			if (!$this->session->has_userdata('uid')) {
		        redirect('site/');
		    }
		    $uid = $this->session->userdata('uid');
		    if ($search != "") {
		    	$data['search'] = $search;
		    }

		    $this->load->model('Project');
		    $this->load->model('Resource');
		    if ($this->session->userdata('user_type') == 0) {
		    	$data['project_list'] = $this->Project->get_project_list(0,'select');
		    	$data['resource_list'] = $this->Resource->get_resource_list('select');
		    	}
		    else{
			    $data['project_list'] = $this->Project->get_project_list_expense($uid,'select');
		    	}
		    $this->load->model('Expenses');
		    $data['all_expenses'] = $this->Expenses->get_all_expenses();

		    $data['title'] = "Welcome to Proactive by Stractive";

		    $data['content'] = "pages/view_expenses";
		    $data['local'] =  "pages/view_expenses_local";

				$this->load->view($this->layout, $data);
		}

		public function reports() {
			if (!$this->session->has_userdata('uid')) {
		        redirect('site/');
		    }
		    $uid = $this->session->userdata('uid');


		    if ($this->session->userdata('user_type') == 0) {
		    $this->load->model('Project');
		    $this->load->model('Resource');
		    $this->load->model('Timesheet');
		    	$data['project_list'] = $this->Project->get_project_list(0,'raw');
		    	$data['resource_list'] = $this->Resource->get_resource_list('raw');
		    	$data['billables'] = $this->Timesheet->get_resource_utilisation(array('start'=>date("Y-m-01"),'end'=>date("Y-m-d"),'rtype'=>"date"));
		    	$data['wdays'] = 8 * $this->Timesheet->countWorkDays(date("Y"), date("m"), array(0, 6));
		    	}

		    $data['ProjectPnL'] = $this->Project->get_all_PnL(); 	
		    $data['title'] = "Welcome to Proactive by Stractive";

		    $data['content'] = "pages/reports";
		    $data['local'] =  "pages/reports_local";

				$this->load->view($this->layout, $data);
		}

		public function get_resource_history()
		{
			/*
                      base used  = hrs_had * salary / (8*Wdays)
                      bonus paid = floor(hrs_had/8) * bonus/(Wdays)
                      */ 
			$uid = $this->input->post('resid');
			$start = implode("-",array_reverse(explode("-", $this->input->post('start'))));
			$end = implode("-",array_reverse(explode("-", $this->input->post('end'))));

			$approve = 0;
		    $this->load->model('Timesheet');
			$this->Timesheet->get_resource_history($uid,$start,$end);
		}

		public function get_project_figures()
		{
		    $this->load->model('Project');
		    $this->Project->pro_id = $this->input->post('proid');
			$this->Project->get_figures();
		}

		public function show_CTC($pid)
		{
		    $this->load->model('Timesheet');
			$data['CTC'] = $this->Timesheet->get_approved_history($pid);
			
		}

		public function get_resource_history_project()
		{
			$uid = $this->input->post('resid');
			$pid = $this->input->post('proid');
			$start = implode("-",array_reverse(explode("-", $this->input->post('start'))));
			$end = implode("-",array_reverse(explode("-", $this->input->post('end'))));

			$approve = 0;
		    $this->load->model('Timesheet');
			$this->Timesheet->get_resource_history_project($uid,$start,$end,$pid);
		}


		public function delete_expense()
		{
			$this->load->model('Expenses');
			$this->Expenses->ex_id = $this->input->post('ex_id');

			if ($this->Expenses->delete()) {
				echo 1;
			} else {
				echo 0;
			}
		}

		public function delete_project()
		{
			$this->load->model('Project');
			$this->Project->pro_id = $this->input->post('pro_id');

			if ($this->Project->delete()) {
				echo 1;
			} else {
				echo 0;
			}
		}

		public function delete_resource()
		{
			$this->load->model('Resource');
			$this->Resource->res_id = $this->input->post('res_id');

			if ($this->Resource->delete()) {
				echo 1;
			} else {
				echo 0;
			}
		}

		public function delete_mapping()
		{
			$this->load->model('Project');
			$prore_id = $this->input->post('prore_id');

			if ($this->Project->delete_map($prore_id)) {
				echo 1;
			} else {
				echo 0;
			}
		}

		public function sign_out() {
		   	$this->session->unset_userdata(array('uid','user_type','email','fullname'));
		   	redirect('site/');
		}

	}

/* End of file */
