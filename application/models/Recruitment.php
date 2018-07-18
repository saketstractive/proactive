<?php

	class Recruitment extends MY_Model {

		const TABLE_NAME = 'recruitment';
		const TABLE_PK = 'recruit_id';

		/**
		  *	 @var int
		  */
		public $recruit_id;

		/**
		  *	 @var string
		  */
		public $recruit_title;

		/**
		  *	 @var string
		  */
		public $recruit_desc;

		/**
		  *	 @var tinyint
		  */
		public $status;

		/**
		  *	 @var datetime
		  */
		public $published_on;

		/**
		  *	 @var datetime
		  */
		public $updated_on;


		// Member Functions
		public function get_all_desc($limit = 0) {
			if ($limit) {
				$query = $this->db->query("SELECT * FROM recruitment ORDER BY updated_on DESC LIMIT ".$limit."");
			} else {
				$query = $this->db->query("SELECT * FROM recruitment ORDER BY updated_on DESC");
			}

			return $query->result_array();
		}
		// function get_all can be used for fetch all news items in asc order

		public function get_all_enable() {
				$query = $this->db->query("SELECT * FROM recruitment WHERE status = 1 ORDER BY updated_on DESC");
				return $query->result_array();
		}

		public function toggle($id) {
			$this->db->query("UPDATE recruitment SET status = !status, updated_on = '".date('Y-m-d H:i:s')."' WHERE recruit_id = $id");
			return $this->db->affected_rows();
		}

		public function update_recruit_by_id($id, $title, $desc) {
			$data = array(
				"recruit_title" => $title,
				"recruit_desc" => $desc,
				"updated_on" => date('Y-m-d H:i:s')
			);

			$this->db->update($this::TABLE_NAME, $data, array("recruit_id" => (int) $id));
			return $this->db->affected_rows();
		}

	}

/* End of file */
