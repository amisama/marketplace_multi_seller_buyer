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
class Model_reseller extends CI_model{
    function top_menu(){
        return $this->db->query("SELECT * FROM menu where position='Top' ORDER BY urutan ASC");
    }
    
    function testimoni(){
        return $this->db->query("SELECT a.*, b.nama_lengkap, b.id_konsumen FROM testimoni a JOIN rb_konsumen b ON a.id_konsumen=b.id_konsumen ORDER BY a.id_testimoni DESC");
    }

    function testimoni_update(){
        $datadb = array('isi_testimoni'=>$this->input->post('b'),
                            'aktif'=>$this->input->post('f'));
        $this->db->where('id_testimoni',$this->input->post('id'));
        $this->db->update('testimoni',$datadb);
    }

    function testimoni_edit($id){
        return $this->db->query("SELECT a.*, b.nama_lengkap, b.id_konsumen FROM testimoni a JOIN rb_konsumen b ON a.id_konsumen=b.id_konsumen where a.id_testimoni='$id'");
    }

    function testimoni_delete($id){
        return $this->db->query("DELETE FROM testimoni where id_testimoni='$id'");
    }

    function public_testimoni($sampai, $dari){
        return $this->db->query("SELECT a.*, b.nama_lengkap, b.foto, b.id_konsumen, b.jenis_kelamin FROM testimoni a JOIN rb_konsumen b ON a.id_konsumen=b.id_konsumen  where a.aktif='Y' ORDER BY a.id_testimoni DESC LIMIT $dari, $sampai");
    }

    function hitung_testimoni(){
        return $this->db->query("SELECT * FROM testimoni where aktif='Y'");
    }

    function insert_testimoni(){
            $datadb = array('id_konsumen'=>$this->session->id_konsumen,
                            'isi_testimoni'=>$this->input->post('testimoni'),
                            'aktif'=>'N',
                            'waktu_testimoni'=>date('Y-m-d H:i:s'));
        $this->db->insert('testimoni',$datadb);
    }

    function cari_reseller($kata){
        $pisah_kata = explode(" ",$kata);
        $jml_katakan = (integer)count($pisah_kata);
        $jml_kata = $jml_katakan-1;
        $cari = "SELECT * FROM rb_reseller a LEFT JOIN rb_kota b ON a.kota_id=b.kota_id WHERE";
            for ($i=0; $i<=$jml_kata; $i++){
              $cari .= " a.nama_reseller LIKE '%".$pisah_kata[$i]."%' OR b.nama_kota LIKE '%".$pisah_kata[$i]."%' ";
                if ($i < $jml_kata ){
                    $cari .= " OR "; 
                } 
            }
        $cari .= " ORDER BY a.id_reseller DESC LIMIT 36";
        return $this->db->query($cari);
    }

    public function view_join_rows($table1,$table2,$field,$where,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->where($where);
        $this->db->order_by($order,$ordering);
        return $this->db->get();
    }

    function penjualan_list_konsumen($id,$level){
        return $this->db->query("SELECT * FROM `rb_penjualan` a JOIN rb_konsumen b ON a.id_pembeli=b.id_konsumen where a.status_penjual='$level' AND a.id_penjual='$id' ORDER BY a.id_penjualan DESC");
    }

    function jual($id){
        return $this->db->query("SELECT sum(a.jumlah) as jual FROM rb_penjualan_detail a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan where a.id_produk='$id' AND b.status_penjual='admin' AND b.proses='1'");
    }

    function beli($id){
        return $this->db->query("SELECT sum(a.jumlah_pesan) as beli FROM rb_pembelian_detail a where a.id_produk='$id'");
    }

    function jual_reseller($penjual, $produk){
        return $this->db->query("SELECT sum(jumlah) as jual FROM `rb_penjualan` a JOIN rb_penjualan_detail b ON a.id_penjualan=b.id_penjualan where a.status_pembeli='konsumen' AND a.status_penjual='reseller' AND a.id_penjual='$penjual' AND b.id_produk='$produk' AND a.proses='1'");
    }

    function beli_reseller($pembeli, $produk){
        return $this->db->query("SELECT sum(jumlah) as beli FROM `rb_penjualan` a JOIN rb_penjualan_detail b ON a.id_penjualan=b.id_penjualan where a.status_pembeli='reseller' AND a.status_penjual='admin' AND a.id_pembeli='$pembeli' AND b.id_produk='$produk' AND a.proses='1'");
    }

