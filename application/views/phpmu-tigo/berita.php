					<div class="main-content">
						<div class="main-page left">
							<div class="double-block">
								<div class="content-block main left">
									<div class="block">
										<div class="block-title" style="background: #2182b4;">
											<a href="<?php echo base_url(); ?>" class="right">Back to homepage</a>
											<h2><?php echo $title; ?></h2>
										</div>
										<div class="block-content">
											<?php
											  foreach ($berita->result_array() as $r) {	
												  $baca = $r['dibaca']+1;	
												  $isi_berita =(strip_tags($r['isi_berita'])); 
												  $isi = substr($isi_berita,0,220); 
												  $isi = substr($isi_berita,0,strrpos($isi," ")); 
												  $judul = substr($r['judul'],0,33); 
												  $total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $r['id_berita']))->num_rows();
												  
												  echo "<div class='article-big'>
															<div style='height:120px; background:#e3e3e3; overflow:hidden' class='article-photo'>
																<a href='".base_url()."$r[judul_seo]' class='hover-effect'>";
																	if ($r['gambar'] == ''){
																		echo "<img style='width:210px;' src='".base_url()."asset/foto_berita/no-image.jpg' alt='no-image.jpg' /></a>";
																	}else{
																		echo "<img style='width:210px;' src='".base_url()."asset/foto_berita/$r[gambar]' alt='$r[gambar]' /></a>";
																	}
																echo "</a>
															</div>
															<div class='article-content'>
																<h2><a title='$r[judul]' href='".base_url()."$r[judul_seo]'>$judul...</a><a href='".base_url()."$r[judul_seo]' class='h-comment'>$total_komentar</a></h2>
																<span class='meta'>
																	<a href='".base_url()."$r[judul_seo]'><span class='icon-text'>&#128100;</span>$r[nama_lengkap]</a>
																	<a href='".base_url()."$r[judul_seo]'><span class='icon-text'>&#128340;</span>$r[jam], ".tgl_indo($r['tanggal'])."</a>
																</span>
																<p>".getSearchTermToBold($isi,$this->input->post('kata'))." . . .</p>
																<span class='meta'>
																	<a href='".base_url()."$r[judul_seo]' class='more'>Read Full Article<span class='icon-text'>&#9656;</span></a>
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
