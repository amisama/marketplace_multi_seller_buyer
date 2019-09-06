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
class Tag extends CI_Controller {
	public function detail(){
		$query = $this->model_utama->view_where('tag',array('tag_seo' => $this->uri->segment(3)));
		if ($query->num_rows()<=0){
			redirect('main');
		}else{
			$row = $query->row_array();
			$jumlah= $this->db->query("SELECT * FROM berita where tag LIKE '%$row[tag_seo]%'")->num_rows();
			$config['base_url'] = base_url().'tag/detail/'.$this->uri->segment(3);
			$config['total_rows'] = $jumlah;
			$config['per_page'] = 15; 	
			if ($this->uri->segment('4')==''){
				$dari = 0;
			}else{
				$dari = $this->uri->segment('4');
			}
			$data['title'] = "Berita Tag $row[nama_tag]";
			$data['description'] = description();
			$data['keywords'] = keywords();
			$data['rows'] = $row;
			if (is_numeric($dari)) {
				$data['beritatag'] = $this->db->query("SELECT berita.*, users.nama_lengkap, kategori.nama_kategori, kategori.kategori_seo FROM berita 
															left join users on berita.username=users.username
																left join kategori on berita.id_kategori=kategori.id_kategori 
																	WHERE  berita.status='Y' AND berita.tag LIKE '%$row[tag_seo]%' 
																		ORDER BY id_berita DESC LIMIT $dari,$config[per_page]");
			}else{
				redirect('main');
			}
			$this->pagination->initialize($config);
			$this->template->load(template().'/template',template().'/detailtag',$data);
		}
	}
}
