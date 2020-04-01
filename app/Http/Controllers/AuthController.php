<?php

namespace App\Http\Controllers;

use App\Repository\User\IUserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class AuthController
 * @property IUserRepositoryInterface userRepository
 * @package App\Http\Controllers
 */
class AuthController extends BaseController
{
    /**
     * Create a new AuthController instance.
     *
     * @param IUserRepositoryInterface $userRepository
     */
    public function __construct(IUserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('auth:api', ['except' => ['login' , 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function register()
    {
        $name = request(['name']);
        $email = request(['email']);
        $pass = request(['password']);

        if ($email['email']){
            $duplicate_user = DB::table('users')
                ->where('email', 'LIKE', $email)
                ->first();

            if ($duplicate_user) {
                return response('This user already exists', 422);
            } else {

                $password = Hash::make($pass['password']);
                $this->userRepository->save($name['name'] , $email['email'] ,$password);
            }
            return response('User created', 202);
        }else{
            return response('Bad request parameter', 400);
        }
    }

}