    function penjualan_konsumen_detail($id){
        return $this->db->query("SELECT * FROM `rb_penjualan` a JOIN rb_reseller b ON a.id_penjual=b.id_reseller JOIN rb_kota c ON b.kota_id=c.kota_id where a.id_penjualan='$id'");
    }

    function profile_konsumen($id){
        return $this->db->query("SELECT a.id_konsumen, a.username, a.nama_lengkap, a.email, a.jenis_kelamin, a.tanggal_lahir, a.tempat_lahir, a.alamat_lengkap, a.kecamatan, a.no_hp, a.tanggal_daftar, b.kota_id, b.nama_kota as kota, c.provinsi_id, c.nama_provinsi as propinsi FROM `rb_konsumen` a LEFT JOIN rb_kota b ON a.kota_id=b.kota_id LEFT JOIN rb_provinsi c ON b.provinsi_id=c.provinsi_id where a.id_konsumen='$id'");
    }

    function orders_report($id,$level){
        return $this->db->query("SELECT * FROM `rb_penjualan` a JOIN rb_reseller b ON a.id_penjual=b.id_reseller where a.status_penjual='$level' AND a.id_pembeli='$id' ORDER BY a.id_penjualan DESC");
    }

    function agenda_terbaru($limit){
        return $this->db->query("SELECT * FROM agenda ORDER BY id_agenda DESC LIMIT $limit");
    }

    public function view_join_where_one($table1,$table2,$field,$where){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->where($where);
        return $this->db->get();
    }

    function modupdatefoto(){
        $config['upload_path'] = 'asset/foto_user/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|gif|JPEG|jpeg';
        $config['max_size']     = '1000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload();
        $hasil=$this->upload->data();

        $config['image_library'] = 'gd2';
        $config['source_image'] = 'asset/foto_user/'.$hasil['file_name'];
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['height']       = 622;
        $this->load->library('image_lib', $config);
        $this->image_lib->crop();

        $datadb = array('foto'=>$hasil['file_name']);
        $this->db->where('id_konsumen',$this->session->id_konsumen);
        $this->db->update('rb_konsumen',$datadb);
    }

    function modupdatefotoreseller(){
        $config['upload_path'] = 'asset/foto_user/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|gif|JPEG|jpeg';
        $config['max_size']     = '1000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload();
        $hasil=$this->upload->data();

        $config['image_library'] = 'gd2';
        $config['source_image'] = 'asset/foto_user/'.$hasil['file_name'];
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['height']       = 622;
        $this->load->library('image_lib', $config);
        $this->image_lib->crop();

        $datadb = array('foto'=>$hasil['file_name']);
        $this->db->where('id_reseller',$this->session->id_reseller);
        $this->db->update('rb_reseller',$datadb);
    }

    function profile_update($id){
        if (trim($this->input->post('a')) != ''){
            $datadbd = array('username'=>$this->db->escape_str(strip_tags($this->input->post('aa'))),
                            'password'=>hash("sha512", md5($this->input->post('a'))),
                            'nama_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('b'))),
                            'email'=>$this->db->escape_str(strip_tags($this->input->post('c'))),
                            'jenis_kelamin'=>$this->db->escape_str($this->input->post('d')),
                            'tanggal_lahir'=>$this->db->escape_str($this->input->post('e')),
                            'tempat_lahir'=>$this->db->escape_str(strip_tags($this->input->post('f'))),
                            'alamat_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('g'))),
                            'kecamatan'=>$this->db->escape_str(strip_tags($this->input->post('k'))),
                            'kota_id'=>$this->db->escape_str(strip_tags($this->input->post('ga'))),
                            'no_hp'=>$this->db->escape_str(strip_tags($this->input->post('l'))));
        }else{
           $datadbd = array('username'=>$this->db->escape_str(strip_tags($this->input->post('aa'))),
                            'nama_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('b'))),
                            'email'=>$this->db->escape_str(strip_tags($this->input->post('c'))),
                            'jenis_kelamin'=>$this->db->escape_str($this->input->post('d')),
                            'tanggal_lahir'=>$this->db->escape_str($this->input->post('e')),
                            'tempat_lahir'=>$this->db->escape_str(strip_tags($this->input->post('f'))),
                            'alamat_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('g'))),
                            'kecamatan'=>$this->db->escape_str(strip_tags($this->input->post('k'))),
                            'kota_id'=>$this->db->escape_str(strip_tags($this->input->post('ga'))),
                            'no_hp'=>$this->db->escape_str(strip_tags($this->input->post('l'))));
        }
        $this->db->where('id_konsumen',$id);
        $this->db->update('rb_konsumen',$datadbd);
    }

