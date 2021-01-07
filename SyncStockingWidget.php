<?php

require "vendor/autoload.php";

class SyncStockingWidget
{
  private $url = "https://b2bwork.hellyhansen.com/api/catalogs/5e2443bcd35aa327ff000001.csv?csv[customer]=9060309&csv[data]=availability&csv[date]=2021-01-05/api/catalogs/5e2443bcd35aa327ff000001.csv?csv[customer]=9060309&csv[data]=availability&csv[date]=2021-01-05";
  private $token = "remember_user_token=BAhbB1sGSSIdNWZmMzcwNjEzZDgzYmYwMDAxMDExNTFiBjoGRVRJIhlDZHp5emh0dWZ3ekRod3BvRXpBbQY7AFQ%3D--8ae2a1ae74e773cc3e98d261aec5df1dee1180e5";
  private $file_location = __DIR__ . "/data.xlsx";

  public $spreadsheet = null;

  public function getCSV()
  {
    /**
     * Gets spreadsheet from remote server and saves to local directory
     */
    if ($this->dataIsOld()) {
      $xlsx = $this->getRemoteFile();
      $this->saveToFile($xlsx);
    } else {
      $this->setCSV($this->file_location);
    }

    return $this->spreadsheet;
  }

  private function setCSV($location)
  {
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(
      $this->file_location
    );

    $this->spreadsheet = $spreadsheet->getActiveSheet();
  }

  private function dataIsOld()
  {
    return time() - filemtime($this->file_location) > 60 * 60 * 24;
  }

  private function getRemoteFile()
  {
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $this->url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_COOKIE, $this->token);

    $result = curl_exec($curl);
    curl_close($curl);

    return $result;
  }

  public function saveToFile($file)
  {
    $fp = fopen($this->file_location, "w");
    fwrite($fp, $file);
    fclose($fp);

    $this->setCSV($this->file_location);
  }
}
