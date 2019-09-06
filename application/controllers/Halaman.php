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
class Halaman extends CI_Controller {
	public function detail(){
		$query = $this->model_utama->view_join_one('halamanstatis','users','username',array('judul_seo' => $this->uri->segment(3)),'id_halaman','DESC',0,1);
		if ($query->num_rows()<=0){
			redirect('main');
		}else{
			$row = $query->row_array();
			$data['title'] = cetak($row['judul']);
			$data['description'] = cetak($row['isi_halaman']);
			$data['keywords'] = cetak(str_replace(' ',', ',$row['judul']));
			$data['rows'] = $row;

			$dataa = array('dibaca'=>$row['dibaca']+1);
			$where = array('id_halaman' => $row['id_halaman']);
			$this->model_utama->update('halamanstatis', $dataa, $where);
			$this->template->load(template().'/template',template().'/detailhalaman',$data);
		}
	}
}
