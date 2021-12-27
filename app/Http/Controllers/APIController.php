<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Traits\APIResponseTrait;
use Tymon\JWTAuth\Contracts\Providers\Auth;
use Tymon\JWTAuth\Http\Parser\Parser;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Manager;

class APIController extends Controller
{
    use APIResponseTrait;

    private UserService $userService;

    private Manager $manager;

    private Parser $parser;

    private Auth $auth;

    public function __construct(UserService $userService, Manager $manager, Parser $parser, Auth $auth)
    {
        $this->userService = $userService;
        $this->manager = $manager;
        $this->parser = $parser;
        $this->auth = $auth;
    }

    public function register(Request $request)
    {
        $data = $request->only('firstname', 'lastname', 'email', 'password');
        $validator = Validator::make($data, [
            'firstname' => 'required|string',
            'lastname'  => 'required|string',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|string|min:8|max:100'
        ]);

        if ($validator->fails()) {
            return $this->generateAPIResponse(
                false,
                [],
                [$validator->messages()],
                Response::HTTP_OK
            );
        }

        $user = $this->userService->createUser(
            $request->input('firstname'),
            $request->input('lastname'),
            $request->input('email'),
            $request->input('password'),
        );

        return $this->generateAPIResponse(
            true,
            $user,
            [],
            Response::HTTP_OK
        );
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($credentials, [
            'email'    => 'required|email',
            'password' => 'required|string|min:8|max:100'
        ]);

        if ($validator->fails()) {
            return $this->generateAPIResponse(false, [], [$validator->messages()], Response::HTTP_OK);
        }

        try {

            $jwt = new JWTAuth($this->manager, $this->auth, $this->parser);
            $token = $jwt->attempt($credentials);

            if (!$token) {
                return $this->generateAPIResponse(false, [], ['Invalid credentials'], Response::HTTP_BAD_REQUEST);
            }

        } catch (JWTException $e) {

            return $this->generateAPIResponse(
                false,
                [],
                ['Could not create token.'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );

        }

        $user = $jwt->setToken($token)->toUser();
        $user = $this->userService->getUser($user->id);

        return $this->generateAPIResponse(
            true,
            [
                'token' => $token,
                'user'  => $user,
            ],
            [],
            Response::HTTP_OK
        );
    }

    public function logout(Request $request)
    {
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->generateAPIResponse(
                false,
                [],
                [$validator->messages()],
                Response::HTTP_OK
            );
        }

        try {

            $jwt = new JWTAuth($this->manager, $this->auth, $this->parser);
            $jwt->setToken($request->token)
                ->invalidate();

            return $this->generateAPIResponse(
                true,
                ['User has been logged out'],
                [],
                Response::HTTP_OK
            );

        } catch (JWTException $exception) {

            return $this->generateAPIResponse(
                false,
                [],
                [$exception->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
