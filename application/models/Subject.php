<?php

	class Subject extends MY_Model {

		const TABLE_NAME = 'subject';
		const TABLE_PK = 'subject_id';

		/**
		  *	 @var int
		  */
		public $subject_id;

		/**
		  *	 @var string
		  */
		public $subject_name;

		/**
		  *	 @var string
		  */
		public $subject_desc;

		/**
		  *	 @var int
		  */
		public $subcat_id;


		// Member Functions
		public function join_and_get() {
			$this->db->select();
			$this->db->from('subject');
			$this->db->join('subcategory', 'subject.subcat_id = subcategory.subcat_id');

			$query = $this->db->get();

			return $query->result_array();
		}

		public function update_subject_by_id($subject_id, $subject_name, $subcat_id) {
			$data = array(
				"subject_name" => $subject_name,
				"subcat_id" => (int) $subcat_id
			);

			$this->db->update($this::TABLE_NAME, $data, array("subject_id" => (int) $subject_id));
			return $this->db->affected_rows();
		}

		public function get_subject_group($subcat_id)
		{
			$this->db->select();
			$this->db->from('subject');
			$this->db->where(array('subcat_id' => (int) $subcat_id));

			$query = $this->db->get();

			return $query->result_array();
		}

	}

/* End of file */
