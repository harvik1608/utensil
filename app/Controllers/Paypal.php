<?php

namespace App\Controllers;

use App\Models\General_setting;
use App\Models\Order;
use App\Controllers\CommonController;

class Paypal extends CommonController
{
    protected $helpers = ["custom"];

    public function success()
    {
        $orderId = $this->request->getGet('token'); // PayPal order ID
        $localOrderId = $this->request->getGet('order_no'); // Your local order ID
        $accessToken = getAccessToken();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, PAYPAL_TEST_BASE_URL . '/v2/checkout/orders/' . $orderId . '/capture');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer $accessToken"
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);
        if (isset($result['status']) && $result['status'] === 'COMPLETED') {
            $transactionId = $result['purchase_units'][0]['payments']['captures'][0]['id'];

            $db = \Config\Database::connect();
            $builder = $db->table('bd_orders');
            $builder->where('order_no', $localOrderId)->update([
                'paymentOrderId' => $orderId,
                'transaction_id' => $transactionId,
                'payment_status' => 1,
                'jsondata' => json_encode($result),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            return redirect()->to("/my-orders");
        } else {
            echo "<pre>";
            print_r ($result);
        }
    }

    public function cancel()
    {
        $orderId = $this->request->getGet('token'); // PayPal order ID
        $localOrderId = $this->request->getGet('order_no'); // Your local order ID

        $db = \Config\Database::connect();
        $builder = $db->table('bd_orders');
        $builder->where('order_no', $localOrderId)->update(['payment_status' => 2]);

        $_session = session();
        $_session->setFlashData("message","Order has been cancelled.");

        return redirect()->to("my-orders");
    }

    public function payment_request_success()
    {
        $orderId = $this->request->getGet('token'); // PayPal order ID
        $localOrderId = $this->request->getGet('order_no'); // Your local order ID
        $accessToken = getAccessToken();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, PAYPAL_TEST_BASE_URL . '/v2/checkout/orders/' . $orderId . '/capture');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer $accessToken"
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);
        if (isset($result['status']) && $result['status'] === 'COMPLETED') {
            $transactionId = $result['purchase_units'][0]['payments']['captures'][0]['id'];

            $db = \Config\Database::connect();
            $builder = $db->table('bd_payment_requests');
            $builder->where('pg_id', $localOrderId)->update([
                'status' => 2,
                'jsondata' => json_encode($result),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $_session = session();
            $_session->setFlashData("message","Amount paid successfully.");
            
            return redirect()->to("/my-payment-requests");
        } else {
            echo "<pre>";
            print_r ($result);
        }
    }

    public function payment_request_cancel()
    {
        $orderId = $this->request->getGet('token'); // PayPal order ID
        $localOrderId = $this->request->getGet('order_no'); // Your local order ID

        $db = \Config\Database::connect();
        $builder = $db->table('bd_payment_requests');
        $builder->where('pg_id', $localOrderId)->update(['status' => 3]);

        $_session = session();
        $_session->setFlashData("message","Payment has been cancelled.");

        return redirect()->to("my-payment-requests");
    }
}