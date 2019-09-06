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
                  <h3 class='box-title'>Edit Produk Terpilih</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form','name'=>'demo');
              echo form_open_multipart('administrator/edit_produk',$attributes);
              $disk = $this->model_app->edit('rb_produk_diskon',array('id_produk'=>$rows['id_produk']))->row_array();
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_produk]'>
                    <tr><th scope='row'>Kategori</th>                   <td><select name='a' class='form-control' onchange=\"showSub()\" required>
                                                                            <option value='' selected>- Pilih Kategori Produk -</option>";
                                                                            foreach ($record as $row){
                                                                              if ($rows['id_kategori_produk']==$row['id_kategori_produk']){
                                                                                echo "<option value='$row[id_kategori_produk]' selected>$row[nama_kategori]</option>";
                                                                              }else{
                                                                                echo "<option value='$row[id_kategori_produk]'>$row[nama_kategori]</option>";
                                                                              }
                                                                            }
                    echo "</select></td></tr>
                    <tr><th scope='row'>Sub Kategori</th>                   <td><select name='aa' class='form-control' id='sub_kategori_produk'>
                                                                                <option value='' selected>- Pilih Sub Kategori Produk -</option>";
                                                                                $sub_kategori_produk = $this->db->query("SELECT * FROM rb_kategori_produk_sub");
                                                                                foreach ($sub_kategori_produk->result_array() as $row){
                                                                                  if ($rows['id_kategori_produk_sub']==$row['id_kategori_produk_sub']){
                                                                                    echo "<option value='$row[id_kategori_produk_sub]' selected>$row[nama_kategori_sub]</option>";
                                                                                  }else{
                                                                                    echo "<option value='$row[id_kategori_produk_sub]'>$row[nama_kategori_sub]</option>";
                                                                                  }
                                                                                }
                    echo "</select></td></tr>
                    <tr><th width='130px' scope='row'>Nama Produk</th>  <td><input type='text' class='form-control' name='b' value='$rows[nama_produk]' required></td></tr>
                    <tr><th scope='row'>Satuan</th>                     <td><input type='text' class='form-control' name='c' value='$rows[satuan]'></td></tr>
                    <tr><th scope='row'>Berat / Gram</th>                      <td><input type='number' class='form-control' name='berat' value='$rows[berat]'></td></tr>
                    <tr><th scope='row'>Harga Modal</th>                 <td><input type='number' class='form-control' name='d' value='$rows[harga_beli]'></td></tr>
                    <tr><th scope='row'>Harga Reseller</th>             <td><input type='number' class='form-control' name='e' value='$rows[harga_reseller]'></td></tr>
                    <tr><th scope='row'>Harga Konsumen</th>             <td><input type='number' class='form-control' name='f' value='$rows[harga_konsumen]'></td></tr>
                    <tr><th scope='row'>Diskon</th>                 <td><input type='number' class='form-control' name='diskon' value='$disk[diskon]'></td></tr>
                    <tr><th scope='row'>Keterangan</th>                 <td><textarea  id='editor1' class='form-control' name='ff'>$rows[keterangan]</textarea></td></tr>
                    <tr><th scope='row'>Foto Produk</th>                     <td><input type='file' id='fileupload' class='form-control' name='userfile[]' multiple>Multiple Upload, Allowed File : .gif, jpg, png
                                                                                 <div id='dvPreview'></div>";
                                                                               if ($rows['gambar'] != ''){ echo "<i style='color:red'>Gambar Saat ini : </i><a target='_BLANK' href='".base_url()."asset/foto_produk/$rows[gambar]'>$rows[gambar]</a>"; } echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
