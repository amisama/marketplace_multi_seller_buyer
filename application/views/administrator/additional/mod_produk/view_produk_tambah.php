<script language="JavaScript" type="text/JavaScript">
  function showSub(){
    <?php
    $query = $this->db->query("SELECT * FROM rb_kategori_produk");
    foreach ($query->result_array() as $data) {
       $id_kategori_produk = $data['id_kategori_produk'];
       echo "if (document.demo.a.value == \"".$id_kategori_produk."\")";
       echo "{";
       $query_sub_kategori = $this->db->query("SELECT * FROM rb_kategori_produk_sub where id_kategori_produk='$id_kategori_produk'");
       $content = "document.getElementById('sub_kategori_produk').innerHTML = \"  <option value=''>- Pilih Sub Kategori Produk -</option>";
       foreach ($query_sub_kategori->result_array() as $data2) {
           $content .= "<option value='".$data2['id_kategori_produk_sub']."'>".$data2['nama_kategori_sub']."</option>";
       }
       $content .= "\"";
       echo $content;
       echo "}\n";
    }
    ?>
    }
</script>

<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Produk Baru</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form','name'=>'demo');
              echo form_open_multipart('administrator/tambah_produk',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th scope='row'>Kategori</th>                   <td><select name='a' class='form-control' onchange=\"showSub()\" required>
                                                                            <option value='' selected>- Pilih Kategori Produk -</option>";
                                                                            foreach ($record as $row){
                                                                                echo "<option value='$row[id_kategori_produk]'>$row[nama_kategori]</option>";
                                                                            }
                    echo "</td></tr>
                    <tr><th scope='row'>Sub Kategori</th>                   <td><select name='aa' class='form-control' id='sub_kategori_produk'>
                                                                              <option value='' selected>- Pilih Sub Kategori Produk -</option>
                                                                            </td></tr>
                    <tr><th width='130px' scope='row'>Nama Produk</th>  <td><input type='text' class='form-control' name='b' required></td></tr>
                    <tr><th scope='row'>Satuan</th>                     <td><input type='text' class='form-control' name='c'></td></tr>
                    <tr><th scope='row'>Berat / Gram</th>                      <td><input type='number' class='form-control' name='berat'></td></tr>
                    <tr><th scope='row'>Harga Modal</th>                 <td><input type='number' class='form-control' name='d'></td></tr>
                    <tr><th scope='row'>Harga Reseller</th>             <td><input type='number' class='form-control' name='e'></td></tr>
                    <tr><th scope='row'>Harga Konsumen</th>             <td><input type='number' class='form-control' name='f'></td></tr>
                    <tr><th scope='row'>Diskon</th>                 <td><input type='number' class='form-control' name='diskon'></td></tr>
                    <tr><th scope='row'>Keterangan</th>                 <td><textarea id='editor1' class='form-control' name='ff'></textarea></td></tr>
                    <tr><th scope='row'>Foto Produk</th>                     <td><input type='file' id='fileupload' class='form-control' name='userfile[]' multiple>Multiple Upload, Allowed File : .gif, jpg, png
                                                                                  <div id='dvPreview'></div> </td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
