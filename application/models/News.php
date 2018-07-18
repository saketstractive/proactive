<?php

	class News extends MY_Model {

		const TABLE_NAME = 'news';
		const TABLE_PK = 'news_id';

		/**
		  *	 @var int
		  */
		public $news_id;

		/**
		  *	 @var string
		  */
		public $news_title;

		/**
		  *	 @var string
		  */
		public $news_desc;

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
				$query = $this->db->query("SELECT * FROM news ORDER BY updated_on DESC LIMIT ".$limit."");
			} else {
				$query = $this->db->query("SELECT * FROM news ORDER BY updated_on DESC");
			}

			return $query->result_array();
		}
		// function get_all can be used for fetch all news items in asc order

		public function get_all_enable() {
				$query = $this->db->query("SELECT * FROM news WHERE status = 1 ORDER BY updated_on DESC");
				return $query->result_array();
		}

		public function toggle($id) {
			$this->db->query("UPDATE news SET status = !status, updated_on = '".date('Y-m-d H:i:s')."' WHERE news_id = $id");
			return $this->db->affected_rows();
		}

		public function update_news_by_id($news_id, $news_title, $news_desc) {
			$data = array(
				"news_title" => $news_title,
				"news_desc" => $news_desc,
				"updated_on" => date('Y-m-d H:i:s')
			);

			$this->db->update($this::TABLE_NAME, $data, array("news_id" => (int) $news_id));
			return $this->db->affected_rows();
		}

	}

/* End of file */
