<?php

	class Ebooks extends MY_Model {

		const TABLE_NAME = 'ebooks';
		const TABLE_PK = 'bid';

		/**
		  *	 @var int
		  */
		public $bid;

		/**
		  *	 @var string
		  */
		public $book_title;

		/**
		  *	 @var string
		  */
		public $book_filename;

    /**
		  *	 @var int
		  */
		public $stream_id;

    /**
		  *	 @var int
		  */
		public $cat_id;

    /**
		  *	 @var int
		  */
		public $subcat_id;

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
  				$query = $this->db->query("SELECT * FROM ebooks, subject WHERE ebooks.subject_id = subject.subject_id ORDER BY bid DESC LIMIT ".$limit."");
  			} else {
  				$query = $this->db->query("SELECT * FROM ebooks, subject WHERE ebooks.subject_id = subject.subject_id ORDER BY bid DESC");
  			}

  			return $query->result_array();
		}

		public function get_all_desc($limit = 0) {
				$query = $this->db->query("SELECT * FROM ebooks ORDER BY uploaded_on DESC");
				return $query->result_array();
		}

		public function get_all_by_id($id)
		{
			$this->db->select();
			$this->db->from('ebooks');
			$this->db->where(array('stream_id' => (int) $id));
			

			$query = $this->db->get();

			return $query->result_array();
		}

    public function update_ebook_by_id($bid, $book_title) {
			$data = array(
				"book_title" => $book_title,
        "updated_on" => date('Y-m-d H:i:s')
			);

			$this->db->update($this::TABLE_NAME, $data, array("bid" => (int) $bid));
			return $this->db->affected_rows();
		}

	}

/* End of file */
