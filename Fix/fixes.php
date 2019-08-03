<?php
ini_set('display_errors',1);
ini_set('error_reporting',E_ALL);

require_once 'unirest-php/src/Unirest.php';

header('Content-type: text/plain');

$NUMBER_OF_SECONDS = 1;

// Countries // 190/10
// $limit = 10;
// $offset = 0;
// $MAX_LIMIT = 1;
// for ($i=0; $i<25; $i++):
//     $url = "https://wft-geo-db.p.rapidapi.com/v1/geo/countries?offset=".$offset."&limit=10";
//     echo $url.PHP_EOL;
//     $response = Unirest\Request::get($url,
//         array(
//             "X-RapidAPI-Host" => "wft-geo-db.p.rapidapi.com",
//             "X-RapidAPI-Key" => ""
//         )
//     );
//     $fp = fopen('countries.json', 'a');
//     fwrite($fp, $response->raw_body.PHP_EOL);
//     fclose($fp);
//     if ($i%5 == 0): sleep($NUMBER_OF_SECONDS); endif;
//     $offset = $limit + 1;
//     $limit = $limit + 10;
//     echo $offset.PHP_EOL;
//     echo $limit.PHP_EOL;
// endfor;


// Regions
// $countriesJson = file_get_contents("data/countries.json");
// $countriesArray = json_decode($countriesJson, true);
// foreach($countriesArray as $country) :
//     $limit = 10;
//     $offset = 0;
//     $MAX_LIMIT = 1;
//     for ($i=0; $i<$MAX_LIMIT; $i++):
//         $url = "https://wft-geo-db.p.rapidapi.com/v1/geo/countries/".$country['wikiDataId']."/regions?offset=".$offset."&limit=10";
//         echo $url.PHP_EOL;
//         $response = Unirest\Request::get($url,
//             array(
//                 "X-RapidAPI-Host" => "wft-geo-db.p.rapidapi.com",
//                 "X-RapidAPI-Key" => ""
//             )
//         );
//         print_r($response);
//         print_r($response->body->data);
//         if (!empty($response->body->data)) {
//             $file_name = $country['code'].'.json';
//             $fp = fopen('data/regions/'.$file_name, 'a');
//             fwrite($fp, $response->raw_body.PHP_EOL);
//             fclose($fp);
//             if ($i%5 == 0): sleep($NUMBER_OF_SECONDS); endif;
//             $offset = $limit + 1;
//             $limit = $limit + 10;

//             // Set Dynamic
//             $TOTAL_COUNT = $response->body->metadata->totalCount;
//             echo $TOTAL_COUNT;
//             if ($TOTAL_COUNT > 10): $MAX_LIMIT = ceil($TOTAL_COUNT/10); endif;
//             echo 'OK SET '.$MAX_LIMIT.PHP_EOL;
//        }
//     endfor;
// endforeach;


// Cities
// $countriesJson = file_get_contents("data/countries.json");
// $countriesArray = json_decode($countriesJson, true);
// foreach($countriesArray as $country) :
//     $file_name = $country['code'].'.json';
//     $statesJson = file_get_contents("data/regions/".$file_name);
//     $statesArray = json_decode($statesJson, true);
//     foreach($statesArray as $state) :
//         // $state_name = $state['name'];
//         $limit = 10;
//         $offset = 0;
//         $MAX_LIMIT = 1;
//         for ($i=0; $i<$MAX_LIMIT; $i++):
//             $url = "https://wft-geo-db.p.rapidapi.com/v1/geo/countries/".$country['wikiDataId']."/regions/".$state['wikiDataId']."/cities?offset=".$offset."&limit=10";
//             echo $url.PHP_EOL;
//             $response = Unirest\Request::get($url,
//                 array(
//                     "X-RapidAPI-Host" => "wft-geo-db.p.rapidapi.com",
//                     "X-RapidAPI-Key" => ""
//                 )
//             );
//             print_r($response);
//             print_r($response->body->data);
//             if (!empty($response->body->data)) {
//                 $file_name = $country['code'].'/'.slugify($state['name']).'.json';
//                 echo $file_name.PHP_EOL;
//                 if (!file_exists('data/cities/'.$country['code'])) {
//                     mkdir('data/cities/'.$country['code'], 0777, true);
//                 }
//                 $fp = fopen('data/cities/'.$file_name, 'a');
//                 fwrite($fp, $response->raw_body.PHP_EOL);
//                 fclose($fp);
//                 if ($i%5 == 0): sleep($NUMBER_OF_SECONDS); endif;
//                 $offset = $limit + 1;
//                 $limit = $limit + 10;

//                 // Set Dynamic
//                 $TOTAL_COUNT = $response->body->metadata->totalCount;
//                 echo $TOTAL_COUNT;
//                 if ($TOTAL_COUNT > 10): $MAX_LIMIT = ceil($TOTAL_COUNT/10); endif;
//                 echo 'OK SET '.$MAX_LIMIT.PHP_EOL;
//             }
//         endfor;
//     endforeach;
// endforeach;


function slugify($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');

  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}


// TEST API
$response = Unirest\Request::get("http://geodb-free-service.wirefreethought.com/v1/geo/countries/Q668/regions/Q1191/cities?offset=0&limit=10",
  array(
    "X-RapidAPI-Host" => "geodb-free-service.wirefreethought.com",
    "X-RapidAPI-Key" => ""
  )
);

print_r($response);
// print_r($response->body->metadata->totalCount);