<?php
    /**
     * Created by PhpStorm.
     * User: Optimistic
     * Date: 01/05/2015
     * Time: 20:51
     */

    namespace Maverickslab\Shipeasy;

    use Carbon\Carbon;
    use Illuminate\Support\Facades\Config;
    use ShippingEasy_Cancellation;
    use ShippingEasy_Order;
    use ShippingEasy;


    /**
     * Class Order
     *
     * @package Maverickslab\Shipeasy
     */
    class Order
    {
        private $requester;
        private $store_api_key;
        private $customer_api_key;

        /**
         * @param APIRequester $requester
         */
//        public function __construct(APIRequester $requester, $store_api_key, $store_secret, $customer_api_key)
        public function __construct($store_api_key, $store_secret, $customer_api_key)
        {
//            $this->requester = $requester;
            ShippingEasy::setApiKey($store_api_key);
            ShippingEasy::setApiSecret($store_secret);
            $this->customer_api_key = $customer_api_key;
            ShippingEasy::setApiBase(Config::get('shippingeasy.base_url'));
            ShippingEasy::setPartnerApiKey(Config::get('shippingeasy.partner_api_key'));
            ShippingEasy::setPartnerApiSecret(Config::get('shippingeasy.partner_api_secret'));
        }

        public function all()
        {
            $order = new ShippingEasy_Order($this->customer_api_key);
//            $order = new ShippingEasy_Order(ShippingEasy::getApiKey());

            $updated_at = Carbon::now()->subWeek(Config::get('shippingeasy.orders_from_past_weeks'));

            return $order->findAll([
                'last_updated_at' => $updated_at . '',
                'status'          => [
                    'shipped', 'ready_for_shipment', 'cleared'
                ]
            ]);
        }

        public function get($order_id)
        {
            $order = new ShippingEasy_Order($this->customer_api_key);

            return $order->find($order_id);
        }

        public function create($order_data)
        {
            $order = new ShippingEasy_Order($this->customer_api_key, $order_data);

            try {
                return $order->create();
            } catch (\Exception $ex) {
                return $ex->getTrace();
            }

            //return $this->requester->request('POST', "/api/stores/{$this->store_api_key}/orders", $order_data);
        }

        public function cancel($order_id)
        {
            $cancellation = new ShippingEasy_Cancellation($this->customer_api_key, $order_id);

            try {
                return $cancellation->create();
            } catch (\Exception $ex) {
                return $ex->getTrace();
            }

            //return $this->requester->request('POST', "/api/stores/{$this->store_api_key}/orders/{$order_id}/cancellations");
        }

    }