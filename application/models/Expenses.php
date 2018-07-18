<?php

	class Expenses extends MY_Model {

		const TABLE_NAME = 'expenses';
		const TABLE_PK = 'ex_id';

		/**
		  *	 @var int
		  */
		public $ex_id;

		/**
		  *	 @var string
		  */
		public $ex_title;
		
		/**
		  *	 @var string
		  */
		public $ex_head;

		/**
		  *	 @var int
		  */
		public $ex_proid;

		/**
		  *	 @var int
		  */
		public $ex_resid;

		/**
		  *	 @var date
		  */
		public $ex_date;

		/**
		  *	 @var int
		  */
		public $ex_amount;

		/**
		  *	 @var string
		  */
		public $ex_description;
		

		/**
		  *	 @var datetime
		  */
		public $ex_date_created;

		/**
		  *	 @var datetime
		  */
		public $ex_date_modified;


		// Member Functions

		public function get_all_by_uid($id) {
			$this->db->select();
			$this->db->from('expenses');
			$this->db->join('project', 'expenses.ex_proid = project.pro_id');
			$this->db->where('ex_head !=','Invoice');
			$this->db->where('ex_frequency !=','Invoice');
			if ($id != 0) {
			$this->db->where('ex_resid', $id);
			}

			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_all_expenses(){
			$query = $this->db->query("SELECT * FROM expenses LEFT JOIN project ON expenses.ex_proid = project.pro_id LEFT JOIN resource ON expenses.ex_resid = resource.res_id LEFT JOIN ex_rejection_history ON expenses.ex_id = ex_rejection_history.exp_id AND rej_id IN (SELECT r.rej_id FROM `ex_rejection_history` r LEFT JOIN `ex_rejection_history` q ON r.exp_id = q.exp_id AND r.rej_id < q.rej_id WHERE q.rej_id is NULL ) WHERE ex_frequency !='Invoice' AND ex_head != 'Invoice'");

			return $query->result_array();
		}

		

		public function get_expenses_by_week($week, $uid)
		{
			if ($uid > 0) $res = "AND t.ex_resid='$uid'";
			else $res = ""; // for admin

			$query = $this->db->query("SELECT `ex_week`,`ex_day`,SUM(`ex_hours`) AS wrk,`ex_proid`,`ex_resid`,`ex_description`,`ex_date`,MIN(`ex_approved`) as clr FROM `expenses` AS t INNER JOIN project as p ON t.ex_proid=p.pro_id WHERE t.ex_week='$week' AND ex_frequency !='Invoice' AND ex_head != 'Invoice' $res GROUP BY `ex_resid`,`ex_proid`,`ex_description`,`ex_date`,`ex_day` ");

			return $query->result_array();

		}

		public function approve_entry($eid, $flag, $reason){
			$uid = $this->session->userdata('uid');
			$query = $this->db->query("UPDATE expenses SET ex_approved='$flag', ex_approval_by='$uid', ex_date_modified='".date('Y-m-d H:i:s')."' WHERE ex_id='$eid'");
			$query = $this->db->query("INSERT INTO ex_rejection_history(exp_id,reason,date_time_stamp) VALUES ('$eid','$reason','".date("Y-m-d H:i:s")."')");

		}

		public function isWorkExists(){
			$query = $this->db->query("SELECT * FROM expenses WHERE ex_date='".$this->ex_date."' AND ex_proid='".$this->ex_proid."' AND ex_resid='".$this->ex_resid."' AND ex_amount='".$this->ex_amount."'");
			
			return $query->result_array();
		}

		public function isInvoiceExists(){
			$query = $this->db->query("SELECT * FROM expenses WHERE ex_date='".$this->ex_date."' AND ex_proid='".$this->ex_proid."' AND ex_head='Invoice' AND ex_amount='".$this->ex_amount."'");
			
			return $query->result_array();
		}

	}

/* End of file */
