<?php

	class Resource extends MY_Model {

		const TABLE_NAME = 'resource';
		const TABLE_PK = 'res_id';

		/**
		  *	 @var int
		  */
		public $res_id;
		
		/**
		  *	 @var string
		  */
		public $res_user;

		/**
		  *	 @var string
		  */
		public $res_password;
		/**
		  *	 @var string
		  */
		public $res_name;

		/**
		  *	 @var string
		  */
		public $res_designation;

		/**
		  *	 @var int
		  */
		public $res_type;

		/**
		  *	 @var int
		  */
		public $res_base;

		/**
		  *	 @var int
		  */
		public $res_bonus;

		/**
		  *	 @var string
		  */
		public $res_expertise;

		/**
		  *	 @var datetime
		  */
		public $res_date_created;

		/**
		  *	 @var datetime
		  */
		public $res_date_modified;


		// Member Functions
		public function authenticate($user, $password) {
			$query = $this->db->query("SELECT * FROM ".$this::TABLE_NAME." WHERE res_user = '".$user."' AND res_password = '".md5($password)."'");

			if ($query->num_rows() == 1) {
			 	$row = $query->row();
			 		$userdata = array(
						'uid' => $row->res_id,
						'user_type' => $row->res_type,
						'user' => $row->res_user,
						'fullname' => $row->res_name,
					);

					$this->session->set_userdata($userdata);
			 		return 1;
			} else {
				return 0;
			}

		}

		public function isUserExists(){
			$query = $this->db->query("SELECT * FROM resource WHERE res_user='".$this->res_user."'");
			
			return $query->result_array();
		}

		public function email_exist($email) {
			$query = $this->db->query("SELECT * FROM user WHERE email = '".$email."'");

			if ($query->num_rows() > 0) {
				return true;
			} else {
				return false;
			}
		}

	
		public function update_password($uid, $password) {
			$data = array(
				"res_password" => $password,
				"res_date_modified" => date('Y-m-d H:i:s')
			);
			$cond = array("res_id" => (int) $uid);
			$this->db->update($this::TABLE_NAME, $data, $cond );
			return $this->db->affected_rows();

		}

		public function reset_password($k, $password) {
			$data = array(
				"password" => $password,
				"updated_on" => date('Y-m-d H:i:s')
			);

			$this->db->update($this::TABLE_NAME, $data, array("verification_key" => $k));
			return $this->db->affected_rows();

		}

		public function get_resources_with_description() {
			$sql = "SELECT res_id,res_name,res_user,res_base,res_bonus,res_expertise,res_designation,res_date_created,res_date_modified, GROUP_CONCAT(pro_title) as projects FROM (SELECT * FROM resource as r LEFT JOIN project_resource as pr ON r.res_id=pr.prore_resid LEFT JOIN project as p ON pr.prore_proid=p.pro_id) as respro GROUP BY res_id ORDER BY res_name ASC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		public function get_resource_by_id($id) {
			$this->db->select();
			$this->db->from('resource');
			$this->db->where('res_id', $id);

			$query = $this->db->get();
			return $query->result_array();
		}


		public function update_profile_id($id, $col_name, $col_value) {
			$data = array(
				$col_name => $col_value,
				"updated_on" => date('Y-m-d H:i:s')
			);

			$this->db->update($this::TABLE_NAME, $data, array("uid" => (int) $id));
			return $this->db->affected_rows();
		}

		public function get_resource_list($select){
				$this->db->select();
				$this->db->from('resource');
				$this->db->order_by('res_name', 'ASC');
				$query = $this->db->get();
				$resources = $query->result_array();

				if ($select == 'select') {
				$options_out = "<option value='0'>Select a Resource</option>";
			foreach ($resources as $row) {
					$row['res_name'] .= " ";
					$name = substr($row['res_name'],0,strpos($row['res_name'], " ")); // omly first name till requirement is not raised
					$options_out .= "<option value='".$row['res_id']."'>".$name."</option>";
					}	
				return $options_out;
				}
				else return $resources;
		}

		public function get_figures($start, $end)
		{
			$query = $this->db->query("SELECT SUM(ex_amount) as amount FROM expenses WHERE ex_resid='".$this->res_id."' AND ex_approved='1' AND ex_date >= '$start' AND ex_date <= '$end' GROUP BY ex_resid");
			$expense = $query->result_array();
			if(count($expense) == 1)
			$data['expense'] = $expense[0]['amount'];
			else
			$data['expense'] = 0;

			$query = $this->db->query("SELECT SUM(tm_hours) as hrs, res_id, res_base, IF(pro_billable='1',res_bonus,0) as bonus, res_name FROM timesheet LEFT JOIN resource ON tm_resid=res_id LEFT JOIN project ON pro_id=tm_proid WHERE tm_resid='".$this->res_id."' AND tm_approved='1' AND tm_date >= '$start' AND tm_date <= '$end' GROUP BY tm_proid");
			$entries = $query->result_array();
			$data['CTC']= 0;
			$data['bonus']= 0;

			foreach ($entries as $entry) {
				$data['CTC'] += $entry['hrs'] * $entry['res_base']/(22*8);
				$data['bonus'] += $entry['hrs'] * $entry['bonus']/(240*8);
			}
				$data['CTC'] = ceil($data['CTC']);
				$data['bonus'] = ceil($data['bonus']);


			return $data;
		}

		

	}

/* End of file */
