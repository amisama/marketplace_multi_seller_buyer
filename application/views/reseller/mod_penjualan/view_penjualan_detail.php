<?php $detail = $this->db->query("SELECT * FROM rb_penjualan where id_penjualan='".$this->uri->segment(3)."'")->row_array(); ?>

            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Detail Transaksi Penjualan</h3>
                  <a class='pull-right btn btn-default btn-sm' href='<?php echo base_url().$this->uri->segment(1); ?>/penjualan'>Kembali</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='140px' scope='row'>Kode Pembelian</th>  <td><?php echo "$rows[kode_transaksi]"; ?></td></tr>
                    <tr><th scope='row'>Nama Konsumen</th>                 <td><?php echo "<a href='".base_url().$this->uri->segment(1)."/detail_konsumen/$rows[id_konsumen]'>$rows[nama_lengkap]</a>"; ?></td></tr>
                    <tr><th scope='row'>Waktu Transaksi</th>               <td><?php echo "$rows[waktu_transaksi]"; ?></td></tr>
                    <tr><th scope='row'>Kurir</th>               <td><?php echo "<span style='text-transform:uppercase'>$detail[kurir]</span> - $detail[service]"; ?></td></tr>
                    <tr><th scope='row'>Status</th>                        <td>
                      <?php
                        if ($rows['proses']=='0'){ $proses = '<i class="text-danger">Pending</i>'; $status = 'Proses'; $icon = 'star-empty'; $ubah = 1; }elseif($rows['proses']=='1'){ $proses = '<i class="text-success">Proses</i>'; $status = 'Pending'; $icon = 'star text-yellow'; $ubah = 0; }else{ $proses = '<i class="text-info">Konfirmasi</i>'; $status = 'Proses'; $icon = 'star'; $ubah = 1; } 
                        echo "$proses <a class='btn btn-primary btn-xs' style='margin-left:5px' title='$status Data' href='".base_url().$this->uri->segment(1)."/proses_penjualan_detail/$rows[id_penjualan]/$ubah' onclick=\"return confirm('Apa anda yakin untuk ubah status jadi $status?')\"><span class='glyphicon glyphicon-$icon'></span> Ubah Status</a>"; 
                      ?>
                    </td></tr>
                  </tbody>
                  </table>
                  <hr>
                  <table class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Nama Produk</th>
                        <th>Harga Jual</th>
                        <th>Jumlah Jual</th>
                        <th>Satuan</th>
                        <th>Sub Total</th>
                      </tr>
                    </thead>
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
                          </tr>";
                      $no++;
                    }
                    $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a where a.id_penjualan='".$this->uri->segment(3)."'")->row_array();
                    echo "<tr class='warning'>
                            <td colspan='5'><b>Ongkir</b></td>
                            <td><b>Rp ".rupiah($detail['ongkir'])."</b></td>
                          </tr>
                          <tr class='warning'>
                            <td colspan='5'><b>Belanja</b></td>
                            <td><b>Rp ".rupiah($total['total'])."</b></td>
                          </tr>
                          <tr class='success'>
                            <td colspan='5'><b>Total</b></td>
                            <td><b>Rp ".rupiah($total['total']+$detail['ongkir'])."</b></td>
                          </tr>";
                  ?>
                  </tbody>
                </table>
              </div>