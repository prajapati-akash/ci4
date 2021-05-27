<?php  
namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table        = 'user';
    protected $primaryKey   = 'id';
    protected $allowedFields= ['id', 'name', 'email', 'password', 'profile_image', 'role', 'created_at', 'updated_at', 'deleted_at', 'status'];
    protected $useTimestamps= true;
    protected $createdField = 'created_at';
    protected $deletedField = 'deleted_at';
    protected $updatedField = 'updated_at';

    public function create($data)
    {
        if (isset($data['status']) && $data['status'] == FALSE)
        {
            $result = $this->where(['status' => '0'])->findAll();
         
            $this->set('status', '1')
                 ->where('status', '0')
                 ->update();

           if ($this->db->affectedRows() == 0)
           {
                return false;
           }
           return $result;
        }

       	$result = $this->save($data);

        if ($this->db->affectedRows() == 1 )
 		{   
 			return ($data['id'] != NULL)?$data['id']:$this->db->insertID();
 		}
 		return false;
    }

    public function select($data = NULL)
    {
        $result = $this->db
                       ->table('user')
                       ->select(['id', 'name', 'email', 'profile_image', 'role']);

        if (! empty($data['email']) && ! empty($data['password']))
        {
            $result->where([ 'email' => $data['email'],
                      'password' => $data['password'],
                      'role'=> $data['role'],
                      'status' => 1 ]);
        }

        if (! empty($data['id']))
        {
            $result->where([ 
                    'id'=> $data['id'],
                ]);
        }

        if (! empty($data['email_id']))  
        {
            $result = $this->where(['email' => $data['email_id']]);
        }

        $result = $result->get()
                         ->getrowarray();
        

        if ($this->db->affectedRows() == 1)
        {
            return $result;
        } 
    	return false;
    }

    public function show($id = NULL)
    {
        if ($id != NULL)
        {
            return $this->find($id);
        }
        
        $result['data'] = $this->where('id !=', session()
                                ->get('admin_id'))
                                ->paginate();
        $result['count'] = $this->where('id !=', session()->get('admin_id'))
                             ->countAllResults();
                             
        if ($result)
        {
            return $result;
        }
        return false;
    }  

    public function delete_data($id)
    {
        $result = $this->where(['id' => $id])->delete();

        if (! $this->db->affectedRows())
        {
            return false;
        } 
        return true;
    }
}
