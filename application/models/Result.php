<?php 

	class Result extends MY_Model {

		const TABLE_NAME = 'result';
		const TABLE_PK = 'rid';

		/**
		  *	 @var int
		  */
		public $rid;

		/**
		  *	 @var int
		  */
		public $uid;

		/**
		  *	 @var int
		  */
		public $pid;

		/**
		  *	 @var string
		  */
		public $correct_ans_arr;

		/**
		  *	 @var string
		  */
		public $attempt_ans_arr;

		/**
		  *	 @var int
		  */
		public $score;

		/**
		  *	 @var datetime
		  */
		public $created_on;

		// Member Functions


public function get_result_list($uid) {
			$query = $this->db->query('SELECT result.rid,result.score,package.p_name, result.created_on FROM result INNER JOIN package WHERE uid = '.$uid.' AND result.pid = package.pid');
			return $query->result_array();
		}


public function get_last_result_id($uid) {
			$query = $this->db->query('SELECT result.rid FROM result WHERE uid = '.$uid.' ORDER BY rid DESC LIMIT 1 ');
			$arr = $query->result_array();
			return $arr[0]['rid'];
		}
public function get_result_by_id($rid,$uid)
		{
			$query = $this->db->query('SELECT * FROM result INNER JOIN package WHERE p_type=1 AND package.pid=result.pid AND result.rid = '.$rid.' AND result.uid='.$uid);
			$array = $query->result_array();

			///Now get the questions
			$query = $this->db->query('SELECT * FROM question_bank WHERE qid IN ('.$array[0]['p_smlist'].')');
			
		 	$array['questions'] = $query->result_array();

			return $array;
		}
				

	}



/* End of file */