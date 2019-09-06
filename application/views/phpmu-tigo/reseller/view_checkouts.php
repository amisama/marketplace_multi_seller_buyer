<?php
echo "<p class='sidebar-title'> Data Pelanggan</p>
<div class='alert alert-info'><b>PENTING!</b> - Lengkapi Form dibawah ini untuk menyelesaikan pesanan anda, Terima kasih...</div>
<br>
<div class='col-md-12'>";
$attributes = array('id' => 'formku','class'=>'form-horizontal','role'=>'form');
echo form_open_multipart('produk/checkouts',$attributes); 
  echo "<div class='form-group'>
            <label for='inputEmail3' class='col-sm-3 control-label'>Nama Lengkap</label>
            <div class='col-sm-9'>
            <div style='background:#fff;' class='input-group col-sm-12'>
                <input type='text' class='required form-control' name='a'>
            </div>
            </div>
        </div>

        <div class='form-group'>
            <label for='inputEmail3' class='col-sm-3 control-label'>Email</label>
            <div class='col-sm-9'>
            <div style='background:#fff;' class='input-group col-sm-12'>
                <input type='email' class='required email form-control' name='b'>
            </div>
            </div>
        </div>

        <div class='form-group'>
            <label for='inputPassword3' class='col-sm-3 control-label'>Alamat</label>
            <div class='col-sm-9'>
            <div style='background:#fff;' class='input-group col-lg-12'>
                <input type='text' class='required form-control' name='c'>
            </div></div>
        </div>

        <div class='form-group'>
            <label for='inputPassword3' class='col-sm-3 control-label'>Propinsi</label>
            <div class='col-sm-9'>
            <div style='background:#fff;' class='input-group col-lg-12'>
                                            <select class='form-control' name='e' id='state' required>
                                                <option value=''>- Pilih -</option>";
                                                foreach ($provinsi as $rows) {
                                                    echo "<option value='$rows[provinsi_id]'>$rows[nama_provinsi]</option>";
                                                }
                                            echo "</select>
            </div></div>
        </div>

        <div class='form-group'>
            <label for='inputPassword3' class='col-sm-3 control-label'>Kota</label>
            <div class='col-sm-9'>
            <div style='background:#fff;' class='input-group col-lg-12'>    
                                            <select class='form-control' name='f' id='city' required>
                                                    <option value=''>- Pilih -</option>
                                            </select>
            </div></div>
        </div>

        <div class='form-group'>
            <label for='inputPassword3' class='col-sm-3 control-label'>Kecamatan</label>
            <div class='col-sm-9'>
            <div style='background:#fff;' class='input-group col-lg-12'>
                <input type='text' class='required form-control' name='g'>
            </div></div>
        </div>

        <div class='form-group'>
            <label for='inputEmail3' class='col-sm-3 control-label'>No Telpon/Hp</label>
            <div class='col-sm-9'>
            <div style='background:#fff;' class='input-group col-sm-6'>
                <input type='number' class='required number form-control' name='h'  minlength='10'>
            </div>
            </div>
        </div>

        <br>
        <div class='form-group'>
            <div class='col-sm-offset-2'>
                <button type='submit' name='submit' class='btn btn-primary btn-sm'>Proses Pesanan</button>
            </div>
        </div>
    </form>
</div>
<div style='clear:both'><br></div>";
?>