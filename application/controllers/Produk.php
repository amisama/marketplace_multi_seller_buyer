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
class Produk extends CI_Controller {
	function index(){
		$jumlah= $this->model_app->view('rb_produk')->num_rows();
		$config['base_url'] = base_url().'produk/index';
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 24; 	
		if ($this->uri->segment('3')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('3');
		}

		if (is_numeric($dari)) {
			if ($this->input->post('kata')){
				$data['title'] = "Hasil Pencarian - ''".cetak($this->input->post('kata'))."''";
				$data['description'] = description();
				$data['keywords'] = keywords();
				$data['record'] = $this->db->query("SELECT a.*, b.nama_reseller, c.nama_kota FROM rb_produk a LEFT JOIN rb_reseller b ON a.id_reseller=b.id_reseller LEFT JOIN rb_kota c ON b.kota_id=c.kota_id where a.id_reseller!='0' AND a.id_produk_perusahaan='0' AND a.nama_produk LIKE '%".cetak($this->input->post('kata'))."%' ORDER BY a.id_produk DESC LIMIT $dari,$config[per_page]");
			}else{
				$data['title'] = title();
				$data['judul'] = 'Semua Produk Kami';
				$data['description'] = description();
				$data['keywords'] = keywords();
				$this->pagination->initialize($config);
				$data['record'] = $this->db->query("SELECT a.*, b.nama_reseller, c.nama_kota FROM rb_produk a LEFT JOIN rb_reseller b ON a.id_reseller=b.id_reseller
	                                    LEFT JOIN rb_kota c ON b.kota_id=c.kota_id where a.id_reseller!='0' AND a.id_produk_perusahaan='0' ORDER BY a.id_produk DESC LIMIT $dari,$config[per_page]");
			}

			$this->template->load(template().'/template',template().'/reseller/view_produk',$data);
		}else{
			redirect('main');
		}
	}

	function kategori(){
		$cek = $this->model_app->edit('rb_kategori_produk',array('kategori_seo'=>$this->uri->segment(3)))->row_array();
		$jumlah= $this->model_app->view_where('rb_produk',array('id_kategori_produk'=>$cek['id_kategori_produk']))->num_rows();
		$config['base_url'] = base_url().'produk/kategori/'.$this->uri->segment(3);
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 12; 	
		if ($this->uri->segment('4')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('4');
		}

		if (is_numeric($dari)) {
			$data['title'] = "Kategori - $cek[nama_kategori]";
			$data['judul'] = "Kategori - $cek[nama_kategori]";
			$data['description'] = description();
			$data['keywords'] = keywords();
			$this->pagination->initialize($config);
			$data['record'] = $this->db->query("SELECT a.*, b.nama_reseller, c.nama_kota FROM rb_produk a LEFT JOIN rb_reseller b ON a.id_reseller=b.id_reseller
                                    LEFT JOIN rb_kota c ON b.kota_id=c.kota_id where a.id_reseller!='0' AND a.id_produk_perusahaan='0' AND a.id_kategori_produk='$cek[id_kategori_produk]' ORDER BY a.id_produk DESC LIMIT $dari,$config[per_page]");
			$this->pagination->initialize($config);
			$this->template->load(template().'/template',template().'/reseller/view_kategori_all',$data);
		}else{
			redirect('main');
		}
	}

	function subkategori(){
		$cek = $this->model_app->edit('rb_kategori_produk_sub',array('kategori_seo_sub'=>$this->uri->segment(3)))->row_array();
		
		$jumlah= $this->model_app->view_where('rb_produk',array('id_kategori_produk_sub'=>$cek['id_kategori_produk_sub']))->num_rows();
		$config['base_url'] = base_url().'produk/subkategori/'.$this->uri->segment(3);
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 12; 	
		if ($this->uri->segment('4')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('4');
		}

		if (is_numeric($dari)) {
			$data['title'] = "Subkategori - $cek[nama_kategori_sub]";
			$data['judul'] = "Subkategori - $cek[nama_kategori_sub]";
			$data['description'] = description();
			$data['keywords'] = keywords();
			$this->pagination->initialize($config);
			$data['record'] = $this->db->query("SELECT a.*, b.nama_reseller, c.nama_kota FROM rb_produk a LEFT JOIN rb_reseller b ON a.id_reseller=b.id_reseller
                                    LEFT JOIN rb_kota c ON b.kota_id=c.kota_id where a.id_reseller!='0' AND a.id_produk_perusahaan='0' AND a.id_kategori_produk_sub='$cek[id_kategori_produk_sub]' ORDER BY a.id_produk DESC LIMIT $dari,$config[per_page]");
			$this->pagination->initialize($config);
			$this->template->load(template().'/template',template().'/reseller/view_kategori_all',$data);
		}else{
			redirect('main');
		}
	}


	function reseller(){
		$jumlah= $this->model_app->view('rb_reseller')->num_rows();
		$config['base_url'] = base_url().'produk/reseller';
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 18; 	
		if ($this->uri->segment('3')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('3');
		}

		if (is_numeric($dari)) {
			$data['title'] = 'Semua Daftar Pelapak';
			$data['description'] = description();
			$data['keywords'] = keywords();
			$this->pagination->initialize($config);
			if (isset($_POST['submit'])){
				$data['record'] = $this->model_reseller->cari_reseller(filter($this->input->post('cari_reseller')));
			}elseif (isset($_GET['cari_reseller'])){
				$data['record'] = $this->model_reseller->cari_reseller(filter($this->input->get('cari_reseller')));
			}else{
				$data['record'] = $this->db->query("SELECT * FROM rb_reseller a LEFT JOIN rb_kota b ON a.kota_id=b.kota_id ORDER BY id_reseller DESC LIMIT $dari,$config[per_page]");
			}
			$this->template->load(template().'/template',template().'/reseller/view_reseller',$data);
		}else{
			redirect('main');
		}
	}

	function detail_reseller(){
		$data['title'] = 'Detail Profile Reseller';
		$data['description'] = description();
		$data['keywords'] = keywords();
		$id = $this->uri->segment(3);
		$data['rows'] = $this->model_app->edit('rb_reseller',array('id_reseller'=>$id))->row_array();
		$data['record'] = $this->model_reseller->penjualan_list_konsumen($id,'reseller');
		$data['rekening'] = $this->model_app->view_where('rb_rekening_reseller',array('id_reseller'=>$id));
		$this->template->load(template().'/template',template().'/reseller/view_reseller_detail',$data);
	}


	function produk_reseller(){
		$id = $this->uri->segment(3);
		$jumlah= $this->model_app->view_where('rb_produk',array('id_reseller'=>$id))->num_rows();
		$config['base_url'] = base_url().'produk/produk_reseller/'.$this->uri->segment('3');
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 18; 	
		if ($this->uri->segment('4')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('4');
		}

		if (is_numeric($dari)) {
			$data['title'] = 'Data Produk Reseller';
			$data['description'] = description();
			$data['keywords'] = keywords();
			$data['rows'] = $this->model_app->edit('rb_reseller',array('id_reseller'=>$id))->row_array();
			$data['record'] = $this->model_app->view_where_ordering_limit('rb_produk',array('id_reseller'=>$id),'id_produk','DESC',$dari,$config['per_page']);
			$this->pagination->initialize($config);
			$this->template->load(template().'/template',template().'/reseller/view_reseller_produk',$data);
		}else{
			redirect('main');
		}
	}

	function keranjang(){
		$id_reseller = $this->uri->segment(3);
		$id_produk   = $this->uri->segment(4);

		$j = $this->model_reseller->jual_reseller($id_reseller,$id_produk)->row_array();
        $b = $this->model_reseller->beli_reseller($id_reseller,$id_produk)->row_array();
        $stok = $b['beli']-$j['jual'];

        $qty = $this->input->post('qty');
		if ($id_produk!=''){
			if ($stok < $qty){
				$produk = $this->model_app->edit('rb_produk',array('id_produk'=>$id_produk))->row_array();
				$produk_cek = filter($produk['nama_produk']);
				echo "<script>window.alert('Maaf, Stok untuk Produk $produk_cek pada Pelapak ini telah habis, silahkan menunggu atau order dengan pelapak lain!');
                                  window.location=('".base_url()."/produk/produk_reseller/$id_reseller')</script>";
			}else{
				$this->session->unset_userdata('produk');
				if ($this->session->idp == ''){
					$idp = 'TRX-'.date('YmdHis');
					$this->session->set_userdata(array('idp'=>$idp,'reseller'=>$id_reseller));
				}

				$cek = $this->model_app->view_where('rb_penjualan_temp',array('session'=>$this->session->idp,'id_produk'=>$id_produk))->num_rows();
				if ($this->session->reseller==$id_reseller){
					if ($cek >=1){
						$this->db->query("UPDATE rb_penjualan_temp SET jumlah=jumlah+$qty where session='".$this->session->idp."' AND id_produk='$id_produk'");
					}else{
						$harga = $this->model_app->view_where('rb_produk',array('id_produk'=>$id_produk))->row_array();
						$disk = $this->model_app->edit('rb_produk_diskon',array('id_produk'=>$id_produk,'id_reseller'=>$id_reseller))->row_array();
	                    $harga_konsumen = $harga['harga_konsumen'];
						$data = array('session'=>$this->session->idp,
					        		  'id_produk'=>$id_produk,
					        		  'jumlah'=>$qty,
					        		  'diskon'=>$disk['diskon'],
					        		  'harga_jual'=>$harga_konsumen,
					        		  'satuan'=>$harga['satuan'],
					        		  'waktu_order'=>date('Y-m-d H:i:s'));
						$this->model_app->insert('rb_penjualan_temp',$data);
					}
					redirect('produk/keranjang');
				}else{
					if ($this->session->idp != ''){
						$data['rows'] = $this->model_app->edit('rb_reseller',array('id_reseller'=>$this->session->reseller))->row_array();
						$data['record'] = $this->model_app->view_join_where('rb_penjualan_temp','rb_produk','id_produk',array('session'=>$this->session->idp),'id_penjualan_detail','ASC');
					}
					$data['title'] = 'Keranjang Belanja';
					$data['description'] = description();
					$data['keywords'] = keywords();
					echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Maaf, Dalam 1 Transaksi hanya boleh order dari 1 Reseller saja.</center></div>');
					redirect('produk/keranjang');
				}
			}
		}else{
			if ($this->session->idp != ''){
				$data['rows'] = $this->model_app->edit('rb_reseller',array('id_reseller'=>$this->session->reseller))->row_array();
				$data['record'] = $this->model_app->view_join_where('rb_penjualan_temp','rb_produk','id_produk',array('session'=>$this->session->idp),'id_penjualan_detail','ASC');
			}
				$data['title'] = 'Keranjang Belanja';
				$this->template->load(template().'/template',template().'/reseller/view_keranjang',$data);

		}
	}

	function keranjang_detail(){
		$data['rows'] = $this->model_reseller->penjualan_konsumen_detail($this->uri->segment(3))->row_array();
		$data['record'] = $this->model_app->view_join_where('rb_penjualan_temp','rb_produk','id_produk',array('session'=>$this->uri->segment(3)),'id_penjualan_detail','ASC');
		$data['title'] = 'Detail Belanja';
		$this->template->load(template().'/template',template().'/reseller/view_keranjang_detail',$data);
	}

	function keranjang_delete(){
		$id = array('id_penjualan_detail' => $this->uri->segment(3));
		$this->model_app->delete('rb_penjualan_temp',$id);
		$isi_keranjang = $this->db->query("SELECT sum(jumlah) as jumlah FROM rb_penjualan_temp where session='".$this->session->idp."'")->row_array();
		if ($isi_keranjang['jumlah']==''){
			$this->session->unset_userdata('idp');
			$this->session->unset_userdata('reseller');
		}
		redirect('produk/keranjang');
	}

	function kurirdata(){
		$iden = $this->model_reseller->penjualan_konsumen_detail($this->session->idp)->row_array();
		$this->load->library('rajaongkir');
		$tujuan=$this->input->get('kota');
		$dari=$iden['kota_id'];
		$berat=$this->input->get('berat');
		$kurir=$this->input->get('kurir');
		$dc=$this->rajaongkir->cost($dari,$tujuan,$berat,$kurir);
		$d=json_decode($dc,TRUE);
		$o='';
		if(!empty($d['rajaongkir']['results'])){
			$data['data']=$d['rajaongkir']['results'][0]['costs'];
			$this->load->view(template().'/reseller/kurirdata',$data);		
		}
	}

	function checkouts(){
		if (isset($_POST['submit'])){
				if ($this->session->idp!=''){
					$this->load->library('email');
					$data = array('username'=>$this->input->post('b'),
			        			  'password'=>hash("sha512", md5(date('YmdHis'))),
			        			  'nama_lengkap'=>$this->input->post('a'),
			        			  'email'=>$this->input->post('b'),
			        			  'jenis_kelamin'=>'Laki-laki',
			        			  'tanggal_lahir'=>date('Y-m-d'),
								  'tempat_lahir'=>'Belum ada informasi',
								  'alamat_lengkap'=>$this->input->post('c'),
								  'kecamatan'=>$this->input->post('g'),
								  'kota_id'=>$this->input->post('f'),
								  'no_hp'=>$this->input->post('h'),
								  'tanggal_daftar'=>date('Y-m-d H:i:s'));
					$this->model_app->insert('rb_konsumen',$data);
					$id = $this->db->insert_id();
					
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

					$session = array('session' => $this->session->idp);
					$this->model_app->delete('rb_penjualan_temp',$session);

					$data['title'] = 'Transaksi Success';
					$data['email'] = $this->input->post('b');
					$data['orders'] = $this->session->idp;

					$iden = $this->model_app->view_where('identitas',array('id_identitas'=>'1'))->row_array();
					$res = $this->model_app->view_where('rb_reseller',array('id_reseller'=>$this->session->reseller))->row_array();
					$alamat = $this->db->query("SELECT a.nama_kota as kota, b.nama_provinsi as propinsi FROM `rb_kota`a JOIN rb_provinsi b ON a.provinsi_id=b.provinsi_id where a.kota_id='".$this->input->post('f')."'")->row_array();
					$data['rekening_reseller'] = $this->model_app->view_where('rb_rekening_reseller',array('id_reseller'=>$this->session->reseller));

					$email_tujuan = $this->input->post('b');
					$tglaktif = date("d-m-Y H:i:s");

					$subject      = "$iden[nama_website] - Detail Orderan anda";
					$message      = "<html><body>Halooo! <b>".$this->input->post('a')."</b> ... <br> Hari ini pada tanggal <span style='color:red'>$tglaktif</span> Anda telah order produk di $iden[nama_website].
						<br><table style='width:100%;'>
			   				<tr><td style='background:#337ab7; color:#fff; pading:20px' cellpadding=6 colspan='2'><b>Berikut Data Anda : </b></td></tr>
							<tr><td width='140px'><b>Nama Lengkap</b></td>  <td> : ".$this->input->post('a')."</td></tr>
							<tr><td><b>Alamat Email</b></td>			<td> : ".$this->input->post('b')."</td></tr>
							<tr><td><b>No Telpon</b></td>				<td> : ".$this->input->post('h')."</td></tr>
							<tr><td><b>Alamat</b></td>					<td> : ".$this->input->post('c')." </td></tr>
							<tr><td><b>Provinsi</b></td>				<td> : ".$alamat['propinsi']." </td></tr>
							<tr><td><b>Kabupaten/Kota</b></td>			<td> : ".$alamat['kota']." </td></tr>
							<tr><td><b>Kecamatan</b></td>				<td> : ".$this->input->post('g')." </td></tr>
						</table><br>

						<table style='width:100%;'>
			   				<tr><td style='background:#337ab7; color:#fff; pading:20px' cellpadding=6 colspan='2'><b>Berikut Data Reseller : </b></td></tr>
							<tr><td width='140px'><b>Nama Reseller</b></td>	<td> : ".$res['nama_reseller']."</td></tr>
							<tr><td><b>Alamat</b></td>					<td> : ".$res['alamat_lengkap']."</td></tr>
							<tr><td><b>No Telpon</b></td>				<td> : ".$res['no_telpon']."</td></tr>
							<tr><td><b>Email</b></td>					<td> : ".$res['email']." </td></tr>
							<tr><td><b>Keterangan</b></td>				<td> : ".$res['keterangan']." </td></tr>
						</table><br>

						No Orderan anda : <b>".$this->session->idp."</b><br>
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
					          $belanjaan = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>$idp),'id_penjualan_detail','ASC');
					          foreach ($belanjaan as $row){
					          $sub_total = ($row['harga_jual']*$row['jumlah']);
					$message .= "<tr bgcolor='#e3e3e3'><td>$no</td>
					                    <td>$row[nama_produk]</td>
					                    <td>".rupiah($row['harga_jual'])."</td>
					                    <td>$row[jumlah]</td>
					                    <td>".($row['berat']*$row['jumlah'])." Gram</td>
					                    <td>Rp ".rupiah($sub_total)."</td>
					                </tr>";
					            $no++;
					          }
					          $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total, sum(b.berat*a.jumlah) as total_berat FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk where a.id_penjualan='".$idp."'")->row_array();
					$message .= "<tr bgcolor='lightgreen'>
					                  <td colspan='5'><b>Total Harga</b></td>
					                  <td><b>Rp ".rupiah($total['total'])."</b></td>
					                </tr>

					                <tr bgcolor='lightblue'>
					                  <td colspan='5'><b>Total Berat</b></td>
					                  <td><b>$total[total_berat] Gram</b></td>
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
							    $rekening = $this->model_app->view_where('rb_rekening_reseller',array('id_reseller'=>$this->session->reseller));
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
					$this->session->unset_userdata('reseller');
					$this->template->load('phpmu-one/template','phpmu-one/view_order_success',$data);
				}else{
					redirect('produk/keranjang');
				}
		}else{
			if ($this->session->id_konsumen==''){
				redirect('auth/login');
			}else{
				$data['title'] = 'Data Pelanggan';
				$data['provinsi'] = $this->model_app->view_ordering('rb_provinsi','provinsi_id','DESC');
				$this->template->load('phpmu-one/template','phpmu-one/view_checkouts',$data);
				$this->template->load(template().'/template',template().'/reseller/view_checkouts',$data);
			}
		}
	}

	function order(){
		$this->session->set_userdata(array('produk'=>$this->uri->segment(3)));
		redirect('produk/reseller');
	}

	public function detail(){
		$ids = $this->uri->segment(3);
		$dat = $this->db->query("SELECT * FROM rb_produk where produk_seo='$ids' AND id_reseller!='0'");
	    $row = $dat->row();
	    $total = $dat->num_rows();
	        if ($total == 0){
	        	redirect('main');
	        }
		$data['title'] = $row->nama_produk;
		$data['record'] = $this->model_app->view_where('rb_produk',array('id_produk'=>$row->id_produk))->row_array();
		$this->template->load(template().'/template',template().'/reseller/view_produk_detail',$data);
	}
}
