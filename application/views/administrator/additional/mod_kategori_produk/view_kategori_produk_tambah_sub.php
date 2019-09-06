<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Sub Kategori Produk</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_kategori_produk_sub',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th scope='row'>Kategori</th>                   <td><select name='b' class='form-control' required>
                                                                            <option value='' selected>- Pilih Kategori Produk -</option>";
                                                                            $kategori = $this->db->query("SELECT * FROM rb_kategori_produk");
                                                                            foreach ($kategori->result_array() as $row){
                                                                                echo "<option value='$row[id_kategori_produk]'>$row[nama_kategori]</option>";
                                                                            }
                    echo "</td></tr>
                    <tr><th width='140px' scope='row'>Nama Sub Kategori</th>    <td><input type='text' class='form-control' name='a' required></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
