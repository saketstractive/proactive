<?php

	class Testimonial extends MY_Model {

		const TABLE_NAME = 'testimonial';
		const TABLE_PK = 'tid';

		/**
		  *	 @var int
		  */
		public $tid;

		/**
		  *	 @var string
		  */
		public $customer_name;

		/**
		  *	 @var string
		  */
		public $testimonial_desc;

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
				$query = $this->db->query("SELECT * FROM testimonial ORDER BY updated_on DESC LIMIT ".$limit."");
			} else {
				$query = $this->db->query("SELECT * FROM testimonial ORDER BY updated_on DESC");
			}

			return $query->result_array();
		}
		// function get_all can be used for fetch all news items in asc order

		public function get_all_enable() {
				$query = $this->db->query("SELECT * FROM testimonial WHERE status = 1 ORDER BY updated_on DESC");
				return $query->result_array();
		}

		public function toggle($id) {
			$this->db->query("UPDATE testimonial SET status = !status, updated_on = '".date('Y-m-d H:i:s')."' WHERE tid = $id");
			return $this->db->affected_rows();
		}

		public function update_testimonial_by_id($id, $customer_name, $testimonial_desc) {
			$data = array(
				"customer_name" => $customer_name,
				"testimonial_desc" => $testimonial_desc,
				"updated_on" => date('Y-m-d H:i:s')
			);

			$this->db->update($this::TABLE_NAME, $data, array("tid" => (int) $id));
			return $this->db->affected_rows();
		}

	}

/* End of file */
