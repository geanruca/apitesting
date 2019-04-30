<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FlowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function signature()
    {
        // REAL
        // $apiKey    = '3C6FADD0-75CD-46BE-A3C8-2DLCAF645821';
        // $secretKey = '2ca0b7d495d64b21036b7e68e6d177af54cdded9';
        $apiKey    = '4F97F6EC-8D67-4383-B5B3-322L977F97BA';
        $secretKey = '432cb51b224dad7cb18d6455e045769c7bdd51c8';
        // $signature = hash_hmac('sha256', $string_to_sign, $secretKey);
        $signature = hash_hmac('sha256', 'RR' , $secretKey);

        // $url = 'https://sandbox.flow.cl/api/payment/create';
        // $url = $url . '/payment/getStatus';
        
        // $params = [
        //     'apiKey'=>$apiKey,
        //     'commerceOrder'=>$commerceOrder,
        //     'subject'=>$subject,
        //     'amount'=>$amount,
        //     'email'=>$email,
        //     'urlConfirmation'=>$urlConfirmation,
        //     'urlReturn'=>$urlReturn,
        //     's'=>$signature,
        // ];
        // $data='';
        // foreach($params as $key => $value) {
        // //encode los parámetros para método GET
        //     $data .= '&' . rawurlencode($key) . '=' . rawurlencode($value);
        // }
        // // Elimina el primer ampersand
        // $data = substr($data, 1);
        // //Agrega los parametros y la firma
        // $url = $url . '?' . $data . '?s=' . $signature;
        // try {
        //     $ch = curl_init();
        //     curl_setopt($ch, CURLOPT_URL, $url);
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //     $response = curl_exec($ch);
        //     if($response === false) {
        //         $error = curl_error($ch);
        //         throw new Exception($error, 1);
        //     } 
        //     $info = curl_getinfo($ch);
        //     // if(!in_array($info['http_code'], array('200', '400', '401')) {

        //     //     throw new Exception('Unexpected error occurred. HTTP_CODE: '.$info['http_code'] , $info['http_code']);
        //     // }
        //     echo $response;
        //     } catch (Exception $e) {
        //     echo 'Error: ' . $e->getCode() . ' - ' . $e->getMessage();
        //     }

        return response()->json([
            'status' => true,
            'data'   => 'todo bien',
            '$sign'  => $signature
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $r)
    {
        // REAL
        // $apiKey    = '3C6FADD0-75CD-46BE-A3C8-2DLCAF645821';
        // $secretKey = '2ca0b7d495d64b21036b7e68e6d177af54cdded9';
        $apiKey    = '4F97F6EC-8D67-4383-B5B3-322L977F97BA';
        $secretKey = '432cb51b224dad7cb18d6455e045769c7bdd51c8';
        $commerceOrder = $r->commerceOrder;
        $subject = $r->subject;
        $amount = $r->amount;
        $email = $r->email;
        $paymentMethod = 1;
        $urlConfirmation = $r->urlConfirmation;
        $urlReturn = $r->urlReturn;
        // $signature = hash_hmac('sha256', $string_to_sign, $secretKey);
        

        $url = 'https://sandbox.flow.cl/api/payment/create';
        // $url = 'https://www.flow.cl/api';
        // $url = $url . '/payment/create';
        
        $data='';
        $params = [
            'apiKey'=> $apiKey,
            'commerceOrder'=>$commerceOrder,
            'subject'=>$subject,
            'amount'=>$amount,
            'email'=>$email,
            'paymentMethod' => 1,
            'urlConfirmation'=>$urlConfirmation,
            'urlReturn'=>$urlReturn,
            // 's'=>$signature
        ];
        ksort($params);
        
        foreach($params as $key => $value) {
            // $value=hash_hmac('sha256', $value, $secretKey);
            $data .= '&' . $key . '=' . $value;
        }
        // Elimina el primer ampersand
        $data = substr($data, 1);
        // dd($data);
        $signature=hash_hmac('sha256', $data, $secretKey);
        //Agrega los parametros y la firma
        $url = $url . '?' . $data . '?s=' . $signature;
        $params = [
            'apiKey'=> $apiKey,
            'commerceOrder'=>$commerceOrder,
            'subject'=>$subject,
            'amount'=>$amount,
            'email'=>$email,
            'paymentMethod' => 9,
            'urlConfirmation'=>$urlConfirmation,
            'urlReturn'=>$urlReturn,
            's'=>$signature
        ];
        sort($params);
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data . '&s=' . $signature);
            $response = curl_exec($ch);
        if($response === false) {
            $error = curl_error($ch);
            throw new Exception($error, 1);
        } 
        $info = curl_getinfo($ch);
        // if(!in_array($info['http_code'], array('200', '400', '401')) {
        //     throw new Exception('Unexpected error occurred. HTTP_CODE: '.$info['http_code'] , $info['http_code']);
        // }
        echo $response;
        } catch (Exception $e) {
        echo 'Error: ' . $e->getCode() . ' - ' . $e->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
