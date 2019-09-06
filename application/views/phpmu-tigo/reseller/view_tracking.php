<p class='sidebar-title block-title'><?php echo $title; ?></p>
<?php 
    $attributes = array('class'=>'form-horizontal','role'=>'form');
    echo form_open_multipart('konfirmasi/tracking',$attributes); 
    echo "<div class='alert alert-info'>Masukkan No Invoice atau No Transaksi Terlebih dahulu!</div>
      <table class='table table-condensed'>
        <tbody>
          <tr><th scope='row' width='120px'>No Invoice</th>       <td><input type='text' name='a' class='form-control' style='width:100%' placeholder='TRX-0000000000' required>
        </tbody>
      </table>

      <div class='box-footer'>
        <button type='submit' name='submit1' class='btn btn-info'>Cek Invoice</button>
      </div>";
    echo form_close();
