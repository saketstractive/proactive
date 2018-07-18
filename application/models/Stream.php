<?php 

	class Stream extends MY_Model {

		const TABLE_NAME = 'stream';
		const TABLE_PK = 'stream_id';

		/**
		  *	 @var int
		  */
		public $stream_id;

		/**
		  *	 @var string
		  */
		public $stream_name;

		/**
		  *	 @var string
		  */
		public $stream_desc;


		// Member Functions

		public function update_stream_by_id($stream_id, $stream_name) {
			$data = array(
				"stream_name" => $stream_name
			);

			$this->db->update($this::TABLE_NAME, $data, array("stream_id" => (int) $stream_id));
			return $this->db->affected_rows();
		}

		


	}

/* End of file */