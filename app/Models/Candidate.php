<?php
namespace App\Models;

use CodeIgniter\Model;

class Candidate extends Model
{
	protected $DBGroup       = 'default';
	protected $table         = 'candidate';
	protected $primaryKey    = 'id';
	protected $allowedFields = ['id', 'userid', 'firstname', 'middlename', 'lastname', 'education', 'language', 'expirience', 'currentctc', 'expectedctc', 'noticeperiod', 'interviewdate', 'reasonleavejob', 'currentstatus', 'rejectedreason'];

	public function create($data)  
    {
   		$result = $this->save($data);

 		if ($this->db->affectedRows() == 1 )
 		{
 			return true;
 		}
 		return false;
   	}

	public function show($status = NULL, $language = NULL, $page = NULL)  
	{
		$result['data'] = $this->where(['userid' => session()->get('user_id')]);

		if (! empty($status) || ! empty($language))
		{
			if (! empty($status))
			{
				$result['data'] = $result['data']->Where(['currentstatus' => $status]);
			}
			if (! empty($language))
			{
				$result['data'] = $result['data']->Where(['language' => $language]);
			}
		}

		$result['data'] = $result['data']->paginate($page);
		$result['count'] = $this->Where(['userid' => session()->get('user_id')])->countAllResults();

		if ($result)
		{
			return $result;
		}
		return false;
	}

	public function show_by_id($id = NULL, $user_id = NULL)
	{
		$result = $this->Where(['id' => $id]);

		if ($user_id != NULL)
		{
			$result = $result->Where(['userid' => $user_id]);
		}

		$result = $result->get()->getRowArray();

		if ($result)
		{
			return $result;
		}
		return false;
	}

	public function delete_data($id = NULL, $user_id = NULL)
	{
		$result = $this->Where(['id'=> $id]);
						
		if ($user_id != NULL)
		{
			$result = $result->where(['userid' => $user_id]);
		}

		$result = $result->delete();

		if ($this->db->affectedRows())
		{
			return true;
		} 
		return false;
	}
}
