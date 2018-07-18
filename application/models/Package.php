<?php

	class Package extends MY_Model {

		const TABLE_NAME = 'package';
		const TABLE_PK = 'pid';

		/**
		  *	 @var int
		  */
		public $pid;

		/**
		  *	 @var string
		  */
		public $p_name;

		/**
		  *	 @var int
		  */
		public $p_duration;

		/**
		  *	 @var int
		  */
		public $p_cost;

		/**
		  *	 @var string
		  */
		public $p_desc;

		/**
		  *	 @var string
		  */
		public $p_keywords;

		/**
		  *	 @var string
		  */
		public $p_smlist;

		/**
		  *	 @var tinyint
		  */
		public $p_type;

		/**
		  *	 @var string
		  */
		public $stream;

		/**
		  *	 @var string
		  */
		public $category;

		/**
		  *	 @var string
		  */
		public $subcategory;

		/**
		  *	 @var string
		  */
		public $subject;

			/**
		  *	 @var datetime
		  */
		public $created_on;

		/**
		  *	 @var datetime
		  */
		public $updated_on;


		// Member Functions
		public function get_all_desc($limit = 0) {
			if ($limit) {
				$query = $this->db->query("SELECT * FROM package ORDER BY created_on ASC LIMIT ".$limit."");
			} else {
				$query = $this->db->query("SELECT * FROM package ORDER BY created_on ASC");
			}
			return $query->result_array();
		}

		public function get_all_subjective($limit = 0) {
			if ($limit) {
				$query = $this->db->query("SELECT * FROM package WHERE p_type = 0 ORDER BY p_name ASC LIMIT ".$limit."");
			} else {
				$query = $this->db->query("SELECT * FROM package WHERE p_type = 0 ORDER BY p_name ASC");
			}
			return $query->result_array();
		}

		public function get_one_subjective($id = 0) {
			if ($id > 0) {
				$query = $this->db->query("SELECT * FROM package WHERE pid = $id ");
			} 
			return $query->result_array();
		}

		public function get_all_objective($limit = 0) {
			if ($limit) {
				$query = $this->db->query("SELECT * FROM package WHERE p_type = 1 OR p_type = 2 ORDER BY p_name ASC LIMIT ".$limit."");
			} else {
				$query = $this->db->query("SELECT * FROM package WHERE p_type = 1 OR p_type = 2 ORDER BY p_name ASC");
			}
			return $query->result_array();
		}

		public function update_package_by_id($pid, $p_name, $p_duration, $p_cost, $p_desc, $p_keywords, $sm_list, $stream, $category, $subcategory, $subject) {
				$data = array(
					"p_name" =>  $p_name,
					"p_duration" => $p_duration,
					"p_cost" => $p_cost,
					"p_desc" => $p_desc,
					"p_keywords" => $p_keywords,
					"p_smlist" => $sm_list,
					// "p_type" => 0,
					"stream" => $stream,
					"category" => $category,
					"subcategory" => $subcategory,
					"subject" => $subject,
					"updated_on" => date('Y-m-d H:i:s')
				);

				$this->db->update($this::TABLE_NAME, $data, array("pid" => (int) $pid));
				return $this->db->affected_rows();
		}

		public function update_objective_package_by_id($pid, $p_name, $p_duration, $p_cost, $p_desc, $p_keywords, $stream, $category, $subcategory, $subject) {
				$data = array(
					"p_name" =>  $p_name,
					"p_duration" => $p_duration,
					"p_cost" => $p_cost,
					"p_desc" => $p_desc,
					"p_keywords" => $p_keywords,
					"p_smlist" => NULL,
					// "p_type" => 1,
					"stream" => $stream,
					"category" => $category,
					"subcategory" => $subcategory,
					"subject" => $subject,
					"updated_on" => date('Y-m-d H:i:s')
				);

				$this->db->update($this::TABLE_NAME, $data, array("pid" => (int) $pid));
				return $this->db->affected_rows();
		}

		public function get_package_by_stream($stream_id) {
				$query = $this->db->query("SELECT * FROM package INNER JOIN stream ON stream.stream_id = $stream_id WHERE stream.stream_name = package.stream ORDER BY package.created_on DESC");
				return $query->result_array();
		}

		// public function search($search_term = null, $p_name = null, $p_keywords = null, $stream = null, $category = null, $subcategory = null, $subject = null) {
		// 		if ($search_term != null) {
		// 				$search_term = strtolower($search_term);
		// 				$search_term = str_replace(" ", "%", $search_term);
		// 				$search_term = "%".$search_term."%";
		//
		// 				$query = $this->db->query("SELECT * FROM package WHERE p_name LIKE '$search_term' OR p_keywords LIKE '$search_term' OR stream LIKE '$search_term' OR category LIKE '$search_term' OR subcategory LIKE '$search_term' OR subject LIKE '$search_term' ORDER BY created_on DESC");
		// 				return $query->result_array();
		// 		}
		// }



		public function search($search_term) {
			$search_term = strtolower($search_term);
			$search_term = str_replace(" ", "%", $search_term);
			$search_term = "%".$search_term."%";

			$query = $this->db->query("SELECT * FROM package WHERE p_name LIKE '$search_term' OR p_keywords LIKE '$search_term' OR stream LIKE '$search_term' OR category LIKE '$search_term' OR subcategory LIKE '$search_term' OR subject LIKE '$search_term' ORDER BY created_on DESC");
			return $query->result_array();
		}

		public function get_annotated_packages($all_sm)
		{
			$query = $this->db->query("SELECT pid,p_smlist,category,subject,subcategory,stream,p_name FROM `package` WHERE '$all_sm' LIKE concat('%,',`pid`,',%')");
			return $query->result_array();
			
		}

	}

/* End of file */
