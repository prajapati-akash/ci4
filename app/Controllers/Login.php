<?php
namespace App\Controllers;

require_once APPPATH.'Libraries/vendor/autoload.php';
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Libraries\Encryption; 
use CodeIgniter\View\View;

class Login extends BaseController
{
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);
		$this->user_role = TRUE;
	}

	public function index()
	{


		$data['title'] = lang('static.login.index.title');
		$data['user'] = $this->user_role;
		$data['validation'] = NULL;
		
		//Login with Google
		$google_client = new \Google_Client();
		$google_client->setAuthConfig(FCPATH.'external/json/credential.json');
		$google_client->setRedirectUri(base_url());
		$google_client->addScope('email');
		$google_client->addScope('profile');
	
		$data['login_button'] = $google_client->createAuthUrl();

		if ($this->request->getVar('code'))
		{
			$token = $google_client->fetchAccessTokenWithAuthCode($this->request->getVar('code'));

			if (! isset($token['error']))
			{
				$google_client->setAccessToken($token['access_token']);
				$google_service = new \Google_Service_Oauth2($google_client);
				$google_data = $google_service->userinfo->get();

				//check email id register or not
				$user_get_data = $this->user->select(['email_id' => $google_data['email']]);

				$user_data = [
					'id' => $user_get_data['id']??NULL,
					'name' => ucwords(trim($google_data['givenName'])), 
					'email' =>  strtolower(trim($google_data['email'])),
					'profile_image' => $google_data['picture'],
				];

				$result = $this->user->create($user_data);
				
				if ($result)
				{
					$this->session->setTempdata('message', lang('static.login.index.message'), 1);
					$this->session->set([
						'user_id' => $result,
						'user_name' => $google_data['givenName'],
					 ]);

					return redirect()->to(base_url("/dashboard"));
				}

				$this->session->setTempdata('error_message', lang('static.login.index.error_message'), 1);
				return $this->load_view('user_login', $data);
			}
		}

		//login with email and password
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
			  'role' => 'user',
			];

			$result = $this->user->select($user_data);

			if ($result)
			{
				$this->session->setTempdata('message', lang('static.login.index.message'), 1);
				$this->session->set([
					'user_id' => $result['id'],
					'user_name' => $result['name'],
				 ]);

				return redirect()->to(base_url("/dashboard"));
			}

			$this->session->setTempdata('error_message', lang('static.login.index.error_message'), 2);
			return $this->load_view('user_login', $data);
		}
		return $this->load_view('user_login', $data);
	}
}
