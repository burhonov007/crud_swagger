<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    /**
    * Get a JWT via given credentials.
    *
    * @return \Illuminate\Http\JsonResponse
    *
    * @OA\Post(
    * path="/auth/login",
    * operationId="authLogin",
    * tags={"Users"},
    * summary="User Login",
    * description="Login User Here",
    *     @OA\RequestBody(
    *         @OA\JsonContent(),
    *         @OA\MediaType(
    *            mediaType="multipart/form-data",
    *            @OA\Schema(
    *               type="object",
    *               required={"email", "password"},
    *              @OA\Property(property="email", type="string", example="akmal@mail.ru"),
    *              @OA\Property(property="password", type="string", example="akmalakmal")
    *            )
    *        ),
    *     ),
    *
    *      @OA\Response(
    *          response=200,
    *          description="Login Successfully",
    *          @OA\JsonContent()

    *       ),
    *      @OA\Response(
    *          response=201,
    *          description="Login Successfully"
    *       ),
    *      @OA\Response(
    *          response=422,
    *          description="Unprocessable Entity"
    *       ),
    *      @OA\Response(
    *          response=401,
    *          description="Unauthorized"
    *       ),
    *      @OA\Response(response=400, description="Bad request"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * )
    */

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }


    /**
    * Register a User.
    *
    * @return \Illuminate\Http\JsonResponse
    *
    * @OA\Post(
    * path="/auth/register",
    * operationId="Register",
    * tags={"Users"},
    * summary="User Register",
    * description="User Register here",
    *     @OA\RequestBody(
    *         @OA\JsonContent(),
    *         @OA\MediaType(
    *            mediaType="multipart/form-data",
    *            @OA\Schema(
    *               type="object",
    *               required={"name","email", "password"},
    *               @OA\Property(property="name", type="string", example="Jabbor"),
     *              @OA\Property(property="email", type="string", example="jabbor@example.com"),
     *              @OA\Property(property="password", type="string", example="123456"),
     *              @OA\Property(property="password_confirmation", type="string", example="123456")
    *            ),
    *        ),
    *    ),
    *      @OA\Response(response=201,description="Register Successfully"),
    *      @OA\Response(response=200,description="Register Successfully",@OA\JsonContent()),
    *      @OA\Response(response=422,description="Unprocessable Entity"),
    *      @OA\Response(response=400,description="Bad request"),
    *      @OA\Response(response=404,description="Resource Not Found"),
    * )
    */

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'password_confirmation' => 'required|same:password'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
        return response()->json([
            'message' => 'User successfully registered'
        ], 201);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
    * @OA\Post(
    * path="/auth/logout",
    * operationId="authLogout",
    * tags={"Users"},
    * summary="User Logout",
    * description="Logout user and invalidate token",
    * security={ {"bearer": {} }},
    * @OA\Response(
    *    response=200,
    *    description="Success"
    *     ),
    * @OA\Response(
    *    response=401,
    *    description="Returns when user is not authenticated",
    *     ),
    * @OA\Response(
    *    response=500,
    *    description="Internal Server Error",
    *     ),
    * )
    */
    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
    /**
     * Refresh a token.
     * @return \Illuminate\Http\JsonResponse
     * @OA\POST(
     *     path="/auth/refresh",
     *     tags={"Users"},
     *     summary="Refresh",
     *     description="Refresh",
     *     security={{"bearer":{}}},
     *     @OA\Response(response=200, description="Refresh" ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }
    /**
    * Get the authenticated User.
    *
    * @return \Illuminate\Http\JsonResponse
    *
    * @OA\Get(
    * path="/auth/profile",
    * summary="Retrieve profile information",
    * description="Get profile short information",
    * operationId="profileShow",
    * tags={"Users"},
    * security={ {"bearer": {} }},
    * @OA\Response(
    *    response=200,
    *    description="Success",
    *     ),
    * @OA\Response(
    *    response=401,
    *    description="User should be authorized to get profile information",
    * )
    * )
    */
    public function profile() {
        return response()->json(auth()->user());
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
