<?php

	class Subcategory extends MY_Model {

		const TABLE_NAME = 'subcategory';
		const TABLE_PK = 'subcat_id';

		/**
		  *	 @var int
		  */
		public $subcat_id;

		/**
		  *	 @var string
		  */
		public $subcat_name;

		/**
		  *	 @var string
		  */
		public $subcat_desc;

		/**
		  *	 @var int
		  */
		public $cat_id;


		// Member Functions
		public function join_and_get() {
			$this->db->select();
			$this->db->from('subcategory');
			$this->db->join('category', 'subcategory.cat_id = category.cat_id');

			$query = $this->db->get();

			return $query->result_array();
		}

		public function update_subcategory_by_id($subcat_id, $subcat_name, $cat_id) {
			$data = array(
				"subcat_name" => $subcat_name,
				"cat_id" => (int) $cat_id
			);

			$this->db->update($this::TABLE_NAME, $data, array("subcat_id" => (int) $subcat_id));
			return $this->db->affected_rows();
		}

		public function get_subcategory_group($cat_id) {
			$this->db->select();
			$this->db->from('subcategory');
			$this->db->where(array('cat_id' => (int) $cat_id));

			$query = $this->db->get();

			return $query->result_array();
		}

	}

/* End of file */
