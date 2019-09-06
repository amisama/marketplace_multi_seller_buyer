      <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Transaksi Pembayaran Bonus</h3>
                </div>
                <div class='box-body'>
                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#profile' id='profile-tab' role='tab' data-toggle='tab' aria-controls='profile' aria-expanded='true'>Pembayaran Referral </a></li>
                      <li role='presentation' class=''><a href='#pembelian' role='tab' id='pembelian-tab' data-toggle='tab' aria-controls='pembelian' aria-expanded='false'>Pembayaran Reward</a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='profile' aria-labelledby='profile-tab'>

                  <div class='col-md-12'>
                  <?php
                    $id_reseller = $this->uri->segment(3);
                    $pembelian = $this->db->query("SELECT sum((b.jumlah*b.harga_jual)-b.diskon) as total FROM rb_penjualan a JOIN rb_penjualan_detail b ON a.id_penjualan=b.id_penjualan where a.status_penjual='admin' AND a.id_pembeli='".$id_reseller."' AND a.proses='1'")->row_array();
                    $penjualan_perusahaan = $this->db->query("SELECT sum((a.jumlah*a.harga_jual)-a.diskon) as total, sum(a.jumlah) as produk FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk
                                                                JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where c.status_penjual='reseller' AND b.id_produk_perusahaan!='0' AND id_penjual='".$id_reseller."' AND c.proses='1'")->row_array();
                    $penjualan = $this->db->query("SELECT sum((a.jumlah*a.harga_jual)-a.diskon) as total, sum(a.jumlah) as produk FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk
                                                                JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where c.status_penjual='reseller' AND b.id_produk_perusahaan='0' AND id_penjual='".$id_reseller."' AND c.proses='1'")->row_array();
                    $modal_perusahaan = $this->db->query("SELECT sum(a.jumlah*b.harga_reseller) as total FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where c.status_pembeli='konsumen' AND c.proses='1' AND c.id_penjual='".$id_reseller."' AND b.id_produk_perusahaan!='0'")->row_array();
                    $modal_pribadi = $this->db->query("SELECT sum(a.jumlah*b.harga_beli) as total FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where c.status_pembeli='konsumen' AND c.proses='1' AND c.id_penjual='".$id_reseller."' AND b.id_produk_perusahaan='0'")->row_array();
                    $set = $this->db->query("SELECT * FROM rb_setting where aktif='Y'")->row_array();
                    $res = $this->db->query("SELECT * FROM rb_reseller where id_reseller='$id_reseller'")->row_array();

                    echo "<table class='table table-striped table-condensed'>
                      <tr><td width='190px'>Nama Toko / Reseller</td>                <td> : <b>$res[nama_reseller]</b></td></tr>
                      <tr><td width='190px'>Belanja ke Perusahaan</td>                <td> : Rp ".rupiah($pembelian['total'])."</td></tr>
                      <tr><td>Penjualan Produk Perusahaan</td>                        <td> : Rp ".rupiah($penjualan_perusahaan['total'])." (".rupiah($penjualan_perusahaan['produk'])." Produk)</td></tr>
                      <tr><td>Modal Produk Perusahaan</td>                            <td> : Rp ".rupiah($modal_perusahaan['total'])."</td></tr>
                      <tr><td>Penjualan Produk Pribadi</td>                           <td> : Rp ".rupiah($penjualan['total'])."</td></tr>
                      <tr><td>Modal Produk Pribadi</td>                               <td> : Rp ".rupiah($modal_pribadi['total'])."</td></tr>

                      <tr class='success'><td>Keuntungan </td>                        <td> : Rp ".rupiah(($penjualan['total']+$penjualan_perusahaan['total'])-($modal_perusahaan['total']+$modal_pribadi['total']))."</td></tr>
                    </table>

                    <div class='alert alert-success'>Data Reseller Referral Anda :</div>
                    <table class='table table-striped table-condensed table-bordered'>
                      <tr style='background:#e3e3e3'>
                          <th>No </th>
                          <th>Nama Toko / Reseller</th>
                          <th>Penjualan Produk Perusahaan</th>
                          <th>Bonus Anda $set[referral]%</th>
                      </tr>";
                    $no = 1;
                    $total_jual = 0;
                    $total_bonus = 0;
                    $reseller = $this->db->query("SELECT * FROM rb_reseller where referral='".$res['username']."'");
                    if ($reseller->num_rows()<=0){
                      echo "<tr><td colspan='4'><center style='color:red; padding:40px'><i>Anda Belum Memiliki Toko / Reseller Referral!,.. ^_^</i></center></td></tr>";
                    }else{
                      foreach ($reseller->result_array() as $row) {
                        $pp = $this->db->query("SELECT sum((a.jumlah*a.harga_jual)-a.diskon) as total, sum(a.jumlah) as produk FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk
                                                                  JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where c.status_penjual='reseller' AND b.id_produk_perusahaan!='0' AND id_penjual='".$row['id_reseller']."' AND c.proses='1'")->row_array();
                        $total_jual = $total_jual+$pp['total'];
                        $total_bonus = $total_bonus+($set['referral']/100*$pp['total']);
                        echo "<tr><td width='20px'>$no</td>
                                  <td><b>$row[nama_reseller]</b></td>  
                                  <td>: Rp ".rupiah($pp['total'])." (".rupiah($pp['produk'])." Produk)</td>
                                  <td>: Rp ".rupiah($set['referral']/100*$pp['total'])."</td>
                              </tr>";
                        $no++;
                      }
                    }
                    $pen = $this->db->query("SELECT sum(bonus_referral) as pencairan FROM rb_pencairan_bonus where id_reseller='$id_reseller'")->row_array();
                    echo "<tr class='alert alert-danger'>
                                <th colspan='2'>Total Penjualan</th> 
                                <th>Rp ".rupiah($total_jual)."</th> 
                                <th>Rp ".rupiah($total_bonus)."</th>
                          </tr>
                          <tr class='alert alert-success'>
                                <th colspan='2'>Total Pencairan Dana</th> 
                                <th></th> 
                                <th>Rp ".rupiah($pen['pencairan'])."</th>
                          </tr>";
                          $sisa_bayar = $total_bonus-$pen['pencairan'];
                          echo form_open('administrator/bayar_bonus');
                          echo "<input type='hidden' value='$id_reseller' name='idk'>
                                <tr class='danger'><td colspan='3'>Bayarkan Sisa Referral</td>  <td><input type='number' class='form-control' name='a' style='width:250px !important; display:inline-block; margin-right:5px' value='$sisa_bayar'>
                                <input type='submit' name='submit' value='Bayarkan' class='btn btn-primary btn-sm' style='margin-top:-5px'>
                                <a class='btn btn-success btn-sm' style='margin-top:-5px' href='".base_url()."administrator/history_referral'>History</a>
                                <a class='btn btn-default btn-sm' style='margin-top:-5px' href='".base_url()."administrator/keuangan'>Kembali</a>
                                </td></tr>";
                          echo form_close();
                      echo "</table>";

              echo "</div>
              </div>

              <div role='tabpanel' class='tab-pane fade' id='pembelian' aria-labelledby='pembelian-tab'>
                <div class='col-md-12'>";

                    if ($_GET['tahun']==''){
                      $tahun = date('Y');
                    }else{
                      $tahun = $_GET['tahun'];
                    }
                    echo "<div class='alert alert-success'><b>Total Penjualan anda Pada Tahun $tahun :</b> </div>
                          <table class='table table-striped table-condensed'>
                            <tr><td width='190px'>Penjualan Produk Perusahaan</td>    <td style='color:red'> : Rp ".rupiah($penjualan_perusahaan['total'])."</td></tr>
                            <tr><td>Jumlah Produk Terjual</td>                        <td style='color:red'> : ".rupiah($penjualan_perusahaan['produk'])." Produk</td></tr>
                          </table>

                        <table class='table table-bordered table-striped table-condensed'>
                              <thead>
                                <tr bgcolor='#e3e3e3'>
                                  <th style='width:20px'>No</th>
                                  <th>Bulan (Tahun $tahun)</th>
                                  <th>Total Penjualan</th>
                                  <th>Bonus / Reward</th>
                                </tr>
                              </thead>
                              <tbody>";
                              for ($i=1; $i <=12 ; $i++) { 
                                $bulan = $tahun."-".sprintf("%02d", $i);
                                $ppb = $this->db->query("SELECT sum((a.jumlah*a.harga_jual)-a.diskon) as total, sum(a.jumlah) as produk FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk
                                                                JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where c.status_penjual='reseller' AND b.id_produk_perusahaan!='0' AND id_penjual='".$id_reseller."' AND c.proses='1' AND substr(c.waktu_transaksi,1,7)='$bulan'")->row_array();
                                echo "<tr bgcolor='#e3e3e3'>
                                        <td>$i</td>
                                        <td><b>".bulan($i)."</b></td>
                                        <td>Rp ".rupiah($ppb['total'])."</td>
                                        <td>";
                                            $nomor = 1;
                                            $rew = $this->db->query("SELECT * FROM `rb_reward` where posisi<='$ppb[total]'");
                                            foreach ($rew->result_array() as $re) {
                                              $cek_reward = $this->db->query("SELECT * FROM rb_pencairan_reward where id_reseller='$id_reseller' AND id_reward='$re[id_reward]' AND reward_date='$bulan'");
                                              if ($cek_reward->num_rows()>=1){
                                                $text = 'line-through';
                                                $color = 'red';
                                              }else{
                                                $text = 'none';
                                                $color = 'black';
                                              }
                                              echo "<span style='text-decoration:$text; color:$color'>$nomor. $re[reward]</span>"; 
                                              if ($cek_reward->num_rows()<=0){
                                                echo " <a title='Bayarkan Reward ini' href='".base_url()."administrator/bayar_reward/$id_reseller/$re[id_reward]/$bulan' onclick=\"return confirm('Apa anda yakin untuk Reward ini sudah dibayarkan?')\"><span class='fa fa-check-square'></span></a>";
                                              }
                                              echo "<br>";
                                              $nomor++;
                                            }
                                        echo "</td>
                                      </tr>";
                              }
                        echo "</tbody></table>
                </div>
            </div>

            </div>
            </div>

          </div>

        </div>
      </div>";