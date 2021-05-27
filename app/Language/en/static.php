<?php
return [
	'registration' => [
		'index' => [
			'title' => 'Registration',
			'message' => 'You have successfully register.',
			'error_message' => 'You have not register yet.',
		],
	],
	'login' => [
		'index' => [
			'title' => 'Login',
			'message' => 'You have successfully login.',
			'error_message' => 'Please enter currect email and password.',
			'google_error' => 'Plase Activate your account.',
		],
	],
	'dashboard' => [
		'index' => [
			'title' => 'Dashboard',
			],
		'logout' => [
			'message' => 'You have successfully logout.',
		],	
	],
	'candidate' => [
		'add' => [
			'title' => 'Add Candidate',
			'message' => 'Candidate Add successfully.',
			'error_message' => 'Not add candidate.',
		],
		'edit' => [
			'title' => 'Edit Candidate',
		],
		'delete' => [
			'message' => 'Candidate Delete  successfully.',
			'error_message' => 'Candidate delete unuccessfully.',
		],
		'update' => [
			'message' => 'Candidate update  successfully.',
			'error_message' => 'No updated candidate.',		
		],	
		'profile' => [
			'title' => 'My profile',
			'image_error_message' => 'Profile image not uploaded .',
			'message' => 'Update profile successfully.',
			'error_message' => 'Profile not updated.',		
		],
	],
	'admin' => [
		'dashboard' => [
			'index' => [
				'title' => 'Dashboard',
			],
			'status' => [
				'activate_message' => 'User activated succefully.',
				'deactivate_message' => 'User deactivated succefully.',
				'status_error' => 'Status Not updated.',
			],
			'logout' => [
				'message' => 'You have successfully logout.',
			],

		],
		'login' => [
				'title' => 'Login',
				'message' => 'You have successfully login.',
				'error_message' => 'Enter current admin emain and password.',
		],
	],
];
