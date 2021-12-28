<?php

namespace App\Http\Controllers;

use App\Services\FavouriteEventService;
use App\Traits\APIResponseTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FavouriteEventController extends Controller
{
    use APIResponseTrait;

    private FavouriteEventService $favouriteEventService;

    public function __construct(FavouriteEventService $favouriteEventService)
    {
        $this->favouriteEventService = $favouriteEventService;
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


    public function create(Request $request)
    {
        try {
            $user = auth()->user();
            return $this->generateAPIResponse(
                true,
                $this->favouriteEventService->addToFavourites($user->id, $request->input('event_id')),
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


    public function destroy(Request $request)
    {
        try {
            $user = auth()->user();
            return $this->generateAPIResponse(
                true,
                $this->favouriteEventService->removeFromFavourites($user->id, $request->input('event_id')),
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
