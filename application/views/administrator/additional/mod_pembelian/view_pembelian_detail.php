            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Detail Transaksi Pembelian (PO)</h3>
                  <a class='pull-right btn btn-default btn-sm' href='<?php echo base_url(); ?>administrator/pembelian'>Kembali</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='140px' scope='row'>Kode Pembelian</th>  <td><?php echo "$rows[kode_pembelian]"; ?></td></tr>
                    <tr><th scope='row'>Nama Supplier</th>                 <td><?php echo "$rows[nama_supplier]"; ?></td></tr>
                    <tr><th scope='row'>Waktu Pembelian</th>               <td><?php echo "$rows[waktu_beli]"; ?></td></tr>
                  </tbody>
                  </table>
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
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                    $sub_total = $row['harga_pesan']*$row['jumlah_pesan'];
                    echo "<tr><td>$no</td>
                              <td>$row[nama_produk]</td>
                              <td>Rp ".rupiah($row['harga_pesan'])."</td>
                              <td>$row[jumlah_pesan]</td>
                              <td>$row[satuan]</td>
                              <td>Rp ".rupiah($sub_total)."</td>
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