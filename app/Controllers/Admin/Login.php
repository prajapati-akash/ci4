<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Login extends Admin_BaseController
{
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		$this->image = \Config\Services::image();
		$this->admin_role = TRUE;
	}
	
	public function index()
	{
		$data['title'] = lang('static.admin.login.login.title');
		$data['admin'] = $this->admin_role;
		$data['validation'] = NULL;

		if ($this->request->getMethod() == 'post')
		{
			if (! $this->validate($this->validation->getRuleGroup('login_rules'))) 
			{
				$data['validation'] = $this->validator;	
				return $this->load_view("admin/login", $data);
			}

			$user_data = [
					'email'	=> $this->request->getVar("email", FILTER_SANITIZE_EMAIL),
					'password' => md5($this->request->getVar("password")),
					'role' => 'admin',
			];	
			$result = $this->user->select($user_data);
			
			if ($result)
			{
				$this->session->setTempdata('message', lang('static.admin.login.message') , 1);
				$this->session->set(['admin_id' => $result['id'], 'admin_name' => $result['name']] );
				return redirect()->to('/admin/dashboard');
			}

			$this->session->setTempdata('error_message', lang('static.admin.login.error_message'), 1);
		}
		return $this->load_view('admin/login', $data);
	}
}
