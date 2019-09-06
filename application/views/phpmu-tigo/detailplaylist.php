					<div class="main-content">
						<div class="main-page left">
							<div class="double-block">
								<div class="content-block main left">
									<div class="block">
										<div class="block-title" style="background:purple;">
											<a href="<?php echo base_url(); ?>" class="right">Back to homepage</a>											
											<h2>Semua Video "<?php echo "$rows[jdl_playlist]"; ?>"</h2>
										</div>
										<div class="block-content">
											<?php
											  foreach ($detailplaylist->result_array() as $r) {	
												  $lihat = $r['dilihat']+1;
												  $judull = substr($r['jdl_video'],0,33); 
												  $isi_berita =(strip_tags($r['keterangan'])); 
												  $isi = substr($isi_berita,0,280); 
												  $isi = substr($isi_berita,0,strrpos($isi," "));
												  $total_komentar = $this->model_utama->view_where('komentarvid',array('id_video' => $r['id_video']))->num_rows();
												  
												  echo "<div class='article-big'>
															<div class='article-photo'>";
															if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $r['youtube'], $match)) {
				                                                echo "<iframe width='210' height='150' src='https://www.youtube.com/embed/".$match[1]."' frameborder='0' allowfullscreen></iframe>";
				                                            } 
														echo "</div>
															<div class='article-content'>
																<h2><a title='$r[jdl_video]' href='".base_url()."playlist/watch/$r[video_seo]'>$judull</a><a href='".base_url()."playlist/watch/$r[video_seo]' class='h-comment'>$total_komentar</a></h2>
																<span class='meta'>
																	<a href='".base_url()."playlist/watch/$r[video_seo]'><span class='icon-text'>&#128100;</span>$r[nama_lengkap]</a>
																	<a href='".base_url()."playlist/watch/$r[video_seo]'><span class='icon-text'>&#128340;</span>$r[jam], ".tgl_indo($r['tanggal'])."</a>
																</span>
																<p>$isi . . .</p>
																<span class='meta'>
																	<a href='".base_url()."playlist/watch/$r[video_seo]' class='more'>Watch This Video<span class='icon-text'>&#9656;</span></a>
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