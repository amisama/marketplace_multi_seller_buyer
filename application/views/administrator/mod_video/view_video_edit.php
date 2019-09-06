<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Video</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/edit_video',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_video]'>
                    <tr><th width='120px' scope='row'>Judul Video</th>  <td><input type='text' class='form-control' name='b' value='$rows[jdl_video]'></td></tr>
                    <tr><th scope='row'>Playlist</th>                   <td><select name='a' class='form-control' required>
                                                                            <option value='' selected>- Pilih Playlist -</option>";
                                                                            foreach ($record as $row){
                                                                              if ($rows['id_playlist']==$row['id_playlist']){
                                                                                echo "<option value='$row[id_playlist]' selected>$row[jdl_playlist]</option>";
                                                                              }else{
                                                                                echo "<option value='$row[id_playlist]'>$row[jdl_playlist]</option>";
                                                                              }
                                                                            }
                    echo "</td></tr>
                    <tr><th scope='row'>Keterangan</th>                 <td><textarea id='editor1' class='form-control' name='c'>$rows[keterangan]</textarea></td></tr>
                    <tr><th scope='row'>Gambar</th>                     <td><input type='file' class='form-control' name='d'>";
                                                                            if ($rows['gbr_video']!=''){ echo " Gambar Saat ini : <a target='_BLANK' href='".base_url()."asset/img_video/$rows[gbr_video]'>$rows[gbr_video]</a>"; } echo "</td></tr>
                    <tr><th scope='row'>Link Youtube</th>               <td><input type='text' class='form-control' name='e' placeholder='Contoh link: http://www.youtube.com/embed/xbuEmoRWQHU' value='$rows[youtube]'></td></tr>
                    <tr><th scope='row'>Tag</th>                        <td><div class='checkbox-scroll'>";
                                                                            $_arrNilai = explode(',', $rows['tagvid']);
                                                                            foreach ($tag as $tag){
                                                                                $_ck = (array_search($tag['tag_seo'], $_arrNilai) === false)? '' : 'checked';
                                                                                echo "<span style='display:block;'><input type=checkbox value='$tag[tag_seo]' name=f[] $_ck> $tag[nama_tag] &nbsp; &nbsp; &nbsp; </span>";
                                                                            }
                    echo "</div></td></tr>
                  </tbody>
                  </table>
                </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url().$this->uri->segment(1)."/video'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();