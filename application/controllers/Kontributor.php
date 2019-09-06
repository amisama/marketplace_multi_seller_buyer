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
class Kontributor extends CI_Controller {
	public function index(){
		$data['title'] = "Pendaftaran Kontributor";
		$data['description'] = description();
		$data['keywords'] = keywords();

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
		$this->template->load(template().'/template',template().'/kontributor',$data);
	}

	function pendaftaran(){
		if (isset($_POST['submit'])){
			$cek = $this->model_app->view_where('users',array('username'=>cetak($this->input->post('a'))));
			if ($cek->num_rows()>0){
				echo $this->session->set_flashdata('message', '<div class="alert alert-danger">Maaf, Username '.cetak($this->input->post('a')).' tidak tersedia !</div>');
				redirect('kontributor');
			}else{
				$config['upload_path'] = 'asset/foto_user/';
	            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
	            $config['max_size'] = '1000'; // kb
	            $this->load->library('upload', $config);
	            $this->upload->do_upload('f');
	            $hasil=$this->upload->data();
	            if ($this->input->post() && (strtolower($this->input->post('secutity_code')) == strtolower($this->session->userdata('mycaptcha')))) {
		            if ($hasil['file_name']==''){
		                    $data = array('username'=>cetak($this->input->post('a')),
		                                    'password'=>hash("sha512", md5(cetak($this->input->post('b')))),
		                                    'nama_lengkap'=>cetak($this->input->post('c')),
		                                    'email'=>cetak($this->input->post('d')),
		                                    'no_telp'=>cetak($this->input->post('e')),
		                                    'level'=>'kontributor',
		                                    'blokir'=>'N',
		                                    'id_session'=>md5(cetak($this->input->post('a'))).'-'.date('YmdHis'));
		            }else{
		                    $data = array('username'=>cetak($this->input->post('a')),
		                                    'password'=>hash("sha512", md5(cetak($this->input->post('b')))),
		                                    'nama_lengkap'=>cetak($this->input->post('c')),
		                                    'email'=>cetak($this->input->post('d')),
		                                    'no_telp'=>cetak($this->input->post('e')),
		                                    'foto'=>$hasil['file_name'],
		                                    'level'=>'kontributor',
		                                    'blokir'=>'N',
		                                    'id_session'=>md5(cetak($this->input->post('a'))).'-'.date('YmdHis'));
		            }

		            $this->model_app->insert('users',$data);
		            $datam = array('id_session'=>md5(cetak($this->input->post('a'))).'-'.date('YmdHis'),
		                           'id_modul'=>18);
		            $this->model_app->insert('users_modul',$datam);
		            $this->session->set_userdata('upload_image_file_manager',true);
					$this->session->set_userdata(array('username'=>cetak($this->input->post('a')),
									   'level'=>'kontributor',
	                                   'id_session'=>md5(cetak($this->input->post('a'))).'-'.date('YmdHis')));
				}
				redirect('administrator/home');
			}
		}
	}
}
