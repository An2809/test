<?php

namespace Drupal\fetch_api_example\Service;

use GuzzleHttp\ClientInterface;
use Drupal\Component\Serialization\Json;

class ApiService {

  protected $httpClient;

  public function __construct(ClientInterface $http_client) {
    $this->httpClient = $http_client;
  }

  public function fetchApiData($url) {
    try {
      $response = $this->httpClient->request('GET', $url);
      $data = $response->getBody()->getContents();
      return Json::decode($data);
    }
    catch (\Exception $e) {
      \Drupal::logger('fetch_api_example')->error($e->getMessage());
      return [];
    }
  }
}

