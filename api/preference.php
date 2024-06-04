<?php 

    $config = require_once 'configmp.php';
    require_once 'vendor/autoload.php';

    use MercadoPago\Client\Preference\PreferenceClient;
    use MercadoPago\Exceptions\MPApiException;
    use MercadoPago\MercadoPagoConfig;

    // Step 2: Set production or sandbox access token
    MercadoPagoConfig::setAccessToken($config['accesstoken']);

    $client = new PreferenceClient();

    $preference = $client->create([
        "external_reference" => "teste",
        "notification_url" => "https://google.com",
        "items"=> array(
          array(
            "id" => "4567",
            "title" => "Dummy Title",
            "description" => "Dummy description",
            "picture_url" => "http://www.myapp.com/myimage.jpg",
            "category_id" => "eletronico",
            "quantity" => 1,
            "currency_id" => "BRL",
            "unit_price" => 100
          )
        ),
        "default_payment_method_id" => "master",
        "excluded_payment_types" => array(
          array(
            "id" => "ticket"
          )
        ),
        "installments"  => 12,
        "default_installments" => 1
      ]);

       echo '<pre>';
      var_dump($preference);