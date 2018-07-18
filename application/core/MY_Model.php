<?php 

	class MY_Model extends CI_Model {

		const TABLE_NAME = 'abstract';
		const TABLE_PK = 'abstract';


		private function insert() {
			$this->db->insert($this::TABLE_NAME, $this);
			$this->{$this::TABLE_PK} = $this->db->insert_id();
		}

		private function update() {
			$this->db->update($this::TABLE_NAME, $this, array($this::TABLE_PK => $this->{$this::TABLE_PK}));
			return $this->db->affected_rows();

			$err_msg = array();
			$err_msg['error'] = $this->db->_error_number();
			$err_msg['message'] = $this->db->_error_message();
			return $err_msg;
		}

		public function save() {
			if (isset($this->{$this::TABLE_PK})) {
				return $this->update();
			} else {
				$this->insert();
				return $this->db->affected_rows();
			}
		}

		public function delete() {
			$this->db->delete($this::TABLE_NAME, array(
					$this::TABLE_PK => $this->{$this::TABLE_PK},
				));
			unset($this->{$this::TABLE_PK});
			return $this->db->affected_rows();
		}

		public function get_one($id) {
			$query = $this->db->get_where($this::TABLE_NAME, array(
					$this::TABLE_PK => $id,
				));
			return $query->result_array();
		}

		public function populate($row) {
			foreach ($row as $key => $value) {
				$this->$key = $value;
			} 
		}

		public function enum_entries($rows,$colid) { // enumeration added by Saket
			$output = array();
			foreach ($rows as $r) {
				$output[$r[$colid]] = $r;
			}
			return $output; 
		}

		public function get_all($limit = 0, $offset = 0) {
			if ($limit) {
				$query = $this->db->get($this::TABLE_NAME, $limit, $offset);
			} else {
				$query = $this->db->get($this::TABLE_NAME);
			}

			$return_value = array();
			$class = get_class($this);
			foreach ($query->result() as $row) {
				$model = new $class;
				$model->populate($row);
				$return_value[$row->{$this::TABLE_PK}] = $model;
			}

			return $return_value;	
		}

	}

/* End of file */