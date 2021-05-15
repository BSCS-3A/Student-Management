<?php
            $dir = '../../user/msg';
            $files = scandir($dir);
            foreach($files as $open){
            if($open == "." || $open == ".." );
            else {
              $sname = explode(".", $open); 
              $file = file_get_contents("../../user/msg/".$sname[0].".html");
              $rows = explode("##", $file);
              $nm = count($rows);
              $rowsx = explode("||",$rows[$nm-2]);
              if(isset($rows[0]) && $rowsx[4] == "unread"){
              echo   '<a href="Admin_MBox.php?id='.$sname[0].'" class="list-group-item list-group-item-action list-group-item-light rounded-0" style="background-color:#1D6986;color:white">                  
              <div class="media-body ml-4" >
              <div class="d-flex align-items-center justify-content-between mb-1" >
              <p class="cname">'.$sname[0].'</p>
              </div>
              <p class="cmessage">'.$rowsx[1].'</p>
              <div class="float-sm-right">
              <small class="small font-weight-bold" >'.$rowsx[2]." ".$rowsx[3].'</small></div>  
              </div></a>
              ';
            }}}
            foreach($files as $open){
            if($open == "." || $open == ".." );
            else {
              $sname = explode(".", $open); 
              $file = file_get_contents("../../user/msg/".$sname[0].".html");
              $rows = explode("##", $file);
              $nm = count($rows);
              $rowsx = explode("||",$rows[$nm-2]);
              if(isset($rows[0]) && $rowsx[4] == "read"){
                echo   '<a href="Admin_MBox.php?id='.$sname[0].'" class="list-group-item list-group-item-action list-group-item-light rounded-0">                  
                <div class="media-body ml-4">
                <div class="d-flex align-items-center justify-content-between mb-1">
                <p class="cname">'.$sname[0].'</p>                
                </div>
                <p class="cmessage">'.$rowsx[1].'</p>
                <div class="float-sm-right">
                <small class="small font-weight-bold" >'.$rowsx[2]." ".$rowsx[3].'</small></div>  
                </div></a>
                ';
             }}}
            ?>