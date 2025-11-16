<?php
Flight::route('POST /services', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::servicesService()->createService(
        $data['name'], $data['description'], $data['duration'], $data['price']
    ));
});
?>
