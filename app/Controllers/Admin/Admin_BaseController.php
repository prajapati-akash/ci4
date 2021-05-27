<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Admin_BaseController extends Controller
{
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		helper(['form', 'Form', 'text', 'html', 'url', 'My_encryption']);

		$this->session = \Config\Services::session();
		$this->validation = \config\Services::validation();
		$this->user = new \App\Models\User;
		$this->candidate = new \App\Models\Candidate;
	}

	public function load_view($view_name, $data = [])
	{
		echo view("include/header", $data);
		echo view($view_name);
		echo view("include/footer");
	}

	public function logout()
	{
		$this->session->setTempdata('message', lang('static.admin.dashboard.logout.message') , 1);
		$this->session->remove(['admin_id', 'admin_name']);
		return redirect()->route('admin_login');
	}
}
