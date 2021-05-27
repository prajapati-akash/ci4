<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Dashboard extends Admin_BaseController
{
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);
		$this->pager = \Config\Services::pager();
		$this->admin_role = TRUE;
	}
	
	public function index()
	{
		$data['title'] = lang('static.admin.dashboard.index.title');
		$data['admin'] = $this->admin_role;
		$data['validation'] = NULL;
		
		return $this->load_view('admin/dashboard', $data);
	}

	public function status()
	{
		if ($this->request->getMethod() == "post")
		{
			$data['id'] = decode($this->request->getPost('id'));
			$data['status'] = decode($this->request->getPost('status'));

			$status = ($data['status'] == 0)?1:0;

			$data = [
				'id' => decode($this->request->getPost('id')),
				'status' => $status,
			];

			//update status data using user_model
			$result = $this->user->create($data);

			if (! empty($result))
			{
				($status == 1)?session()->setTempdata('message', lang('static.admin.dashboard.status.activate_message'), 1):'';
				($status == 0)?session()->setTempdata('error_message',  lang('static.admin.dashboard.status.deactivate_message'), 1):'';

				return redirect()->to(base_url('/admin/dashboard'));	
			}
	
			session()->setTempdata('error_message', lang('static.admin.dashboard.status.status_error'), 1);
			return redirect()->to(base_url('/admin/dashboard'));
		}
	}

	public function adminajax()
	{
		if ($this->request->isAJAX())
        {
			$data = ['showdata' => $this->user->show(),
		             'pager' => $this->user->pager,
		             'status' => $this->request->getPost('status'),
	        ];
			return view("admin/ajax/showdata", $data);
        }
	    return redirect()->to('/admin/dashboard');
	}
}
