<?php
    include 'connection.php';

    if(isset($_FILES["image"])){

        /*echo "<pre>";
        print_r($_FILES);
        echo "</pre>";*/

       $file_name = $_FILES['image']['name'];
       $file_size = $_FILES['image']['size'];
       $file_tmp = $_FILES['image']['tmp_name'];
       $file_type = $_FILES['image']['type'];

       if(move_uploaded_file($file_tmp,"upload-images/" . $file_name)){

        $sql=" UPDATE payment  SET image_name = '$file_name'  where id = '4' ";

       /* $sql = "INSERT INTO payment(image_name) VALUES('$file_name')";*/
        $result = mysqli_query($conn,$sql);
       echo "uploaded";
       
       }

       else{
        echo "upload failed.";
       }



    }
    

?>


<html>
    <head>
        <title>image</title>
    </head>
    <body>
        <center>
            <form action="#" method="POST" enctype="multipart/form-data">
                <input type ="file" name = "image" required> <br> <br>
                <input type ="submit" name ="submit" id ="ss_subm" value="Upload">
           </form>
        </center>
    </body>
</html>