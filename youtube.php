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
    <h1>Youtube</h1>

    <?php
    $key = 'AIzaSyDfENYAWofh7L6mFJjhOZNh1WZAkRRVSoI';
    $base_url = 'https://www.googleapis.com/youtube/v3/';
    $channelId = 'UCKZozRVHRYsYHGEyNKuhhdA';
    $maxResult = 25;

    $API_URL = $base_url . "search?part=snippet&channelId=" . $channelId . "&maxResults=" . $maxResult . "&key=" . $key;

    // echo "<pre>";
    // print_r($API_URL);
    // exit();

    $videos = json_decode(file_get_contents($API_URL));

    // echo "<pre>";
    // print_r($videos);
    // exit();

    foreach($videos->items as $video){

    //     echo "<pre>";
    // print_r($video->id->videoId);
        $video_id=  '';
        if(isset($video->id->videoId))
        {
            $video_id = $video->id->videoId;
        }

        
        
        $title = $video->snippet->title;
        $description = $video->snippet->description;
        $thumbnail_url = $video->snippet->thumbnails->medium->url;
        


        
        mysqli_query($con, "INSERT INTO `videos` (`video_id`, `title`, `description` , `thumbnail_url`, `published_at`)
        VALUES ('$video_id', '$title', '$description' ,'$thumbnail_url', current_timestamp())");  
 
        
    }
    // exit();
    // echo "<pre>";
    // print_r($videos);
    // exit();


    ?>

    <!-- <a href="<?php //$API_URL ?>">Click Me</a> -->
    <!-- //  $sql = "INSERT INTO `videos` (`id`, `video_id`, `title`, `thumbnail_url`, `published_at`)
        //     VALUES (NULL, '', '', '', current_timestamp())"; -->
</body>

</html>