    function penjualan_list_konsumen_top($id,$level){
        return $this->db->query("SELECT * FROM `rb_penjualan` a JOIN rb_konsumen b ON a.id_pembeli=b.id_konsumen where a.status_penjual='$level' AND a.id_penjual='$id' ORDER BY a.id_penjualan DESC LIMIT 10");
    }

    function reseller_pembelian($id,$level){
        return $this->db->query("SELECT * FROM `rb_penjualan` a JOIN rb_reseller b ON a.id_pembeli=b.id_reseller where a.status_penjual='$level' AND a.id_pembeli='$id' ORDER BY a.id_penjualan DESC");
    }

    function penjualan_detail($id){
        return $this->db->query("SELECT * FROM `rb_penjualan` a JOIN rb_reseller b ON a.id_pembeli=b.id_reseller where a.id_penjualan='$id'");
    }

    function penjualan_konsumen_detail_reseller($id){
        return $this->db->query("SELECT * FROM `rb_penjualan` a JOIN rb_konsumen b ON a.id_pembeli=b.id_konsumen where a.id_penjualan='$id'");
    }

    function penjualan_list($id,$level){
        return $this->db->query("SELECT * FROM `rb_penjualan` a JOIN rb_reseller b ON a.id_pembeli=b.id_reseller where a.status_penjual='$level' AND a.id_penjual='$id' ORDER BY a.id_penjualan DESC");
    }

    function pembelian($id_reseller){
        return $this->db->query("SELECT sum((b.jumlah*b.harga_jual)-b.diskon) as total FROM rb_penjualan a JOIN rb_penjualan_detail b ON a.id_penjualan=b.id_penjualan where a.status_penjual='admin' AND a.id_pembeli='".$id_reseller."' AND a.proses='1'");
    }

    function penjualan_perusahaan($id_reseller){
        return $this->db->query("SELECT sum((a.jumlah*a.harga_jual)-a.diskon) as total, sum(a.jumlah) as produk FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where c.status_penjual='reseller' AND b.id_produk_perusahaan!='0' AND id_penjual='".$id_reseller."' AND c.proses='1'");
    }

    function penjualan($id_reseller){
        return $this->db->query("SELECT sum((a.jumlah*a.harga_jual)-a.diskon) as total, sum(a.jumlah) as produk FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk
                                    JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where c.status_penjual='reseller' AND b.id_produk_perusahaan='0' AND id_penjual='".$id_reseller."' AND c.proses='1'");
    }

    function modal_perusahaan($id_reseller){
        return $this->db->query("SELECT sum(a.jumlah*b.harga_reseller) as total FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where c.status_pembeli='konsumen' AND c.proses='1' AND c.id_penjual='".$id_reseller."' AND b.id_produk_perusahaan!='0'");
    }

    function modal_pribadi($id_reseller){
        return $this->db->query("SELECT sum(a.jumlah*b.harga_beli) as total FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where c.status_pembeli='konsumen' AND c.proses='1' AND c.id_penjual='".$id_reseller."' AND b.id_produk_perusahaan='0'");
    }

    function produk_perkategori($id_reseller,$id_produk_perusahaan,$id_kategori_produk,$limit){
        return $this->db->query("SELECT a.*, b.nama_reseller, c.nama_kota FROM rb_produk a LEFT JOIN rb_reseller b ON a.id_reseller=b.id_reseller
                                    LEFT JOIN rb_kota c ON b.kota_id=c.kota_id where a.id_reseller!='$id_reseller' AND a.id_produk_perusahaan='$id_produk_perusahaan' AND a.id_kategori_produk='$id_kategori_produk' ORDER BY a.id_produk DESC LIMIT $limit");
    }

}