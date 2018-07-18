<?php

	class Yt_videos extends MY_Model {

		const TABLE_NAME = 'yt_videos';
		const TABLE_PK = 'vid';

		/**
		  *	 @var int
		  */
		public $vid;

		/**
		  *	 @var string
		  */
		public $video_title;

		/**
		  *	 @var string
		  */
		public $video_desc;

    /**
		  *	 @var string
		  */
		public $video_url;

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
				$query = $this->db->query("SELECT * FROM yt_videos ORDER BY updated_on DESC LIMIT ".$limit."");
			} else {
				$query = $this->db->query("SELECT * FROM yt_videos ORDER BY updated_on DESC");
			}

			return $query->result_array();
		}


		public function get_video_data_by_id($id) {
			$this->db->select('*');
			$this->db->from('yt_videos');
			$this->db->where('vid', $id);

			$query = $this->db->get();
			return $query->result_array();
		}

		public function filter_by_stream($stream = null) {
				if ($stream !== 0) {
						$query = $this->db->query("SELECT * FROM yt_videos WHERE stream = '$stream' ORDER BY updated_on DESC");
						return $query->result_array();
				} else {
						echo 0;
				}
		}

		public function filter_by_category($category = null) {
				if ($category !== 0) {
						$query = $this->db->query("SELECT * FROM yt_videos WHERE category = '$category' ORDER BY updated_on DESC");
						return $query->result_array();
				} else {
						echo 0;
				}
		}

		public function filter_by_subcategory($subcategory = null) {
				if ($subcategory !== 0) {
						$query = $this->db->query("SELECT * FROM yt_videos WHERE subcategory = '$subcategory' ORDER BY updated_on DESC");
						return $query->result_array();
				} else {
						echo 0;
				}
		}

		public function filter_by_subject($subject = null) {
				if ($subject !== 0) {
						$query = $this->db->query("SELECT * FROM yt_videos WHERE subject = '$subject' ORDER BY updated_on DESC");
						return $query->result_array();
				} else {
						echo 0;
				}
		}


		// public function filter($stream = null, $category = null, $subcategory = null, $subject = null) {
		// 		if ($stream !== 0) {
		// 				$query = $this->db->query("SELECT * FROM yt_videos WHERE stream = '$stream' ORDER BY updated_on DESC");
		// 				return $query->result_array();
		// 		} else if ($category !== 0) {
		// 				$query = $this->db->query("SELECT * FROM yt_videos WHERE category = '$category' ORDER BY updated_on DESC");
		// 				return $query->result_array();
		// 		} else if ($subcategory !== 0) {
		// 				$query = $this->db->query("SELECT * FROM yt_videos WHERE subcategory = '$subcategory' ORDER BY updated_on DESC");
		// 				return $query->result_array();
		// 		} else if ($subject !== 0) {
		// 				$query = $this->db->query("SELECT * FROM yt_videos WHERE subject = '$subject' ORDER BY updated_on DESC");
		// 				return $query->result_array();
		// 		} else {
		// 				return 0;
		// 		}
		// }

	}

/* End of file */
