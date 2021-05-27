<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class BaseController extends Controller
{
	// protected $helpers = ['form','Form'];
	protected $helpers = (['form', 'text', 'url', 'number', 'inflector', 'html', 'My_encryption']);

	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		// load model
		$this->user = new \App\Models\User;
		$this->candidate = new \App\Models\Candidate;
	
		//load service	
		$this->session = \Config\Services::session();
		$this->security = \Config\Services::security();
		$this->validation = \config\Services::validation();

	}

	public function load_view($view_name, $data = [])
	{
		echo view("include/header", $data);
		echo view($view_name);
		echo view("include/footer");
	}

	public function logout()
	{
		$this->session->setTempdata('message', lang('static.dashboard.logout.message'), 1);
		$this->session->remove(['user_id', 'user_name']);
		return redirect()->route('user_login');
	}
}
