<?php

	class Premium_videos extends MY_Model {

		const TABLE_NAME = 'premium_videos';
		const TABLE_PK = 'vpid';

		/**
		  *	 @var int
		  */
		public $vpid;

		/**
		  *	 @var string
		  */
		public $vp_name;

		/**
		  *	 @var int
		  */
		public $vp_duration;

		/**
		  *	 @var int
		  */
		public $vp_cost;

		/**
		  *	 @var string
		  */
		public $vp_desc;

		/**
		  *	 @var string
		  */
		public $vp_keywords;

		/**
		  *	 @var int`
		  */
		public $stream;

		/**
		  *	 @var int`
		  */
		public $category;

		/**
		  *	 @var int`
		  */
		public $subcategory;

		/**
		  *	 @var int`
		  */
		public $subject;

		/**
		  *	 @var string
		  */
		public $vp_url;

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
				$query = $this->db->query("SELECT * FROM premium_videos ORDER BY created_on DESC LIMIT ".$limit."");
			} else {
				$query = $this->db->query("SELECT * FROM premium_videos ORDER BY created_on DESC");
			}
			return $query->result_array();
		}

		public function update_video_package_by_id($vpid, $vp_name, $vp_duration, $vp_cost, $vp_desc, $vp_keywords, $stream, $category, $subcategory, $subject) {
				$data = array(
					"vp_name" =>  $vp_name,
					"vp_duration" => $vp_duration,
					"vp_cost" => $vp_cost,
					"vp_desc" => $vp_desc,
					"vp_keywords" => $vp_keywords,
					"stream" => $stream,
					"category" => $category,
					"subcategory" => $subcategory,
					"subject" => $subject,
					"updated_on" => date('Y-m-d H:i:s')
				);

				$this->db->update($this::TABLE_NAME, $data, array("vpid" => (int) $vpid));
				return $this->db->affected_rows();
		}


		public function filter_by_stream($stream = null) {
				if ($stream !== 0) {
						$query = $this->db->query("SELECT * FROM premium_videos WHERE stream = '$stream' ORDER BY updated_on DESC");
						return $query->result_array();
				} else {
						echo 0;
				}
		}

		public function filter_by_category($category = null) {
				if ($category !== 0) {
						$query = $this->db->query("SELECT * FROM premium_videos WHERE category = '$category' ORDER BY updated_on DESC");
						return $query->result_array();
				} else {
						echo 0;
				}
		}

		public function filter_by_subcategory($subcategory = null) {
				if ($subcategory !== 0) {
						$query = $this->db->query("SELECT * FROM premium_videos WHERE subcategory = '$subcategory' ORDER BY updated_on DESC");
						return $query->result_array();
				} else {
						echo 0;
				}
		}

		public function filter_by_subject($subject = null) {
				if ($subject !== 0) {
						$query = $this->db->query("SELECT * FROM premium_videos WHERE subject = '$subject' ORDER BY updated_on DESC");
						return $query->result_array();
				} else {
						echo 0;
				}
		}
	}

/* End of file */
