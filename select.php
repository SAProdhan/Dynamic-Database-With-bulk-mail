<?php  
 require "connection.php";  
 $table = $_POST["t_name"];
 $temp = array();
 $output = '';  
 $sql = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='EF_Applicant' AND `TABLE_NAME`='".$table."'";
 $column_name = mysqli_query($connect, $sql);
 $sql = "SELECT * FROM `".$table."`";  
 $result = mysqli_query($connect, $sql);  
 $output .= '  
      <thead>
          <tr>';  
 if(mysqli_num_rows($column_name) > 0)  
 {  
      while($column = mysqli_fetch_array($column_name))  
      {  
          $output .= 
               '
                     <th>'.$column['COLUMN_NAME'].'</th>   
               ';
          array_push($temp, $column['COLUMN_NAME']);
      }  
      $output .= ' 
      <th>Action</th> 
      </tr>
      </thead>
      <tbody>';  
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result))  
      {  $output .= 
          '<tr>';
          foreach($temp as $column){
               $output .= 
               '
                     <td class="'.$column.'" contenteditable>'.$row[$column].'</td>  
                     ';
          }
          $output .= '
          <td><button type="button" name="delete_btn" data-id1="'.$row[0].'" class="btn btn-xs btn-danger btn_delete">x</button>&nbsp;&nbsp;<button type="button" name="delete_btn" data-id7="'.$row[0].'" class="btn btn-xs btn-success btn_edit"> ✓</button></td>  
                </tr>';
      } 
  }
      
 }  
 else  
 {  
    $output .= '<tr>  
                    <td>Table not found</td>  
                </tr>';  
 }
    $output .='<tr>';  
    foreach($temp as $column){
        if($column == 'Serial No')
        {
            $output .= 
        '<td id="'.$column.'"></td>';
        }
        else{
            $output .= 
        '<td id="'.$column.'" contenteditable></td>';
        }
        
    }
    $output .= '<td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>  
           </tr>';   
  
 if($table !='paxzone_email_data'){
     $output .= "</tbody><script>$(document).ready(function() { var table = $('#mytable').DataTable({
         'scrollY': 500, 
         'scrollX': true, 
         dom: 'Bfrtip',
         buttons: [
                'pageLength','colvis'
         ]}); 
         $('#mytable tbody').on( 'click', 'tr', function () { if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); } } ); $('#button').click( function () { table.row('.selected').remove().draw( false ); } ); } );</script>";
 }
 else{
     $output .= "</tbody><script>$(document).ready(function() { var table = $('#mytable').DataTable({'scrollY': 500, 'dom': 'Rlfrtip',}); $('#mytable tbody').on( 'click', 'tr', function () { if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); } } ); $('#button').click( function () { table.row('.selected').remove().draw( false ); } ); } );</script>";
 }
 echo $output;  
 ?>

