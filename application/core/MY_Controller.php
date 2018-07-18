<?php

	class MY_Controller extends CI_Controller {

		public $layout;

		public function __construct() {
			parent::__construct();
			$this->output->set_header("Access-Control-Allow-Origin: *");
			// $this->output->set_header('Access-Control-Allow-Methods: GET,POST');
			// $this->output->set_status_header(200);

			$this->layout = 'layout/master';
		}

	}

/* End of file */
