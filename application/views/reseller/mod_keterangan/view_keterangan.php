<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Keterangan</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/keterangan',$attributes); 
          echo "<div class='col-md-12'>
                  <div class='alert alert-warning'><b>PENTING!</b> - Informasi ini akan ditampilkan pada Keranjang Belanja Konsumen yang order produk anda.</div>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$record[id_keterangan]'>
                    <tr><th width='120px' scope='row'>Keterangan</th>                  <td><textarea class='textarea form-control' name='a' style='height:300px'>$record[keterangan]</textarea></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                  </div>
            </div>";
