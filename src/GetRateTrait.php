<?php

namespace TechDesign\CanadaPost;

trait GetRateTrait
{
    function getRatesXmlRequest($mailed_by, $weight, $origin_postal_code, $postal_code)
    {
        return $xmlRequest = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<mailing-scenario xmlns="http://www.canadapost.ca/ws/ship/rate-v4">
  <customer-number>{$mailed_by}</customer-number>
  <parcel-characteristics>
    <weight>{$weight}</weight>
  </parcel-characteristics>
  <origin-postal-code>{$origin_postal_code}</origin-postal-code>
  <destination>
    <domestic>
      <postal-code>{$postal_code}</postal-code>
    </domestic>
  </destination>
</mailing-scenario>
XML;
    }
}
