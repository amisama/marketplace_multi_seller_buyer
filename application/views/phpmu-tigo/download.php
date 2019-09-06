<div class="main-page left">
	<div class="single-block">
		<div class="content-block main left">
			<div class="block">
				<div class="block-title" style="background: #bf4b37;">
					<a href="<?php echo base_url(); ?>" class="right">Back to Homepage</a>
					<h2>Semua daftar / List File Download</h2>
				</div>
				<div class="block-content">
					<div class="shortcode-content">
						<div class="paragraph-row">
							<div class="column12">
								<table class='table-download' style='font-weight:bold; border:1px solid #e3e3e3;' width='100%'>
									<tr style='background:#8a8a8a'>
										<th>No</th>
										<th>Nama File</th>
										<th>Hits</th>
										<th style='width:70px'></th>
									</tr>
									<?php
										$no=$this->uri->segment(3)+1;
										foreach ($download->result_array() as $r) {	
										if(($no % 2)==0){ $warna="#ffffff";}else{ $warna="#E1E1E1"; }
											echo "<tr bgcolor=$warna>
													<td>$no</td>
												  	<td>$r[judul]</td>
												  	<td>$r[hits] Kali</td>
												  	<td><a class='button' style='background:#29b332; color:#ffffff; padding:2px 10px' href='".base_url()."download/file/$r[nama_file]'>Download</a></td>
												  </tr>";
										$no++;
										}
									?>
								</table>
								<div class="pagination">
									<?php echo $this->pagination->create_links(); ?>
								</div>
							</div>
						</div>
						
						<?php
						$ia = $this->model_utama->view_ordering_limit('iklantengah','id_iklantengah','ASC',6,1)->row_array();
						echo "<a href='$ia[url]' target='_blank'>";
							$string = $ia['gambar'];
							if ($ia['gambar'] != ''){
								if(preg_match("/swf\z/i", $string)) {
									echo "<embed style='margin-top:-10px' src='".base_url()."asset/foto_iklantengah/$ia[gambar]' width='100%' height=90px quality='high' type='application/x-shockwave-flash'>";
								} else {
									echo "<img style='margin-top:-10px; margin-bottom:5px' width='100%' src='".base_url()."asset/foto_iklantengah/$ia[gambar]' title='$ia[judul]' />";
								}
							}
						echo "</a>";
						?>
						<div class="article-title">
							<div class="share-block right">
								<div>
									<div class="share-article left">
										<span>Social media</span>
										<strong>Share this article</strong>
									</div>
									<div class="left">
										<script language="javascript">
										document.write("<a href='http://www.facebook.com/share.php?u=" + document.URL + " ' target='_blank' class='custom-soc icon-text'>&#62220;</a> <a href='http://twitter.com/home/?status=" + document.URL + "' target='_blank' class='custom-soc icon-text'>&#62217;</a> <a href='https://plus.google.com/share?url=" + document.URL + "' target='_blank' class='custom-soc icon-text'>&#62223;</a>");
										</script>
										<a href="#" class="custom-soc icon-text">&#62232;</a>
										<a href="#" class="custom-soc icon-text">&#62226;</a>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class='main-sidebar right'>
	<?php include "sidebar_halaman.php"; ?>
</div>