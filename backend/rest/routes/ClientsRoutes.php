<?php
/**
 * @OA\Get(
 *     path="/clients",
 *     tags={"clients"},
 *     summary="Get all clients",
 *     @OA\Response(response=200, description="List of all clients")
 * )
 */
Flight::route('GET /clients', function(){
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::clientsService()->getAllClients());
});

/**
 * @OA\Get(
 *     path="/clients/{id}",
 *     tags={"clients"},
 *     summary="Get client by ID",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Client data")
 * )
 */
Flight::route('GET /clients/@id', function($id){
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::clientsService()->getClientById($id));
});

/**
 * @OA\Post(
 *     path="/clients",
 *     tags={"clients"},
 *     summary="Create new client",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"first_name","last_name","email","phone"},
 *             @OA\Property(property="first_name", type="string"),
 *             @OA\Property(property="last_name", type="string"),
 *             @OA\Property(property="email", type="string"),
 *             @OA\Property(property="phone", type="string")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Client created")
 * )
 */
Flight::route('POST /clients', function(){
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::clientsService()->createClient($data));
});

/**
 * @OA\Put(
 *     path="/clients/{id}",
 *     tags={"clients"},
 *     summary="Update client by ID",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\RequestBody(required=true, @OA\JsonContent()),
 *     @OA\Response(response=200, description="Client updated")
 * )
 */
Flight::route('PUT /clients/@id', function($id){
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::clientsService()->updateClient(
        $id, $data['first_name'], $data['last_name'], $data['email'], $data['phone']
    ));
});

/**
 * @OA\Delete(
 *     path="/clients/{id}",
 *     tags={"clients"},
 *     summary="Delete client by ID",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Client deleted")
 * )
 */
Flight::route('DELETE /clients/@id', function($id){
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json(Flight::clientsService()->deleteClient($id));
});
?>
