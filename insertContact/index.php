<?php

   $id = htmlspecialchars($_GET["id"]);
   $candidate = htmlspecialchars($_GET["candidate"]);

   $url = 'https://api.wallyjobs.com/usertocontact' ;

   $post = array(
      'user_id' => $id,
      'friend_id' => $candidate
      );

   $ch = curl_init();
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
   curl_setopt($ch, CURLOPT_SSL_VERSION, 3);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
   $result = curl_exec($ch);
   curl_close($ch);

   echo $result;

?>