<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

	function __construct()
	{
		parent:: __construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->helper('captcha');

		$vals = array(
			'img_path' => './captcha/',
			'img_url' => base_url().'captcha/',
			'expiration' => 7200,
			'word_lenght' => 8,
			'font_size' => 22
		);

		$cap = create_captcha($vals);
		$data['captcha'] = $cap['image'];
		$this->session->set_userdata('captchaWord', $cap['word']);

		$this->load->view('layout/header');
		$this->load->view('blog/index', $data);
		$this->load->view('layout/footer');
	}

	public function refresh_captcha(){
		$this->load->helper('captcha');
		$vals = array(
				'img_path' => './captcha/',
				'img_url' => base_url().'captcha/',
				'expiration' => 7200,
				'word_lenght' => 8,
				'font_size' => 22
		);

		$cap = create_captcha($vals);
		$this->session->set_userdata('captchaWord', $cap['word']);
		echo $cap['image'];
	}

	public function submit(){
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|callback_matching_captcha');

		if($this->form_validation->run()){
			$data['name'] = $this->input->post('name');
			$data['email'] = $this->input->post('email');

			$this->load->view('layout/header');
			$this->load->view('blog/success_view', $data);
			$this->load->view('layout/footer');
		}else{
			$this->index();
		}
	}

	public function matching_captcha($str){
		if(strtolower($str) != strtolower($this->session->userdata('captchaWord'))){
			$this->form_validation->set_message('matching_captcha', 'The {field} did not matching');
			return false;
		}else{
			return true;
		}
	}
}
