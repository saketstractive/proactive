<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Site extends MY_Controller {

		public function __construct() {
			parent::__construct();
		}

		public function index() {
			if ($this->session->has_userdata('uid')) {
		        redirect('user/');
		    	}
			if($this->session->has_userdata("password") && $this->session->userdata("password") == "Changed")
			{
				$data['msg'] = "Please login with new password";
				$this->session->set_userdata("password","");
			}
			else{
			$this->session->userdata();
			}
			$data['content'] = 'pages/login';
			$this->load->view($this->layout, $data);
		}

		
		public function forgot() {
			$data['title'] = "Forgot your password?";

			$data['content'] = 'pages/forgot_password';
			$this->load->view($this->layout, $data);
		}

		public function error404() {
			$data['title'] = "Error 404 - Page Not Found";

			$data['content'] = 'layout/error_page';
			$this->load->view($this->layout, $data);
		}


		//
		// User Registration and Authentication
		//



		public function auth_user() {
			$this->load->model('Resource');
			$flag = $this->Resource->authenticate($this->input->post("user"), $this->input->post("password"));

			if($flag == 1) {
				redirect(site_url("user/"));
				exit();
			}
			if($flag == 0) {
				$data['title'] = "Login Failed - Stractive Proactive";
				$data['error_status'] = 0;
			}

			$data['content'] = 'pages/login_message';
			$this->load->view($this->layout, $data);

		}


		public function sendPasswordLink() {
			$this->load->library('email');

			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'mail.stractive.com';
			$config['smtp_port'] = '2525';
			$config['smtp_user'] = 'noreply@stractive.com';
			$config['smtp_pass'] = 'stractive123';
			$config['smtp_timeout'] = 30;
			$config['mailtype'] = 'html';
			$config['charset'] = 'iso-8859-1';
			$config['newline'] = '\r\n';
			$config['wordwrap'] = TRUE;

			$this->email->initialize($config);

			$message = "";

			$this->email->from('noreply@stractive.com', 'Stractive Proactive');
			$this->email->to($this->input->post("email"));
			$this->email->subject('Reset Your Password - Proactive by Stractive');

			$url = site_url("site/resetpassword")."?token=".md5($this->input->post("email"));

			$message = 'Hi,<br /><br />

	        			Please click this link to reset your account password:<br />
								<a href="'.$url.'" target="_blank">Reset your password.</a><br /><br />

								Regards,<br />
								Team Proactive';

			$this->email->message($message);

			if($this->email->send()) {
				echo 1;
			} else {
				echo 0;
			}
		}


		public function resetpassword() {
			$token = $this->input->get("token");

			$data['title'] = "Reset Your Password - Stractive Proactive";

			$data['content'] = 'pages/reset_password';
			$this->load->view($this->layout, $data);
		}


		public function reset_user_password() {
			$this->load->model('Resource');
			$status = $this->Resource->reset_password($this->input->post("k"), md5($this->input->post("new_password")));

				if ($status) {
					echo 1;
				} else {
					echo 0;
				}
			}

		public function sign_out() {
		   	$this->session->unset_userdata(array('uid','user_type','user','fullname'));
		   	redirect('site/');
		}	


	}


/* End of file */
