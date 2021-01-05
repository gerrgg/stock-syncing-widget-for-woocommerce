<?php

class SyncStockingWidget
{
  private $url = "https://b2bwork.hellyhansen.com/api/catalogs/5e2443bcd35aa327ff000001.csv?csv[customer]=9060309&csv[data]=availability&csv[date]=2021-01-05";
  private $token = "remember_user_token=BAhbB1sGSSIdNWZmMzcwNjEzZDgzYmYwMDAxMDExNTFiBjoGRVRJIhlDZHp5emh0dWZ3ekRod3BvRXpBbQY7AFQ%3D--8ae2a1ae74e773cc3e98d261aec5df1dee1180e5";

  public $result = null;

  public function getCSV()
  {
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $this->url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_COOKIE, $this->token);

    $result = curl_exec($curl);

    $this->result = $result;

    return $result;
  }
}
