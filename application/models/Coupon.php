<?php

	class Coupon extends MY_Model {

		const TABLE_NAME = 'coupon';
		const TABLE_PK = 'coupon_id';

		/**
		  *	 @var int
		  */
		public $coupon_id;

		/**
		  *	 @var string
		  */
		public $coupon_code;

		/**
		  *	 @var int
		  */
		public $coupon_disc;

    	/**
		  *	 @var string
		  */
		public $coupon_desc;

		/**
		  *	 @var boolean
		  */
		public $coupon_type;

    	/**
		  *	 @var datetime
		  */
		public $coupon_validity;

    	/**
		  *	 @var datetime
		  */
		public $created_on;


		// Member Functions
		public function check_coupon_code($code) {
			$query = $this->db->query('SELECT * FROM coupon WHERE coupon_code = \''.$code.'\' AND coupon_validity >= \''.date('Y-m-d').'\'');
			return $query->result_array();
		}

	}

/* End of file */
