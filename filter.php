<?php  
 //filter.php  
 if(isset($_POST["from_date"], $_POST["to_date"]))  
 {  
      $connect = mysqli_connect("mysql.hostinger.com.br", "u942257283_nupso", "nupsolxyz", "u942257283_banco");  
      $output = '';  
      $query = "  
           SELECT * FROM backup 
           WHERE date BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'  
      ";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
           <table class="table table-bordered">  
                <tr>  
                     <th width="5%">ID</th>  
                     <th width="30%">Data</th>  
                     <th width="43%">Corrente</th>  
                     <th width="10%">Tensão</th>  
                     <th width="12%">dateserver</th>  
                </tr>  
      ';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                          <td>'. $row["id"] .'</td>  
                          <td>'. $row["date"] .'</td>  
                          <td>'. $row["cmed"] .'</td>  
                          <td>'. $row["vmed"] .'</td>  
                          <td>'. $row["dateserver"] .'</td>  
                     </tr>  
                ';  
           }  
      }  
      else  
      {  
           $output .= '  
                <tr>  
                     <td colspan="5">No Order Found</td>  
                </tr>  
           ';  
      }  
      $output .= '</table>';  
      echo $output;  
 }  
 ?>
