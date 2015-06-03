<?php
    /**
     * Created by PhpStorm.
     * User: Optimistic
     * Date: 01/05/2015
     * Time: 07:26
     */

    namespace Maverickslab\Shipeasy;


    use GuzzleHttp\Client;
    use Illuminate\Support\Facades\Config;
    use ShippingEasy as ShippingEasyLib;

    class APIRequester
    {
        /**
         * guzzle instance
         *
         * @var Client
         */
        private $http_client;

        /**
         * injecting guzzle http in requester
         *
         * @param Client $http_client
         */
        public function __construct(Client $http_client)
        {
            $this->http_client = $http_client;
            ShippingEasyLib::setApiBase(Config::get("shippingeasy.base_url"));
        }

        /**
         * this function makes the actual request to the shipping easy api
         *
         * @param      $method
         * @param      $resource
         * @param null $data
         *
         * @return string
         */
        public function request($method, $resource, $data = NULL)
        {
            $signature = self::sign($method, $resource, $data);

            $base_url = Config::get("shippingeasy.base_url") . $signature;

            $request_data['verify'] = false;

            if ($data) {
                $request_data['body'] = json_encode($data);
            }

            if ($method === 'GET') {
                $response = $this->http_client->get($base_url, $request_data);
            } else {
                $response = $this->http_client->post($base_url, $request_data);
            }

            return json_decode($response->getBody(), true);
        }

        /**
         * signs the request data that will be sent to shipping easy
         *
         * @param      $method
         * @param      $resource
         * @param null $data
         *
         * @return string
         */
        public function sign($method, $resource, $data = NULL)
        {
            $api_key = Config::get("shippingeasy.partner_api_key");
            $api_secret = Config::get("shippingeasy.partner_api_secret");


            $api_timestamp = time();
            $data = is_null($data) ? $data : json_encode($data);

            $query_params = http_build_query([
                "api_key"       => $api_key,
                "api_timestamp" => $api_timestamp
            ]);

            if ($data) {
                $request_data = "$method&$resource&$query_params&$data";
            } else {
                $request_data = "$method&$resource&$query_params";
            }

            $signed_request_data = hash_hmac("sha256", $request_data, $api_secret);

            return "{$resource}?api_key={$api_key}&api_signature={$signed_request_data}&api_timestamp={$api_timestamp}";
        }
    }