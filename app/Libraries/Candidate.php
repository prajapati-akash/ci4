<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Candidate extends BaseController
{
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		$this->validation = \config\Services::validation();
		$this->image = \Config\Services::image();
		$this->user_role = TRUE;
	}
	
	public function add()
	{
		$data = [];
		$data['title'] = lang('static.candidate.add.title');
		$data['user'] = $this->user_role;
		$data['validation'] = NULL;
		$data['result'] =  NULL;
		
		if ($this->request->getMethod() === 'post') 
		{
			$status = $this->request->getVar('status');
			$set_rules = $this->validation->getRuleGroup('set_rules');

			if ($status == "Rejected")
			{
				$set_rules_status = [
					'rejectreason'  => [
						'label' => 'rejectreason',
						'rules' => 'required',
						'errors' => [
							'required' => 'Plase enter reason for rejection.',
						]
					],					
				];
				$set_rules = array_merge($set_rules, $set_rules_status);
			}

			if (! $this->validate($set_rules)) 
			{
				$data['validation'] = $this->validator;	
				return $this->load_view("candidate/form/form_view", $data);
			}

			$user_data = [
				'id' => NULL,
				'userid' => session()->get('user_id'),
				'firstname' => ucwords(trim($this->request->getVar('firstname',FILTER_SANITIZE_STRING))),
			    'middlename' => ucwords(trim($this->request->getVar('middlename', FILTER_SANITIZE_STRING))),
			    'lastname' => ucwords(trim($this->request->getVar('lastname', FILTER_SANITIZE_STRING))),
			    'education' => trim($this->request->getVar('education', FILTER_SANITIZE_STRING)),
			    'language' => trim($this->request->getVar('language')),
			    'expirience' => trim($this->request->getVar('expirience', FILTER_SANITIZE_NUMBER_INT)), 
			    'currentctc' => trim($this->request->getVar('currentctc', FILTER_SANITIZE_NUMBER_INT)), 
			    'expectedctc' => trim($this->request->getVar('expectedctc', FILTER_SANITIZE_NUMBER_INT)),
			    'noticeperiod' => trim($this->request->getVar('noticeperiod', FILTER_SANITIZE_NUMBER_INT)),
			    'interviewdate' => trim($this->request->getVar('interviewdate')),
			    'reasonleavejob' => htmlentities(trim($this->request->getVar('reason'))),
			    'currentstatus' => trim($this->request->getVar('status')),
			];
				
			if (! empty($this->request->getVar('rejectreason')))
			{
				$reason_data = [
				'rejectedreason'=> htmlentities(ucfirst(trim($this->request->getVar('rejectreason'))))	
				];
				$user_data = array_merge($user_data, $reason_data);
			}

			//return true or false
			$result = $this->candidate->create($user_data);

			if ($result)
			{
				$this->session->setTempdata('message', lang('static.candidate.add.message'), 1);
				return redirect()->to(base_url('/dashboard'));			
			}

			$this->session->setTempdata('message', lang('static.candidate.add.error_message'), 1);
			return redirect()->to(base_url());
		}

		return $this->load_view('candidate/form/form_view', $data);
	}

	public function edit()
	{
		if ($this->request->getMethod() === 'post')
		{
			$data['title'] = 'Edit Candidate';
			$data['validation'] = null;
			$data['user'] = $this->user_role;
			$id = decode($this->request->getPost('id'));
			$user_id = session()->get('user_id');

			$data['result'] = $this->candidate->show_by_id($id, $user_id);

			if ($data['result'])
			{
				return $this->load_view('candidate/form/form_view', $data);
			}

			return $this->load_view('candidate/dashboard', $data);
		}

		return redirect()->to(base_url('/dashboard'));
	}

	public function delete()
	{
		if ($this->request->getMethod() === 'post')
		{	
			$id = decode($this->request->getPost('id'));			
			$user_id = session()->get('user_id');
			$result = $this->candidate->delete_data($id, $user_id);

			if ($result)
			{
				$this->session->setTempdata('message', lang('static.candidate.delete.message'), 1);
				return redirect()->to("/dashboard");
			}
			
			$this->session->setTempdata('error_message', lang('static.candidate.delete.error_message'), 1);
			return redirect()->to("/dashboard");
		}
		return redirect()->to('/dashboard');
	}
	
	public function update()
	{
		$data['validation'] = NULL;
		$data['result'] = NULL;
		$data['user'] = $this->user_role;

		if ($this->request->getMethod() == 'post')
		{
			$set_rules = NULL;
			$current_status = trim($this->request->getVar('status', FILTER_SANITIZE_STRING));
			$set_rule = $this->validation->getRuleGroup('set_rules');

			if ($current_status == "Rejected")
			{
				$set_rules_status = [
					'rejectreason' => [
						'label' => 'rejectreason',
						'rules' => 'required',
						'errors' => [
							'required' => 'Plase Enter Reason for Rejection',
						],
					],					
				];
				$set_rule = array_merge($set_rule, $set_rules_status);
			}

			if (! $this->validate($set_rule)) 
			{
				$data['validation'] = $this->validator;	
				return $this->load_view("candidate/form/form_view", $data);
			}

			$user_data = [
				'id' => trim($this->request->getVar('id')),
				'userid' => session()->get('user_id'),
				'firstname' => trim($this->request->getVar('firstname', FILTER_SANITIZE_STRING)),
			    'middlename' => trim($this->request->getVar('middlename', FILTER_SANITIZE_STRING)),
			    'lastname' => trim($this->request->getVar('lastname', FILTER_SANITIZE_STRING)),
			    'education' => trim($this->request->getVar('education', FILTER_SANITIZE_STRING)),
			    'language' => trim($this->request->getVar('language')),
			    'expirience' => trim($this->request->getVar('expirience')), 
			    'currentctc' => trim($this->request->getVar('currentctc')), 
			    'expectedctc' => trim($this->request->getVar('expectedctc')),
			    'noticeperiod' => trim($this->request->getVar('noticeperiod')),
			    'interviewdate' => trim($this->request->getVar('interviewdate')),
			    'reasonleavejob' => htmlentities(trim($this->request->getVar('reason'))),
			    'currentstatus' => trim($this->request->getVar('status')),
			];

			if (! empty($this->request->getVar('rejectreason')))
			{
				$reason_data = [
					'rejectedreason'=> htmlentities(ucfirst(trim($this->request->getVar('rejectreason')))),  
				];
				$user_data = array_merge($user_data, $reason_data);
			}

			$result  =  $this->candidate->create($user_data);
			$this->session->setTempdata('message', lang('static.candidate.update.message'), 1);
			return redirect()->to(base_url('dashboard'));
		}
		return redirect()->to(base_url('dashboard'));
	}

	public function profile()
	{
		$data['title'] = lang('static.candidate.profile.title');
		$data['user'] = $this->user_role;
		$data['validation'] = NULL;
		$data['result'] = $this->user->select(['id' => session()->get('user_id')]);
		
		if($this->request->getMethod() == 'post')
		{
			$ids = $this->request->getVar('id');
			
			$set_rules = [
				'name' => [
					'label' => 'name',
					'rules' => 'required',
					'errors' => [
						'required' => 'Please enter a name.',
					]
				],
				'email' => [
					'label' => 'email',
					'rules' => 'valid_email|is_unique[user.email,id,'.$ids.']',
					'errors' => [
						'valid_email' => 'Please enter valid email.',
						'is_unique' => 'Please enter unique email.',
					]
				],
				'profileimg' => [
					'label' => 'profileimg',
					'rules' => 'max_size[profileimg, 100]|ext_in[profileimg,png,jpg,jpeg]',
					'errors' => [
						'max_size' => 'Please select profile image less than 100kb.', 
						'ext_in' => 'Please enter only jpg, jpeg and png file.',
					]
				], 
			];

			if (! $this->validate($set_rules)) 
			{
				$data['validation'] = $this->validator;
				return $this->load_view("candidate/profile", $data);
			}
				
			$new_file = NULL;
			$file = $this->request->getFile('profileimg');

			if ($file->isValid() && ! $file->hasMoved('profileimg'))
			{
				$new_file = $file->getRandomName();

				$save_image = $this->image
						   ->withFile($file->getPathName())
					       ->resize(250, 250, true )
					       ->save('../external/uploads/images/'.$new_file);
				
				if (! $save_image)
				{
					session()->setTempdata('error_message', lang('static.candidate.profile.image_error_message'), 1);
					return redirect()->to('/candidate/profile');
				}
			}

			$user_data = [
					'id' => trim($this->request->getVar('id')),
					'name' => trim($this->request->getVar('name')),
					'email' => trim($this->request->getVar('email')),
				];

			if ($new_file)
			{
				$user_image = [
					'profile_image' => $new_file,
				];
				$user_data = array_merge($user_data, $user_image);
			}

			if ($this->user->create($user_data))
			{
				session()->setTempdata('message', lang('static.candidate.profile.message'), 1);
				return redirect()->to('/candidate/profile');
			}
				session()->setTempdata('error_message', lang('static.candidate.profile.error_message'),1);
				return redirect()->to('/candidate/profile');
		}
		return $this->load_view("candidate/profile", $data);
	}
}
