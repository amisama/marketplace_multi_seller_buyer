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
class Konfirmasi extends CI_Controller {
	function index(){
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$config['upload_path'] = 'asset/files/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '10000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('f');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
				$data = array('id_penjualan'=>$this->input->post('id'),
			        		  'total_transfer'=>$this->input->post('b'),
			        		  'id_rekening'=>$this->input->post('c'),
			        		  'nama_pengirim'=>$this->input->post('d'),
			        		  'tanggal_transfer'=>$this->input->post('e'),
			        		  'waktu_konfirmasi'=>date('Y-m-d H:i:s'));
				$this->model_app->insert('rb_konfirmasi_pembayaran_konsumen',$data);
			}else{
				$data = array('id_penjualan'=>$this->input->post('id'),
			        		  'total_transfer'=>$this->input->post('b'),
			        		  'id_rekening'=>$this->input->post('c'),
			        		  'nama_pengirim'=>$this->input->post('d'),
			        		  'tanggal_transfer'=>$this->input->post('e'),
			        		  'bukti_transfer'=>$hasil['file_name'],
			        		  'waktu_konfirmasi'=>date('Y-m-d H:i:s'));
				$this->model_app->insert('rb_konfirmasi_pembayaran_konsumen',$data);
			}
				$data1 = array('proses'=>'2');
				$where = array('id_penjualan' => $this->input->post('id'));
				$this->model_app->update('rb_penjualan', $data1, $where);
			redirect('members/keranjang_detail/'.$this->input->post('id'));
		}else{
			$data['title'] = 'Konfirmasi Orderan anda';
			$data['description'] = description();
			$data['keywords'] = keywords();
			if (isset($_POST['submit1']) OR $_GET['kode']){
				if ($_GET['kode']!=''){
					$kode_transaksi = filter($this->input->get('kode'));
				}else{
					$kode_transaksi = filter($this->input->post('a'));
				}
				$row = $this->db->query("SELECT a.id_penjualan, b.id_reseller FROM `rb_penjualan` a jOIN rb_reseller b ON a.id_penjual=b.id_reseller where status_penjual='reseller' AND a.kode_transaksi='$kode_transaksi'")->row_array();
				$data['record'] = $this->model_app->view('rb_rekening');
				$data['total'] = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total, a.id_penjualan FROM `rb_penjualan_detail` a where a.id_penjualan='".$row['id_penjualan']."'")->row_array();
				$data['rows'] = $this->model_app->view_where('rb_penjualan',array('id_penjualan'=>$row['id_penjualan']))->row_array();
				$this->template->load(template().'/template',template().'/reseller/view_konfirmasi_pembayaran',$data);
			}else{
				$this->template->load(template().'/template',template().'/reseller/view_konfirmasi_pembayaran',$data);
			}
		}
	}

	function tracking(){
		if (isset($_POST['submit1']) OR $this->uri->segment(3)!=''){
			if ($this->uri->segment(3)!=''){
				$kode_transaksi = filter($this->uri->segment(3));
			}else{
				$kode_transaksi = filter($this->input->post('a'));
			}

			$cek = $this->model_app->view_where('rb_penjualan',array('kode_transaksi'=>$kode_transaksi));
			if ($cek->num_rows()>=1){
				$data['title'] = 'Tracking Order '.$kode_transaksi;
				$data['description'] = description();
				$data['keywords'] = keywords();
				$data['rows'] = $this->db->query("SELECT * FROM rb_penjualan a JOIN rb_konsumen b ON a.id_pembeli=b.id_konsumen JOIN rb_kota c ON b.kota_id=c.kota_id where a.kode_transaksi='$kode_transaksi'")->row_array();
				$data['record'] = $this->db->query("SELECT a.kode_transaksi, b.*, c.nama_produk, c.satuan, c.berat, c.produk_seo FROM `rb_penjualan` a JOIN rb_penjualan_detail b ON a.id_penjualan=b.id_penjualan JOIN rb_produk c ON b.id_produk=c.id_produk where a.kode_transaksi='".$kode_transaksi."'");
				$data['total'] = $this->db->query("SELECT a.kode_transaksi, a.kurir, a.service, a.proses, a.ongkir, sum(b.harga_jual*b.jumlah) as total, sum(b.diskon*b.jumlah) as diskon_total, sum(c.berat*b.jumlah) as total_berat FROM `rb_penjualan` a JOIN rb_penjualan_detail b ON a.id_penjualan=b.id_penjualan JOIN rb_produk c ON b.id_produk=c.id_produk where a.kode_transaksi='".$kode_transaksi."'")->row_array();
				$this->template->load(template().'/template',template().'/reseller/view_tracking_view',$data);
			}else{
				redirect('konfirmasi/tracking');
			}
		}else{
			$data['title'] = 'Tracking Order';
			$data['description'] = description();
			$data['keywords'] = keywords();
			$this->template->load(template().'/template',template().'/reseller/view_tracking',$data);
		}
	}
}
