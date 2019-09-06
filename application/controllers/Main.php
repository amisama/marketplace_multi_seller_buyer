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
class Main extends CI_Controller {
	public function index(){
		$data['title'] = title();
		$data['description'] = description();
		$data['keywords'] = keywords();
		$data['ik1'] = $this->model_app->view_ordering_limit('iklanatas','id_iklanatas','ASC',0,1)->row_array();
		$data['ik2'] = $this->model_app->view_ordering_limit('iklanatas','id_iklanatas','ASC',1,1)->row_array();
		$data['ik3'] = $this->model_app->view_ordering_limit('iklanatas','id_iklanatas','ASC',2,1)->row_array();
		$data['ik4'] = $this->model_app->view_ordering_limit('iklanatas','id_iklanatas','ASC',3,1)->row_array();
		$data['ik5'] = $this->model_app->view_ordering_limit('iklanatas','id_iklanatas','ASC',4,1)->row_array();
		$data['kategori'] = $this->db->query("SELECT * FROM (SELECT a.*,b.produk FROM (SELECT * FROM `rb_kategori_produk`) as a LEFT JOIN
										(SELECT id_kategori_produk, COUNT(*) produk FROM rb_produk GROUP BY id_kategori_produk HAVING COUNT(id_kategori_produk)) as b on a.id_kategori_produk=b.id_kategori_produk ORDER BY RAND()) as c WHERE produk>=6 ORDER BY c.id_kategori_produk DESC LIMIT 5");
		$this->template->load(template().'/template',template().'/content',$data);
	}
}
