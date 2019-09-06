<div class='panel-body'>
    <ul class='myTabs nav nav-tabs' role='tablist'>
      <li role='presentation' class='active'><a href='#konsumen' id='konsumen-tab' role='tab' data-toggle='tab' aria-controls='konsumen' aria-expanded='true'>Pendaftaran Pembeli </a></li>
      <li role='presentation' class=''><a href='#reseller' role='tab' id='reseller-tab' data-toggle='tab' aria-controls='reseller' aria-expanded='false'>Pendaftaran Penjual</a></li>
    </ul><br>
    <div id='myTabContent' class='tab-content'>
        <div role='tabpanel' class='tab-pane fade active in' id='konsumen' aria-labelledby='konsumen-tab'>

            <div class='alert alert-info'><b>PENTING!</b> Lengkapi Form dibawah ini untuk mendaftarkan diri Sebagai <b>Pembeli</b>, harap di isi dengan data yang sebenar-benarnya sesuai dengan KTP, Terima kasih...</div>
            <div class="block-content">
                <div id="writecomment">
                    <form action="<?php echo base_url(); ?>auth/register" method="POST" id="form_komentar">
                        <p class="contact-form-user">
                            <label for="c_name">Username<span class="required">*</label>
                            <input type="text" name='a' class="required" onkeyup="nospaces(this)" required/>
                        </p>

                        <p class="contact-form-user">
                            <label for="c_name">Password<span class="required">*</label>
                            <input type="password" name='b' class="required" onkeyup="nospaces(this)" required/>
                        </p>

                        <p class="contact-form-user">
                            <label for="c_name">Nama Lengkap<span class="required">*</label>
                            <input type="text" name='c' placeholder="Tuliskan Nama Lengkap,.." class="required" required/>
                        </p>

                        <p class="contact-form-email">
                            <label for="c_email">E-mail<span class="required">*</span></label>
                            <input type="email" name='d' placeholder="alamat.emailanda@mail.com" onkeyup="nospaces(this)" class="required" required/>
                        </p>

                        <p class="contact-form-message">
                            <label for="c_message">Provinsi<span class="required">*</span></label>
                            <?php echo "<select style='margin-left:5px' class='form-control' name='g' id='state' required>
                                            <option value=''>- Pilih -</option>";
                                            foreach ($provinsi as $rows) {
                                                echo "<option value='$rows[provinsi_id]'>$rows[nama_provinsi]</option>";
                                            }
                                        echo "</select>"; ?>
                        </p>

                        <p class="contact-form-message">
                            <label for="c_message">Kota<span class="required">*</span></label>
                                        <select style='margin-left:5px' class='form-control' name='h' id='city' required>
                                                <option value=''>- Pilih -</option>
                                        </select>
                        </p>

                        <p class="contact-form-user">
                            <label for="c_name">Kecamatan<span class="required">*</label>
                            <input type="text" name='i' placeholder="Nama Kecamatan.." class="required" required/>
                        </p>

                        <p class="contact-form-message">
                            <label for="c_message">Alamat<span class="required">*</span></label>
                            <textarea name='e' placeholder="Alamat Desa, Jalan, dan No Rumah/Kantor anda.." class="required" required></textarea>
                        </p>

                        <p class="contact-form-user">
                            <label for="c_name">No Handphone<span class="required">*</label>
                            <input type="number" name='j'placeholder="08**********" class="required" required/>
                        </p>
                        <p><input type="submit" name="submit1" class="styled-button" value="Daftar Sebagai Pembeli"/></p>
                    </form>
                </div>
            </div>
            <div style='clear:both'><br></div>
        </div>

        <div role='tabpanel' class='tab-pane fade' id='reseller' aria-labelledby='reseller-tab'>
        <div class='alert alert-warning'><b>PENTING!</b> Lengkapi Form dibawah ini untuk mendaftarkan diri sebagai <b>Pelapak</b>, harap di isi dengan data yang sebenar-benarnya, Terima kasih...</div>
            <div class="block-content">
                <div id="writecomment">
                    <form action="<?php echo base_url(); ?>auth/register" method="POST" id="form_komentar">
                        <p class="contact-form-user">
                            <label for="c_name">Username<span class="required">*</label>
                            <input type="text" name='a' class="required" onkeyup="nospaces(this)" required/>
                        </p>

                        <p class="contact-form-user">
                            <label for="c_name">Password<span class="required">*</label>
                            <input type="password" name='b' class="required" onkeyup="nospaces(this)" required/>
                        </p>

                        <p class="contact-form-user">
                            <label for="c_name">Nama Toko<span class="required">*</label>
                            <input type="text" name='c' placeholder="Tuliskan Nama Anda / Perusahaan,.." class="required" required/>
                        </p>

                        <p class="contact-form-user">
                            <label for="c_name">Jenis Kelamin<span class="required">*</label>
                            <input type='radio' name='d' value='Laki-laki'> Laki-laki &nbsp;
                            <input type='radio' name='d' value='Perempuan'> Perempuan
                        </p>

                        <p class="contact-form-user">
                            <label for="c_name">No Handphone<span class="required">*</label>
                            <input type="number" name='f'placeholder="08**********" class="required" required/>
                        </p>


                        <p class="contact-form-email">
                            <label for="c_email">E-mail<span class="required">*</span></label>
                            <input type="email" name='g' placeholder="alamat.emailanda@mail.com" onkeyup="nospaces(this)" class="required" required/>
                        </p>

                        <p class="contact-form-message">
                            <label for="c_message">Provinsi<span class="required">*</span></label>
                            <?php echo "<select style='margin-left:5px' class='form-control' name='state' id='state_reseller' required>
                                            <option value=''>- Pilih -</option>";
                                            foreach ($provinsi as $rows) {
                                                echo "<option value='$rows[provinsi_id]'>$rows[nama_provinsi]</option>";
                                            }
                                        echo "</select>"; ?>
                        </p>

                        <p class="contact-form-message">
                            <label for="c_message">Kota<span class="required">*</span></label>
                                        <select style='margin-left:5px' class='form-control' name='kota' id='city_reseller' required>
                                                <option value=''>- Pilih -</option>
                                        </select>
                        </p>

                        <p class="contact-form-message">
                            <label for="c_message">Alamat<span class="required">*</span></label>
                            <textarea name='e' placeholder="Nama Kecamatan, Desa, Jalan, dan No Rumah anda.." class="required" required></textarea>
                        </p>
                        
                        <p class="contact-form-user">
                            <label for="c_name">Kode POS<span class="required">*</label>
                            <input type="number" name='h' placeholder="*******" onkeyup="nospaces(this)" class="required" required/>
                        </p>

                        <p class="contact-form-user">
                            <label for="c_name">Referral<span class="required">*</label>
                            <input type="text" name='i' placeholder="Username Referral.." onkeyup="nospaces(this)" class="required" required/>
                        </p>
                        <p><input type="submit" name="submit2" class="styled-button" value="Daftar Sebagai Penjual"/></p>
                    </form>
                </div>
            </div>
            <div style='clear:both'><br></div>
        </div>
    </div>
</div>