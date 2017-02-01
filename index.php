<?php 
  require 'vendor/autoload.php';
  
  use Aws\Credentials\CredentialProvider;
  use Aws\S3\S3Client;


  $profile = 'pidro-dev';
  $path = '/Users/mf/.aws/credentials';

  $provider = CredentialProvider::ini($profile, $path);
  $provider = CredentialProvider::memoize($provider);


  $keyname = 'pic.jpg';
  $bucket = 'static-dev.pidro.online';
  $filepath = '/Users/mf/code/pidro/php-s3-upload/pic.jpg';

  $s3 = new S3Client([
    'version' => 'latest',
    'region' => 'eu-west-1',
    'credentials' => $provider
  ]);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title></title>
  </head>
  <body>


    <?php

      echo "<p>Starting...</p>";

      $result = $s3->putObject(array(
        'Bucket' => $bucket,
        'Key' => $keyname,
        'SourceFile' => $filepath,
        'ContentType' => 'image/jpeg',
        'ACL' => 'public-read'
      ));


      echo "<p>Done:</p>";
      echo "<img width='500' src='".$result['ObjectURL']."' />";
      
    ?>




  </body>
</html>




