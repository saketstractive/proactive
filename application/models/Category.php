<?php

	class Category extends MY_Model {

		const TABLE_NAME = 'category';
		const TABLE_PK = 'cat_id';

		/**
		  *	 @var int
		  */
		public $cat_id;

		/**
		  *	 @var string
		  */
		public $cat_name;

		/**
		  *	 @var string
		  */
		public $cat_desc;

		/**
		  *	 @var int
		  */
		public $stream_id;


		// Member Functions
		public function join_and_get() {
			$this->db->select();
			$this->db->from('category');
			$this->db->join('stream', 'category.stream_id = stream.stream_id');

			$query = $this->db->get();

			return $query->result_array();
		}

		public function update_category_by_id($cat_id, $cat_name, $stream_id) {
			$data = array(
				"cat_name" => $cat_name,
				"stream_id" => (int) $stream_id
			);

			$this->db->update($this::TABLE_NAME, $data, array("cat_id" => (int) $cat_id));
			return $this->db->affected_rows();
		}

		public function get_category_group($stream_id) {
			$this->db->select();
			$this->db->from('category');
			$this->db->where(array('stream_id' => (int) $stream_id));

			$query = $this->db->get();

			return $query->result_array();
		}

	}

/* End of file */
