<?php

// Cache Geofences Tiles

if (file_exists("./.cache") && @$disable_geomap <> 'True') {

   $opts = array(
     'http'=>array(
       'method'=>"GET",
       'header'=>"Accept-language: en\r\n" .
                 "X-Poracle-Secret: $api_secret\r\n"
     )
   );

   $context = stream_context_create($opts);

   $geo_hash = file_get_contents("$api_address/api/geofence/all/hash", false, $context);
   $json = json_decode($geo_hash, true); 
   $geo_hash = $json['areas'];

   foreach ($json['areas'] as $area_name => $hash) {

      // Call Each Geofence and check hash

      if (!file_exists("./.cache/geo_".$area_name."_".$hash.".png")) { 
	      $geo = file_get_contents("$api_address/api/geofence/".rawurlencode($area_name)."/map", false, $context);
	      echo "$api_address/api/geofence/".rawurlencode($area_name)."/map<br>";
	 $json = json_decode($geo, true);
	 $png=$json['url'];
	 if ( @fopen($png, 'r') ) { 
               $area_name = str_replace('%20', '_', $area_name);
               file_put_contents("./.cache/geo_".strtoupper($area_name)."_".$hash.".png", file_get_contents($png));
            }
      }

   }

}

?>
