<?php
class Account_Model extends Model{

	public function __construct(){
		parent::__construct();
	}

	public function create($data){

		$this->db->insert('users', array(

            'username' => $data['name'],

            'lastname' => $data['lastname'],

            'mail' => $data['email'],

            'account' => $data['username'],

            'password' => $data['password'],

            'active' => '',

            'reset_key' => '',

            'reset_expire' => date('Y-m-d H:i:s') // use GMT aka UTC 0:00

        ));

	}



    public function AuthNick($data){

        return $this->db->select('SELECT count(*) as inUsed FROM users WHERE account =:account', array('account' => $data['account']));

    }



    public function AuthMail($data){

        return $this->db->select('SELECT count(*) as inUsed FROM users WHERE mail =:mail', array('mail' => $data['email']));



    }

}