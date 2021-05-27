<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\User;

class Sampleapi extends ResourceController
{
	// protected $modelName = 'App\Models\User';
	// // protected $model = 'user';
	//    protected $format    = 'json';

	public function index()
	{
		// $this->model->first();
		// $data = $this->model->where('userid', 18)->findAll();
		// $data = $this->model->where('userid', 18)->orderBy('firstname','asc')->findAll();
		// return $this->respond($data);

		echo "hii";
		// echo $this->model->getLastQuery();
	}

	public function new()
	{

	}

	public function create()
	{
		echo "create function ";
	}

	public function edit($id = NULL)
	{
		echo "edit".$id;
	}

	public function show($id = NULL)
	{
		return $this->respond($this->model->find($id));  // done
	}

	public function update($id = NULL)
	{
		echo "update - ". $id;
	}

	public function delete($id = NULL)
	{
		return $this->respond($this->model->delete($id));
	}

}
