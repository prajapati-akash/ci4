<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use CodeIgniter\Encryption\EncrypterInterface;

class Dashboard extends BaseController
{
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);
		$this->pager = \Config\Services::pager();
		$this->user_role = TRUE;
	}

	public function index ()
	{
		$data['title'] = lang('static.dashboard.index.title');
		$data['user'] = $this->user_role;
		return $this->load_view('candidate/dashboard', $data);
	}

	public function ajaxrequest()
	{
		if ($this->request->isAJAX())
		{
			$status = trim($this->request->getPost('status'));
			$language = trim($this->request->getPost('language'));
			$pageno = 5;
			$data['token'] = $this->request->getVar('csrf_test_name');

			$data = [
		        'showdata' => $this->candidate->show($status , $language , $pageno),
		        'pager' => $this->candidate->pager,
		        'status' => $this->request->getPost('status'),
		        'language' => $this->request->getPost('language'),
	        ];
	   		return  view("candidate/ajax/showdata", $data);
		}
		return redirect()->to('/dashboard');
	}
}
