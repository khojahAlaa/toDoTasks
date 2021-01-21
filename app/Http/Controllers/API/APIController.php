<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use JWTAuth;
use App\User;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegistrationFormRequest;

use Validator;
use Response;

class APIController extends Controller
{
    /**
     * @var bool
     */
    public $loginAfterSignUp = true;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
public function login(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $credentials = $request->only('email', 'password');
        $token = null;

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $token,
            'data' => $credentials,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    /**
     * @param RegistrationFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegistrationFormRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
       
        // User::create([
        //     'name'=> $request->get('name'),
        //     'email'=> $request->get('email'),
        //     'password'=> bcrypt($request->get('password')),
        // ]);
        // $user = User::frist();
        // $token = JWTAuth::fromUser($user);
        // return  Response::json(compact('token'));

        // if ($this->loginAfterSignUp) {
        //     return $this->login($request);
        // }

        return response()->json([
            'success'   =>  true,
            'data'      =>  $user
        ], 200);
    }
}