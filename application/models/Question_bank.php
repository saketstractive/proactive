<?php

	class Question_bank extends MY_Model {

		const TABLE_NAME = 'question_bank';
		const TABLE_PK = 'qid';

		/**
		  *	 @var int
		  */
		public $qid;

		/**
		  *	 @var string
		  */
		public $question;

		/**
		  *	 @var string
		  */
		public $opt1;

    /**
		  *	 @var string
		  */
		public $opt2;

    /**
		  *	 @var string
		  */
		public $opt3;

    /**
		  *	 @var string
		  */
		public $opt4;

    /**
		  *	 @var tinyint
		  */
		public $answer;

    /**
		  *	 @var string
		  */
		public $solution;

    /**
		  *	 @var int
		  */
		public $subject_id;

    /**
		  *	 @var datetime
		  */
		public $created_on;

    /**
		  *	 @var datetime
		  */
		public $updated_on;


		// Member Functions
		public function add_questions_to_db($result_arr, $sub_id) {
				$count = 0;
				foreach ($result_arr as $value) {
						// die(var_dump($value));
						// $array = explode(";", $value[0]);
						$data = array(
									'question' => $value[0],
									'opt1' => $value[1],
									'opt2' => $value[2],
									'opt3' => $value[3],
									'opt4' => $value[4],
									'answer' => $value[5],
									'solution' => $value[6],
									'subject_id' => $sub_id,
									'created_on' => date('Y-m-d H:i:s'),
									'updated_on' => date('Y-m-d H:i:s')
						);

						$this->db->insert('question_bank', $data);
						$count++;
				}

				if (count($result_arr) == $count) {
					return true;
				} else {
					return false;
				}
		}

		public function get_all_desc($limit = 0) {
			if ($limit) {
				$query = $this->db->query("SELECT * FROM question_bank ORDER BY updated_on DESC LIMIT ".$limit."");
			} else {
				$query = $this->db->query("SELECT * FROM question_bank ORDER BY updated_on DESC");
			}

			return $query->result_array();
		}

		public function get_all_subjectwise($limit = 0, $id) {
			if ($limit) {
				$query = $this->db->query("SELECT * FROM question_bank WHERE subject_id = ".$id." ORDER BY updated_on DESC LIMIT ".$limit."");
			} else {
				$query = $this->db->query("SELECT * FROM question_bank WHERE subject_id = ".$id." ORDER BY updated_on DESC");
			}

			return $query->result_array();
		}

		public function get_all_testwise($pid) {
				
				$query = $this->db->query("SELECT p_smlist,subject_id FROM package INNER JOIN subject ON (package.subject=subject.subject_name) WHERE package.pid='$pid' LIMIT 1");
				$arr = $query->result_array();
				$subject_id = $arr[0]["subject_id"];
				$chklist =  $arr[0]["p_smlist"];

				$query = $this->db->query("SELECT *,'0' as chk FROM question_bank WHERE subject_id = ".$subject_id." AND qid NOT IN ($chklist) UNION SELECT *,'1' as chk FROM question_bank WHERE subject_id = ".$subject_id." AND qid IN ($chklist)");
				
			return $query->result_array();
		}

		public function get_correct_ans($q_arr)
		{
			$query = $this->db->query("select answer from question_bank where concat(',','".$q_arr."',',') LIKE concat(\"%,\",`qid`,\",%\")");
			return $query->result_array();
		}

		public function load_single($qid)
		{
			$query = $this->db->query("select * from question_bank where `qid`='$qid'");
			return $query->result_array();
		}

	}

/* End of file */
