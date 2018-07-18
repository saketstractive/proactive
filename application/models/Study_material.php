<?php

	class Study_material extends MY_Model {

		const TABLE_NAME = 'study_material';
		const TABLE_PK = 'sm_id';

		/**
		  *	 @var int
		  */
		public $sm_id;

		/**
		  *	 @var string
		  */
		public $sm_title;

		/**
		  *	 @var string
		  */
		public $sm_filename;

    /**
		  *	 @var int
		  */
		public $subject_id;

    /**
		  *	 @var datetime
		  */
		public $uploaded_on;

    /**
		  *	 @var datetime
		  */
		public $updated_on;


		// Member Functions
    public function join_and_get($limit = 0) {
        if ($limit) {
  				$query = $this->db->query("SELECT * FROM study_material, subject WHERE study_material.subject_id = subject.subject_id ORDER BY sm_id DESC LIMIT ".$limit."");
  			} else {
  				$query = $this->db->query("SELECT * FROM study_material, subject WHERE study_material.subject_id = subject.subject_id ORDER BY sm_id DESC");
  			}

  			return $query->result_array();
		}

    public function update_material_by_id($sm_id, $sm_title, $subject_id) {
			$data = array(
				"sm_title" => $sm_title,
				"subject_id" => (int) $subject_id,
        "updated_on" => date('Y-m-d H:i:s')
			);

			$this->db->update($this::TABLE_NAME, $data, array("sm_id" => (int) $sm_id));
			return $this->db->affected_rows();
		}

	public function get_annotated_materials($all_sm)
		{
			$query = $this->db->query("SELECT sm_id,sm_title,sm_filename FROM `study_material` WHERE '$all_sm' LIKE concat('%,',`sm_id`,',%')");
			return $query->result_array();
			
		}	

	}

/* End of file */
