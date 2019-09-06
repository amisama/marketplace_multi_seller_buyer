<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Yahoo Messanger</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/tambah_ym',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                    <tbody>
                      <input type='hidden' name='id' value=''>
                      <tr><th width='120px' scope='row'>Nama Pengguna</th>    <td><input type='text' class='form-control' name='a' required></td></tr>
                      <tr><th scope='row'>Username</th>                       <td><input type='text' class='form-control' name='b' required></td></tr>
                      <tr><th scope='row'>Ym Icon</th>                        <td><input type='number' class='form-control' name='c' required></td></tr>
                    </tbody>
                  </table>
                </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='".base_url().$this->uri->segment(1)."/ym'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();
