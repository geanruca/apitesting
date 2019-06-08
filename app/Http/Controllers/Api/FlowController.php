<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class FlowController extends Controller
{
   
    
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

   
    public function create(Request $r)
    {
        \Log::info('FLOW_INFO',[$r->all()]);
        // REAL
        // $apiKey    = '3C6FADD0-75CD-46BE-A3C8-2DLCAF645821';
        // $secretKey = '2ca0b7d495d64b21036b7e68e6d177af54cdded9';
        //SANDBOX
        $apiKey          = '4F97F6EC-8D67-4383-B5B3-322L977F97BA';
        $secretKey       = '432cb51b224dad7cb18d6455e045769c7bdd51c8';

        // Creación de usuario si es que no existe el usuario
        // if(){
        //     User::where('celular',$r->celular)->first();
        // }

        $usuario = Pedido::join('users as u','u.id','=','pedidos.id_usuario')
        ->where('u.email',$r->email)
        ->orderBy('pedidos.created_at','desc')
        ->select('pedidos.id as id_pedido')
        ->first();
        
        if($usuario){
            $commerceOrder   = $usuario->id_pedido;
        }else{
            $email = User::where('email', $r->email)->first();
            if(!$email){
                return response()->json('Error. No existe usuario con ese email.',401);
            }
            $usuario = new Pedido();
            $usuario->pago_total = $r->amount;
            $usuario->email = $email->email;
            $usuario->save();
            // ::orderBy('pedidos.created_at','desc')->select('pedidos.id as id_pedido')->first();
            $commerceOrder = $usuario->id;
            // return response()->json('Error, el usuario no existe');
        }
        $subject         = $r->subject;
        $amount          = $r->amount;
        $email           = $r->email;
        $paymentMethod   = 1;
        $urlConfirmation = $r->urlConfirmation;
        $urlReturn       = $r->urlReturn;
        // $signature = hash_hmac('sha256', $string_to_sign, $secretKey);
        

        $url = 'https://sandbox.flow.cl/api/payment/create';
        // $url = 'https://www.flow.cl/api/payment/create';
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
        // $params = [
        //     'apiKey'=> $apiKey,
        //     'commerceOrder'=>$commerceOrder,
        //     'subject'=>$subject,
        //     'amount'=>$amount,
        //     'email'=>$email,
        //     'paymentMethod' => 9,
        //     'urlConfirmation'=>$urlConfirmation,
        //     'urlReturn'=>$urlReturn,
        //     's'=>$signature
        // ];
        // sort($params);
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
            
           
            $response_final = str_replace('\\','',$response);
            $coleccion = json_decode($response_final);
            // dd($coleccion);
            $coleccion->url_final = $coleccion->url.'?token='.$coleccion->token;
            $params_status = [
                'flowOrder'=>$coleccion->flowOrder,
                'apiKey'=>$apiKey,
            ];
            ksort($params_status);
            $new_data = '';
            foreach($params_status as $key => $value) {
                // $value=hash_hmac('sha256', $value, $secretKey);
                $new_data .= '&' . $key . '=' . $value;
            }
            // Elimina el primer ampersand
            $new_data = substr($new_data, 1);

            $new_signature=hash_hmac('sha256', $new_data, $secretKey);
            $coleccion->s = $new_signature;

            // $coleccion->urlGetStatus = "https://www.flow.cl/api/payment/getStatusByFlowOrder?flowOrder=$coleccion->flowOrder&apiKey=$apiKey&s=$new_signature";
            $coleccion->urlGetStatus = "https://sandbox.flow.cl/api/payment/getStatusByFlowOrder?flowOrder=$coleccion->flowOrder&apiKey=$apiKey&s=$new_signature";

            // $this->flow_status($coleccion->urlGetStatus);
            // dd($coleccion->flowOrder);
            $pedido = Pedido::find($usuario->id_pedido);
            $pedido->flowOrder   = $coleccion->flowOrder;
            $pedido->estado_pago = 'PENDIENTE';
            // dd($pedido->save());
            $pedido->save();

        return response()->json(
            $coleccion
        );

        // echo()
        } catch (Exception $e) {
            echo 'Error: ' . $e->getCode() . ' - ' . $e->getMessage();
        }
    }
    
    public function flow_status($url){
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $data . '&s=' . $signature);
            $response = curl_exec($ch);

            if($response === false) {
                $error = curl_error($ch);
                throw new Exception($error, 1);
            } 
            $info = curl_getinfo($ch);
            
            $coleccion = json_decode($response);
            // dd($coleccion);
            $coleccion->url_final = $coleccion->url.'?token='.$coleccion->token;
            $params_status = [
                'flowOrder'=>$coleccion->flowOrder,
                'apiKey'=>$apiKey,
            ];
            ksort($params_status);
            $new_data = '';
            foreach($params_status as $key => $value) {
                // $value=hash_hmac('sha256', $value, $secretKey);
                $new_data .= '&' . $key . '=' . $value;
            }
            // Elimina el primer ampersand
            $new_data = substr($new_data, 1);

            $new_signature=hash_hmac('sha256', $new_data, $secretKey);
            $coleccion->s = $new_signature;

            $coleccion->urlGetStatus = "https://www.flow.cl/api/payment/getStatusByFlowOrder?flowOrder=$coleccion->flowOrder&apiKey=$apiKey&s=$new_signature";

            $this->flow_status($coleccion->urlGetStatus);

        return response()->json(
            $coleccion
        );

        // echo()
        } catch (Exception $e) {
            echo 'Error: ' . $e->getCode() . ' - ' . $e->getMessage();
        }
    }

}
