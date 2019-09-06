<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Konfirmasi Pembayaran</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/konfirmasi_pembayaran',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='".$this->uri->segment(3)."'>
                    <tr><th scope='row'>No Invoice</th>                   <td><input type='text' name='a' class='form-control' value='$rows[kode_transaksi]' readonly='on' required>
                    <tr><th scope='row'>Total</th>                        <td><input type='text' name='b' class='form-control' value='Rp ".rupiah($total['total'])."' required>
                    <tr><th scope='row'>Transfer Ke</th>                  <td><select name='c' class='form-control' required>";
                                                                            foreach ($record->result_array() as $row){
                                                                                echo "<option value='$row[id_rekening]'>$row[nama_bank] - $row[no_rekening], A/N : $row[pemilik_rekening]</option>";
                                                                            }
                    echo "</td></tr>
                    <tr><th width='130px' scope='row'>Nama Pengirim</th>  <td><input type='text' class='form-control' name='d' required></td></tr>
                    <tr><th scope='row'>Tanggal Transfer</th>             <td><input type='text' class='datepicker form-control' name='e' data-date-format='yyyy-mm-dd' value='".date('Y-m-d')."'></td></tr>
                    <tr><th scope='row'>Bukti Transfer</th>               <td><input type='file' class='form-control' name='f'></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Kirimkan</button>
                    <a href='".base_url().$this->uri->segment(1)."/pembelian'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
