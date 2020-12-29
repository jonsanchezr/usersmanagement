<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Profile;
use App\Http\Requests\RegisterRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
  /**
   * Register.
   *
   * @param RegisterRequest $request
   * @return JsonResponse
   * @throws AuthorizationException
   */
  public function register(RegisterRequest $request)
  {
    $user = new User;
    $user->name = $request->username;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->save();

    $profile = new Profile;
    $profile->create([
      'user_id' => $user->id,
      'firstname' => $request->firstname,
      'lastname' => $request->lastname,
      'country' => $request->country,
      'phone' => $request->phone,
      'age' => $request->age,
      'birthday_date' => $request->birthday_date,
    ]);
    
    return response()->json(['status' => 'success'], 200);
  }

  /**
   * Login.
   *
   * @param Request $request
   * @return JsonResponse
   * @throws AuthorizationException
   */
  public function login(Request $request)
  {
    $credentials = $request->only('email', 'password');
    
    if ($token = $this->guard()->attempt($credentials)) {
      return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
    }
    
    return response()->json(['error' => 'Unauthorized Access'], 401);
  }
  
  /**
   * Logout.
   *
   * @return JsonResponse
   * @throws AuthorizationException
   */
  public function logout()
  {
    $this->guard()->logout();
    
    return response()->json([
      'status' => 'success',
      'msg' => 'Logged out Successfully.'
    ], 200);
  }
  
  /**
   * Logout.
   *
   * @return Auth
   */
  private function guard()
  {
    return Auth::guard();
  }
}