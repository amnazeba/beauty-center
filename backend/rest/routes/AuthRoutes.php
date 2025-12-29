<?php
use Roles;

/**
 * @OA\Get(
 *     path="/appointments/client/{id}",
 *     tags={"appointments"},
 *     summary="Get all appointments for a client",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response=200, description="List of appointments for the client")
 * )
 */
Flight::route('GET /appointments/client/@id', function($id){
    // CLIENT i ADMIN mogu vidjeti svoje termine
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::CLIENT]);
    Flight::json(Flight::appointmentsService()->getByClientId($id));
});

/**
 * @OA\Get(
 *     path="/appointments/employee/{id}",
 *     tags={"appointments"},
 *     summary="Get all appointments for an employee",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response=200, description="List of appointments for the employee")
 * )
 */
Flight::route('GET /appointments/employee/@id', function($id){
    // EMPLOYEE i ADMIN mogu vidjeti termine
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::EMPLOYEE]);
    Flight::json(Flight::appointmentsService()->getByEmployeeId($id));
});

/**
 * @OA\Post(
 *     path="/appointments",
 *     tags={"appointments"},
 *     summary="Create a new appointment",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"client_id","employee_id","service_id","admin_id","appointment_date","status"},
 *             @OA\Property(property="client_id", type="integer"),
 *             @OA\Property(property="employee_id", type="integer"),
 *             @OA\Property(property="service_id", type="integer"),
 *             @OA\Property(property="admin_id", type="integer"),
 *             @OA\Property(property="appointment_date", type="string"),
 *             @OA\Property(property="status", type="string")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Appointment created")
 * )
 */
Flight::route('POST /appointments', function(){
    // SAMO ADMIN može kreirati termin
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN]);
    $data = Flight::request()->data->getData();

    Flight::json(Flight::appointmentsService()->createAppointment(
        $data['client_id'],
        $data['employee_id'],
        $data['service_id'],
        $data['admin_id'],
        $data['appointment_date'],
        $data['status']
    ));
});

/**
 * @OA\Put(
 *     path="/appointments/{id}",
 *     tags={"appointments"},
 *     summary="Update appointment by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="client_id", type="integer"),
 *             @OA\Property(property="employee_id", type="integer"),
 *             @OA\Property(property="service_id", type="integer"),
 *             @OA\Property(property="admin_id", type="integer"),
 *             @OA\Property(property="appointment_date", type="string"),
 *             @OA\Property(property="status", type="string")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Appointment updated")
 * )
 */
Flight::route('PUT /appointments/@id', function($id){
    // SAMO ADMIN može ažurirati termin
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN]);
    $data = Flight::request()->data->getData();

    Flight::json(Flight::appointmentsService()->updateAppointment(
        $id,
        $data['client_id'],
        $data['employee_id'],
        $data['service_id'],
        $data['admin_id'],
        $data['appointment_date'],
        $data['status']
    ));
});

/**
 * @OA\Delete(
 *     path="/appointments/{id}",
 *     tags={"appointments"},
 *     summary="Delete appointment by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response=200, description="Appointment deleted")
 * )
 */
Flight::route('DELETE /appointments/@id', function($id){
    // SAMO ADMIN može obrisati termin
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN]);
    Flight::json(Flight::appointmentsService()->deleteAppointment($id));
});
?>
