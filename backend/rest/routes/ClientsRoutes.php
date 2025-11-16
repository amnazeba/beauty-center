<?php
Flight::route('GET /clients', function(){
    Flight::json(Flight::clientsService()->getAllClients());
});

Flight::route('GET /clients/@id', function($id){
    Flight::json(Flight::clientsService()->getClientById($id));
});

Flight::route('POST /clients', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::clientsService()->createClient($data));
});

Flight::route('PUT /clients/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::clientsService()->updateClient(
        $id, $data['first_name'], $data['last_name'], $data['email'], $data['phone']
    ));
});

Flight::route('DELETE /clients/@id', function($id){
    Flight::json(Flight::clientsService()->deleteClient($id));
});
?>
