<div class='col-md-12'>
  <div class='box box-info'>
    <div class='box-header with-border'>
      <h3 class='box-title'>Detail Data Supplier</h3>
      <a class='pull-right btn btn-warning btn-sm' href='<?php echo base_url(); ?>administrator/supplier'>Kembali</a>
    </div>
    <div class='box-body'>
      <table class='table table-condensed table-bordered'>
        <tbody>
          <tr bgcolor='#e3e3e3'><th rowspan='14' width='110px'><center><?php echo "<img style='border:1px solid #cecece; height:85px; width:85px' src='".base_url()."asset/foto_user/users.gif' class='img-circle img-thumbnail'>"; ?></center></th></tr>
          <tr><th width='130px' scope='row'>Nama Supplier</th> <td><?php echo $rows['nama_supplier']; ?></td></tr>
          <tr><th scope='row'>Kontak Person</th> <td><?php echo $rows['kontak_person']; ?></td></tr>
          <tr><th scope='row'>Alamat Lengkap</th> <td><?php echo $rows['alamat_lengkap']; ?></td></tr>
          <tr><th scope='row'>No Hp</th> <td><?php echo $rows['no_hp']; ?></td></tr>
          <tr><th scope='row'>Alamat Email</th> <td><?php echo $rows['alamat_email']; ?></td></tr>
          <tr><th scope='row'>Kode Pos</th> <td><?php echo tgl_indo($rows['kode_pos']); ?></td></tr>
          <tr><th scope='row'>No Telpon</th> <td><?php echo $rows['no_telpon']; ?></td></tr>
          <tr><th scope='row'>Fax</th> <td><?php echo $rows['fax']; ?></td></tr>
          <tr><th scope='row'>Keterangan</th> <td><?php echo $rows['keterangan']; ?></td></tr>
         
        </tbody>
      </table>
             
    </div>
  </div>
</div>