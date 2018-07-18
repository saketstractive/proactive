<?php

	class Transactions extends MY_Model {

		const TABLE_NAME = 'transactions';
		const TABLE_PK = 'tid';

		/**
		  *	 @var int
		  */
		public $tid;

		/**
		  *	 @var string
		  */
		public $txnid;

		/**
		  *	 @var string
		  */
		public $fullname;

    	/**
		  *	 @var string
		  */
		public $email;

    	/**
		  *	 @var string
		  */
		public $contact;

    	/**
		  *	 @var int
		  */
		public $amount;

		/**
		  *	 @var tinyint
		  */
		public $status;

		/**
		  *	 @var datetime
		  */
		public $created_on;

		/**
		  *	 @var datetime
		  */
		public $updated_on;


		// Member Functions
		

		public function update_txn_status($id){
			$data = array(
				"status" => 1
			);

			$this->db->update($this::TABLE_NAME, $data, array("txnid" => (int) $id));
			return $this->db->affected_rows();
		}


	}

/* End of file */
