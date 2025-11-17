<?php
Flight::route('GET /employees', function(){
    Flight::json(Flight::employeesService()->getAll());
});

Flight::route('GET /employees/@id', function($id){
    Flight::json(Flight::employeesService()->getById($id));
});

Flight::route('GET /employees/email/@email', function($email){
    Flight::json(Flight::employeesService()->getByEmail($email));
});

Flight::route('GET /employees/position/@position', function($position){
    Flight::json(Flight::employeesService()->getByPosition($position));
});
?>
