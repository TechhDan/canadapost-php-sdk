<?php

namespace TechDesign\CanadaPost;

use SimpleXMLElement;

class CanadaPost
{
	use GetRateTrait;

	protected $user;
	protected $password;
	protected $customer_number;

	public function __construct(string $user, string $password, string $customer_number = null, string $origin_postal_code = null)
	{
		$this->user = $user;
		$this->password = $password;
		$this->customer_number = $customer_number;
		$this->origin_postal_code = $origin_postal_code;
	}

	public function getRates(): SimpleXMLElement
	{
		$service_url = 'https://ct.soa-gw.canadapost.ca/rs/ship/price';
		$postal_code = 'K1K4T3';
		$weight = 1;
		$xmlRequest = $this->getXmlRequest($this->customer_number, $weight, $this->origin_postal_code, $postal_code);

		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curl, CURLOPT_CAINFO, realpath(__DIR__ . '/../resources/cert/cacert.pem'));
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $xmlRequest);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($curl, CURLOPT_USERPWD, $this->user . ':' . $this->password);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/vnd.cpc.ship.rate-v4+xml', 'Accept: application/vnd.cpc.ship.rate-v4+xml'));
		$curl_response = curl_exec($curl);
		$xml = simplexml_load_string($curl_response) or die("Error: Cannot create XML object");

		return $xml;
	}
}
