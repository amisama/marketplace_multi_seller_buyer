						<div class="full-width">
							<div class="block">
								<div class="block-title">
									<a href="<?php echo base_url(); ?>" class="right">Back to homepage</a>
									<h2>Playlist</h2>
								</div>
								<div class="block-content">
									<div class="map-border">
										<ul class="article-block-big">
												<?php 
													$no=$this->uri->segment(3)+1;
													foreach ($playlist->result_array() as $h) {	
													$total_video = $this->model_utama->view_where('video',array('id_playlist' => $h['id_playlist']))->num_rows();
														echo "<li style='width:217px'>
																<div style='overflow:hidden; height:135px;' class='article-photo'>
																	<a href='".base_url()."playlist/detail/$h[playlist_seo]' class='hover-effect'>";
																		if ($h['gbr_playlist'] ==''){
																			echo "<a class='hover-effect' href='".base_url()."playlist/detail/$h[playlist_seo]'><img style='width:215px' src='".base_url()."asset/img_playlist/no-image.jpg' alt='no-image.jpg' /></a>";
																		}else{
																			echo "<a class='hover-effect' href='".base_url()."playlist/detail/$h[playlist_seo]'><img style='width:215px' src='".base_url()."asset/img_playlist/$h[gbr_playlist]' alt='$h[gbr_playlist]' /></a>";
																		}
																echo "</a>
																</div>
																<div class='article-content'>
																	<span style='font-size:14px; color:#8a8a8a;'><center>Ada $total_video Video</center></span>
																	<h4 align=center><a href='".base_url()."playlist/detail/$h[playlist_seo]'>$h[jdl_playlist]</a></h4>
																</div>
															  </li>";
													}
												?>
											</ul>
									</div>
								</div>
							</div>
						</div>