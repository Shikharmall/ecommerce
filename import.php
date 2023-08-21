<?php
include 'connection.php';

    if(isset($_POST["upload_excel"])){
       
        $filename=$_FILES["file"]["tmp_name"];    
        if($_FILES["file"]["size"] > 0)
        {
            $file = fopen($filename, "r");
            while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
            {
                /*$sql = "INSERT into employeeinfo (emp_id,firstname,lastname,email,reg_date) 
                      values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."')";*/
   
                $sql_insert = "INSERT INTO items(item_name,original_price,selling_price,discount,occasion) VALUES('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."')";
        
                $result_insert = mysqli_query($conn,$sql_insert);

                if(!isset($result_insert))
                {
                    echo "<script type=\"text/javascript\">
                      alert(\"Invalid File:Please Upload CSV File.\");
                      </script>";    
                }
                else{
                    echo "<script type=\"text/javascript\">
                    alert(\"CSV File has been successfully Imported.\");
                  </script>";
                }
            }
         
            fclose($file);  
        }
    }   
 ?>