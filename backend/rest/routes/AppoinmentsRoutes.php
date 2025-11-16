<?php
Flight::route('GET /appointments/client/@id', function($id){
    Flight::json(Flight::appointmentsService()->getByClientId($id));
});

Flight::route('GET /appointments/employee/@id', function($id){
    Flight::json(Flight::appointmentsService()->getByEmployeeId($id));
});

Flight::route('POST /appointments', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::appointmentsService()->createAppointment(
        $data['client_id'], $data['employee_id'], $data['service_id'], $data['admin_id'], $data['appointment_date'], $data['status']
    ));
});

Flight::route('PUT /appointments/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::appointmentsService()->updateAppointment(
        $id, $data['client_id'], $data['employee_id'], $data['service_id'], $data['admin_id'], $data['appointment_date'], $data['status']
    ));
});

Flight::route('DELETE /appointments/@id', function($id){
    Flight::json(Flight::appointmentsService()->deleteAppointment($id));
});
?>
