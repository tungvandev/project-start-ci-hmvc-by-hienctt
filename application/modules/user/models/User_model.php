<?php
class User_model extends CI_Model {

	protected $table = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_list_users() {
    	return $this->db->get($this->table);
    }

    public function find_user_by_id($id) {
    	// $user = $this->db->where('id', $id);

    	$this->db->select('*')
        ->from($this->table)
        ->where('id', $id);
        $user = $this->db->get()->row();
 
    	if(!$user) {
			return false;
		}

		return $user;
    }

	public function create($data) {
  
		$user = $this->db->insert($this->table, $data); 
		if(!$user) {
			return false;
		}
		$data['user_id'] = $this->db->insert_id();
		return $data['user_id'];
	}
    public function update($data, $id) {
		
		$this->db->where('id', $id);
		$user = $this->db->update($this->table, $data);  

		if(!$user) {
			return false;
		}

		return true;
    }

    public function delete($id) {
		$user = $this->db->delete($this->table, array('id' => $id)); 
		if(!$user) {
			return false;
		}

		return true;
    }
}
