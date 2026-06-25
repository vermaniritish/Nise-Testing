<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CCAvenueController extends Controller
{
    public function checkout()
    {
        return view('checkout');
    }

    public function pay(Request $request)
    {
        $merchant_data = '';

        $data = [
    'merchant_id'    => env('CCA_MERCHANT_ID'),
    'order_id'       => time(),
    'currency'       => 'INR',
    'amount'         => '1.00',

    'redirect_url'   => route('ccavenue.response'),
    'cancel_url'     => route('ccavenue.response'),

    'language'       => 'EN',

    'billing_name'    => 'Test User',
    'billing_address' => '123 Test Street',
    'billing_city'    => 'Delhi',
    'billing_state'   => 'Delhi',
    'billing_zip'     => '110001',
    'billing_country' => 'India',
    'billing_tel'     => '9999999999',
    'billing_email'   => 'test@test.com',
];

        foreach ($data as $key => $value) {
            $merchant_data .= $key . '=' . $value . '&';
        }

        $encrypted_data = $this->encrypt(
            $merchant_data,
            env('CCA_WORKING_KEY')
        );

        return view('ccavenue_redirect', compact('encrypted_data'));
    }

    public function response(Request $request)
    {
        $workingKey = env('CCA_WORKING_KEY');

        $encResponse = $request->encResp;

        $response = $this->decrypt($encResponse, $workingKey);

        parse_str($response, $paymentData);

        dd($paymentData);
    }

    public function encrypt($plainText, $key)
    {
        $secretKey = hextobin(md5($key));

        $initVector = pack("C*", 0x00,0x01,0x02,0x03,0x04,0x05,0x06,0x07,
            0x08,0x09,0x0a,0x0b,0x0c,0x0d,0x0e,0x0f);

        $openMode = openssl_encrypt(
            $plainText,
            'AES-128-CBC',
            $secretKey,
            OPENSSL_RAW_DATA,
            $initVector
        );

        return bin2hex($openMode);
    }

    public function decrypt($encryptedText, $key)
    {
        $secretKey = hextobin(md5($key));

        $initVector = pack("C*", 0x00,0x01,0x02,0x03,0x04,0x05,0x06,0x07,
            0x08,0x09,0x0a,0x0b,0x0c,0x0d,0x0e,0x0f);

        $encryptedText = hextobin($encryptedText);

        return openssl_decrypt(
            $encryptedText,
            'AES-128-CBC',
            $secretKey,
            OPENSSL_RAW_DATA,
            $initVector
        );
    }
}

function hextobin($hexString)
{
    $length = strlen($hexString);
    $binString = "";

    for ($i = 0; $i < $length; $i += 2) {
        $binString .= pack("H*", substr($hexString, $i, 2));
    }

    return $binString;
}