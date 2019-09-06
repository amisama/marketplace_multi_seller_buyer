<?php
echo "<div class='wrapper'>			
	<div class='header-logo'>";
		  $iden = $this->model_utama->view('identitas')->row_array();
		  $logo = $this->model_utama->view_ordering_limit('logo','id_logo','DESC',0,1);
		  foreach ($logo->result_array() as $row) {
			echo "<a href='".base_url()."'><img style='height:40px' src='".base_url()."asset/logo/$row[gambar]'/></a>";
		  }
	echo "
	</div>	
	<div class='mainmenu hidden-xs'>
	    <ul class='mainnav'>
	        <li class='hassubs first'><a href='#'><span class='glyphicon glyphicon-th-list'></span>&nbsp; Kategori</a>
	        	<ul class='dropdown-phpmu'>";
	        	$kategori = $this->model_app->view('rb_kategori_produk');
				foreach ($kategori->result_array() as $rows) {
					$sub_kategori = $this->db->query("SELECT * FROM rb_kategori_produk_sub where id_kategori_produk='$rows[id_kategori_produk]'");
					if ($sub_kategori->num_rows()>=1){
						echo "<li class='subs hassubs'><a href='".base_url()."produk/kategori/$rows[kategori_seo]'> $rows[nama_kategori] <span class='caret caret-right'></span></a>
							  <ul class='dropdown-phpmu'>";
							   foreach ($sub_kategori->result_array() as $row) { 
								  echo "<li class='subs'><a href='".base_url()."produk/subkategori/$row[kategori_seo_sub]'>$row[nama_kategori_sub]</a></li>";
							   }
							  echo "</ul></li>";
					}else{
						echo "<li class='subs'><a href='".base_url()."produk/kategori/$rows[kategori_seo]'> <a href='".base_url()."produk/kategori/$rows[kategori_seo]'> $rows[nama_kategori]</a></li>";
					}
				}
				echo "</ul>";
	        echo "</li>
	    </ul>
	</div>

	<div class='header-menu'>
		<div class='header-search'>
			".form_open('produk/index')."
				<input type='text' placeholder='Akun Mau Belanja..'' name='kata' class='search-input' required/>
				<input type='submit' value='Search' name='cari' class='search-button'/>
			</form>
		</div>
	</div>
	
	<div class='header-addons'>
		<span class='city'>
		  ".hari_ini(date('w')).", ".tgl_indo(date('Y-m-d')).", <span id='jam'></span></span><br>";
		  if ($this->session->id_konsumen != ''){
		      $ksm = $this->db->query("SELECT * FROM rb_konsumen where id_konsumen='".$this->session->id_konsumen."'")->row_array();
		  }

          if ($this->session->id_konsumen != ''){
          	$isi_keranjang = $this->db->query("SELECT sum(jumlah) as jumlah FROM rb_penjualan_detail where id_penjualan='".$this->session->idp."'")->row_array();
            echo "<a href='".base_url()."members/orders_report'>Lihat Status Transaksi</a> &nbsp; &nbsp; 
            	  <a href='".base_url()."members/keranjang'><b> 
            	  	<span class='glyphicon glyphicon glyphicon-shopping-cart' style='font-size:19px'></span></b> 
            	  	<span class='badge badgee'>".rupiah($isi_keranjang['jumlah'])."</span></a> &nbsp; 
            	  <a class='btn btn-xs btn-success' style='padding:1px 12px' href='".base_url()."members/profile'>Account</a> 
            	  <a class='btn btn-xs btn-danger' style='padding:1px 12px' href='".base_url()."members/logout'>Logout</a><br>";

            
          }else{
          	$isi_keranjang = $this->db->query("SELECT sum(jumlah) as jumlah FROM rb_penjualan_temp where session='".$this->session->idp."'")->row_array();
			 echo "<a href='".base_url()."members/orders_report'>Lihat Status Transaksi</a> &nbsp; 
			 		<a href='".base_url()."produk/keranjang'> 
			 			<span class='glyphicon glyphicon glyphicon-shopping-cart' style='font-size:19px'></span></b> 
            	  	<span class='badge badgee'>".rupiah($isi_keranjang['jumlah'])."</span></a> &nbsp; ";
            echo "<a class='btn btn-xs btn-success' style='width:60px' href='".base_url()."auth/login'>Login</a> 
                  <a class='btn btn-xs btn-default' style='width:60px; color:#000' href='".base_url()."auth/register'>Daftar</a>";
            
          }
	echo "</div>
</div>

<div class='main-menu sticky'>	
	<div class='wrapper'>";
		function main_menu() {
			$ci = & get_instance();
	        $query = $ci->db->query("SELECT id_menu, nama_menu, link, id_parent FROM menu where aktif='Ya' AND position='Bottom' order by urutan");
	        $menu = array('items' => array(),'parents' => array());
	        foreach ($query->result() as $menus) {
	            $menu['items'][$menus->id_menu] = $menus;
	            $menu['parents'][$menus->id_parent][] = $menus->id_menu;
	        }
	        if ($menu) {
	            $result = build_main_menu(0, $menu);
	            return $result;
	        }else{
	            return FALSE;
	        }
	    }

		function build_main_menu($parent, $menu) {
			$ci = & get_instance();
	        $html = "";
	        if (isset($menu['parents'][$parent])) {
	        	if ($parent=='0'){
		            $html .= "<ul class='the-menu'>
		            			<li><a href='".base_url()."' style='background: url(".base_url()."asset/images/home.png) no-repeat center; font-size:0; width:34px;'><br></a></li>";
		        }else{
		        	$html .= "<ul>";
		        }
	            foreach ($menu['parents'][$parent] as $itemId) {
	                if (!isset($menu['parents'][$itemId])) {
	                    if(preg_match("/^http/", $menu['items'][$itemId]->link)) {
	                        $html .= "<li><a target='_BLANK' href='".$menu['items'][$itemId]->link."'>".$menu['items'][$itemId]->nama_menu."</a></li>";
	                    }else{
	                        $html .= "<li><a href='".base_url().''.$menu['items'][$itemId]->link."'>".$menu['items'][$itemId]->nama_menu."</a></li>";
	                    }
	                }
	                if (isset($menu['parents'][$itemId])) {
	                    if(preg_match("/^http/", $menu['items'][$itemId]->link)) {
	                        $html .= "<li><a target='_BLANK' href='".$menu['items'][$itemId]->link."'><span>".$menu['items'][$itemId]->nama_menu."</span></a>";
	                    }else{
	                        $html .= "<li><a href='".base_url().''.$menu['items'][$itemId]->link."'><span>".$menu['items'][$itemId]->nama_menu."</span></a>";
	                    }
	                    $html .= build_main_menu($itemId, $menu);
	                    $html .= "</li>";
	                }
	            }

	            if ($parent=='0'){
		            // Keranjang Bisa Disini...
				}

	            $html .= "</ul>";
	        }
	        return $html;
	    }
	    echo main_menu();
	echo "</div>
</div>";



echo "<div class='secondary-menu'>
	<div class='wrapper'>
		<ul>";
				$tag = $this->model_utama->view_ordering_limit('tag','id_tag','RANDOM',0,14);
		  		foreach ($tag->result_array() as $row) {
					echo "<li><a href='".base_url()."tag/detail/$row[tag_seo]'>$row[nama_tag]</a></li>";
				}
		echo "</ul>
	</div>
</div>";