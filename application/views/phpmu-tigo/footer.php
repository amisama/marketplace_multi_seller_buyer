<?php
echo "<div class='wrapper'>
	<ul class='right'>";
		$topmenu2 = $this->model_utama->view_where('menu',array('position' => 'Top','aktif' => 'Ya'),'urutan','ASC',0,5);
			foreach ($topmenu2->result_array() as $row) {
			echo "<li><a href='$row[link]'>$row[nama_menu]</a></li>";
		}
	echo "</ul>
	<p>&copy; ".date('Y')." Copyright <b>phpmu.com</b> News. All Rights reserved.<br/>Develop by. <b style='color:orange'>Robby Prihandaya</b> - Redesign by. <b style='color:orange'>Nama Anda Disini</b></p>
</div>";