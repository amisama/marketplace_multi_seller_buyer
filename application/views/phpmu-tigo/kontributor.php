<script type="text/javascript">
	function validasireg(form){
		if (form.a.value == ""){ alert("Anda belum mengisikan Username"); form.a.focus(); return (false); }							
		if (form.b.value == ""){ alert("Anda belum mengisikan Password"); form.b.focus(); return (false); }									
		if (form.c.value == ""){ alert("Anda belum menuliskan Nama Lengkap"); form.c.focus(); return (false); }
		if (form.d.value == ""){ alert("Anda belum menuliskan Email"); form.d.focus(); return (false); }
		if (form.e.value == ""){ alert("Anda belum menuliskan No Telpon"); form.e.focus(); return (false); }																		
	  return (true);
	}
</script>	
<div class="main-page left">
	<div class="single-block">
		<div class="content-block main left">
			<div class="block">
				<div class="block-title" style="background: #bf4b37;">
					<a href="<?php echo base_url(); ?>" class="right">Back to homepage</a>
					<h2>Pendaftaran untuk Kontributor</h2>
				</div>
				<div class="block-content">
					<div class="shortcode-content">
							<div class="column12">
								<div  id="writecomment">
								<p><label for="c_name"><b style='color:red'>PENTING!</b></label><i>Untuk berkontribusi dalam memberikan atau menulis artikel/berita, maka Silahkan Melengkapi form dibawah ini dengan data yang sebenarnya. Terima kasih,.. ^_^</i></p><br>
								<?php echo $this->session->flashdata('message'); ?>
								<form action="<?php echo base_url(); ?>kontributor/pendaftaran" method="POST" enctype='multipart/form-data' onSubmit="return validasireg(this)">
									<p class="contact-form-user">
										<label for="c_name">Username<span class="required">*</span></label>
										<input type="text" placeholder="Nickname" name='a' style='width:40%' id="c_name" onkeyup="nospaces(this)" required/>
									</p>
									<p class="contact-form-user">
										<label for="c_name">Password<span class="required">*</span></label>
										<input type="text" placeholder="Password" name='b' style='width:40%' id="c_name" required/>
									</p>
									<p class="contact-form-user">
										<label for="c_name">Nama Lengkap<span class="required">*</span></label>
										<input type="text" placeholder="Nama Lengkap" name='c' style='width:90%' id="c_name" required/>
									</p>
									<p class="contact-form-email">
										<label for="c_email">E-mail<span class="required">*</span></label>
										<input type="text" placeholder="E-mail" name='d' style='width:90%' id="c_email" required/>
									</p>
									<p class="contact-form-email">
										<label for="c_email">No Telpon<span class="required">*</span></label>
										<input type="text" placeholder="No Telpon" name='e' id="c_email" required/>
									</p>
									<p class="contact-form-email">
										<label for="c_email">Foto<span class="required">*</span></label>
										<input type="file" name='f' id="c_email" required/><br>
										<i>Allowed File : gif, jpg, png, jpeg</i>
									</p>
									<p class="contact-form-message">
										<label for="c_message">
										<?php echo $image; ?><br></label>
										<input name='secutity_code' maxlength=6 type="text" class="required" placeholder="Masukkkan kode di sebelah kiri..">
									</p>
									<p><br><input type="submit" class="styled-button" name='submit' value="Daftar Sekarang!" /></p>
									<hr>
								</form>
								</div>
							</div>
						</div><br>
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


<div class='main-sidebar right'>
<?php include "sidebar_kontributor.php"; ?>
</div>