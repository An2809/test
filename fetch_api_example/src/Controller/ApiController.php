<?php

namespace Drupal\fetch_api_example\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\fetch_api_example\Service\ApiService;

class ApiController extends ControllerBase {

  protected $apiService;

  public function __construct(ApiService $api_service) {
    $this->apiService = $api_service;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('fetch_api_example.api_service')
    );
  }

  public function listData() {
    $url = 'https://jsonplaceholder.typicode.com/posts'; // Example API URL
    $data = $this->apiService->fetchApiData($url);

    $items = [];
    foreach ($data as $item) {
      $items[] = [
        '#markup' => $item['title'],
      ];
    }

    return [
      '#theme' => 'item_list',
      '#items' => $items,
      '#title' => $this->t('API Data List'),
    ];
  }
}

