<?php

	class Cart extends MY_Model {

		const TABLE_NAME = 'cart';
		const TABLE_PK = 'cart_id';

		/**
		  *	 @var int
		  */
		public $cart_id;

		/**
		  *	 @var int
		  */
		public $uid;

		/**
		  *	 @var int
		  */
		public $pid;

    /**
		  *	 @var tinyint
		  */
		public $status;

    /**
		  *	 @var datetime
		  */
		public $added_on;

    /**
		  *	 @var datetime
		  */
		public $updated_on;


		// Member Functions
		public function count_cart($id) {
			$query = $this->db->query('SELECT * FROM cart WHERE uid = '.$id.' AND status = 0');
			echo $query->num_rows();
		}

		public function get_all_by_id($id) {
			$this->db->select();
			$this->db->from('cart');
			$this->db->where(array('uid' => (int) $id, 'status' => 0));
			$this->db->join('package', 'cart.pid = package.pid');

			$query = $this->db->get();

			$array1 = $query->result_array();

			$this->db->select('vpid as pid, vp_name as p_name, vp_cost as p_cost, cart_id,cart.pid,cart.status,cart.added_on,cart.updated_on');
			$this->db->from('cart');
			$this->db->where(array('uid' => (int) $id, 'status' => 0));
			$this->db->join('premium_videos', 'cart.pid = premium_videos.vpid');

			$query = $this->db->get();

			$array2 = $query->result_array();

			return array_merge($array1,$array2);

		}

		public function get_recent_transactions($id) {
			$this->db->select();
			$this->db->from('cart');
			$this->db->where(array('uid' => (int) $id, 'status' => 1));
			$this->db->join('package', 'cart.pid = package.pid');

			$query = $this->db->get();

			return $query->result_array();
		}

		public function user_purchased_package($id) {
			$this->db->select("cart_id, uid, cart.pid, cart.status, package.p_name, package.p_duration, package.p_cost, package.p_desc, package.p_keywords, package.p_smlist, package.p_type, package.stream, package.category, package.subcategory, package.subject, cart.updated_on");
			$this->db->from('cart');
			$this->db->where(array('uid' => (int) $id, 'status' => 1));
			$this->db->join('package', 'cart.pid = package.pid');

			$query = $this->db->get();

			return $query->result_array();
		}

		public function update_purchase_status($id){
			$data = array(
				"status" => 1
			);

			$this->db->update($this::TABLE_NAME, $data, array("uid" => (int) $id));
			return $this->db->affected_rows();
		}

		public function get_all_pv_orders()
		{
			$this->db->select();
			$this->db->from('cart');
			$this->db->where(array('status' => 1));
			$this->db->join('premium_videos', 'cart.pid = premium_videos.vpid');

			$query = $this->db->get();

			return $query->result_array();
		}
/////////////// admin orders
		public function get_orders($filter) {
			$query;

			// if ($filter == 'all') {
			// 		$query = $this->db->query("SELECT * FROM user INNER JOIN cart INNER JOIN package ON user.uid = cart.uid AND cart.pid=package.pid WHERE cart.status = 1");
			// }
			if ($filter == 'material') {
					$query = $this->db->query("SELECT * FROM user INNER JOIN cart INNER JOIN package ON user.uid = cart.uid AND cart.pid=package.pid WHERE cart.status = 1 AND cart.pid < 100000 order by cart_id DESC");
			}
			if ($filter == 'usb') {
					$query = $this->db->query("SELECT * FROM user INNER JOIN cart INNER JOIN premium_videos ON user.uid = cart.uid AND cart.pid=premium_videos.vpid WHERE cart.status = 1 AND cart.pid > 100000 order by cart_id DESC");
			}

			return $query->result_array();
		}		

	}

/* End of file */
