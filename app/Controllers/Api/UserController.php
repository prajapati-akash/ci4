<?php
namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\User;

class UserController extends ResourceController
{
	public function __construct()
	{
		$this->user = new User();
		$this->validation = \Config\Services::validation();
		helper(['form']);
	}

	public function index()  //GET : http://localhost:8080/api/user/
	{
		$data = [
			'status' =>  200,
			'data'  => $this->user->show(),
		];

		if ($data['data'])
		{
			return $this->response
						->setStatusCode(200)
						->setContentType('text/json')
						->setBody(json_encode($data));
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

	public function new()  //GET : http://localhost:8080/api/user/new
	{
		$data = [
			'id' => NULL,
			'name'  =>  'akash',
	        'email' =>  'admin'.rand(1,1000).'@gmail.com',
	        'password' =>  md5(rand(100,10000)),
	        'profile_image' =>  'myprofile.png',        
		];
		
		if ($this->user->create($data))
		{
			$data = [
				'status' => 201,
				'message' => [
					'error' => 'Create new user.',
				]
			];

			return $this->respond($data, 201);
		}

		$data = [
			'status' => 400,
			'message' => [
				'error' => 'not create new user',
			]
		];

		return $this->respond($data);
	}

	public function create()  // POST : http://localhost:8080/api/user/ with filled data
	{
		$data = [
			'name' => $this->request->getVar('name'),
			'email' => $this->request->getVar('email'),
			'password' => $this->request->getVar('password'),
			'confirm_password' => $this->request->getVar('confirm_password'),
			'profile_image' => $this->request->getVar('profile_image')??NULL,
		];

		if (! $this->validate($this->validation->getRuleGroup('registration_rules'))) 
		{	
			return $this->respond(['status' => 400, 'message' => $this->validation->getErrors()], 400);
		}

		$user_data = [
			'id'  => NULL,
			'name' => ucwords(trim($this->request->getVar('name', FILTER_SANITIZE_STRING))),
			'email' => strtolower(trim($this->request->getVar('email', FILTER_SANITIZE_EMAIL))),
			'password' => md5(trim($this->request->getVar('password'))),
		];

		//return true or false
		$result = $this->user->create($user_data);
		
		if ($result)
		{
			$response = [
				'status' => 201,
			 	'message' => [
			 		'success' => 'Registration Successfully',
			 	],
			];
			// return $this->respond($result);
	        return $this->respondCreated($response);
		}

		$response = [
				'status' => 400,
			 	'message' => [
			 		'success' => 'Registration not successfully.',
			 	],
			];

	    return $this->respondCreated($response, 400);
	}

	public function edit($id = NULL) //  GET : http://localhost:8080/api/user/245/edit : get data
	{
		$result = [
			'status'  => 200,
			'data'   =>  $this->user->select(['id' => $id ]),
		];

		return $this->respond($result, 200);
	}

	public function show($id = NULL) // GET : http://localhost:8080/api/user/245
	{
		$data = [
			'status' => 200,
			'data' => $this->user->show($id),
		];
		
		if($data['data'])
		{
			return $this->respond($data, 200);
		}

		$response = [
            'status'   => 404,
            'messages' => [
                'error' => 'No Data found with id '.$id,
            ]
        ];

		return $this->respond($response, 404);
	}
 
	public function update($id = NULL)  // PUT : http://localhost:8080/api/user/update
	{
		if ($this->request->getMethod() == 'put')
		{
			$check_id = $this->user->select(['id' => $id]);

			if ($check_id == FALSE)
			{
				$response = [
					'status' => 401,
				 	'message' => [
				 		'success' => 'User not found with id '. $id,
				 	],
				];
			    return $this->respond($response, 401, 'invalid_data');
			}
			
			$set_rules = [
				'name'  		   => [
					'label'  => 'Name',
					'rules'  => 'required|max_length[10]',
					'errors' => [
						'required' => 'Please enter a name.',
						'max_length' => 'Please enter maximum 10 character {field}.',
					]
				], 
				'email'    	=> [
					'label'  => 'email',
					'rules'   => 'valid_email|is_unique[user.email,id,'.$id.']',
					'errors'   => [
						'valid_email'  => 'Please enter valid email.',
						'is_unique'   =>  'Please enter unique email.',
					]
				]
			];		

			if (! $this->validate($set_rules))  
			{	
				return $this->respond(['status' => 400, 'message' => $this->validation->getErrors()] , 400);
			}

	        $input = $this->request->getRawInput();


			$user_data = [
			   	'id' => $id,
			   	'name' => ucwords(trim($input['name'])),
			   	'email' => strtolower($input['email']),
				'profile_image' => $new_file??NULL,
			];

			//return true or false
			$result = $this->user->create($user_data);

			if ($result)
			{
				$response = [
					'status' => 200,
				 	'message' => [
				 		'success' => 'User update successfully.',
				 	],
				];

			    return $this->respondCreated($response, 200);
			}
			
			$response = [
				'status' => 500,
			 	'message' => [
					'success' => 'Not update userdata.',
			 	],
			];

			return $this->respondCreated($response, 500);
		}

		$data = [
			'status' => 406,
			'message' => [
				'errors' => 'Not acceptable',
			]
		];

		return $this->respond($data, 406);
	}

	public function delete($id = NULL) // DELETE : http://localhost:8080/api/user/66
	{
		if ($this->user->delete_data($id))
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

		if ($this->user->delete_data($id))
		{
			$data = [
				'status' => 200,
				'message' => [
					'errors' => 'User deleted successfully.',
				]
			];
		}
		else
		{
			$data = [
				'status' => 400,
				'message' => [
					'errors' => 'Data not found with id '. $id,
				]
			];
		}

		return $this->respond($data, 400);
	}
}
