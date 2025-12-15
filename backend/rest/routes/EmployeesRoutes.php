<?php
/**
 * @OA\Get(
 *     path="/employees",
 *     tags={"employees"},
 *     summary="Get all employees",
 *     @OA\Response(response=200, description="List of all employees")
 * )
 */
Flight::route('GET /employees', function(){
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::employeesService()->getAll());
});

/**
 * @OA\Get(
 *     path="/employees/{id}",
 *     tags={"employees"},
 *     summary="Get employee by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response=200, description="Employee data")
 * )
 */
Flight::route('GET /employees/@id', function($id){
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::employeesService()->getById($id));
});

/**
 * @OA\Get(
 *     path="/employees/email/{email}",
 *     tags={"employees"},
 *     summary="Get employee by email",
 *     @OA\Parameter(
 *         name="email",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(response=200, description="Employee found by email")
 * )
 */
Flight::route('GET /employees/email/@email', function($email){
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::employeesService()->getByEmail($email));
});

/**
 * @OA\Get(
 *     path="/employees/position/{position}",
 *     tags={"employees"},
 *     summary="Get employees by position",
 *     @OA\Parameter(
 *         name="position",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(response=200, description="List of employees with selected position")
 * )
 */
Flight::route('GET /employees/position/@position', function($position){
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::employeesService()->getByPosition($position));
});

/**
 * @OA\Post(
 *     path="/employees",
 *     tags={"employees"},
 *     summary="Add a new employee",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "email", "position"},
 *             @OA\Property(property="name", type="string", example="John Doe"),
 *             @OA\Property(property="email", type="string", example="john@example.com"),
 *             @OA\Property(property="position", type="string", example="Manager")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Employee added")
 * )
 */
Flight::route('POST /employees', function(){
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::employeesService()->add($data));
});

/**
 * @OA\Put(
 *     path="/employees/{id}",
 *     tags={"employees"},
 *     summary="Update employee by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Updated Name"),
 *             @OA\Property(property="email", type="string", example="updated@example.com"),
 *             @OA\Property(property="position", type="string", example="Supervisor")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Employee updated")
 * )
 */
Flight::route('PUT /employees/@id', function($id){
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::employeesService()->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/employees/{id}",
 *     tags={"employees"},
 *     summary="Delete employee by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response=200, description="Employee deleted")
 * )
 */
Flight::route('DELETE /employees/@id', function($id){
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json(Flight::employeesService()->delete($id));
});
?>
