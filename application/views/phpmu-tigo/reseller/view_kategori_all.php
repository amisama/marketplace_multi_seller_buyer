<p class='sidebar-title text-danger produk-title'> &nbsp; <?php echo $judul; ?></p>
<?php 
if ($this->uri->segment(2)=='kategori'){
  $cek = $this->model_app->edit('rb_kategori_produk',array('kategori_seo'=>$this->uri->segment(3)))->row_array();
  $jumlah= $this->model_app->view_where('rb_produk',array('id_kategori_produk'=>$cek['id_kategori_produk']))->num_rows();
  if ($jumlah <= 0){
      echo "<div  style='margin:10%' class='alert alert-info'><center>Maaf, Produk pada Kategori ini belum tersedia..!</center></div>";
  }
}

if ($this->uri->segment(2)=='subkategori'){
  $cek = $this->model_app->edit('rb_kategori_produk_sub',array('kategori_seo_sub'=>$this->uri->segment(3)))->row_array();
  $jumlah= $this->model_app->view_where('rb_produk',array('id_kategori_produk_sub'=>$cek['id_kategori_produk_sub']))->num_rows();
  if ($jumlah <= 0){
      echo "<div  style='margin:10%' class='alert alert-info'><center>Maaf, Produk pada Sub Kategori ini belum tersedia..!</center></div>";
  }
}

  $no = 1;
  echo "<div class='container'>";
  foreach ($record->result_array() as $row){
  $ex = explode(';', $row['gambar']);
  if (trim($ex[0])==''){ $foto_produk = 'no-image.png'; }else{ $foto_produk = $ex[0]; }
  if (strlen($row['nama_produk']) > 38){ $judul = substr($row['nama_produk'],0,38).',..';  }else{ $judul = $row['nama_produk']; }

  $jual = $this->model_reseller->jual_reseller($row['id_reseller'],$row['id_produk'])->row_array();
  $beli = $this->model_reseller->beli_reseller($row['id_reseller'],$row['id_produk'])->row_array();
  if ($beli['beli']-$jual['jual']<=0){ $stok = '<b style="color:000">Stok Habis</b>'; }else{ $stok = "<span style='color:green'>Stok ".($beli['beli']-$jual['jual'])." $row[satuan]</span>"; }

  $disk = $this->db->query("SELECT * FROM rb_produk_diskon where id_produk='$row[id_produk]'")->row_array();
  $diskon = rupiah(($disk['diskon']/$row['harga_konsumen'])*100,0)."%";
  if ($diskon>0){ $diskon_persen = "<div class='top-right'>$diskon</div>"; }else{ $diskon_persen = ''; }
  if ($diskon>=1){ 
    $harga =  "<del style='color:#8a8a8a'><small>Rp ".rupiah($row['harga_konsumen'])."</small></del> Rp ".rupiah($row['harga_konsumen']-$disk['diskon']);
  }else{
    $harga =  "Rp ".rupiah($row['harga_konsumen']);
  }
  echo "<div class='col-md-2 col-xs-6'>
            <center>
              <div style='height:140px; overflow:hidden'>
                <a title='$row[nama_produk]' href='".base_url()."produk/detail/$row[produk_seo]'><img style='border:1px solid #cecece; min-height:140px; width:99%' src='".base_url()."asset/foto_produk/$foto_produk'></a>
                  $diskon_persen
              </div>
              <h4 class='produk-title produk-title-list'><a title='$row[nama_produk]' href='".base_url()."produk/detail/$row[produk_seo]'>$judul</a></h4>
              <span style='color:red;'>$harga</span><br>
                <i>$stok</i><br><small>$row[nama_kota]</small>
            </center><br>
        </div>";
    $no++;
  }
echo "</div>
<div class='pagination'>";
         echo $this->pagination->create_links();
    echo "</div>";

