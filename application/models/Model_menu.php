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
class Model_menu extends CI_model{
	function top_menu(){
		return $this->db->query("SELECT * FROM menu where position='Top' ORDER BY urutan ASC");
	}

    function menugroup(){
        return $this->db->query("SELECT * FROM group_menu ORDER BY id_group_menu DESC");
    }

    function menugroup_edit($id){
        return $this->db->query("SELECT * FROM group_menu where id_group_menu='$id'");
    }

    function menugroup_update(){
        $datadb = array('nama_group_menu'=>$this->db->escape_str($this->input->post('a')));
        $this->db->where('id_group_menu',$this->input->post('id'));
        $this->db->update('group_menu',$datadb);
    }

    function menugrouplist(){
        return $this->db->query("SELECT * FROM group_menu_list a JOIN group_menu b ON a.id_group_menu=b.id_group_menu ORDER BY a.id_group_menu DESC");
    }

    function menugrouplist_tambah(){
        $datadb = array('id_group_menu'=>$this->db->escape_str($this->input->post('a')),
                        'nama'=>$this->db->escape_str($this->input->post('b')),
                        'link'=>$this->db->escape_str($this->input->post('c')));
        $this->db->insert('group_menu_list',$datadb);
    }

    function menugrouplist_edit($id){
        return $this->db->query("SELECT * FROM group_menu_list where id_group_menu_list='$id'");
    }

    function menugrouplist_update(){
        $datadb = array('id_group_menu'=>$this->db->escape_str($this->input->post('a')),
                        'nama'=>$this->db->escape_str($this->input->post('b')),
                        'link'=>$this->db->escape_str($this->input->post('c')));
        $this->db->where('id_group_menu_list',$this->input->post('id'));
        $this->db->update('group_menu_list',$datadb);
    }

    function menugrouplist_delete($id){
        return $this->db->query("DELETE FROM group_menu_list where id_group_menu_list='$id'");
    }

    function bottom_menu(){
        return $this->db->query("SELECT * FROM menu where id_parent='0' AND position = 'Bottom' AND aktif='Ya' ORDER BY urutan ASC");
    }

    function dropdown_menu($id){
        return $this->db->query("SELECT * FROM menu WHERE id_parent='$id' AND aktif='Ya' ORDER BY urutan ASC");
    }

    function menu_website(){
		return $this->db->query("SELECT * FROM menu ORDER BY urutan");
	}

    function menu_utama(){
        return $this->db->query("SELECT * FROM menu where id_parent='0' ORDER BY urutan");
    }

    function menu_cek($id){
        return $this->db->query("SELECT * FROM menu where id_menu='$id'");
    }

    function menu_website_tambah(){
            $datadb = array('id_parent'=>$this->db->escape_str($this->input->post('b')),
                            'nama_menu'=>$this->db->escape_str($this->input->post('c')),
                            'link'=>$this->db->escape_str($this->input->post('a')),
                            'aktif'=>$this->db->escape_str('Ya'),
                            'position'=>$this->db->escape_str($this->input->post('d')),
                            'urutan'=>$this->db->escape_str($this->input->post('e')));
        $this->db->insert('menu',$datadb);
    }

    function menu_website_update(){
            $datadb = array('id_parent'=>$this->db->escape_str($this->input->post('b')),
                            'nama_menu'=>$this->db->escape_str($this->input->post('c')),
                            'link'=>$this->db->escape_str($this->input->post('a')),
                            'aktif'=>$this->db->escape_str($this->input->post('f')),
                            'position'=>$this->db->escape_str($this->input->post('d')),
                            'urutan'=>$this->db->escape_str($this->input->post('e')));
        $this->db->where('id_menu',$this->input->post('id'));
        $this->db->update('menu',$datadb);
    }

    function menu_edit($id){
        return $this->db->query("SELECT * FROM menu where id_menu='$id'");
    }

    function menu_delete($id){
        return $this->db->query("DELETE FROM menu where id_menu='$id'");
    }

}