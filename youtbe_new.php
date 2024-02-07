<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>YOUTUBE</h1>
    <?php

$con=mysqli_connect("localhost","root","","youtube_new");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$url = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet%2C+id%2C+status&playlistId=PLU12uITxBEPHfZZRTIk96NduwU_8hT-Yo&maxResults=10&key=AIzaSyDfENYAWofh7L6mFJjhOZNh1WZAkRRVSoI";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:53.0) Gecko/20100101 Firefox/53.0'
));

curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
curl_setopt($ch, CURLINFO_HEADER_OUT, TRUE);

$json_response = curl_exec($ch);
curl_close ($ch);

$result = json_decode($json_response, true);

// echo "<pre>";
// print_r($result);
// exit();

// foreach ($result['items'] as $page_info) {

// $video_id = $page_info['snippet']['resourceId']['videoId'];
// $title = $page_info['snippet']['title'];
// $description = $page_info['snippet']['description'];

// mysqli_query($con, "INSERT INTO `youtube` (`id`, `video_id`, `title`, `description`) VALUES (NULL, '$video_id', '$title', '$description')");  


// }


?>
</body>
</html>