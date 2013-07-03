<?php

// added to git...

    $url = 'http://api.wunderground.com/api/82fdf29d7abafe2f/conditions/q/27011.json';

    $rrd_file = "/home/bs/temp.rrd";

      $json = file_get_contents($url);
      $arr = json_decode($json);
      if($arr->current_observation->windchill_f == "NA")
        $windchill_f = 0;
      else
        $windchill_f = $arr->current_observation->windchill_f;
      if($arr->current_observation->windchill_c == "NA")
        $windchill_c = 0;
      else
        $windchill_c = $arr->current_observation->windchill_c;

      $w = "N:";
      $w .= $arr->current_observation->temp_f . ":";
      $w .= $arr->current_observation->temp_c . ":";
      $w .= trim($arr->current_observation->relative_humidity, '%') . ":";
      $w .= $arr->current_observation->wind_mph . ":";
      $w .= $arr->current_observation->wind_gust_mph . ":";
      $w .= $arr->current_observation->wind_degrees . ":";
      $w .= $arr->current_observation->pressure_mb . ":";
      $w .= $arr->current_observation->pressure_in . ":";
      $w .= $arr->current_observation->dewpoint_f . ":";
      $w .= $arr->current_observation->dewpoint_c . ":";
      $w .= $windchill_f . ":"; //$arr->current_observation->windchill_f . ":";
      $w .= $windchill_c . ":"; //$arr->current_observation->windchill_c . ":";
      $w .= $arr->current_observation->feelslike_f . ":";
      $w .= $arr->current_observation->feelslike_c . ":";
      $w .= $arr->current_observation->visibility_mi . ":";
      $w .= $arr->current_observation->visibility_km . ":";
      $w .= $arr->current_observation->precip_today_in;
  $rrd_return = rrd_update($rrd_file, array($w));
  echo "$rrd_return ($w)";
?>
