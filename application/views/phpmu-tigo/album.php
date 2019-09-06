						<div class="full-width">
							<div class="block">
								<div class="block-title">
									<a href="<?php echo base_url(); ?>" class="right">Back to homepage</a>
									<h2>Albums</h2>
								</div>
								<div class="block-content">
									<div class="map-border">
										<ul class="article-block-big">
												<?php 
													$no = $this->uri->segment(3)+1;
													foreach ($album->result_array() as $h) {	
														$total_foto = $this->model_utama->view_where('gallery',array('id_album' => $h['id_album']))->num_rows();
														echo "<li style='width:217px'>
																<div style='overflow:hidden; height:135px;' class='article-photo'>
																	<a href='".base_url()."albums/detail/$h[album_seo]' class='hover-effect'>";
																		if ($h['gbr_album'] ==''){
																			echo "<a class='hover-effect' href='".base_url()."albums/detail/$h[album_seo]'><img style='width:215px' src='".base_url()."asset/img_album/no-image.jpg' alt='no-image.jpg' /></a>";
																		}else{
																			echo "<a class='hover-effect' href='".base_url()."albums/detail/$h[album_seo]'><img style='width:215px' src='".base_url()."asset/img_album/$h[gbr_album]' alt='$h[gbr_album]' /></a>";
																		}
																echo "</a>
																</div>
																<div class='article-content'>
																	<span style='font-size:14px; color:#8a8a8a;'><center>Ada $total_foto Foto</center></span>
																	<h4><a href='".base_url()."albums/detail/$h[album_seo]'>$h[jdl_album]</a></h4>
																	<span class='meta'>
																		<a href='".base_url()."albums/detail/$h[album_seo]'><span class='icon-text'>&#128340;</span>$h[jam], ".tgl_indo($h['tgl_posting']).", <span style='font-size:14px; color:#8a8a8a'>$h[hits_album] view</span></a>
																	</span>
																</div>
															  </li>";
													}
												?>
											</ul>
									</div>
									<div class="pagination">
										<?php echo $this->pagination->create_links(); ?>
									</div>
								</div>
							</div>
						</div>