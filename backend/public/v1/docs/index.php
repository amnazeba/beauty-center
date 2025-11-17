<?php

/**
 * @OA\Info(
 *   title="API",
 *   description="Beauty-center API",
 *   version="1.0",
 *   @OA\Contact(
 *     email="beautycenter@gmail.com",
 *     name="Beauty-center"
 *   )
 * ),
 * @OA\Server(
 *     url=LOCALSERVER,
 *     description="API server"
 * ),
 * @OA\Server(
 *     url=PRODSERVER,
 *     description="API server"
 * ),
 * @OA\SecurityScheme(
 *     securityScheme="ApiKey",
 *     type="apiKey",
 *     in="header",
 *     name="Authentication"
 * )
 */