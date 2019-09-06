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
class Members extends CI_Controller {
	function foto(){
		cek_session_members();
		if (isset($_POST['submit'])){
			$this->model_reseller->modupdatefoto();
			redirect('members/profile');
		}else{
			redirect('members/profile');
		}
	}

	function profile(){
		cek_session_members();
		$data['title'] = 'Profile Anda';
		$data['row'] = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();
		$this->template->load(template().'/template',template().'/reseller/view_profile',$data);
	}

	function edit_profile(){
		cek_session_members();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_reseller->profile_update($this->session->id_konsumen);
			redirect('members/profile');
		}else{
			$data['title'] = 'Edit Profile Anda';
			$data['row'] = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();
			$row = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();
			$data['provinsi'] = $this->model_app->view_ordering('rb_provinsi','provinsi_id','ASC');
			$data['rowse'] = $this->db->query("SELECT provinsi_id FROM rb_kota where kota_id='$row[kota_id]'")->row_array();
			$this->template->load(template().'/template',template().'/reseller/view_profile_edit',$data);
		}
	}


	function reseller(){
		cek_session_members();
		$jumlah= $this->model_app->view('rb_reseller')->num_rows();
		$config['base_url'] = base_url().'members/reseller';
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 12; 	
		if ($this->uri->segment('3')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('3');
		}

		if (is_numeric($dari)) {
			$data['title'] = 'Semua Daftar Reseller';
			$this->pagination->initialize($config);
			if (isset($_POST['submit'])){
				$data['record'] = $this->model_reseller->cari_reseller(filter($this->input->post('cari_reseller')));
			}elseif (isset($_GET['cari_reseller'])){
				$data['record'] = $this->model_reseller->cari_reseller(filter($this->input->get('cari_reseller')));
				$total = $this->model_reseller->cari_reseller(filter($this->input->get('cari_reseller')));
				if ($total->num_rows()==1){
					$row = $total->row_array();
					redirect('produk/keranjang/'.$row['id_reseller'].'/'.$this->session->produk);
				}
			}else{
				$data['record'] = $this->db->query("SELECT * FROM rb_reseller a LEFT JOIN rb_kota b ON a.kota_id=b.kota_id ORDER BY id_reseller DESC LIMIT $dari,$config[per_page]");
			}
			$this->template->load(template().'/template',template().'/reseller/view_reseller',$data);
		}else{
			redirect('main');
		}
	}

	function detail_reseller(){
		cek_session_members();
		$data['title'] = 'Detail Profile Reseller';
		$id = $this->uri->segment(3);
		$data['rows'] = $this->model_app->edit('rb_reseller',array('id_reseller'=>$id))->row_array();
		$data['record'] = $this->model_reseller->penjualan_list_konsumen($id,'reseller');
		$data['rekening'] = $this->model_app->view_where('rb_rekening_reseller',array('id_reseller'=>$id));
		$this->template->load(template().'/template',template().'/reseller/view_reseller_detail',$data);

	}

	function orders_report(){
		cek_session_members();
		$data['title'] = 'Laporan Pesanan Anda';
		$data['record'] = $this->model_reseller->orders_report($this->session->id_konsumen,'reseller');
		$this->template->load(template().'/template',template().'/reseller/members/view_orders_report',$data);
	}

	function produk_reseller(){
		cek_session_members();
		$jumlah= $this->model_app->view('rb_produk')->num_rows();
		$config['base_url'] = base_url().'members/produk_reseller/'.$this->uri->segment('3');
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 12; 	
		if ($this->uri->segment('4')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('4');
		}

		if (is_numeric($dari)) {
			$data['title'] = 'Data Produk Reseller';
			$id = $this->uri->segment(3);
			$data['rows'] = $this->db->query("SELECT * FROM rb_reseller a JOIN rb_kota b ON a.kota_id=b.kota_id where a.id_reseller='$id'")->row_array();
			$data['record'] = $this->model_app->view_where_ordering_limit('rb_produk',array('id_reseller!='=>'0'),'id_produk','DESC',$dari,$config['per_page']);
			$this->pagination->initialize($config);
			$this->template->load(template().'/template',template().'/reseller/view_reseller_produk',$data);
		}else{
			redirect('main');
		}
	}

	function keranjang(){
		cek_session_members();
		$id_reseller = $this->uri->segment(3);
		$id_produk   = $this->uri->segment(4);

		$j = $this->model_reseller->jual_reseller($id_reseller,$id_produk)->row_array();
        $b = $this->model_reseller->beli_reseller($id_reseller,$id_produk)->row_array();
        $stok = $b['beli']-$j['jual'];

		if ($id_produk!=''){
			if ($stok <= '0'){
				$produk = $this->model_app->edit('rb_produk',array('id_produk'=>$id_produk))->row_array();
				$produk_cek = filter($produk['nama_produk']);
				echo "<script>window.alert('Maaf, Stok untuk Produk $produk_cek pada Reseller ini telah habis!');
                                  window.location=('".base_url()."members/reseller')</script>";
			}else{
				$this->session->unset_userdata('produk');
				if ($this->session->idp == ''){
					$kode_transaksi = 'TRX-'.date('YmdHis');
					$data = array('kode_transaksi'=>$kode_transaksi,
				        		  'id_pembeli'=>$this->session->id_konsumen,
				        		  'id_penjual'=>$id_reseller,
				        		  'status_pembeli'=>'konsumen',
				        		  'status_penjual'=>'reseller',
				        		  'waktu_transaksi'=>date('Y-m-d H:i:s'),
				        		  'proses'=>'0');
					$this->model_app->insert('rb_penjualan',$data);
					$idp = $this->db->insert_id();
					$this->session->set_userdata(array('idp'=>$idp));
				}

				$qty = $this->input->post('qty');
				$reseller = $this->model_app->view_where('rb_penjualan',array('id_penjualan'=>$this->session->idp))->row_array();
				$cek = $this->model_app->view_where('rb_penjualan_detail',array('id_penjualan'=>$this->session->idp,'id_produk'=>$id_produk))->num_rows();
				if ($reseller['id_penjual']==$id_reseller){
					if ($cek >=1){
						$this->db->query("UPDATE rb_penjualan_detail SET jumlah=jumlah+$qty where id_penjualan='".$this->session->idp."' AND id_produk='$id_produk'");
					}else{
						$harga = $this->model_app->view_where('rb_produk',array('id_produk'=>$id_produk))->row_array();
						$disk = $this->model_app->edit('rb_produk_diskon',array('id_produk'=>$id_produk,'id_reseller'=>$id_reseller))->row_array();
	                    $harga_konsumen = $harga['harga_konsumen']-$disk['diskon'];
						$data = array('id_penjualan'=>$this->session->idp,
					        		  'id_produk'=>$id_produk,
					        		  'jumlah'=>$qty,
					        		  'harga_jual'=>$harga_konsumen,
					        		  'satuan'=>$harga['satuan']);
						$this->model_app->insert('rb_penjualan_detail',$data);
					}
					redirect('members/keranjang');
				}else{
					if ($this->session->idp != ''){
						$data['rows'] = $this->model_reseller->penjualan_konsumen_detail($this->session->idp)->row_array();
						$data['record'] = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>$this->session->idp),'id_penjualan_detail','ASC');
					}
					$data['title'] = 'Keranjang Belanja';
					$data['error_reseller'] = "<div class='alert alert-danger'>Maaf, Dalam 1 Transaksi hanya boleh order dari 1 Reseller saja.</div>";
					$this->template->load(template().'/template',template().'/reseller/members/view_keranjang',$data);
				}
			}
		}else{
			if ($this->session->idp != ''){
				$data['rows'] = $this->model_reseller->penjualan_konsumen_detail($this->session->idp)->row_array();
				$data['rowsk'] = $this->model_reseller->view_join_where_one('rb_konsumen','rb_kota','kota_id',array('id_konsumen'=>$this->session->id_konsumen))->row_array();
				$data['record'] = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>$this->session->idp),'id_penjualan_detail','ASC');
			}
				$data['title'] = 'Keranjang Belanja';
				$this->template->load(template().'/template',template().'/reseller/members/view_keranjang',$data);

		}
	}

	function keranjang_detail(){
		cek_session_members();
		$data['rows'] = $this->model_reseller->penjualan_konsumen_detail($this->uri->segment(3))->row_array();
		$data['record'] = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>$this->uri->segment(3)),'id_penjualan_detail','ASC');
		$data['title'] = 'Detail Belanja';
		$this->template->load(template().'/template',template().'/reseller/members/view_keranjang_detail',$data);
	}

	function keranjang_delete(){
		$id = array('id_penjualan_detail' => $this->uri->segment(3));
		$this->model_app->delete('rb_penjualan_detail',$id);
		$isi_keranjang = $this->db->query("SELECT sum(jumlah) as jumlah FROM rb_penjualan_detail where id_penjualan='".$this->session->idp."'")->row_array();
		if ($isi_keranjang['jumlah']==''){
			$idp = array('id_penjualan' => $this->session->idp);
			$this->model_app->delete('rb_penjualan',$idp);
			$this->session->unset_userdata('idp');
		}
		redirect('members/keranjang');
	}

	function selesai_belanja(){
		if (isset($_POST['submit'])){
			$iden = $this->model_app->view_where('identitas',array('id_identitas'=>'1'))->row_array();
			$cekres = $this->model_app->view_where('rb_penjualan',array('id_penjualan'=>$this->session->idp))->row_array();
			$kons = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();

			$res = $this->model_app->view_where('rb_reseller',array('id_reseller'=>$cekres['id_penjual']))->row_array();
			$data['rekening_reseller'] = $this->model_app->view_where('rb_rekening_reseller',array('id_reseller'=>$cekres['id_penjual']));

			$data1 = array('kurir'=>$this->input->post('kurir'),
						   'service'=>$this->input->post('service'),
						   'ongkir'=>$this->input->post('ongkir'));
			$where1 = array('id_penjualan'=>$this->session->idp);
			$this->model_app->update('rb_penjualan', $data1, $where1);

			$email_tujuan = $kons['email'];
			$tglaktif = date("d-m-Y H:i:s");

			$subject      = "$iden[nama_website] - Detail Orderan anda";
			$message      = "<html><body>Halooo! <b>".$kons['nama_lengkap']."</b> ... <br> Hari ini pada tanggal <span style='color:red'>$tglaktif</span> Anda telah order produk di $iden[nama_website].
				<br><table style='width:100%;'>
	   				<tr><td style='background:#337ab7; color:#fff; pading:20px' cellpadding=6 colspan='2'><b>Berikut Data Anda : </b></td></tr>
					<tr><td width='140px'><b>Nama Lengkap</b></td>  <td> : ".$kons['nama_lengkap']."</td></tr>
					<tr><td><b>Alamat Email</b></td>			<td> : ".$kons['email']."</td></tr>
					<tr><td><b>No Telpon</b></td>				<td> : ".$kons['no_hp']."</td></tr>
					<tr><td><b>Alamat</b></td>					<td> : ".$kons['alamat_lengkap']." </td></tr>
					<tr><td><b>Negara</b></td>					<td> : ".$kons['negara']." </td></tr>
					<tr><td><b>Provinsi</b></td>				<td> : ".$kons['propinsi']." </td></tr>
					<tr><td><b>Kabupaten/Kota</b></td>			<td> : ".$kons['kota']." </td></tr>
					<tr><td><b>Kecamatan</b></td>				<td> : ".$kons['kecamatan']." </td></tr>
				</table><br>

				<table style='width:100%;'>
	   				<tr><td style='background:#337ab7; color:#fff; pading:20px' cellpadding=6 colspan='2'><b>Berikut Data Reseller : </b></td></tr>
					<tr><td width='140px'><b>Nama Reseller</b></td>	<td> : ".$res['nama_reseller']."</td></tr>
					<tr><td><b>Alamat</b></td>					<td> : ".$res['alamat_lengkap']."</td></tr>
					<tr><td><b>No Telpon</b></td>				<td> : ".$res['no_telpon']."</td></tr>
					<tr><td><b>Email</b></td>					<td> : ".$res['email']." </td></tr>
					<tr><td><b>Keterangan</b></td>				<td> : ".$res['keterangan']." </td></tr>
				</table><br>

				No Orderan anda : <b>".$cekres['kode_transaksi']."</b><br>
				Berikut Detail Data Orderan Anda :
				<table style='width:100%;' class='table table-striped'>
			          <thead>
			            <tr bgcolor='#337ab7'>
			              <th style='width:40px'>No</th>
			              <th width='47%'>Nama Produk</th>
			              <th>Harga</th>
			              <th>Qty</th>
			              <th>Berat</th>
			              <th>Subtotal</th>
			            </tr>
			          </thead>
			          <tbody>";

			          $no = 1;
			          $belanjaan = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>$this->session->idp),'id_penjualan_detail','ASC');
			          foreach ($belanjaan as $row){
			          $sub_total = ($row['harga_jual']*$row['jumlah']);
			$message .= "<tr bgcolor='#e3e3e3'><td>$no</td>
			                    <td>$row[nama_produk]</td>
			                    <td>".rupiah($row['harga_jual'])."</td>
			                    <td>$row[jumlah]</td>
			                    <td>".($row['berat']*$row['jumlah'])." Kg</td>
			                    <td>Rp ".rupiah($sub_total)."</td>
			                </tr>";
			            $no++;
			          }
			          $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total, sum(b.berat*a.jumlah) as total_berat FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk where a.id_penjualan='".$this->session->idp."'")->row_array();
			$message .= "<tr bgcolor='lightgreen'>
			                  <td colspan='5'><b>Total Harga</b></td>
			                  <td><b>Rp ".rupiah($total['total'])."</b></td>
			                </tr>

			                <tr bgcolor='lightblue'>
			                  <td colspan='5'><b>Total Berat</b></td>
			                  <td><b>$total[total_berat] Kg</b></td>
			                </tr>

			        </tbody>
			      </table><br>

			      Silahkan melakukan pembayaran ke rekening reseller :
			      <table style='width:100%;' class='table table-hover table-condensed'>
					<thead>
					  <tr bgcolor='#337ab7'>
					    <th width='20px'>No</th>
					    <th>Nama Bank</th>
					    <th>No Rekening</th>
					    <th>Atas Nama</th>
					  </tr>
					</thead>
					<tbody>";
					    $noo = 1;
					    $rekening = $this->model_app->view_where('rb_rekening_reseller',array('id_reseller'=>$cekres['id_penjual']));
					    foreach ($rekening->result_array() as $row){
			$message .= "<tr bgcolor='#e3e3e3'><td>$noo</td>
					              <td>$row[nama_bank]</td>
					              <td>$row[no_rekening]</td>
					              <td>$row[pemilik_rekening]</td>
					          </tr>";
					      $noo++;
					    }
			$message .= "</tbody>
				  </table><br><br>

			      Jika sudah melakukan transfer, jangan lupa konfirmasi transferan anda <a href='".base_url()."konfirmasi'>disini</a><br>
			      Admin, $iden[nama_website] </body></html> \n";
			
			$this->email->from($iden['email'], $iden['nama_website']);
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
			$this->session->unset_userdata('idp');
		}
		redirect('members/orders_report/orders');
	}

	function batalkan_transaksi(){
		echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Anda Telah mebatalkan Transaksi!</center></div>');
		$idp = array('id_penjualan' => $this->session->idp);
		$this->model_app->delete('rb_penjualan',$idp);
		$idp_detail = array('id_penjualan' => $this->session->idp);
		$this->model_app->delete('rb_penjualan_detail',$idp_detail);

		$this->session->unset_userdata('idp');
		redirect('members/profile');
	}

	function order(){
		cek_session_members();
		$this->session->set_userdata(array('produk'=>$this->uri->segment(3)));
		$cek = $this->db->query("SELECT b.nama_kota FROM rb_konsumen a JOIN rb_kota b ON a.kota_id=b.kota_id where a.id_konsumen='".$this->session->id_konsumen."'")->row_array();
		redirect('members/reseller?cari_reseller='.$cek['nama_kota']);
	}

	public function username_check(){
        // allow only Ajax request    
        if($this->input->is_ajax_request()) {
	        // grab the email value from the post variable.
	        $username = $this->input->post('a');

            if(!$this->form_validation->is_unique($username, 'rb_konsumen.username')) {          
	         	$this->output->set_content_type('application/json')->set_output(json_encode(array('messageusername' => 'Maaf, Username ini sudah terdaftar,..')));
            }

        }
    }

    public function email_check(){
        // allow only Ajax request    
        if($this->input->is_ajax_request()) {
	        // grab the email value from the post variable.
	        $email = $this->input->post('d');

	        if(!$this->form_validation->is_unique($email, 'rb_konsumen.email')) {          
	         	$this->output->set_content_type('application/json')->set_output(json_encode(array('message' => 'Maaf, Email ini sudah terdaftar,..')));
            }
        }
    }

	function logout(){
		cek_session_members();
		$this->session->sess_destroy();
		redirect('main');
	}
}
