<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
 
$client_id = '15389c42a3ca4a55a6568b2da13d2dc9'; 
$client_secret = '3b2f1929521d4f68bfafdb89da54fbb7';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,            'https://accounts.spotify.com/api/token' );
curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret))); 
curl_setopt($ch, CURLOPT_POSTFIELDS,     'grant_type=client_credentials' ); 
curl_setopt($ch, CURLOPT_POST,           1 );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:x.x.x) Gecko/20041107 Firefox/x.x");
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
$json = curl_exec($ch);
$json = json_decode($json);
curl_close($ch);


$authorization = "Authorization: Bearer " . $json->access_token;
 
$artist = 'Lady Gaga';

$spotifyURL = 'https://api.spotify.com/v1/search?q='.urlencode($artist).'&type=artist';
 
$ch2 = curl_init();
 
 
curl_setopt($ch2, CURLOPT_URL, $spotifyURL);
curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization));
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch2, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:x.x.x) Gecko/20041107 Firefox/x.x");
curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
$json2 = curl_exec($ch2);
$json2 = json_decode($json2);
curl_close($ch2);
 
if($json2)
{
  	foreach ($json2 as $key => $json_artist_details) 
  	{
    	$items = $json_artist_details->items;

	    if($items)
	    {
	    	foreach ($items as $keyitem => $item) 
	    	{
	    		$atrist_href = $item->href;

	    		$spotifyURL = $atrist_href.'/albums?offset=0&limit=50&include_groups=album,single,compilation,appears_on';
	 
				$ch2 = curl_init();
				 
				 
				curl_setopt($ch2, CURLOPT_URL, $spotifyURL);
				curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization));
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch2, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:x.x.x) Gecko/20041107 Firefox/x.x");
				curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
				$json24 = curl_exec($ch2);
				$json24 = json_decode($json24);
				curl_close($ch2);
	 
				if($json24)
				{
					foreach ($json24 as $key_album => $artist_album) 
					{
						if(is_array($artist_album) == 1)
						{
							if($artist_album)
							{
								foreach($artist_album as $key_atristalbum => $artistalbum) 
								{
									$albumlink = $artistalbum->href;

									$spotifyURL_album = $albumlink;

									$ch2 = curl_init();

									curl_setopt($ch2, CURLOPT_URL, $spotifyURL_album);
									curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization));
									curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
									curl_setopt($ch2, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:x.x.x) Gecko/20041107 Firefox/x.x");
									curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, false);
									curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
									$json2_get_data = curl_exec($ch2);
									$json2_get_data = json_decode($json2_get_data);
									curl_close($ch2);


									echo '<pre>';
									print_r($json2_get_data);
								
									if($json2_get_data->tracks)
									{
										foreach ($json2_get_data->tracks as $key_new => $get_data) 
										{	
											if(is_array($get_data) == 1)
											{
												if($get_data)
												{
													foreach ($get_data as $key_getdata => $getdata) 
													{
														echo '<pre>';
														print_r($getdata);
														//echo $getdata->name.'<br/>'.$getdata->preview_url.'<br/>'.$getdata->type.'<br/>'.$json2_get_data->images[1]->url.'<br/>';
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
    		}
    	}
  	}
}
die();
?>