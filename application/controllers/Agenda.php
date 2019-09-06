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
class Agenda extends CI_Controller {
	public function index(){
			$jumlah= $this->model_utama->view('agenda')->num_rows();
			$config['base_url'] = base_url().'agenda/index/'.$this->uri->segment(3);
			$config['total_rows'] = $jumlah;
			$config['per_page'] = 15; 	
			if ($this->uri->segment('4')==''){
				$dari = 0;
			}else{
				$dari = $this->uri->segment('4');
			}
			$data['title'] = "Agenda";
			$data['description'] = description();
			$data['keywords'] = keywords();
			if (is_numeric($dari)) {
				$data['agenda'] = $this->model_utama->view_join('agenda','users','username','id_agenda','DESC',$dari,$config['per_page']);
			}else{
				redirect('main');
			}
			$this->pagination->initialize($config);
			$this->template->load(template().'/template',template().'/agenda',$data);
	}

	public function detail(){
		$query = $this->model_utama->view_join_one('agenda','users','username',array('tema_seo' => $this->uri->segment(3)),'id_agenda','DESC',0,1);
		if ($query->num_rows()<=0){
			redirect('main');
		}else{
			$row = $query->row_array();
			$data['title'] = cetak($row['tema']);
			$data['description'] = cetak($row['isi_agenda']);
			$data['keywords'] = cetak(str_replace(' ',', ',$row['tema']));
			$data['rows'] = $row;

			$dataa = array('dibaca'=>$row['dibaca']+1);
			$where = array('id_agenda' => $row['id_agenda']);
			$this->model_utama->update('agenda', $dataa, $where);
			$this->template->load(template().'/template',template().'/detailagenda',$data);
		}
	}
}
