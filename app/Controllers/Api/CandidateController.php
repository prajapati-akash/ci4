<?php 
namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Candidate;

class CandidateController extends ResourceController
{
	public function __construct()
	{
		$this->candidate = new Candidate;
		$this->validation = \config\Services::validation();
		helper(['text']);
	}

	public function index() 	 //  GET : http://localhost:8080/api/candidate/
	{	
		if ($this->candidate->show())
		{
			return $this->response
						->setStatusCode(200)
						->setContentType('text/json')
						->setBody(json_encode([
									'status' => 200,
									'data' => $this->candidate->show(),
								]));
		}

		$data = [
			'status' => 404,
			'message' => [
				'error' => 'No Data Found.'
			]
		];

		return  $this->response
					 ->setStatusCode(404)
					 ->setContentType('text/json')
					 ->setBody(json_encode($data));
	}

	public function new()   //   GET  : http://localhost:8080/api/candidate/new
	{
		$user_data = [
			'id' => NULL,
			'userid' => 18,
			'firstname' => ucfirst(random_string('alpha',5)),
		    'middlename' => ucfirst(random_string('alpha',1)),
		    'lastname' => ucfirst(random_string('alpha',5)),
		    'education' => 'B.e',
		    'language' => 'php',
		    'expirience' => rand(0,10), 
		    'currentctc' => rand(7000,10000), 
		    'expectedctc' => rand(10000, 15000),
		    'noticeperiod' => rand(1,3),
		    'interviewdate' => '2021-04-20',
		    'reasonleavejob' => ucwords(random_string('alpha',20)),
		    'currentstatus' => 'Reviewed',
		];

		if ($this->candidate->create($user_data))
		{
			$response = [
				'status' => 201,
				'message' => [
					'success' => 'Add candidate successfully.',
				],
			];
			
			return $this->respondCreated($response);
		}

		$response = [
				'status' => 400,
			 	'message' => [
			 		'success' => 'Not add candidate.',
			 	],
			];

	    return $this->respondCreated($response, 400);	
	}

	public function create($id = null )   // POST : http://localhost:8080/api/candidate/ with filled data 
	{
		if ($this->request->getMethod() === 'post') 
		{
			$status = $this->request->getVar('status');
			$set_rules = $this->validation->getRuleGroup('set_rules');

			if ($status == "Rejected")
			{
				$set_rules_status = [
					'rejectreason' => [
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
				return $this->respond(['status' => 400, 'message' => $this->validation->getErrors()], 400);
			}

			$user_data = [
				'id' => NULL,
				'userid' => $this->request->getVar('userid'),
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
				'rejectedreason' => htmlentities(ucfirst(trim($this->request->getVar('rejectreason'))))	
				];
				$user_data = array_merge($user_data, $reason_data);
			}

			//return true or false
			$result = $this->candidate->create($user_data);

			if ($result)
			{
				$response = [
					'status' => 201,
					'message' => [
					'success' => 'Registration Successfully',
					],
				];
				
				return $this->respondCreated($response);
			}
			$response = [
				'status' => 400,
			 	'message' => [
			 		'success' => 'Registration not successfully.',
			 	],
			];
		    return $this->respond($response, 400);
		}	
	}

	public function edit($id = NULL)   // GET : http://localhost:8080/api/candidate/45/edit
	{
		if ($this->candidate->show_by_id(['id' => $id ]))
		{
			$result = [
				'status' => 200,
				'data' => $this->candidate->show_by_id(['id' => $id ]),
			];	
			return $this->respond($result, 200);
		}

		$result = [
			'status' => 400,
			'data' => [
				'message' => "Data not get into database.",
			],
		];

		return $this->respond($result, 400);
	}

	public function show($id = NULL) 	// GET Method : http://localhost:8080/api/candidate/41
	{
		if (! empty($this->candidate->show_by_id(['id' => $id ])))
		{
			$result = [
				'status' => 200,
				'data' => $this->candidate->show_by_id(['id' => $id ]),
			];	

			return $this->respond($result, 200);
		}

		$result = [
			'status' => 400,
			'data' => [
				'message' => "Data not get into database.",
			],
		];

		return $this->respond($result, 400);
	}

	public function update($id = NULL)
	{
		$user_data = [
			'id' => $id,
			'userid' => 18,
			'firstname' => 'akash_'.rand(1,1000),
		    'middlename'=> 'k',
		    'lastname' => 'prajapati',
		    'education' => 'B.e.',
		    'language' => 'php',
		    'expirience' => rand(0,1), 
		    'currentctc' => rand(0,10), 
		    'expectedctc' => rand(10000,25000),
		    'noticeperiod' => rand(1, 2),
		    'interviewdate' => '2021-04-20',
		    'reasonleavejob'=> 'Upgradation',
		    'currentstatus' => 'Reviewed',
		];
		
		return $this->respond($this->candidate->create($user_data));
	}

	public function delete($id = NULL)
	{
		if ($this->candidate->delete_data($id))
		{
			$data = [
				'status' => 200,
				'message' => [
					'errors' => 'User deleted successfully.',
				]
			];
			return $this->respond($data, 200);
		}

		$data = [
			'status' => 400,
			'message' => [
				'errors' => 'Data not found with id '. $id,
			]
		];
		return $this->respond($data, 400);
	}
}
