<?php

class ShippingEasy_SignatureTest extends UnitTestCase
{
  public function testPlaintext()
  {
    $secret = "f5cd6a754f3ed64ea8697be6f662910fe7d7e9b0bee47a23214964a6a12db69f";
    $method = "post";
    $path = "/api/orders";
    $params = array("foo" => "bar", "xyz" => "123", "api_timestamp" => "1390928206");
    $json_body = array("orders" => array("id" => "1234"));
    $signature = new ShippingEasy_Signature($secret, $method, $path, $params, $json_body);
    $this->assertEqual($signature->plaintext(), 'POST&/api/orders&api_timestamp=1390928206&foo=bar&xyz=123&{"orders":{"id":"1234"}}');
  }
  
  public function testEncrypted()
  {
    $secret = "f5cd6a754f3ed64ea8697be6f662910fe7d7e9b0bee47a23214964a6a12db69f";
    $method = "post";
    $path = "/api/orders";
    $params = array("foo" => "bar", "xyz" => "123", "api_timestamp" => "1390928206");
    $json_body = array("orders" => array("id" => "1234"));
    $signature = new ShippingEasy_Signature($secret, $method, $path, $params, $json_body);    
    $this->assertEqual($signature->encrypted(), "f01d4c9bb1dec1a5f46d2a3ba9dfbdc6f3c145604440fb145677eb7ef3af9731");
  }
}
