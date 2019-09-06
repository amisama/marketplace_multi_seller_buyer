<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Rekening Bank Reseller</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/edit_rekening',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_rekening_reseller]'>
                    <tr><th width='120px' scope='row'>Nama Bank</th>    <td><input type='text' class='form-control' name='a' value='$rows[nama_bank]' required></td></tr>
                    <tr><th scope='row'>No Rekening</th>                 <td><input type='number' class='form-control' name='b' value='$rows[no_rekening]'></td></tr>
                    <tr><th scope='row'>Atas Nama</th>                   <td><input type='text' class='form-control' name='c' value='$rows[pemilik_rekening]'></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url().$this->uri->segment(1)."/rekening'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
