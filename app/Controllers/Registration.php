<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Registration extends BaseController
{
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);
		$this->user_role = TRUE;
	}

	public function index()
	{
		$data = [] ;
		$data['title'] = lang('static.registration.index.title');
		$data['user'] = $this->user_role;		
		$data['validation'] = NULL;
		
		if ($this->request->getMethod() === 'post') 
		{
			if (! $this->validate($this->validation->getRuleGroup('registration_rules'))) 
			{
				$data['validation'] = $this->validator;	
				return $this->load_view("registration", $data);
			}

			$user_data = [
				'id' => NULL,
				'name' => ucwords(trim($this->request->getVar('name', FILTER_SANITIZE_STRING))),
				'email' => strtolower(trim($this->request->getVar('email', FILTER_SANITIZE_EMAIL))),
				'password' => md5(trim($this->request->getVar('password'))),
			];

			//return true or false
			$result = $this->user->create($user_data);

			if ($result)
			{
				$this->session->setTempdata('message', lang('static.registration.index.message'), 3);
				return redirect()->to(base_url('login'));			
			}

			$this->session->setTempdata('error_message', lang('static.registration.index.error_message'), 3);
			return redirect()->to(base_url());
			
		}
		return $this->load_view('registration', $data);				
	}
}
