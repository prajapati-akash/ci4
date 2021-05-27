<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Libraries\Encryption; 

class Login extends BaseController
{
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);
		$this->user_role = TRUE;
	}

	public function index()
	{
		// log_message('Myerror', 'hii this is custome info');


		// $secure = new Encryption();
		// echo "<pre>";
		// $data = $secure->myMethod("hii");
		// print_r($data);   // : done
		// echo "<br>";
		// print_r($secure->decode($data));   // : done
		// echo "</pre>";

		$data['title'] = lang('Static.login.index.title');
		$data['user'] = $this->user_role;
		$data['validation'] = NULL;
		
		if ($this->request->getMethod() === 'post') 
		{
			if (! $this->validate($this->validation->getRuleGroup('login_rules'))) 
			{
				$data['validation'] = $this->validator;	
				return $this->load_view("user_login", $data);
			}
		
			$user_data = [
			  'email' => trim($this->request->getVar("email", FILTER_SANITIZE_EMAIL)),
			  'password' => md5(trim($this->request->getVar("password"))),
			];

			$result = $this->user->select($user_data);

			if ($result)
			{
				$this->session->setTempdata('message', lang('Static.login.index.message'), 1);
				$this->session->set([
					'user_id' => $result['id'],
					'user_name' => $result['name'],
				 ]);

				return redirect()->to(base_url("/dashboard"));
			}

			$this->session->setTempdata('error_message', lang('Static.login.index.error_message'), 2);
			return $this->load_view('user_login', $data);
		}
		return $this->load_view('user_login', $data);
	}
}
