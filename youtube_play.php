<?php $con=mysqli_connect("localhost","root","","youtube");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Youtube Play</h1>

    <?php
        $sql = "SELECT * FROM videos";
        $play = $con->query($sql);
        // $row = $play->fetch_assoc();
        // echo "<pre>";
        // print_r($row);

        // foreach($row as $video){
            while ($row = mysqli_fetch_assoc($play)) {

            // echo "<pre>";
            // print_r($row);
            // exit();

            echo '<iframe width="460" height="215" src="https://www.youtube.com/embed/'.$row['video_id'].'" 
                title="YouTube video player" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen></iframe>';

        }

  

exit();
    ?>
    


   
</body>
</html>