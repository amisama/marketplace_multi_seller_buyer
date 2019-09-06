            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Konfirmasi Pembayaran Reseller</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:30px'>No</th>
                        <th>Kode Transaksi</th>
                        <th>Total Tagihan</th>
                        <th>Total Transfer</th>
                        <th>Ke Rekening</th>
                        <th>Nama Pengirim</th>
                        <th>Tanggal Transfer</th>
                        <th>Bukti Transfer</th>
                        <th>Status Transaksi</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    if ($row['proses']=='0'){ $proses = '<i class="text-danger">Pending</i>'; }elseif($row['proses']=='1'){ $proses = '<i class="text-success">Proses</i>';  }else{ $proses = '<i class="text-info">Konfirmasi</i>'; } 
                    $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
                    echo "<tr>
                              <td>$no</td>
                              <td><a href='".base_url()."administrator/detail_penjualan/$row[id_penjualan]'>$row[kode_transaksi]</a></td>
                              <td>$row[total_transfer]</td>
                              <td>Rp ".rupiah($total['total'])."</td>
                              <td>$row[nama_bank]</td>
                              <td>$row[nama_pengirim]</td>
                              <td>".tgl_indo($row['tanggal_transfer'])."</td>
                              <td><a href='".base_url()."administrator/download_bukti/$row[bukti_transfer]'>Download File</a></td>
                              <td>$proses</td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>