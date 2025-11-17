<?php
require_once 'ClientsService.php';

$users_service = new ClientsService();
 $data = [
     'first_name' => 'Amna',
     'last_name' => 'Zeba',
     'email' => 'zamna0662@gmail.com',
     'phone' => '123123123',
     'password' => 'Amnaa2401'
 ];
 $result = $users_service->createClient($data);
 print_r($result);

 ?>