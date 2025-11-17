<?php
/**
 * @OA\Get(
 *     path="/reviews",
 *     tags={"reviews"},
 *     summary="Get all reviews",
 *     @OA\Response(response=200, description="List of all reviews")
 * )
 */
Flight::route('GET /reviews', function(){
    Flight::json(Flight::reviewsService()->getAll());
});

/**
 * @OA\Get(
 *     path="/reviews/{id}",
 *     tags={"reviews"},
 *     summary="Get review by ID",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Review data")
 * )
 */
Flight::route('GET /reviews/@id', function($id){
    Flight::json(Flight::reviewsService()->getById($id));
});

/**
 * @OA\Get(
 *     path="/reviews/client/{id}",
 *     tags={"reviews"},
 *     summary="Get reviews by client ID",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="List of reviews for a client")
 * )
 */
Flight::route('GET /reviews/client/@id', function($id){
    Flight::json(Flight::reviewsService()->getByClientId($id));
});

/**
 * @OA\Post(
 *     path="/reviews",
 *     tags={"reviews"},
 *     summary="Add new review",
 *     @OA\RequestBody(required=true, @OA\JsonContent()),
 *     @OA\Response(response=200, description="Review added")
 * )
 */
Flight::route('POST /reviews', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::reviewsService()->insert($data));
});

/**
 * @OA\Put(
 *     path="/reviews/{id}",
 *     tags={"reviews"},
 *     summary="Update review by ID",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\RequestBody(required=true, @OA\JsonContent()),
 *     @OA\Response(response=200, description="Review updated")
 * )
 */
Flight::route('PUT /reviews/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::reviewsService()->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/reviews/{id}",
 *     tags={"reviews"},
 *     summary="Delete review by ID",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Review deleted")
 * )
 */
Flight::route('DELETE /reviews/@id', function($id){
    Flight::json(Flight::reviewsService()->delete($id));
});
?>
