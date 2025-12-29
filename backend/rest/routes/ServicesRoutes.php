<?php
/**
 * @OA\Get(path="/services", tags={"services"}, summary="Get all services", @OA\Response(response=200, description="List of all services"))
 */
Flight::route('GET /services', function(){
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::servicesService()->getAll());
});

/**
 * @OA\Get(path="/services/{id}", tags={"services"}, summary="Get service by ID", @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")), @OA\Response(response=200, description="Service data"))
 */
Flight::route('GET /services/@id', function($id){
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::servicesService()->getById($id));
});

/**
 * @OA\Post(path="/services", tags={"services"}, summary="Create new service", @OA\RequestBody(required=true, @OA\JsonContent()), @OA\Response(response=200, description="Service created"))
 */
Flight::route('POST /services', function(){
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::servicesService()->createService(
        $data['name'], $data['description'], $data['duration'], $data['price']
    ));
});

/**
 * @OA\Put(path="/services/{id}", tags={"services"}, summary="Update service by ID", @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")), @OA\RequestBody(required=true, @OA\JsonContent()), @OA\Response(response=200, description="Service updated"))
 */
Flight::route('PUT /services/@id', function($id){
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::servicesService()->update($id, $data));
});

/**
 * @OA\Delete(path="/services/{id}", tags={"services"}, summary="Delete service by ID", @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")), @OA\Response(response=200, description="Service deleted"))
 */
Flight::route('DELETE /services/@id', function($id){
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json(Flight::servicesService()->delete($id));
});
?>
