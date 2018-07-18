<?php

	class Usermodel extends MY_Model {

		const TABLE_NAME = 'user';
		const TABLE_PK = 'uid';

		/**
		  *	 @var int
		  */
		public $uid;

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
		public $password;

		/**
		  *	 @var string
		  */
		public $contact;

		/**
		  *	 @var int
		  */
		public $user_stream;

		/**
		  *	 @var string
		  */
		public $address;

		/**
		  *	 @var string
		  */
		public $city;

		/**
		  *	 @var string
		  */
		public $district;

		/**
		  *	 @var string
		  */
		public $state;

		/**
		  *	 @var string
		  */
		public $dob;

		/**
		  *	 @var string
		  */
		public $qualification;

		/**
		  *	 @var string
		  */
		public $gender;

		/**
		  *	 @var tinyint
		  */
		public $usertype;

		/**
		  *	 @var string
		  */
		public $verification_key;

		/**
		  *	 @var tinyint
		  */
		public $is_verified;

		/**
		  *	 @var datetime
		  */
		public $created_on;

		/**
		  *	 @var datetime
		  */
		public $updated_on;


		// Member Functions
		public function authenticate($res_user, $res_password) {

			$query = $this->db->query("SELECT * FROM resource WHERE res_user = '".$res_user."' AND res_password = '".md5($res_password)."' LIMIT 1");

			if ($query->num_rows() == 1) {
			 	$row = $query->row();

			 		$userdata = array(
						'uid' => $row->uid,
						'user_type' => 1,
						'res_user' => $row->res_user,
						'fullname' => $row->fullname,
						'stream' => $row->user_stream,
						'is_verified' => $row->is_verified
					);

					$this->session->set_userdata($userdata);
			 		return 1;


			} else {	return 0; }

		}

		public function email_exist($email) {
			$query = $this->db->query("SELECT * FROM user WHERE email = '".$email."'");

			if ($query->num_rows() > 0) {
				return true;
			} else {
				return false;
			}
		}

		public function verify() {
			$this->db->set('is_verified', 1);
			$this->db->where('verification_key', $this->input->get("k"));

			return $this->db->update($this::TABLE_NAME);
		}

		public function update_password($id, $password) {
			$data = array(
				"password" => $password,
				"updated_on" => date('Y-m-d H:i:s')
			);

			$this->db->update($this::TABLE_NAME, $data, array("uid" => (int) $id));
			return $this->db->affected_rows();

		}

		public function reset_password($k, $password) {
			$data = array(
				"password" => $password,
				"updated_on" => date('Y-m-d H:i:s')
			);

			$this->db->update($this::TABLE_NAME, $data, array("verification_key" => $k));
			return $this->db->affected_rows();

		}

		public function get_all_by_id($id) {
			$this->db->select();
			$this->db->from('user');
			$this->db->join('stream', 'user.user_stream = stream.stream_id');
			$this->db->where('uid', $id);

			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_user_bill_details_by_id($id) {
			$this->db->select('fullname, email, contact');
			$this->db->from('user');
			$this->db->where('uid', $id);

			$query = $this->db->get();
			return $query->result_array();
		}

		public function update_profile_id($id, $col_name, $col_value) {
			$data = array(
				$col_name => $col_value,
				"updated_on" => date('Y-m-d H:i:s')
			);

			$this->db->update($this::TABLE_NAME, $data, array("uid" => (int) $id));
			return $this->db->affected_rows();
		}

		public function get_subscribers($filter) {
			$query;

			if ($filter == 'all') {
					$query = $this->db->query("SELECT * FROM user");
			}
			if ($filter == 'non_premium') {
					$query = $this->db->query("SELECT * FROM user INNER JOIN cart ON user.uid = cart.uid WHERE cart.status = 0 GROUP BY user.fullname");
			}
			if ($filter == 'premium') {
					$query = $this->db->query("SELECT * FROM user INNER JOIN cart ON user.uid = cart.uid WHERE cart.status = 1 GROUP BY user.fullname");
			}
			if ($filter == 'non_verified') {
					$query = $this->db->query("SELECT * FROM user WHERE is_verified = 0");
			}
			if ($filter == 'verified') {
					$query = $this->db->query("SELECT * FROM user WHERE is_verified = 1");
			}

			return $query->result_array();
		}

	}

/* End of file */
