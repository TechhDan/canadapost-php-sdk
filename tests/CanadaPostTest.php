<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use TechDesign\CanadaPost\CanadaPost;
use SimpleXMLElement;

class CanadaPostTest extends TestCase
{
	protected $api;

	protected function setUp(): void
	{
		$this->api = new CanadaPost(
            $_ENV['API_USER'],
            $_ENV['API_PASSWORD'],
            $_ENV['CUSTOMER_NUMBER'],
            $_ENV['ORIGIN_POSTAL_CODE']
        );
	}

	public function testCanadaPostCreation()
    {
        $this->assertInstanceOf(CanadaPost::class, $this->api);
    }

    public function testGetRates()
    {
        $rates = $this->api->getRates();
        $this->assertInstanceOf(SimpleXMLElement::class, $rates);
    }

    public function testGetServices()
    {
        $services = $this->api->getServices();
        $this->assertInstanceOf(SimpleXMLElement::class, $services);
    }
}
