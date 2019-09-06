            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Edit Detail Transaksi Pembelian (PO)</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php 
                  $attributes = array('class'=>'form-horizontal','role'=>'form');
                  echo form_open_multipart('administrator/edit_pembelian',$attributes); 
                ?>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='140px' scope='row'>Kode Pembelian</th>  <td><input type='text' class='form-control' value='<?php echo "$rows[kode_pembelian]"; ?>' name='a'></td></tr>
                    <tr><th scope='row'>Nama Supplier</th>                 <td><select class='form-control' name='b'>
                                                                                <?php 
                                                                                  foreach ($supplier as $r){
                                                                                    if ($r['id_supplier']==$rows['id_supplier']){
                                                                                      echo "<option value='$r[id_supplier]' selected>$r[nama_supplier]</option>";
                                                                                    }else{
                                                                                      echo "<option value='$r[id_supplier]'>$r[nama_supplier]</option>";
                                                                                    }
                                                                                  }
                                                                                ?>
                                                                               </select></td></tr>
                    <tr><th scope='row'>Waktu Pembelian</th>               <td><input type='text' class='form-control' value='<?php echo "$rows[waktu_beli]"; ?>' name='c'></td></tr>
                  </tbody>
                  </table>
                  <input class='btn btn-primary btn-sm' type="submit" name='submit1' value='Simpan Data'>
                  <a class='btn btn-default btn-sm' href='<?php echo base_url(); ?>administrator/pembelian'>Selesai / Kembali</a>
                  <hr>
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Nama Produk</th>
                        <th>Harga Pesan</th>
                        <th>Jumlah Pesan</th>
                        <th>Satuan</th>
                        <th>Sub Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <?php 
                        echo "<tr>
                                <td></td>
                                <input type='hidden' value='".$this->uri->segment(3)."' name='idp'>
                                <input type='hidden' value='".$this->uri->segment(4)."' name='idpd'>
                                <td><select name='aa' class='combobox form-control' onchange=\"changeValue(this.value)\" autofocus>
                                                                      <option value='' selected> Cari Barang </option>";
                                                                      $jsArray = "var prdName = new Array();\n";    
                                                                      foreach ($barang as $r){
                                                                        if ($r['id_produk']==$row['id_produk']){
                                                                          echo "<option value='$r[id_produk]' selected>$r[nama_produk]</option>";
                                                                          $jsArray .= "prdName['" . $r['id_produk'] . "'] = {name:'" . addslashes($r['harga_beli']) . "',desc:'".addslashes($r['satuan'])."'};\n";
                                                                        }else{
                                                                          echo "<option value='$r[id_produk]'>$r[nama_produk]</option>";
                                                                          $jsArray .= "prdName['" . $r['id_produk'] . "'] = {name:'" . addslashes($r['harga_beli']) . "',desc:'".addslashes($r['satuan'])."'};\n";
                                                                        }
                                                                      }
                                                                   echo "</select></td>
                                <td><input class='form-control' type='number' name='bb' value='$row[harga_pesan]' id='harga'> </td>
                                <td><input class='form-control' type='number' name='cc' value='$row[jumlah_pesan]'></td>
                                <td><input class='form-control' type='text' name='dd' id='satuan' value='$row[satuan]' readonly='on'> </td>
                                <td></td>
                                <td><button type='submit' name='submit' class='btn btn-success  btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button>
                                    <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/edit_pembelian/".$this->uri->segment(3)."'><span class='glyphicon glyphicon-remove'></span></a>
                                </td>
                              </tr>";
                      ?>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                    echo "<tr><td>$no</td>
                              <td>$row[nama_produk]</td>
                              <td>Rp ".rupiah($row['harga_pesan'])."</td>
                              <td>$row[jumlah_pesan]</td>
                              <td>$row[satuan]</td>
                              <td>Rp ".rupiah($row['harga_pesan']*$row['jumlah_pesan'])."</td>
                              <td>
                                <a class='btn btn-warning btn-xs' title='Edit Data' href='".base_url()."administrator/edit_pembelian/".$this->uri->segment(3)."/$row[id_pembelian_detail]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_pembelian_detail/".$this->uri->segment(3)."/$row[id_pembelian_detail]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </td>
                          </tr>";
                      $no++;
                    }

                    $total = $this->db->query("SELECT sum(a.harga_pesan*a.jumlah_pesan) as total FROM `rb_pembelian_detail` a where a.id_pembelian='".$this->uri->segment(3)."'")->row_array();
                    echo "<tr class='success'>
                            <td colspan='5'><b>Total</b></td>
                            <td><b>Rp ".rupiah($total['total'])."</b></td>
                          </tr>";
                  ?>
                  </tbody>
                </table>
                </div>
                </div>
                </div>


              

<script type="text/javascript">    
<?php echo $jsArray; ?>  
  function changeValue(id){  
    document.getElementById('harga').value = prdName[id].name;  
    document.getElementById('satuan').value = prdName[id].desc;  
  };  
</script> 