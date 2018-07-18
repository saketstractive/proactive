<?php

	class Editorial extends MY_Model {

		const TABLE_NAME = 'editorial';
		const TABLE_PK = 'ed_id';

		/**
		  *	 @var int
		  */
		public $ed_id;

		/**
		  *	 @var string
		  */
		public $ed_title;

		/**
		  *	 @var string
		  */
		public $ed_desc;

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
				$query = $this->db->query("SELECT * FROM editorial ORDER BY updated_on DESC LIMIT ".$limit."");
			} else {
				$query = $this->db->query("SELECT * FROM editorial ORDER BY updated_on DESC");
			}

			return $query->result_array();
		}
		// function get_all can be used for fetch all news items in asc order

		public function get_all_enable() {
				$query = $this->db->query("SELECT * FROM editorial WHERE status = 1 ORDER BY updated_on DESC");
				return $query->result_array();
		}

		public function toggle($id) {
			$this->db->query("UPDATE editorial SET status = !status, updated_on = '".date('Y-m-d H:i:s')."' WHERE ed_id = $id");
			return $this->db->affected_rows();
		}

		public function update_editorial_by_id($ed_id, $ed_title, $ed_desc) {
			$data = array(
				"ed_title" => $ed_title,
				"ed_desc" => $ed_desc,
				"updated_on" => date('Y-m-d H:i:s')
			);

			$this->db->update($this::TABLE_NAME, $data, array("ed_id" => (int) $ed_id));
			return $this->db->affected_rows();
		}

	}

/* End of file */
