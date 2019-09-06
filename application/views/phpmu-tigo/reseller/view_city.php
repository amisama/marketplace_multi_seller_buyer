<?php
  echo "<option value=''>- Pilih -</option>";
  foreach ($kota as $row){
      echo "<option value='$row[kota_id]'>$row[nama_kota]</option>";
  }