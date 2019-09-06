<div class="col-xs-12">  
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Edit Detail Transaksi Pembelian</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <?php 
      $attributes = array('class'=>'form-horizontal','role'=>'form');
      echo form_open_multipart($this->uri->segment(1).'/edit_pembelian',$attributes); 
      if ($rows['proses']=='0'){ $proses = '<i class="text-danger">Pending</i>'; }else{ $proses = '<i class="text-success">Proses</i>'; }
      if ($rows['proses']=='1'){
        redirect($this->uri->segment(1).'/pembelian');
      }else{
    ?>
      <table class='table table-condensed table-bordered'>
      <tbody>
        <tr><th width='140px' scope='row'>Kode Pembelian</th>  <td><input type='text' class='form-control' value='<?php echo "$rows[kode_transaksi]"; ?>' readonly='on'></td></tr>
        <tr><th scope='row'>Waktu Transaksi</th>               <td><input type='text' class='form-control' value='<?php echo "$rows[waktu_transaksi]"; ?>' readonly='on'></td></tr>
        <tr><th scope='row'>Status Transaksi</th>               <td><?php echo "$proses"; ?></td></tr>
      </tbody>
      </table>
      <hr>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th style='width:40px'>No</th>
            <th>Nama Produk</th>
            <th width='120px'>Harga</th>
            <th width='80px'>Jumlah</th>
            <th width='80px'>Satuan</th>
            <th>Sub Total</th>
            <th width='80px'>Action</th>
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
                                                              $jsArray .= "prdName['" . $r['id_produk'] . "'] = {name:'" . addslashes($r['harga_reseller']) . "',desc:'".addslashes($r['satuan'])."'};\n";
                                                            }else{
                                                              echo "<option value='$r[id_produk]'>$r[nama_produk]</option>";
                                                              $jsArray .= "prdName['" . $r['id_produk'] . "'] = {name:'" . addslashes($r['harga_reseller']) . "',desc:'".addslashes($r['satuan'])."'};\n";
                                                            }
                                                          }
                                                       echo "</select></td>
                    <td><input class='form-control' type='number' name='bb' value='$row[harga_jual]' id='harga' readonly='on'> </td>
                    <td><input class='form-control' type='number' name='dd' value='$row[jumlah]'></td>
                    <td><input class='form-control' type='text' name='ee' id='satuan' value='$row[satuan]' readonly='on'> </td>
                    <td></td>
                    <td><button type='submit' name='submit' class='btn btn-success  btn-xs'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button>
                        <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url().$this->uri->segment(1)."/edit_pembelian/".$this->uri->segment(3)."'><span class='glyphicon glyphicon-remove'></span></a>
                    </td>
                  </tr>";
          ?>
        <tbody>
      <?php 
        $no = 1;
        foreach ($record as $row){
        $sub_total = ($row['harga_jual']*$row['jumlah'])-$row['diskon'];
        echo "<tr><td>$no</td>
                  <td>$row[nama_produk]</td>
                  <td>Rp ".rupiah($row['harga_jual'])."</td>
                  <td>$row[jumlah]</td>
                  <td>$row[satuan]</td>
                  <td>Rp ".rupiah($sub_total)."</td>
                  <td>
                    <a class='btn btn-warning btn-xs' title='Edit Data' href='".base_url().$this->uri->segment(1)."/edit_pembelian/".$this->uri->segment(3)."/$row[id_penjualan_detail]'><span class='glyphicon glyphicon-edit'></span></a>
                    <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url().$this->uri->segment(1)."/delete_pembelian_detail/".$this->uri->segment(3)."/$row[id_penjualan_detail]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                  </td>
              </tr>";
          $no++;
        }

        $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a where a.id_penjualan='".$this->uri->segment(3)."'")->row_array();
        echo "<tr class='success'>
                <td colspan='5'><b>Total</b></td>
                <td><b>Rp ".rupiah($total['total'])."</b></td>
              </tr>";
      ?>
      </tbody>
    </table>

    <a class='btn btn-primary btn-sm' href='<?php echo base_url().$this->uri->segment(1); ?>/pembelian'>Selesai / Kembali</a>
    <?php } ?>
    </div>
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