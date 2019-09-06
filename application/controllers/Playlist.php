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
class Playlist extends CI_Controller {
	public function index(){
			$jumlah= $this->model_utama->view('playlist')->num_rows();
			$config['base_url'] = base_url().'playlist/index/'.$this->uri->segment(3);
			$config['total_rows'] = $jumlah;
			$config['per_page'] = 12; 	
			if ($this->uri->segment('4')==''){
				$dari = 0;
			}else{
				$dari = $this->uri->segment('4');
			}
			$data['title'] = "Playlist";
			$data['description'] = description();
			$data['keywords'] = keywords();
			if (is_numeric($dari)) {
				$data['playlist'] = $this->model_utama->view_where_ordering_limit('playlist',array('aktif' => 'Y'),'id_playlist','DESC',$dari,$config['per_page']);
			}else{
				redirect('main');
			}
			$this->pagination->initialize($config);
			$this->template->load(template().'/template',template().'/playlist',$data);
	}

	public function detail(){
		$query = $this->model_utama->view_where('playlist',array('playlist_seo' => $this->uri->segment(3)));
		if ($query->num_rows()<=0){
			redirect('main');
		}else{
			$row = $query->row_array();
			$jumlah= $this->model_utama->view_where('video',array('id_playlist' => $row['id_playlist']))->num_rows();
			$config['base_url'] = base_url().'playlist/detail/'.$this->uri->segment(3);
			$config['total_rows'] = $jumlah;
			$config['per_page'] = 12;
			if ($this->uri->segment('4')==''){
				$dari = 0;
			}else{
				$dari = $this->uri->segment('4');
			}
			$data['title'] = "Playlist $row[jdl_playlist]";
			$data['description'] = description();
			$data['keywords'] = keywords();
			$data['rows'] = $row;
			if (is_numeric($dari)){
				$data['detailplaylist'] = $this->model_utama->view_join_two('video','users','playlist','username','id_playlist',array('video.id_playlist' => $row['id_playlist']),'id_video','DESC',$dari,$config['per_page']);
			}else{
				redirect('main');
			}
			$this->pagination->initialize($config);
			$this->template->load(template().'/template',template().'/detailplaylist',$data);
		}
	}

	public function watch(){
		$query = $this->model_utama->view_join_two('video','users','playlist','username','id_playlist',array('video.video_seo' => $this->uri->segment(3)),'id_video','DESC',0,1);
		if ($query->num_rows()<=0){
			redirect('main');
		}else{
			$row = $query->row_array();
			$data['title'] = cetak($row['jdl_video']);
			$data['description'] = cetak($row['keterangan']);
			$data['keywords'] = cetak($row['tagvid']);
			$data['rows'] = $row;

			$dataa = array('dilihat'=>$row['dilihat']+1);
			$where = array('id_video' => $row['id_video']);
			$this->model_utama->update('video', $dataa, $where);

			$this->load->helper('captcha');
			$vals = array(
                'img_path'	 => './captcha/',
                'img_url'	 => base_url().'captcha/',
                'font_path' => './asset/Tahoma.ttf',
                'font_size'     => 17,
                'img_width'	 => '150',
                'img_height' => 45,
                'border' => 0, 
                'word_length'   => 5,
                'expiration' => 7200
            );

            $cap = create_captcha($vals);
            $data['image'] = $cap['image'];
            $this->session->set_userdata('mycaptcha', $cap['word']);
			$this->template->load(template().'/template',template().'/play',$data);
		}
	}

	function kirim_komentar(){
		if (isset($_POST['submit'])){
			$cek = $this->model_utama->view_where('video',array('id_video' => $this->input->post('a')));
			$row = $cek->row_array();
			if ($cek->num_rows()<=0){
				redirect('main');
			}else{
				if ($this->input->post() && (strtolower($this->input->post('secutity_code')) == strtolower($this->session->userdata('mycaptcha')))) {
					$data = array('id_video'=>cetak($this->input->post('a')),
		                            'nama_komentar'=>cetak($this->input->post('b')),
		                            'url'=>cetak($this->input->post('c')),
		                            'isi_komentar'=>cetak($this->input->post('d')),
		                            'tgl'=>date('Y-m-d'),
		                            'jam_komentar'=>date('H:i:s'),
		                            'aktif'=>'N');
					$this->model_utama->insert('komentarvid',$data);
					echo $this->session->set_flashdata('message', '<div class="alert alert-success"><center>Komentar anda akan tampil setelah kami setujui!</center></div>');
				}else{
					echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Security Code yang anda masukkan salah!</center></div>');
				}
			}

			redirect('playlist/watch/'.$row['video_seo'].'#listcomment');

		}
	}
}
