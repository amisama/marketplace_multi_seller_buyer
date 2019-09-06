<?php
echo "<div class='widget'>
    <h3>Tentang Pelapak</h3>";
        
      echo "<table class='table table-condensed'>
      <tbody>";
        if (trim($rows['foto'])==''){ $foto_user = 'users.gif'; }else{ $foto_user = $rows['foto']; }
        $ex = explode(' ', $rows['tanggal_daftar']);
        $sukses = $this->db->query("SELECT * FROM rb_penjualan where id_penjual='$rows[id_reseller]' AND status_penjual='reseller' AND proses!='0'");
        $pelanggan = $this->db->query("SELECT * FROM rb_penjualan where id_penjual='$rows[id_reseller]' AND status_pembeli='konsumen' AND status_penjual='reseller' GROUP BY id_pembeli");
        echo "<tr bgcolor='#e3e3e3'><td rowspan='4' style='width:70px'><center><img style='border:1px solid #cecece; height:60px; width:60px' src='".base_url()."asset/foto_user/$foto_user' class='img-circle img-thumbnail'></center></td></tr>
        <tr><td colspan='2'><b style='font-size:16px'>$rows[nama_reseller]</b></td></tr>
        <tr><td colspan='2'><span class='glyphicon glyphicon-globe'></span> $rows[nama_kota]</td></tr>
        <tr><td colspan='2'><span class='glyphicon glyphicon-phone-alt'></span> $rows[no_telpon]</td></tr>
      </tbody>
      </table>
</div>

<a class='btn btn-xs btn-block btn-success' href='".base_url()."produk/produk_reseller/$rows[id_reseller]'>Semua Produk</a>
<a class='btn btn-xs btn-block btn-info' href='".base_url()."produk/detail_reseller/$rows[id_reseller]'>Lihat Profile</a>
<a class='btn btn-xs btn-block btn-default' href=''>Jumlah Pelanggan <span class='badge'>".$pelanggan->num_rows()."</span></a>
<a class='btn btn-xs btn-block btn-default' href=''>Pesanan Diterima <span class='badge'>".$sukses->num_rows()."</span></a>
<a class='btn btn-xs btn-block btn-default' href=''>Bergabung <span class='badge'>".tgl_indo($ex[0])."</span></a>

<br><img style='width:100%' src='".base_url()."asset/foto_pasangiklan/ekpedisi2.jpg'>";
?>