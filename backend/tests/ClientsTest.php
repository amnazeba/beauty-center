<?php
use PHPUnit\Framework\TestCase;

class ClientsTest extends TestCase {

    public function setUp(): void
    {
        require_once __DIR__ . '/../vendor/autoload.php';
        require_once __DIR__ . '/../index.php';
        Flight::halt(false);  // sprječava automatski exit
    }

    public function testGetAllClients()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/clients';
        ob_start();
        Flight::start(); 
        $output = ob_get_clean();

        $this->assertEquals(200, http_response_code()); 
        $this->assertJson($output); 
    }

    public function testGetClientById() {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/clients/1';
        ob_start();
        Flight::start();
        $output = ob_get_clean();

        $this->assertEquals(200, http_response_code());
        $this->assertJson($output); 
        $this->assertStringContainsString('"id":1', $output);
    }
}
