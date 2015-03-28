<?php

   $description = htmlspecialchars($_GET["description"]);
   $reccomender_id = htmlspecialchars($_GET["reccomender_id"]);
   $job_id = htmlspecialchars($_GET["job_id"]);
   $application_id = htmlspecialchars($_GET["application_id"]);

   $url = 'https://api.wallyjobs.com/recommendations' ;

   $post = array(
      'description' => $description,
      'reccomender_id' => $reccomender_id,
      'job_id' => $job_id,
      'application_id' => $application_id
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