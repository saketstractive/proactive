<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Viewer extends CI_Controller {

		public function __construct() {
			parent::__construct();
		}

		public function index() {

		}

		public function view($filename) {

			$data["filename"] = $filename;

			$this->load->view("viewer/read", $data);
		}

	}