<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
		
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	public $set_rules = [
		'firstname' => [
			'label'  => 'first name',
	        'rules'  => 'required',
        	'errors' => [
	       		'required' => 'Enter a {field}.',
    	        ]
			],
			'middlename' => [
					'label'  => 'middle name',
		            'rules'  => 'required',
    		    	'errors' =>	[
                		'required' => 'Enter a {field}.',
 			        ]	
			],
			'lastname' => [
					'label'  => 'last name',
		            'rules'  => 'required',
    		    	'errors' => [
                		'required' => 'Enter a {field}.',
 			        ]	
			],
		    'education' => [
		    		'label'  => 'qualification',
		            'rules'  => 'required|in_list[B.e., M.c.a., B.c.a., B.tech.]',
    		    	'errors' =>	[
                		'required' => 'Select your {field}.',
 			        ]	
		    ],
		    'language' => [
		    		'label'   => 'language',
		    		'rules'   => 'required|in_list[php, java, android]',
		    		'errors'  => [
		    				'required'   =>  'Select a {field}.',
		    		]
		    ],
		    'expirience' => [
		    		'label'		=>  'expirience',
				    'rules'		=>  'required|numeric',
				    'errors'    =>  [
				    	'required'   =>  'Enter your {field}.',
				    	'numeric'  => 'Enter only numbers.'
				    ]
		    ],
		    'currentctc' => [
		    		'label'   =>  'current ctc',
		    		'rules'   =>  'required|numeric|is_natural',
		    		'errors'  => [
		    			'required'  => 'Enter current ctc.',
		    			'numeric' => 'Enter a number.',
		    			'is_natural' => 'Enter only number',
		    		]	
		    ],
		    'expectedctc' => [
		    		'label'   => 'Expected ctc',
					'rules'   => 'required|numeric|is_natural_no_zero',
					'errors'  => [
						'required'   => 'Enter an expected ctc.',
			    			'numeric' => 'Enter a number.',
		    			'is_natural_no_zero' => 'Enter only numbers',
					]
		    ],
		    'noticeperiod' => [
		    		'label'    =>  'Notice period',
		    		'rules'    =>  'required|numeric',
		    		'errors'   =>  [
		    			'required'   => 'Enter a notice period.',
		    			'numeric'  => 'enter only numbers.'
		    		]
		    ],
		    'interviewdate' => [
		    		'label'   => 'Interview date',
		    		'rules'   => 'required',
		    		'errors'  => [
		    			'required'   => 'Please select a date.',
		    		]
		    ],
		    'reason'  => [
		    		'label'   => 'Reason',
		    		'rules'   => 'required',
		    		'errors'  => [
		    			'required'  => 'Enter reason leave Job.',
		    		]
		    ],
		    'status' => [
		    		'label'   => 'Status',
		    		'rules'   => 'required',
		    		'errors'  => [
		    			'required'  => 'Please select a current status.',
		    		]
		    ],
		];

	public $registration_rules = [
				'name'  		   => [
					'label'  => 'Name',
					'rules'  => 'required|max_length[10]',
					'errors' => [
						'required' => 'Please enter a name.',
						'max_length' => 'Please enter maximum 10 character {field}.',
					]
				], 
				'email'  		   => [
					'label'  => 'Email',
					'rules'  => 'required|valid_email|is_unique[user.email]',
					'errors' => [
						'required' => 'Please enter a email.',
						'valid_email' => 'Please enter valid email.',
						'is_unique' => 'This email is registered, Please enter unique email.',
					],
				],
				'password'  	   => [
					'label'  => 'Password',
					'rules'  => 'required',
					'errors'  => [
						'required'  => 'Please enter a password.'
					],
				],
				'confirm_password' => [
					'label'  => 'Confirm Password',
					'rules'  => 'matches[password]|required',
					'errors'  => [
						'required'  => 'Please enter a {field}.',
						'matches'  => 'Please enter {field}, same as Password',
					],
				] ,
			];

	public $login_rules = [ 
				'email'  	=> [
					'label'  => 'email',
					'rules'  => 'required|valid_email',
					'errors' => [
						'required' => 'Please enter a {field}.',
						'valid_email'  => 'Please enter a valid {field}.'
					]
			],
				'password'	=> [

					'label'  => 'Password',
					'rules' => 'required',
					'errors' => [
						'required'  => 'Please enter a password.'
					],
				],
			];
}
