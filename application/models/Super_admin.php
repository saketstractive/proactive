<?php 

	class Super_admin extends MY_Model {

		const TABLE_NAME = 'super_admin';
		const TABLE_PK = 'id';

		/**
		  *	 @var int
		  */
		public $id;

		/**
		  *	 @var string
		  */
		public $username;

		/**
		  *	 @var string
		  */
		public $password;


		// Member Functions

		public function authenticate($username, $password) {
			$row = $this->db->get_where($this::TABLE_NAME, array('username' => $username, 'password' => md5($password)))->result_array();
			if (count($row) == 1) {
				foreach ($row as $item) {
					$userdata = array(
						'id' => $item['id'],
						'user_type' => 0,
						'username' => $item['username']
					);
				}

				$this->session->set_userdata($userdata);
				return true;

			} else if (count($row) == 0) {
				return false;
			}
		}

		public function update_password($id, $password) {
			$data = array(
				"password" => md5($password)
			);

			$this->db->update($this::TABLE_NAME, $data, array("id" => (int) $id));
			return $this->db->affected_rows();
			
		}


	}

/* End of file */