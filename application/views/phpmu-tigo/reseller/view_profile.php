<?php 
echo "<p class='sidebar-title text-danger produk-title'> Data Profile Anda 
        <a class='btn btn-success btn-xs pull-right' href='".base_url()."members/edit_profile'><span class='glyphicon glyphicon-edit'></span> Edit Profile</a></p>";
        echo $this->session->flashdata('message'); 
        $this->session->unset_userdata('message');
        echo "<p>Berikut Informasi Data Profile anda.<br> 
           Pastikan data-data dibawah ini sudah benar, agar tidak terjadi kesalahan saat transaksi.</p>";                
                  echo "<table class='table table-hover table-condensed'>
                        <thead>
                          <tr><td width='170px'><b>Username</b></td> <td><b style='color:red'>$row[username]</b></td></tr>
                          <tr><td><b>Nama Lengkap</b></td>           <td>$row[nama_lengkap]</td></tr>
                          <tr><td><b>Email</b></td>                  <td>$row[email]</td></tr>
                          <tr><td><b>Jenis Kelamin</b></td>          <td>$row[jenis_kelamin]</td></tr>
                          <tr><td><b>Tanggal Lahir</b></td>          <td>".tgl_indo($row['tanggal_lahir'])."</td></tr>
                          <tr><td><b>Tempat Lahir</b></td>           <td>$row[tempat_lahir]</td></tr>
                          <tr><td><b>Alamat</b></td>                 <td>$row[alamat_lengkap]</td></tr>
                          
                          <tr><td><b>Propinsi</b></td>               <td>".$row['propinsi']."</td></tr>
                          <tr><td><b>Kota</b></td>                   <td>".$row['kota']."</td></tr>
                          <tr><td><b>Kecamatan</b></td>              <td>$row[kecamatan]</td></tr>
                          <tr><td><b>No Hp</b></td>                  <td>$row[no_hp]</td></tr>
                        </thead>
                    </table>";

/*
echo "<table id='example11' class='table table-hover table-condensed'>
  <thead>
    <tr>
      <th width='20px'>No</th>
      <th>Nama Penjual</th>
      <th>Belanja & Ongkir</th>
      <th>Status</th>
      <th>Total + Ongkir</th>
      <th></th>
    </tr>
  </thead>
  <tbody>";

      $no = 1;
      $record = $this->model_reseller->orders_report($this->session->id_konsumen,'reseller');
      foreach ($record->result_array() as $row){
      if ($row['proses']=='0'){ $proses = '<i class="text-danger">Pending</i>'; }elseif($row['proses']=='1'){ $proses = '<i class="text-success">Proses</i>'; }else{ $proses = '<i class="text-info">Konfirmasi</i>'; }
      $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
      echo "<tr><td>$no</td>
                <td><a href='".base_url()."members/detail_reseller/$row[id_reseller]'><small><b>$row[nama_reseller]</b></small><br><small class='text-success'>$row[kode_transaksi]</small></a></td>
                <td><span style='color:blue;'>Rp ".rupiah($total['total'])."</span> <br> <small><i style='color:green;'><b style='text-transform:uppercase'>$row[kurir]</b> - Rp ".rupiah($row['ongkir'])."</i></small></td>
                <td>$proses <br><small>$row[nama_reseller]</small></td>
                <td style='color:red;'>Rp ".rupiah($total['total']+$row['ongkir'])."</td>
                <td width='130px'>";
                if ($row['proses']=='0'){
                  echo "<a style='margin-right:3px' class='btn btn-success btn-sm' title='Konfirmasi Pembayaran' href='".base_url()."konfirmasi?kode=$row[kode_transaksi]'>Konfirmasi</a>";
                }else{
                  echo "<a style='margin-right:3px' class='btn btn-default btn-sm' href='#'  onclick=\"return confirm('Maaf, Pembayaran ini sudah di konfirmasi!')\">Konfirmasi</a>";
                }
              
              echo "<a class='btn btn-info btn-sm' title='Detail data pesanan' href='".base_url()."members/keranjang_detail/$row[id_penjualan]'><span class='glyphicon glyphicon-search'></span></a></td>
            </tr>";
        $no++;
      }

  echo "</tbody>
</table>"; */
?>