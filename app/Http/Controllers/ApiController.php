<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;



class ApiController extends Controller
{

  public function login(Request $request)
  {

      $http= new \GuzzleHttp\Client();
      $response = $http->request('POST', 'http://localhost:8000/api/login', [
          'headers' => [
              'cache-control' => 'no-cache',
              // 'Content-Type' => 'application/x-www-form-urlencoded'

          ],
          'form_params' => [
              'email' =>$request->email,
              'password' => $request->password

          ],
      ]);


      $status =  $response->getStatusCode();
      if($status == 200)

      {

          $contents =json_decode((string) $response->getBody(), true);

          if(isset($contents['success'])==true) {
                session(['logged_in' => true]);
                session(['token' => $contents['token']]);
                return response()->json(['success'=>true, 'url'=>url('/home')]);
          }

          else if(isset($contents['error']) == true) {
                $data = ['error' => true, 'message' => $contents['message']];
                return response()->json($data, 200);
              }
      }
    return response()->json(['error'=>true,' message'=> 'Some error Occured!'], 401);

      // return redirect()->route('home');


      // return response($response->getBody(), 200);

      //return json_decode((string) $response->getBody(), true);
}

public function logout()
{

  $http= new \GuzzleHttp\Client();
      $response = $http->request('GET', 'http://localhost:8000/api/user/logout', [
          'headers' => [
              'cache-control' => 'no-cache',
              'Accept'        => 'application/json',
              'Authorization' => 'Bearer '.session('token')

            //  'Content-Type' => 'application/x-www-form-urlencoded'
          ]

      ]);


        $status =  $response->getStatusCode();
      if($status == 200)

      {
        session(['logged_in' => false]);
        session(['token' => '']);
      return response()->json(['url'=>url('/login')]);
    }

    return 0;
}
}
