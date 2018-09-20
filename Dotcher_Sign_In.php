<?php

if (! defined('BASEPATH')) exit('No direct script access allowed');

class Dotcher_Sign_In extends CI_Controller {

//pertama , kalau kata ka dinda log_in itu dimaksud dengan mengeset data
	//kalau log_up itu mengambil data
	// script login
	public function login(){

	$data = array();
	$email = $this -> input -> post ('email');
	$password = $this -> input -> post('password');
	
	$queri = $this -> db -> where('email', $email);
	$queri = $this -> db -> where ('password', $password);

		if ($queri) {
			$query = $this -> db -> get('sign_in');

		if ($query -> num_rows() > 0) {
			$data['result'] = 'true';
			$data['pesan'] = 'Login berhasil';
			$data['sign_in'] = array();

			foreach ($query -> result() as $row) {
				$dataa=array();
				$dataa["id"]=$row->id_user;
				$dataa["email"]=$row->email;
				$dataa["password"]=$row->password;
				array_push($data["sign_in"],$dataa);

			}
			echo json_encode($data);

		} else {
			$data['result'] = 'false';
			$data['pesan'] = 'Login gagal';
		echo json_encode($data);

	}
}

}

	public function daftar(){
		$data = array();

		
		$email = $this -> input -> post('email');
		$password = $this -> input -> post('password');
		$username = $this -> input -> post('username');
		$alamat=$this ->  input -> post('alamat');



		$this -> db -> where('email', $email);
		$q = $this -> db -> get('sign_in');

		if ($q -> num_rows()> 0) {
			$data['result'] = 'false';
			$data['pesan'] = 'email sudah ada';
		} else {
			$simpan = array();
			$simpan['email'] = $email;
			$simpan['password'] = $password;
			$simpan['username'] = $username;
			$simpan['alamat'] = $alamat;
			$status = $this -> db -> insert('sign_in', $simpan);

			if ($status) {
				$data['result'] = 'true';
				$data['pesan'] = 'Register berhasil';
			} else {
				$data['result'] = 'false';
				$data['pesan'] = 'Register gagal';
			}

			echo json_encode($data);
		}
	}
}






?>



