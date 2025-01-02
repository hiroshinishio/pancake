<?php

declare(strict_types=1);

namespace GuiBranco\Pancake\Tests\Integration;

use GuiBranco\Pancake\Request;
use PHPUnit\Framework\TestCase;

final class RequestTest extends TestCase
{
    public function testCanGet(): void
    {
        $request = new Request();
        $response = $request->get('https://httpbin.org/get');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->isSuccess());
        $this->assertNotEmpty($response->getMessage());
    }

    public function testCanPost(): void
    {
        $request = new Request();
        $response = $request->post('https://httpbin.org/post');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->isSuccess());
        $this->assertNotEmpty($response->getMessage());
    }

    public function testCanPostWithPayload(): void
    {
        $request = new Request();
        $response = $request->post('https://httpbin.org/post', array(), ['name' => 'GuiBranco']);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->isSuccess());
        $this->assertNotEmpty($response->getMessage());
    }

    public function testCanPut(): void
    {
        $request = new Request();
        $response = $request->put('https://httpbin.org/put');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->isSuccess());
        $this->assertNotEmpty($response->getMessage());
    }

    public function testCanPutWithPayload(): void
    {
        $request = new Request();
        $response = $request->put('https://httpbin.org/put', array(), ['name' => 'GuiBranco']);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->isSuccess());
        $this->assertNotEmpty($response->getMessage());
    }

    public function testCanPatch(): void
    {
        $request = new Request();
        $response = $request->patch('https://httpbin.org/patch');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->isSuccess());
        $this->assertNotEmpty($response->getMessage());
    }

    public function testCanPatchWithPayload(): void
    {
        $request = new Request();
        $response = $request->patch('https://httpbin.org/patch', array(), ['name' => 'GuiBranco']);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->isSuccess());
        $this->assertNotEmpty($response->getMessage());
    }

    public function testCanDelete(): void
    {
        $request = new Request();
        $response = $request->delete('https://httpbin.org/delete');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->isSuccess());
        $this->assertNotEmpty($response->getMessage());
    }

    public function testCanDeleteWithPayload(): void
    {
        $request = new Request();
        $response = $request->delete('https://httpbin.org/delete', array(), ['name' => 'GuiBranco']);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->isSuccess());
        $this->assertNotEmpty($response->getMessage());
    }

    public function testCanOptions(): void
    {
        $request = new Request();
        $response = $request->options('https://httpbin.org/get');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->isSuccess());
        $this->assertNotEmpty($response->getMessage());
    }

    public function testCanHead(): void
    {
        $request = new Request();
        $response = $request->head('https://httpbin.org/get', ['Host: httpbin.org']);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->isSuccess());
        $this->assertNotEmpty($response->getMessage());
    }

    public function testCanGetWithHeaders(): void
    {
        $request = new Request();
        $response = $request->get('https://httpbin.org/headers', ['X-Test: test']);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->isSuccess());
        $this->assertNotEmpty($response->getMessage());
    }

    public function testCanPostWithHeaders(): void
    {
        $request = new Request();
        $response = $request->post('https://httpbin.org/post', ['X-Test: test'], json_encode(['name' => 'GuiBranco']));
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->isSuccess());
        $this->assertNotEmpty($response->getMessage());
    }

    public function testCanPutWithHeaders(): void
    {
        $request = new Request();
        $response = $request->put('https://httpbin.org/put', ['X-Test: test'], json_encode(['name' => 'GuiBranco']));
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->isSuccess());
        $this->assertNotEmpty($response->getMessage());
    }

    public function testCanPatchWithHeaders(): void
    {
        $request = new Request();
        $response = $request->patch('https://httpbin.org/patch', ['X-Test: test'], json_encode(['name' => 'GuiBranco']));
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->isSuccess());
        $this->assertNotEmpty($response->getMessage());
    }

    public function testCanDeleteWithHeaders(): void
    {
        $request = new Request();
        $response = $request->delete('https://httpbin.org/delete', ['X-Test: test'], json_encode(['name' => 'GuiBranco']));
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->isSuccess());
        $this->assertNotEmpty($response->getMessage());
    }

    public function testCannotGet(): void
    {
        $request = new Request();
        $response = $request->get('https://non-existing-url');
        $this->assertEquals(-1, $response->getStatusCode());
        $this->assertFalse($response->isSuccess());
        $this->assertNotEmpty($response->getMessage());
    }

    public function testCanAddRequest(): void
    {
        $request = new Request();
        $request->addRequest('test', 'https://httpbin.org/get');
        $responses = $request->executeBatch();
        $this->assertArrayHasKey('test', $responses);
        $this->assertEquals(200, $responses['test']->getStatusCode());
        $this->assertTrue($responses['test']->isSuccess());
        $this->assertNotEmpty($responses['test']->getMessage());
    }

    public function testCanAddMultipleRequests(): void
    {
        $request = new Request();
        $request->addRequest('test1', 'https://httpbin.org/get');
        $request->addRequest('test2', 'https://httpbin.org/post', [], 'POST', ['name' => 'GuiBranco']);
        $responses = $request->executeBatch();
        $this->assertArrayHasKey('test1', $responses);
        $this->assertArrayHasKey('test2', $responses);
        $this->assertEquals(200, $responses['test1']->getStatusCode());
        $this->assertEquals(200, $responses['test2']->getStatusCode());
        $this->assertTrue($responses['test1']->isSuccess());
        $this->assertNotEmpty($responses['test1']->getMessage());
    }
        $this->assertTrue($responses['test2']->isSuccess());
        $this->assertNotEmpty($responses['test2']->getMessage());

    public function testCanAddRequestWithHeaders(): void
    {
        $request = new Request();
        $request->addRequest('test', 'https://httpbin.org/get', ['X-Test: test']);
        $responses = $request->executeBatch();
        $this->assertArrayHasKey('test', $responses);
        $this->assertEquals(200, $responses['test']->getStatusCode());
        $this->assertTrue($responses['test']->isSuccess());
        $this->assertNotEmpty($responses['test']->getMessage());
    }

    public function testCanAddRequestWithPayload(): void
    {
        $request = new Request();
        $request->addRequest('test', 'https://httpbin.org/post', [], 'POST', ['name' => 'GuiBranco']);
        $responses = $request->executeBatch();
        $this->assertArrayHasKey('test', $responses);
        $this->assertTrue($responses['test']->isSuccess());
        $this->assertNotEmpty($responses['test']->getMessage());
        $this->assertEquals(200, $responses['test']->getStatusCode());
    }

    public function testCanSetSSLVerification(): void
    {
        $request = new Request();
        $request->setSSLVerification(false);
        $response = $request->get('https://httpbin.org/get');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->isSuccess());
        $this->assertNotEmpty($response->getMessage());
    }
}
