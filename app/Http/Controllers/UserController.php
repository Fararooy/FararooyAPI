<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Traits\APIResponseTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    use APIResponseTrait;

    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        try {
            return $this->generateAPIResponse(
                true,
                $this->userService->getUser(auth()->user()->id),
                [],
                Response::HTTP_OK
            );
        } catch (\Exception $exception) {
            return $this->generateAPIResponse(
                false,
                [],
                $exception->getCode(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $user = auth()->user();
            return $this->generateAPIResponse(
                true,
                $this->userService->updateUser($user->id, $request->all()),
                [],
                Response::HTTP_OK
            );
        } catch (\Exception $exception) {
            return $this->generateAPIResponse(
                false,
                [],
                $exception->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
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

    public function uploadProfileImage(Request $request)
    {
        try {
            $user = auth()->user();
            return $this->generateAPIResponse(
                true,
                $this->userService->uploadProfileImage($user->id, $request),
                [],
                Response::HTTP_OK
            );
        } catch (\Exception $exception) {
            return $this->generateAPIResponse(
                false,
                [],
                $exception->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
