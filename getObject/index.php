<?php

   $name = htmlspecialchars($_GET["name"]);
   $objectid = htmlspecialchars($_GET["objectid"]);

   $url = 'https://api.wallyjobs.com/' . $name . '/' . $objectid;

   $ch = curl_init();
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
   curl_setopt($ch, CURLOPT_SSL_VERSION, 3);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_URL, $url);
   $result = curl_exec($ch);
   curl_close($ch);

   echo $result;

?>