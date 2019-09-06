<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Modul Website</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/tambah_manajemenmodul',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th width='120px' scope='row'>Nama Modul</th>  <td><input type='text' class='form-control' name='a' required></td></tr>
                    <tr><th scope='row'>Link</th>              <td style='color:red'><b>".base_url()."administrator/</b> <input type='text' class='form-control' name='b' style='width:50%; display:inline-block' required></td></tr>
                    <tr><th scope='row'>Publish</th>                <td><input type='radio' name='c' value='Y' checked> Ya &nbsp; <input type='radio' name='c' value='N'> Tidak</td></tr>
                    <tr><th scope='row'>Aktif</th>                <td><input type='radio' name='d' value='Y' checked> Ya &nbsp; <input type='radio' name='d' value='N'> Tidak</td></tr>
                    <tr><th scope='row'>Status</th>                <td><input type='radio' name='e' value='admin' checked> Admin &nbsp; <input type='radio' name='e' value='user'> User</td></tr>
                  </tbody>
                  </table>
                </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='".base_url().$this->uri->segment(1)."/manajemenmodul'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();
