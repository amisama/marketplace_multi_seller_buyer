					<div class="main-content">
						<div class="main-page left">
							<div class="double-block">
								<div class="content-block main left">
									<div class="block">
										<div class="block-title" style="background:orange;">
											<a href="<?php echo base_url(); ?>" class="right">Back to homepage</a>											
											<h2>Agenda</h2>	
										</div>
										<div class="block-content">
											<?php
											  foreach ($agenda->result_array() as $r) {	
												  $tgl_posting = tgl_indo($r['tgl_posting']);
												  $tgl_mulai   = tgl_indo($r['tgl_mulai']);
												  $tgl_selesai = tgl_indo($r['tgl_selesai']);
												  $baca = $r['dibaca']+1;
												  $judull = substr($r['tema'],0,33); 
												  $isi_agenda =(strip_tags($r['isi_agenda'])); 
												  $isi = substr($isi_agenda,0,280); 
												  $isi = substr($isi_agenda,0,strrpos($isi," "));
												  
												  echo "<div class='article-big'>
															<div class='article-photo'>";
															if ($r['gambar']==''){
																echo "<img width='210px' height='150px' src='".base_url()."asset/foto_agenda/small_no-image.jpg'>";
															}else{
																echo "<img width='210px' height='150px' src='".base_url()."asset/foto_agenda/$r[gambar]'>";
															}	
															echo "</div>
															<div class='article-content'>
																<h2><a title='$r[tema]' href='".base_url()."agenda/detail/$r[tema_seo]'>$judull</a></h2>
																<span class='meta'>
																	<a href='".base_url()."agenda/detail/$r[tema_seo]'><span class='icon-text'>&#128100;</span>$r[nama_lengkap]</a>
																	<a href='".base_url()."agenda/detail/$r[tema_seo]'><span class='icon-text'>&#128340;</span>$tgl_posting - $baca view</a>
																</span>
																<p>$isi . . .</p>
																<span class='meta'>
																	<a href='".base_url()."agenda/detail/$r[tema_seo]' class='more'>See More<span class='icon-text'>&#9656;</span></a>
																</span>
															</div>
														</div>";
											  }
										?>
											<div class="pagination">
												<?php echo $this->pagination->create_links(); ?>
											</div>
										</div>
									</div>
								</div>
								<div class="content-block right">
									<?php include "sidebar_kiri.php"; ?>
								</div>
							</div>
						</div>
						<div class="main-sidebar right">
							<?php include "sidebar_kanan.php"; ?>
						</div>
						<div class="clear-float"></div>
					</div>
				<!-- END .wrapper -->