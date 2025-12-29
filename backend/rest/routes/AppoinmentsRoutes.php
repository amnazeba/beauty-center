<?php
/**
 * @OA\Get(
 *     path="/appointments/client/{id}",
 *     tags={"appointments"},
 *     summary="Get all appointments for a client",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="List of appointments for the client")
 * )
 */
Flight::route('GET /appointments/client/@id', function($id){
    Flight::auth_middleware()->authorizeRoles([Roles::CLIENT, Roles::ADMIN]);
    Flight::json(Flight::appointmentsService()->getByClientId($id));
});

/**
 * @OA\Get(
 *     path="/appointments/employee/{id}",
 *     tags={"appointments"},
 *     summary="Get all appointments for an employee",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="List of appointments for the employee")
 * )
 */
Flight::route('GET /appointments/employee/@id', function($id){
    Flight::auth_middleware()->authorizeRoles([Roles::EMPLOYEE, Roles::ADMIN]);
    Flight::json(Flight::appointmentsService()->getByEmployeeId($id));
});

/**
 * @OA\Post(
 *     path="/appointments",
 *     tags={"appointments"},
 *     summary="Create a new appointment",
 *     @OA\RequestBody(required=true, @OA\JsonContent()),
 *     @OA\Response(response=200, description="Appointment created")
 * )
 */
Flight::route('POST /appointments', function(){
    Flight::auth_middleware()->authorizeRoles([Roles::CLIENT, Roles::ADMIN]);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::appointmentsService()->createAppointment(
        $data['client_id'], $data['employee_id'], $data['service_id'],
        $data['admin_id'], $data['appointment_date'], $data['status']
    ));
});

/**
 * @OA\Put(
 *     path="/appointments/{id}",
 *     tags={"appointments"},
 *     summary="Update appointment by ID",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\RequestBody(required=true, @OA\JsonContent()),
 *     @OA\Response(response=200, description="Appointment updated")
 * )
 */
Flight::route('PUT /appointments/@id', function($id){
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::appointmentsService()->updateAppointment(
        $id, $data['client_id'], $data['employee_id'], $data['service_id'],
        $data['admin_id'], $data['appointment_date'], $data['status']
    ));
});

/**
 * @OA\Delete(
 *     path="/appointments/{id}",
 *     tags={"appointments"},
 *     summary="Delete appointment by ID",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Appointment deleted")
 * )
 */
Flight::route('DELETE /appointments/@id', function($id){
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json(Flight::appointmentsService()->deleteAppointment($id));
});
?>
