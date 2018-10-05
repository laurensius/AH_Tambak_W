<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rest extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('mod_monitoring');
		$this->load->model('mod_log');
		$this->load->model('mod_user');

		$this->str_normal = "Normal";
		$this->str_rendah = "Rendah";
		$this->str_tinggi = "Tinggi";

		$this->notif_suhu_rendah = "Kondisi suhu di bawah batas normal.";
		$this->notif_suhu_normal = "Kondisi suhu normal.";
		$this->notif_suhu_tinggi = "Kondisi suhu di atas batas normal.";
		$this->notif_kekeruhan_rendah = "Kondisi kekeruhan air di bawah batas normal.";
		$this->notif_kekeruhan_normal = "Kondisi kekeruhan normal.";
		$this->notif_kekeruhan_tinggi = "Kondisi kekeruhan air di atas batas normal.";
		$this->notif_kedalaman_rendah = "Kondisi air tambak di bawah batas normal.";
		$this->notif_kedalaman_normal = "Kondisi kedalaman normal.";
		$this->notif_kedalaman_tinggi = "Kondisi air tambak di atas batas normal.";
	}

	public function index(){
		$data["recent"] = $this->mod_monitoring->select();
		$data["notif"] = $this->mod_log->select();
		$this->load->view('monitoring',$data);
	}

	public function insert(){
		header('Content-type:JSON');
		if($this->uri->segment(3) != null && $this->uri->segment(4) != null && $this->uri->segment(5) != null){
			$val_suhu = $this->uri->segment(3);
			$val_kekeruhan = $this->uri->segment(4);
			$val_kedalaman = $this->uri->segment(5);

			$notif_suhu = '';
			$notif_kekeruhan = '';
			$notif_kedalaman = '';

			$tanggal = date("Y-m-d H:i:s");

			if($val_suhu > 0 && $val_suhu <= 14){
				$cat_suhu = $this->str_rendah;
				$notif_suhu .= $this->notif_suhu_rendah;
			}else
			if($val_suhu > 15 && $val_suhu <= 24){
				$cat_suhu = $this->str_normal;
			}else
			if($val_suhu > 25){
				$cat_suhu = $this->str_tinggi;
				$notif_suhu .= $this->notif_suhu_tinggi;
			}

			if($val_kekeruhan > 0 && $val_kekeruhan <= 300){
				$cat_kekeruhan = $this->str_tinggi;
				$notif_kekeruhan .= $this->notif_kekeruhan_tinggi;
			}else
			if($val_kekeruhan > 301 && $val_kekeruhan <= 675){
				$cat_kekeruhan = $this->str_normal;
			}else
			if($val_kekeruhan > 676){
				$cat_kekeruhan = $this->str_rendah;
				$notif_kekeruhan .= $this->notif_kekeruhan_rendah;
			}

			if($val_kedalaman > 0 && $val_kedalaman <= 7){
				$cat_kedalaman = $this->str_rendah;
				$notif_kedalaman .= $this->notif_kedalaman_rendah;
			}else
			if($val_kedalaman > 8 && $val_kedalaman <= 20){
				$cat_kedalaman = $this->str_normal;
			}else
			if($val_kedalaman > 20){
				$cat_kedalaman = $this->str_tinggi;
				$notif_kedalaman .= $this->notif_kedalaman_tinggi;
			}

			if($cat_suhu != $this->str_normal || $cat_kekeruhan != $this->str_normal || $cat_kedalaman != $this->str_normal){
				$pesan_notifikasi = trim($notif_suhu . " " . $notif_kekeruhan . " " . $notif_kedalaman);
				$data_log = array(
					"val_suhu" => $val_suhu,
					"val_kekeruhan" => $val_kekeruhan,
					"val_kedalaman" => $val_kedalaman,
					"cat_suhu" => $cat_suhu,
					"cat_kekeruhan" => $cat_kekeruhan,
					"cat_kedalaman" => $cat_kedalaman,
					"datetime" => $tanggal,
					"pesan_notifikasi" => $pesan_notifikasi
				);
				$this->mod_log->insert($data_log);
			}

			$data_monitoring = array(
				"val_suhu" => $val_suhu,
				"val_kekeruhan" => $val_kekeruhan,
				"val_kedalaman" => $val_kedalaman,
				"cat_suhu" => $cat_suhu,
				"cat_kekeruhan" => $cat_kekeruhan,
				"cat_kedalaman" => $cat_kedalaman,
				"datetime" => $tanggal
			);

			$insert = $this->mod_monitoring->update($data_monitoring);

			if($insert > 0){
				$response = array(
					"severity" => "success",
					"message" => "Penyimpanan data berhasil"
				);
			}else{
				$response = array(
					"severity" => "warning",
					"message" => "Penyimpanan data gagal"
				);
			}

		}else{
			$response = array(
				"severity" => "warning",
				"message" => "Parameter yang dikirim ke server tidak lengkap"
			);
		}
		echo json_encode($response,JSON_PRETTY_PRINT);
	}

	public function verifikasi(){ 
		header('Content-type:JSON');
		if($this->input->post('username') == null && $this->input->post('password') == null){
			$login = file_get_contents('php://input');
			$json = json_decode($login);
			if($json == null){
				$severity = "warning";
				$message = "Tidak ada data dikirim ke server";
				$data_count = "0";
				$data = array();
				$username = null;
				$password = null;
			}else{
				$username = $json->username;
				$password = $json->password;
			}
		}else{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
		}
		if($username != null && $password != null ){
			$check = $this->mod_user->is_registered($username);
			if(sizeof($check) > 0){
				if($check[0]->password == md5($password)){
					$severity = "success";
					$message = "Login berhasil";
					$data_count = (string)sizeof($check);
					$data = $check;
				}else{
					$severity = "warning";
					$message = "Nama pengguna dan kata sandi tidak sesuai";
					$data_count = "0";
					$data = array();
				}
			}else{
				$severity = "danger";
				$message = "Nama pengguna tidak terdaftar";
				$data_count = "0";
				$data = $check;
			}
		}else{
			$severity = "warning";
			$message = "Tidak ada data dikirim ke server";
			$data_count = "0";
			$data = array();
		}
		$response = array(
			"severity" => $severity,
			"message" => $message,
			"data_count" => $data_count,
			"data" => $data
		);
		echo json_encode($response,JSON_PRETTY_PRINT);
	}

	public function android(){
		header('Content-type:JSON');
		$android = array(
			"recent" => $this->mod_monitoring->select(),
			"notif" => $this->mod_log->select()
		);
		echo json_encode($android,JSON_PRETTY_PRINT);
	}

	public function mqtt(){
		$output = shell_exec('mosquitto_pub -m "hello dr php '. rand(0,10000) .'" -t "rnz"');
		echo "<pre>$output</pre>";
	}
}
