<?php if ($this->uri->segment(3) == ''){ $stat = 'Pertanyaan'; $id = '0'; }else{ $stat = 'Jawaban'; $id = $this->uri->segment(3); } ?>
<div id='form' class="main-page left">
	<div class="single-block">
		<div class="content-block main left">
			<div class="block">
				<div class="block-title">
					<h2>Tuliskan <?php echo "$stat"; ?> Anda Pada Form Dibawah Ini</h2>
				</div>
				<div class="block-content">
					<div id="writecomment">
						<form action="<?php echo base_url(); ?>konsultasi/reply" method="POST" onSubmit="return validasi(this)" id="form_komentar">
							<input type="hidden" value='<?php echo $id; ?>' name='a'>
							<p class="contact-form-user">
								<label for="c_name">Nama Anda<span class="required">*</label>
								<input type="text" placeholder="Nama Anda" id="nama" value='<?php echo "$usr[nama_lengkap]"; ?>' name='b' class="required" required/>
							</p>
							<p class="contact-form-email">
								<label for="c_email">E-mail<span class="required">*</span></label>
								<input type="text" name='c' placeholder="Alamat E-mail" id="email" value='<?php echo "$usr[email]"; ?>' class="required" required/>
							</p>

							<?php 
								$tanya = $this->model_utama->view_where('tbl_comment',array('id_komentar'=>$this->uri->segment(3)))->row_array();
								if ($this->uri->segment(3) != ''){  
									echo "<p><label for='c_email'><b>Pertanyaan</b><span class='required'></span></label>
											<div style='margin-left:8px;'>$tanya[isi_pesan] ? </div>
										  </p>";
								}
							?>

							<p class="contact-form-message">
								<label for="c_message"><?php echo "$stat"; ?><span class="required">*</span></label>
								<textarea name='d' placeholder="Tuliskan <?php echo "$stat"; ?> Anda.." class="required" required></textarea>
							</p>
							<?php if ($this->uri->segment(3) == ''){ ?>
								<p><input type="submit" name="submit" class="styled-button" value="Kirimkan Pertanyaan" onclick="return confirm('Yakin ingin mengirimkan pertanyaan ini ?')"/></p>
							<?php }else{ ?>
								<p><input type="submit" name="submit" class="styled-button" value="Kirimkan Balasan" onclick="return confirm('Kirimkan Sebagai Balasan Pesan terpilih?')"/></p>
							<?php } ?>
						</form>
					</div>
				</div>
				
				<div id="viewcomment" class="block-title">
					<h2><?php $total = $this->model_utama->view_where('tbl_comment',array('reply'=>0))->num_rows();
						echo "Total Ada $total Pertanyaan"; ?>
					</h2>
				</div>
				<div class="block-content">
					<div class="comment-block">
						<ol class="comments">
							<li>
								<?php
									$no = 1;
									foreach ($konsultasi->result_array() as $kka) {
										$isian=nl2br($kka['isi_pesan']); 
										$komentarku=sensor($isian); 
										if(($no % 2)==0){ $warna="#ffffff;"; }else{ $warna="#e3e3e3"; }
										$test = md5(strtolower(trim($kka['alamat_email'])));	
										echo "<div id='reply$kka[id_komentar]' style='background:$warna' class='commment-content'>
												<div class='user-avatar'>
													<a href='#' class='hover-effect'>";
														if ($kka['alamat_email'] == ''){
															echo "<img class='setborder' src='".base_url()."asset/foto_user/blank.png'/>";
														}else{
															echo "<img class='setborder' src='http://www.gravatar.com/avatar/$test.jpg?s=100'/>";
														}
													echo "</a>
												</div>
												<strong class='user-nick'><a href='#'>$kka[nama_lengkap]</a></strong>
												<span class='time-stamp'>".tgl_indo($kka['tanggal_komentar']).", $kka[jam_komentar] WIB</span>
												<div class='comment-text'>
													<p>$komentarku</p>";
													if ($this->session->level!=''){
														echo "<a class='button' style='background:#bf0000; color:#ffffff; float:right; padding:2px 10px' href='".base_url()."administrator/logout'>Logout</a> 
														      <a class='button' style='background:#29b332; color:#ffffff; float:right; padding:2px 10px' href='".base_url()."konsultasi/delete/$kka[id_komentar]'>Hapus</a> 
														      <a class='button' style='background:#6cd43f; color:#ffffff; float:right; padding:2px 10px' href='".base_url()."konsultasi/index/$kka[id_komentar]'>Berikan Jawaban</a>";
													}
													
												echo "</div><div style='clear:both'></div>";
												
												$reply = $this->model_utama->view_where('tbl_comment',array('reply'=>$kka['id_komentar']));
												  foreach ($reply->result_array() as $r) {
												  	$testt = md5(strtolower(trim($r['alamat_email'])));
													echo "<div style='background:$warna; margin-top:0px; margin-left:40px;'>
															<h4 style='background:lightgreen; color:#fff; margin-bottom:5px; padding:4px'>
																Dibalas Oleh : $r[nama_lengkap], Pada : ".tgl_indo($r['tanggal_komentar']).", $kka[jam_komentar] WIB  
															</h4>
															<div class='user-avatar'>
																<a href='#' class='hover-effect'>";
																	if ($r['alamat_email'] == ''){
																		echo "<img class='setborder' src='".base_url()."asset/foto_user/blank.png'/>";
																	}else{
																		echo "<img class='setborder' src='http://www.gravatar.com/avatar/$testt.jpg?s=100'/>";
																	}
																echo "</a>
															</div>
															<div style='padding:left:10px'>
															<i style='color:red;'>$r[alamat_email]</i> - 
															$r[isi_pesan]
															</div><div style='clear:both'></div>
														  </div>";
												  }	
											  echo "</div>";
										$no++;
									}
								?>
							</li>
							
						</ol>

					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<div class='main-sidebar right'>
	<?php include "sidebar_kanan.php";  ?>
</div>