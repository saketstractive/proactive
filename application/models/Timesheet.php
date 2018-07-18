<?php

	class Timesheet extends MY_Model {

		const TABLE_NAME = 'timesheet';
		const TABLE_PK = 'tm_id';

		/**
		  *	 @var int
		  */
		public $tm_id;

		/**
		  *	 @var int
		  */
		public $tm_week;
		
		/**
		  *	 @var string
		  */
		public $tm_day;

		/**
		  *	 @var int
		  */
		public $tm_proid;

		/**
		  *	 @var int
		  */
		public $tm_resid;

		/**
		  *	 @var date
		  */
		public $tm_date;

		/**
		  *	 @var int
		  */
		public $tm_hours;

		/**
		  *	 @var string
		  */
		public $tm_description;

		/**
		  *	 @var int
		  */
		public $tm_approved;

		/**
		  *	 @var int
		  */
		public $tm_approval_by;

		/**
		  *	 @var datetime
		  */
		public $tm_date_created;

		/**
		  *	 @var datetime
		  */
		public $tm_date_modified;


		// Member Functions

		public function get_all_by_uid($id) {
			$this->db->select();
			$this->db->from('timesheet');
			$this->db->join('project', 'timesheet.tm_proid = project.pro_id');
			$this->db->where('tm_resid', $id);

			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_project_history_with_week($uid=0, $pid, $approve=0){
			// $this->db->select('tm_week,SUM(tm_hours) as hrs, BIT_AND(tm_approved) as clr, GROUP_CONCAT(DISTINCT tm_description SEPARATOR \' \') as wdesc, tm_proid, pro_title, pro_client, res_name as resourc');
			//Commented old query. Seperating resources in new query < CANCELLED
			$this->db->select('tm_week,SUM(tm_hours) as hrs, BIT_AND(tm_approved) as clr, GROUP_CONCAT(DISTINCT tm_description SEPARATOR \' \') as wdesc, tm_proid, pro_title, pro_client, GROUP_CONCAT(res_name SEPARATOR \',\') as resourc');
			$this->db->from('timesheet');

			// $this->db->join('project_resource', 'timesheet.tm_proid = project_resource.pro_id');
			$this->db->join('project', 'timesheet.tm_proid = project.pro_id');
			$this->db->join('resource', 'timesheet.tm_resid = resource.res_id');
			
			$this->db->where('timesheet.tm_proid', $pid);	

			// if ($uid != 0 && $approve == 0) {
			// $this->db->where('resource.res_id', $uid);
			// }
			
			$this->db->group_by('tm_week,tm_proid');

			$query = $this->db->get();
			$arr = $query->result_array();
			foreach ($arr as $indx => $row) {
				$tmp = explode(",", $row['resourc']);
				foreach ($tmp as $key => $value) {
					$tmp[$key] = trim($value);
				}
				$arr[$indx]['resourc'] = implode(",", array_unique($tmp));

			}
			echo json_encode($arr);			
		}

		public function get_project_history_in_week($uid=0, $pid, $week, $approve=0){
			$this->db->select();
			$this->db->from('timesheet');
			// $this->db->join('project_resource', 'timesheet.tm_proid = project_resource.pro_id');
			$this->db->join('project', 'timesheet.tm_proid = project.pro_id');
			$this->db->join('resource', 'timesheet.tm_resid = resource.res_id');
			$this->db->join('rejection_history', 'timesheet.tm_id = rejection_history.tmsht_id AND rej_id IN (SELECT r.rej_id FROM `rejection_history` r LEFT JOIN `rejection_history` q ON r.tmsht_id = q.tmsht_id AND r.rej_id < q.rej_id WHERE q.rej_id is NULL )');

			$this->db->where('timesheet.tm_proid', $pid);	
			$this->db->where('timesheet.tm_week', $week);	
			if ($uid != 0 && $approve == 0) {
			$this->db->where('timesheet.tm_resid', $uid);
			}
			else{
			$this->db->order_by('timesheet.tm_approved','DESC');	
			}

			$query = $this->db->get();
			// die(var_dump($query->result_array()));
			$output = $query->result_array();
			$output['approver'] = 0;
			if ($uid > 0 && $approve == 1) {
			 	$approver_exists = $this->db->query("select * from project_resource WHERE prore_resid='$uid' AND prore_proid='$pid' AND prore_approver='1'");
			 	if (count($approver_exists->result_array()) > 0) { $output['approver'] = 1;	}
			 } 
			return $output;			
		}

		public function get_approved_history($pid){
			$this->db->select('SUM(tm_hours) as hrs, GROUP_CONCAT(DISTINCT tm_description SEPARATOR \' \') as wdesc, res_name');
			$this->db->from('timesheet');

			// $this->db->join('project_resource', 'timesheet.tm_proid = project_resource.pro_id');
			$this->db->join('project', 'timesheet.tm_proid = project.pro_id');
			$this->db->join('resource', 'timesheet.tm_resid = resource.res_id');
			
			$this->db->where('timesheet.tm_proid', $pid);	
			
			$this->db->group_by('res_name');

			$query = $this->db->get();
			$arr = $query->result_array();
		}

		public function get_timesheet_by_week($week, $uid, $approve=0)
		{
			$res = $approval = $grp_approval = "";
			if ($uid > 0 && $approve == 0) {
				$approval = "`tm_approved`";
				$res = "AND t.tm_resid='$uid'";
				$grp_approval = $approval;
			}
			else $approval = "MAX(`tm_approved`) as clr";

			$query = $this->db->query("SELECT `tm_week`,`tm_day`,SUM(`tm_hours`) AS wrk,`tm_proid`,`tm_resid`,`tm_description`,`tm_date`, $approval FROM `timesheet` AS t INNER JOIN project as p ON t.tm_proid=p.pro_id WHERE t.tm_week='$week' $res GROUP BY `tm_resid`,`tm_proid`,`tm_description`,`tm_date`,`tm_day`, $grp_approval");
			return $query->result_array();

		}

		public function get_resource_history($uid, $start, $end, $approve=0){
			$dt = explode("-", $start);
			$wdays = $this->countWorkDays($dt[0], $dt[1], array(0, 6));
			$this->db->select($wdays.' as wdays, SUM(tm_hours) as hrs,MIN(tm_date) as start,MAX(tm_date) as end, GROUP_CONCAT(DISTINCT tm_description SEPARATOR \' \') as wdesc, tm_proid, pro_title, pro_client, tm_resid,res_name,res_base,IF(pro_billable=\'1\',res_bonus,0) as bonus');
			$this->db->from('timesheet');

			$this->db->join('project', 'timesheet.tm_proid = project.pro_id');
			$this->db->join('resource', 'timesheet.tm_resid = resource.res_id');
			// $this->db->join('project_resource', 'prore_resid = resource.res_id');
			
			if ($uid != 0 && $approve == 0) {
			$this->db->where('resource.res_id', $uid);
			$this->db->where('timesheet.tm_approved', '1');
			$this->db->where('timesheet.tm_date >=', $start);
			$this->db->where('timesheet.tm_date <=', $end);
			}
			
			$this->db->group_by('tm_proid,tm_resid');

			$query = $this->db->get();

			// die(var_dump($query->result_array()));
			echo json_encode($query->result_array());			
		}

		public function get_resource_history_project($uid, $start, $end, $pid){
			$dt = explode("-", $start);
			$wdays = $this->countWorkDays($dt[0], $dt[1], array(0, 6));
			$this->db->select($wdays.' as wdays, tm_hours as hrs,tm_date, tm_description as wdesc, tm_proid, pro_title, pro_client, res_name,res_base,IF(pro_billable=\'1\',res_bonus,0) as bonus');
			$this->db->from('timesheet');

			$this->db->join('project', 'timesheet.tm_proid = project.pro_id');
			$this->db->join('resource', 'timesheet.tm_resid = resource.res_id');
			
			$this->db->where('timesheet.tm_resid', $uid);
			$this->db->where('timesheet.tm_proid', $pid);
			$this->db->where('timesheet.tm_approved', '1');
			$this->db->where('timesheet.tm_date >=', $start);
			$this->db->where('timesheet.tm_date <=', $end);
			
			// $this->db->group_by('tm_date');

			$query = $this->db->get();
			echo json_encode($query->result_array());			
		}

		public function approve_entry($eid, $flag, $reason){
			$uid = $this->session->userdata('uid');
			$query = $this->db->query("UPDATE timesheet SET tm_approved='$flag', tm_approval_by='$uid', tm_date_modified='".date('Y-m-d H:i:s')."' WHERE tm_id='$eid'");
			$query = $this->db->query("INSERT INTO rejection_history(tmsht_id,reason,date_time_stamp) VALUES ('$eid','$reason','".date("Y-m-d H:i:s")."')");

		}

		public function clean_entries(){
			//delete 0 hours
			$this->db->query("DELETE FROM `timesheet` WHERE `tm_hours`='0'");
			$query = $this->db->query("SELECT MAX(tm_id) as maxid FROM `timesheet`");
			$arr = $query->result_array();
			$next = $arr[0]['maxid'] + 1;
			// set auto incerment again
			$this->db->query("ALTER TABLE `timesheet` AUTO_INCREMENT = ".$next);
			//delete 0 hour history also
			$this->db->query("DELETE FROM rejection_history WHERE tmsht_id NOT IN (SELECT tm_id FROM timesheet)");
			$query = $this->db->query("SELECT MAX(tmsht_id) as maxid FROM `rejection_history`");
			$arr = $query->result_array();
			$next = $arr[0]['maxid'] + 1;
			$this->db->query("ALTER TABLE `rejection_history` AUTO_INCREMENT = ".$next);

			

		}		

		public function isWorkExists(){
			$query = $this->db->query("SELECT * FROM timesheet WHERE tm_week='".$this->tm_week."' AND tm_proid='".$this->tm_proid."' AND tm_resid='".$this->tm_resid."' AND tm_date='".$this->tm_date."'");
			
			return $query->result_array();
		}

		public function getFilteredEntries()
		{
			$this->db->select('SUM(tm_hours) as hrs, GROUP_CONCAT(DISTINCT tm_description SEPARATOR \' \') as wdesc, res_name');
			$this->db->from('timesheet');

			// $this->db->join('project_resource', 'timesheet.tm_proid = project_resource.pro_id');
			$this->db->join('project', 'timesheet.tm_proid = project.pro_id');
			$this->db->join('resource', 'timesheet.tm_resid = resource.res_id');
			
			$this->db->where('timesheet.tm_proid', $this->tm_proid);	
			$this->db->where('timesheet.tm_approved', $this->tm_approved);	
			
			$this->db->group_by('tm_week,tm_proid,res_name');

			$query = $this->db->get();
			$arr = $query->result_array();
			return $arr;	
			
		}

		public function get_resource_utilisation($data){
			$start = $data['start'];
			$end = $data['end'];
			$range = "";
			if ($data['rtype'] == "week") {
				$range =  " AND tm_week >= '$start' AND tm_week <= '$end'";	
			}
			else if($data['rtype'] == "date")
			{
				$range =  " AND tm_date >= '$start' AND tm_date <= '$end'";	
			}
			$query = $this->db->query('SELECT res_name, res_id, SUM(tm_hours) as work FROM resource LEFT JOIN timesheet ON res_id=tm_resid WHERE tm_approved = 1'.$range.' GROUP BY res_name,res_id');
				$resources = $query->result_array();
				return $this->enum_entries($resources, "res_id");
		}

		public function countWorkDays($year, $month, $ignore) {
		    $count = 0;
		    $counter = mktime(0, 0, 0, $month, 1, $year);
		    while (date("n", $counter) == $month) {
		        if (in_array(date("w", $counter), $ignore) == false) {
		            $count++;
		        }
		        $counter = strtotime("+1 day", $counter);
		    }
		    return $count;
			//workHours = 8 * countWorkDays($year, $month, array(0, 6)); 
		}

		public function blank_history()
		{ // set history for the first time
			$eid = $this->tm_id;
			$reason = "NA";
			$query = $this->db->query("INSERT INTO rejection_history(tmsht_id,reason,date_time_stamp) VALUES ('$eid','$reason','".date("Y-m-d H:i:s")."')");
		}


	}

/* End of file */
