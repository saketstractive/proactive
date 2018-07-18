<?php

	class Invoices extends MY_Model {

		const TABLE_NAME = 'invoices';
		const TABLE_PK = 'inv_id';

		/**
		  *	 @var int
		  */
		public $inv_id;

		/**
		  *	 @var int
		  */
		public $inv_proid;
		
		/**
		  *	 @var string
		  */
		public $inv_date;
		
		/**
		  *	 @var string
		  */
		public $inv_number;

		/**
		  *	 @var int
		  */
		public $inv_total;		

		/**
		  *	 @var int
		  */
		public $inv_amount;

			
		/**
		  *	 @var datetime
		  */
		public $inv_date_created;

		/**
		  *	 @var datetime
		  */
		public $inv_date_modified;


		// Member Functions

		public function get_all_invoices(){
			$query = $this->db->query("SELECT * FROM invoices LEFT JOIN project ON invoices.inv_proid = project.pro_id");
			return $query->result_array();
		}

		public function isInvoiceExists(){
			$query = $this->db->query("SELECT * FROM invoices WHERE inv_date='".$this->inv_date."' AND inv_proid='".$this->inv_proid."' AND inv_amount='".$this->inv_amount."'");
			
			return $query->result_array();
		}
	}

/* End of file */
