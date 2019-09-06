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
class Konsultasi extends CI_Controller {
	public function index(){
			$jumlah= $this->model_utama->view('tbl_comment')->num_rows();
			$config['base_url'] = base_url().'konsultasi/index/'.$this->uri->segment(3);
			$config['total_rows'] = $jumlah;
			$config['per_page'] = 50; 	
			if ($this->uri->segment('3')==''){
				$dari = 0;
			}else{
				$dari = $this->uri->segment('3');
			}
			$data['title'] = "Konsultasi";
			$data['description'] = description();
			$data['keywords'] = keywords();
			if (is_numeric($dari)) {
				$data['konsultasi'] = $this->model_utama->view_where_ordering_limit('tbl_comment',array('reply'=>0),'id_komentar','DESC',0,$config['per_page']);
			}else{
				redirect('main');
			}
			$data['usr'] = $this->model_utama->view_where('users', array('username'=>$this->session->username))->row_array();
			$this->pagination->initialize($config);

			$this->load->helper('captcha');
			$vals = array(
                'img_path'	 => './captcha/',
                'img_url'	 => base_url().'captcha/',
                'font_path' => './asset/Tahoma.ttf',
                'font_size'     => 17,
                'img_width'	 => '150',
                'img_height' => 33,
                'border' => 0, 
                'word_length'   => 5,
                'expiration' => 7200
            );

            $cap = create_captcha($vals);
            $data['image'] = $cap['image'];
            $this->session->set_userdata('mycaptcha', $cap['word']);
			$this->template->load(template().'/template',template().'/konsultasi',$data);
	}

	function reply(){
		if (isset($_POST['submit'])){
			$data = array('reply'=>cetak($this->input->post('a')),
                            'nama_lengkap'=>cetak($this->input->post('b')),
                            'alamat_email'=>cetak($this->input->post('c')),
                            'isi_pesan'=>cetak($this->input->post('d')),
                            'tanggal_komentar'=>date('Y-m-d'),
                            'jam_komentar'=>date('H:i:s'));
			$this->model_utama->insert('tbl_comment',$data);
			$id_komentar = $this->db->insert_id();
			redirect('konsultasi#comment-'.$id_komentar);
		}
	}

	function delete(){
        cek_session_admin();
		$id = array('id_komentar' => $this->uri->segment(3));
        $this->model_app->delete('tbl_comment',$id);
		redirect('konsultasi#comment-'.$this->uri->segment(3));
	}


}
