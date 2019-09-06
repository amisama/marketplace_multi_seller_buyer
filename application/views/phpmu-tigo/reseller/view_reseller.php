<p class='sidebar-title block-title'>Daftar Semua Pelapak</p>
  <?php 
    $attributes = array('class'=>'pull-right','role'=>'form','style'=>'width:100%;');
    echo form_open_multipart('produk/reseller',$attributes); 
    echo "<input type='search' name='cari_reseller' class='form-control' style='display:inline-block; width:96%;' placeholder='Cari nama pelapak atau kota pelapak terdekat disini...'>
          <button class='btn btn-primary' type='submit' name='submit' style='margin-top:-4px'><span class='glyphicon glyphicon-search'></span></button>";
    echo form_close();
    if (isset($_POST['submit'])){
      echo "<i class='text-danger'>Hasil Pencarian dengan keyword : <b>".filter($this->input->post('cari_reseller'))."</b></i>";
    }
    echo "<hr><div style='clear:both'><br></div>";


    $no = 1;
    foreach ($record->result_array() as $row){
      if (!file_exists("asset/foto_user/$row[foto]") OR $row['foto']==''){
        $foto_user = "blank.png";
      }else{
        $foto_user = $row['foto'];
      }
      if (trim($row['nama_kota'])==''){ $kota = '<i style="color:red">Kota Tidak Ada..</i>'; }else{ $kota = "<i style='color:blue'>Kota $row[nama_kota]</i>"; }
    echo "<div class='col-md-2 col-xs-6' style='margin-bottom:20px'>
              <center><img style='border:1px solid #cecece; height:85px; width:85px' src='".base_url()."asset/foto_user/$foto_user' class='img-circle img-thumbnail'><br>
              <b>$row[nama_reseller]</b> <br>
              <span>$kota</span><br>";
              if($this->session->level=='konsumen'){ $akses = 'members'; }else{ $akses = 'produk'; }
                if ($this->session->produk == ''){
                  echo "<a class='btn btn-info btn-xs' title='Detail Data' href='".base_url()."$akses/detail_reseller/$row[id_reseller]'><span class='glyphicon glyphicon-user'></span> Profile</a>
                        <a class='btn btn-success btn-xs' title='Lihat Produk' href='".base_url()."$akses/produk_reseller/$row[id_reseller]'><span class='glyphicon glyphicon-folder-open'></span> Produk</a>";
                }else{
                  echo "<a style='width:60px' class='btn btn-info btn-xs' title='Detail Data' href='".base_url()."$akses/detail_reseller/$row[id_reseller]'><span class='glyphicon glyphicon-user'></span> Profile</a>
                        <a style='width:60px' class='btn btn-primary btn-xs' title='Detail Data' href='".base_url()."$akses/keranjang/$row[id_reseller]/".$this->session->produk."'><span class='glyphicon glyphicon-ok'></span> Produk</a>";
                }
              
              echo "</center>
          </div>";
      $no++;
    }

    echo "<div style='clear:both'><br></div>";
    echo $this->pagination->create_links();
  ?>

