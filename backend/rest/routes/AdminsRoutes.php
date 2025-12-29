<?php
require_once __DIR__ . '/../services/AdminsService.php';
require_once __DIR__ . '/../../data/roles.php';

$adminsService = new AdminsService();

/**
 * @OA\Get(
 *     path="/admins",
 *     tags={"admins"},
 *     summary="Get all admins",
 *     @OA\Response(
 *         response=200,
 *         description="List of all admins"
 *     )
 * )
 */
Flight::route('GET /admins', function() use ($adminsService) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json($adminsService->getAll());
});

/**
 * @OA\Get(
 *     path="/admins/{id}",
 *     tags={"admins"},
 *     summary="Get admin by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Admin data"
 *     )
 * )
 */
Flight::route('GET /admins/@id', function($id) use ($adminsService) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json($adminsService->getById($id));
});

/**
 * @OA\Post(
 *     path="/admins/login",
 *     tags={"admins"},
 *     summary="Login admin",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"username","password"},
 *             @OA\Property(property="username", type="string"),
 *             @OA\Property(property="password", type="string")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Logged in admin")
 * )
 */
Flight::route('POST /admins/login', function() use ($adminsService) {
    $data = Flight::request()->data->getData();
    try {
        $result = $adminsService->login($data['username'], $data['password']);
        Flight::json($result);
    } catch(Exception $e) {
        Flight::json(['error' => $e->getMessage()], 400);
    }
});

/**
 * @OA\Post(
 *     path="/admins/register",
 *     tags={"admins"},
 *     summary="Register new admin",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"username","password","full_name","email"},
 *             @OA\Property(property="username", type="string"),
 *             @OA\Property(property="password", type="string"),
 *             @OA\Property(property="full_name", type="string"),
 *             @OA\Property(property="email", type="string")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Admin registered")
 * )
 */
Flight::route('POST /admins/register', function() use ($adminsService) {
    $data = Flight::request()->data->getData();
    try {
        $result = $adminsService->register(
            $data['username'],
            $data['password'],
            $data['full_name'],
            $data['email']
        );
        Flight::json($result);
    } catch(Exception $e) {
        Flight::json(['error' => $e->getMessage()], 400);
    }
});

/**
 * @OA\Put(
 *     path="/admins/{id}",
 *     tags={"admins"},
 *     summary="Update admin by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"full_name","email"},
 *             @OA\Property(property="full_name", type="string"),
 *             @OA\Property(property="email", type="string")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Admin updated")
 * )
 */
Flight::route('PUT /admins/@id', function($id) use ($adminsService) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json($adminsService->updateAdmin($id, $data['full_name'], $data['email']));
});
?>
