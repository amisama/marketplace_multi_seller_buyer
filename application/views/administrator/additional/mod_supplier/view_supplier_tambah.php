<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data supplier</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_supplier',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='130px' scope='row'>Nama Supplier</th>  <td><input class='form-control' type='text' name='a'></td></tr>
                    <tr><th scope='row'>Kontak Person</th>                <td><input class='form-control' type='text' name='b'></td></tr>
                    <tr><th scope='row'>Alamat Lengkap</th>               <td><textarea class='form-control' name='c'></textarea></td></tr>
                    <tr><th scope='row'>No Hp</th>                        <td><input class='form-control' type='number' name='d'></td></tr>
                    <tr><th scope='row'>Alamat Email</th>                 <td><input class='form-control' type='email' name='e'></td></td></tr>
                    <tr><th scope='row'>Kode Pos</th>                     <td><input class='form-control' type='number' name='f'></td></tr>
                    <tr><th scope='row'>No Telpon</th>                    <td><input class='form-control' type='number' name='g'></td></tr>
                    <tr><th scope='row'>Fax</th>                    <td><input class='form-control' type='number' name='h'></td></tr>
                    <tr><th scope='row'>Keterangan</th>                   <td><textarea class='form-control' name='i'></textarea></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambah</button>
                    <a href='".base_url()."supplier'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
