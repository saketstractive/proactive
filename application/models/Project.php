<?php

	class Project extends MY_Model {

		const TABLE_NAME = 'project';
		const TABLE_PK = 'pro_id';

		/**
		  *	 @var int
		  */
		public $pro_id;
		
		/**
		  *	 @var string
		  */
		public $pro_title;

		/**
		  *	 @var string
		  */
		public $pro_client;

		/**
		  *	 @var string
		  */
		public $pro_description;

		/**
		  *	 @var int
		  */
		public $pro_billable;

				/**
		  *	 @var int
		  */
		public $pro_allow_exp;

		/**
		  *	 @var date
		  */
		public $pro_start;

		/**
		  *	 @var date
		  */
		public $pro_end;		

		/**
		  *	 @var date
		  */
		public $pro_onsite_start;

		/**
		  *	 @var date
		  */
		public $pro_onsite_end;

		/**
		  *	 @var int
		  */
		public $pro_onsite_days;

		/**
		  *	 @var date
		  */
		public $pro_offshore_start;

		/**
		  *	 @var date
		  */
		public $pro_offshore_end;

		/**
		  *	 @var int
		  */
		public $pro_offshore_days;

		/**
		  *	 @var string
		  */
		public $pro_expertise;

		/**
		  *	 @var datetime
		  */
		public $pro_date_created;

		/**
		  *	 @var datetime
		  */
		public $pro_date_modified;


		// Member Functions
		
		public function get_current_project()
		{
			$this->db->select();
			$this->db->from('project');
			if($this->pro_id > 0){
			$this->db->where('pro_id', $this->pro_id);
			$query = $this->db->get();
			return $query->result_array();
			}
			else return false;
		}

		public function get_projects_by_uid($id, $exp=0) {
			$this->db->select();
			$this->db->from('project');
			$this->db->order_by('project.pro_title', 'ASC');
			if ($id > 0) {
				$this->db->join('project_resource', 'project.pro_id = project_resource.prore_proid');
				$this->db->join('resource', 'resource.res_id = project_resource.prore_resid');
				$this->db->where('resource.res_id', $id);
				if ($exp == 1) {
					$this->db->where('project.pro_allow_exp', 1);
				}
			}

			$query = $this->db->get();
			// die(var_dump($query->result_array()));
			return $query->result_array();
		}

		public function get_project_by_id($id) {
			$this->db->select();
			$this->db->from('project');
			$this->db->where('project.pro_id', $id);

			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_projects_with_description() {
			$sql = "SELECT * FROM project as pj LEFT JOIN project_resource as pr ON pj.pro_id=pr.prore_proid LEFT JOIN resource as res ON pr.prore_resid=res.res_id ORDER BY pj.pro_title ASC";
			//approver in DESC so that no initial "," is placed in front of approver list
			//ORDER BY pr.prore_approver DESC
			
			$query = $this->db->query($sql);
			// die(var_dump($query->result_array()));
			return $query->result_array();
		}

		public function get_project_list($uid,$select){
				$projects = $this->get_projects_by_uid($uid);
				$uniq = array();
				foreach ($projects as $row) {
					$uniq[$row['pro_id']] = $row;
				} // code to remove duplicates

				if ($select == 'select') {
				$options_out = "<option value=''>Project</option>";
			foreach ($uniq as $id => $row) {
					$options_out .= "<option value='".$id."'>".$row['pro_title']."</option>";
					}	
				return $options_out;
				}
				else return $projects;
				
		}

		public function get_project_list_expense($uid,$select){
				$projects = $this->get_projects_by_uid($uid,1);
				$uniq = array();
				foreach ($projects as $row) {
					$uniq[$row['pro_id']] = $row;
				} // code to remove duplicates
				
				if ($select == 'select') {
				$options_out = "<option value=''>Project</option>";
			foreach ($uniq as $id => $row) {
					$options_out .= "<option value='".$id."'>".$row['pro_title']."</option>";
					}	
				return $options_out;
				}
				else return $projects;
				
		}

		public function get_existing_resources($pid)
		{
			$this->db->select('prore_id,res_name,prore_days,prore_type,prore_approver');
			$this->db->from('project_resource');
			if ($pid > 0) {
			$this->db->join('resource', 'resource.res_id = project_resource.prore_resid');
			$this->db->where('project_resource.prore_proid', $pid);
			}
			else
				return false;

			$query = $this->db->get();
			return $query->result_array();

		}
			
		public function insert_mapping($data)
		{
			if (count($data) > 0) {
			$sql = "INSERT INTO project_resource(prore_resid,prore_days,prore_type,prore_approver, prore_proid,prore_date_added,prore_date_modified) VALUES ";
			foreach ($data as $irow) {
				$sql .= "('".implode("','", $irow)."'),";
			}
			$sql = substr($sql, 0, -1);
			$query = $this->db->query($sql);
			return $query;
			}
			else return false;
		}

		public function get_figures()
		{
			$query = $this->db->query("SELECT SUM(ex_amount) as amount, ex_resid FROM expenses LEFT JOIN resource ON ex_resid=res_id WHERE ex_proid = '".$this->pro_id."' AND ex_approved='1' GROUP BY ex_resid");
			$data['expense_list'] = $query->result_array();

			$query = $this->db->query("SELECT SUM(inv_amount) as amount FROM invoices WHERE inv_proid = '".$this->pro_id."' GROUP BY inv_proid");
			$data['invoice_list'] = $query->result_array();

			$query = $this->db->query("SELECT SUM(tm_hours) as hrs, res_id, res_base, IF(pro_billable='1',res_bonus,0) as bonus, res_name FROM timesheet LEFT JOIN resource ON tm_resid=res_id LEFT JOIN project ON pro_id=tm_proid WHERE tm_proid='".$this->pro_id."' AND tm_approved='1' GROUP BY tm_resid");
			$data['efforts'] = $query->result_array();
			echo json_encode($data);
		}

		public function get_all_PnL()
		{
			$PnL = array();
			$query = $this->db->query("SELECT SUM(amount) as amnt, ex_proid, inv FROM (SELECT SUM(ex_amount) as amount, ex_resid,ex_proid, IF(ex_head='Invoice',1,0) as inv FROM expenses WHERE ex_approved='1' GROUP BY ex_resid,ex_proid,inv) as explist LEFT JOIN resource ON ex_resid=res_id LEFT JOIN project ON ex_proid=pro_id GROUP BY ex_proid, inv");
			$expense_list = $query->result_array();
			foreach ($expense_list as $key => $value) {
				if (!isset($PnL[$value['ex_proid']])) {
					$PnL[$value['ex_proid']] = 0;	
				} // independant condition

				if ($value['inv'] == 1) {
				$PnL[$value['ex_proid']] += floor($value['amnt']);
				}
				else
				{
				$PnL[$value['ex_proid']] -= floor($value['amnt']);
				}

			}

			$query = $this->db->query("SELECT SUM(inv_amount) as amnt, inv_proid FROM invoices GROUP BY inv_proid");
			$invoice_list = $query->result_array();
			foreach ($invoice_list as $key => $value) {
				if (!isset($PnL[$value['inv_proid']])) {
					$PnL[$value['inv_proid']] = 0;	
				} // independant condition

				$PnL[$value['inv_proid']] += floor($value['amnt']);
			}

			$query = $this->db->query("SELECT SUM(tm_hours) as hrs, res_id, res_base, IF(pro_billable='1',res_bonus,0) as bonus, res_name, pro_id FROM timesheet LEFT JOIN resource ON tm_resid=res_id LEFT JOIN project ON pro_id=tm_proid WHERE tm_approved='1' GROUP BY tm_resid,pro_id, pro_billable");
			$efforts = $query->result_array();
			foreach ($efforts as $key => $value) {
				if (!isset($PnL[$value['pro_id']])) {
					$PnL[$value['pro_id']] = 0;	
				} // independant condition

				$base = $value['hrs'] * $value['res_base']/(22*8); // for hours
				$bonus = $value['hrs'] * $value['bonus']/(240*8); // for hours
				$CTC = $base + $bonus;
				$PnL[$value['pro_id']] -= floor($CTC);

			}
			return $PnL;
		}

		public function isWorkExists(){
			$query = $this->db->query("SELECT * FROM project WHERE pro_title='".$this->pro_title."'");
			
			return $query->result_array();
		}

		public function last_id()
		{
			$query = $this->db->query("SELECT MAX(pro_id) as last FROM project");
			return $query->result_array();	
		}

		public function delete_map($prore_id)
		{
			$query = $this->db->query("DELETE FROM project_resource WHERE prore_id='$prore_id'");
			return $query;	
		}



	}

/* End of file */
