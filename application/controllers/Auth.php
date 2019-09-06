<?php
/*
-- ---------------------------------------------------------------
-- MARKETPLACE MULTI BUYER MULTI SELLER + SUPPORT RESELLER SYSTEM
-- CREATED BY : ROBBY PRIHANDAYA
-- COPYRIGHT  : Copyright (c) 2018 - 2019, PHPMU.COM. (https://phpmu.com/)
-- LICENSE    : http://opensource.org/licenses/MIT  MIT License
-- CREATED ON : 2019-03-26
-- UPDATED ON : 2019-03-27
-- ---------------------------------------------------------------
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
	function city(){
		$state_id = $this->input->post('stat_id');
		$data['kota'] = $this->model_app->view_where_ordering('rb_kota',array('provinsi_id' => $state_id),'kota_id','DESC');
		$this->load->view(template().'/reseller/view_city',$data);		
	}

	public function register(){
		if (isset($_POST['submit1'])){
			$data = array('username'=>$this->input->post('a'),
	        			  'password'=>hash("sha512", md5($this->input->post('b'))),
	        			  'nama_lengkap'=>$this->input->post('c'),
	        			  'email'=>$this->input->post('d'),
	        			  'alamat_lengkap'=>$this->input->post('e'),
	        			  'kota_id'=>$this->input->post('h'),
	        			  'kecamatan'=>$this->input->post('i'),
						  'no_hp'=>$this->input->post('j'),
						  'tanggal_daftar'=>date('Y-m-d H:i:s'));
			$this->model_app->insert('rb_konsumen',$data);
			$id = $this->db->insert_id();
			$this->session->set_userdata(array('id_konsumen'=>$id, 'level'=>'konsumen'));

			if ($this->session->idp!=''){
				$data = array('kode_transaksi'=>$this->session->idp,
			        		  'id_pembeli'=>$id,
			        		  'id_penjual'=>$this->session->reseller,
			        		  'status_pembeli'=>'konsumen',
			        		  'status_penjual'=>'reseller',
			        		  'waktu_transaksi'=>date('Y-m-d H:i:s'),
			        		  'proses'=>'0');
				$this->model_app->insert('rb_penjualan',$data);
				$idp = $this->db->insert_id();

				$keranjang = $this->model_app->view_where('rb_penjualan_temp',array('session'=>$this->session->idp));
				foreach ($keranjang->result_array() as $row) {
					$dataa = array('id_penjualan'=>$idp,
				        		   'id_produk'=>$row['id_produk'],
				        		   'jumlah'=>$row['jumlah'],
				        		   'harga_jual'=>$row['harga_jual'],
				        		   'satuan'=>$row['satuan']);
					$this->model_app->insert('rb_penjualan_detail',$dataa);
				}

				$this->db->query("DELETE FROM rb_penjualan_temp where session='".$this->session->idp."'");
				$this->session->unset_userdata('reseller');
				$this->session->unset_userdata('idp');
				$this->session->set_userdata(array('idp'=>$idp));
			}
			redirect('members/profile');

		}elseif (isset($_POST['submit2'])){
			$cek  = $this->model_app->view_where('rb_reseller',array('username'=>$this->input->post('a')))->num_rows();
			if ($cek >= 1){
				$username = $this->input->post('a');
				echo "<script>window.alert('Maaf, Username $username sudah dipakai oleh orang lain!');
                                  window.location=('".base_url()."/auth/register')</script>";
			}else{
				$route = array('administrator','agenda','auth','berita','contact','download','gallery','konfirmasi','main','members','page','produk','reseller','testimoni','video');
				if (in_array($this->input->post('a'), $route)){
					$username = $this->input->post('a');
					echo "<script>window.alert('Maaf, Username $username sudah dipakai oleh orang lain!');
	                                  window.location=('".base_url()."/".$this->input->post('i')."')</script>";
				}else{
				$data = array('username'=>$this->input->post('a'),
		        			  'password'=>hash("sha512", md5($this->input->post('b'))),
		        			  'nama_reseller'=>$this->input->post('c'),
		        			  'jenis_kelamin'=>$this->input->post('d'),
		        			  'kota_id'=>$this->input->post('kota'),
		        			  'alamat_lengkap'=>$this->input->post('e'),
		        			  'no_telpon'=>$this->input->post('f'),
							  'email'=>$this->input->post('g'),
							  'kode_pos'=>$this->input->post('h'),
							  'referral'=>$this->input->post('i'),
							  'tanggal_daftar'=>date('Y-m-d H:i:s'));
				$this->model_app->insert('rb_reseller',$data);
				$id = $this->db->insert_id();
				$this->session->set_userdata(array('id_reseller'=>$id, 'level'=>'reseller'));
				redirect('reseller/home');
				}
			}
		}else{
			$data['title'] = 'Formulir Pendaftaran';
			$data['provinsi'] = $this->model_app->view_ordering('rb_provinsi','provinsi_id','ASC');
			$this->template->load(template().'/template',template().'/reseller/view_register',$data);
		}
	}

	public function login(){
		if (isset($_POST['login'])){
				$username = strip_tags($this->input->post('a'));
				$password = hash("sha512", md5(strip_tags($this->input->post('b'))));
				$cek = $this->db->query("SELECT * FROM rb_konsumen where username='".$this->db->escape_str($username)."' AND password='".$this->db->escape_str($password)."'");
			    $row = $cek->row_array();
			    $total = $cek->num_rows();
				if ($total > 0){
					$this->session->set_userdata(array('id_konsumen'=>$row['id_konsumen'], 'level'=>'konsumen'));
					if ($this->session->idp!=''){
						$data = array('kode_transaksi'=>$this->session->idp,
			        			  'id_pembeli'=>$row['id_konsumen'],
			        			  'id_penjual'=>$this->session->reseller,
			        			  'status_pembeli'=>'konsumen',
			        			  'status_penjual'=>'reseller',
			        			  'waktu_transaksi'=>date('Y-m-d H:i:s'),
			        			  'proses'=>'0');
						$this->model_app->insert('rb_penjualan',$data);
						$id = $this->db->insert_id();

						$query_temp = $this->db->query("SELECT * FROM rb_penjualan_temp where session='".$this->session->idp."'");
						foreach ($query_temp->result_array() as $r) {
							$data = array('id_penjualan'=>$id,
			        			  'id_produk'=>$r['id_produk'],
			        			  'jumlah'=>$r['jumlah'],
			        			  'diskon'=>$r['diskon'],
			        			  'harga_jual'=>$r['harga_jual'],
			        			  'satuan'=>$r['satuan']);
							$this->model_app->insert('rb_penjualan_detail',$data);
						}
						$this->db->query("DELETE FROM rb_penjualan_temp where session='".$this->session->idp."'");

						$this->session->unset_userdata('reseller');
						$this->session->unset_userdata('idp');
						$this->session->set_userdata(array('idp'=>$id));
					}
					redirect('members/profile');
				}else{
					$data['title'] = 'Gagal Login';
					echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Maaf, Username atau password salah!</center></div>');
					redirect('auth/login');
				}
		}else{
			$data['title'] = 'User Login';
			$this->template->load(template().'/template',template().'/reseller/view_login',$data);
		}
	}

	public function lupass(){
		if (isset($_POST['lupa'])){
			$email = strip_tags($this->input->post('a'));
			$cek = $this->db->query("SELECT * FROM rb_konsumen where email='".$this->db->escape_str($email)."'");
		    $row = $cek->row_array();
		    $total = $cek->num_rows();
			if ($total > 0){
				$identitas = $this->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
				$randompass = generateRandomString(10);
				$passwordbaru = hash("sha512", md5($randompass));
				$this->db->query("UPDATE rb_konsumen SET password='$passwordbaru' where email='".$this->db->escape_str($email)."'");

				if ($row['jenis_kelamin']=='Laki-laki'){ $panggill = 'Bpk.'; }else{ $panggill = 'Ibuk.'; }
				$email_tujuan = $row['email'];
				$tglaktif = date("d-m-Y H:i:s");
				$subject      = 'Permintaan Reset Password ...';
				$message      = "<html><body>Halooo! <b>$panggill ".$row['nama_lengkap']."</b> ... <br> Hari ini pada tanggal <span style='color:red'>$tglaktif</span> Anda Mengirimkan Permintaan untuk Reset Password
					<table style='width:100%; margin-left:25px'>
		   				<tr><td style='background:#337ab7; color:#fff; pading:20px' cellpadding=6 colspan='2'><b>Berikut Data Informasi akun Anda : </b></td></tr>
						<tr><td><b>Nama Lengkap</b></td>			<td> : ".$row['nama_lengkap']."</td></tr>
						<tr><td><b>Alamat Email</b></td>			<td> : ".$row['email']."</td></tr>
						<tr><td><b>No Telpon</b></td>				<td> : ".$row['no_hp']."</td></tr>
						<tr><td><b>Jenis Kelamin</b></td>			<td> : ".$row['jenis_kelamin']." </td></tr>
						<tr><td><b>Tempat Lahir</b></td>				<td> : ".$row['tempat_lahir']." </td></tr>
						<tr><td><b>Tanggal Lahir</b></td>			<td> : ".$row['tanggal_lahir']." </td></tr>
						<tr><td><b>Alamat Lengkap</b></td>			<td> : ".$row['alamat_lengkap']." </td></tr>
						<tr><td><b>Waktu Daftar</b></td>			<td> : ".$row['tanggal_daftar']."</td></tr>
					</table>
					<br> Username Login : <b style='color:red'>$row[username]</b>
					<br> Password Login : <b style='color:red'>$randompass</b>
					<br> Silahkan Login di : <a href='$identitas[url]'>$identitas[url]</a> <br>
					Admin, $identitas[nama_website] </body></html> \n";
				
				$this->email->from($identitas['email'], $identitas['nama_website']);
				$this->email->to($email_tujuan);
				$this->email->cc('');
				$this->email->bcc('');

				$this->email->subject($subject);
				$this->email->message($message);
				$this->email->set_mailtype("html");
				$this->email->send();
				
				$config['protocol'] = 'sendmail';
				$config['mailpath'] = '/usr/sbin/sendmail';
				$config['charset'] = 'utf-8';
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = 'html';
				$this->email->initialize($config);

				$data['email'] = $email;
				$data['title'] = 'Permintaan Reset Password Sudah Terkirim...';
				$this->template->load('phpmu-one/template','phpmu-one/view_lupass_success',$data);
			}else{
				$data['email'] = $email;
				$data['title'] = 'Email Tidak Ditemukan...';
				$this->template->load('phpmu-one/template','phpmu-one/view_lupass_error',$data);
			}
		}
	}
}
