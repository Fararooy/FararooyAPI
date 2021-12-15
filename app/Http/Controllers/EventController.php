<?php

namespace App\Http\Controllers;

use App\Enums\APIResponseStatus;
use App\Services\EventService;
use App\Traits\APIResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    use APIResponseTrait;

    private EventService $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return $this->generateAPIResponse(
                APIResponseStatus::SUCCESS,
                $this->eventService->getAllEvents(),
                [],
                200
            );
        } catch (\Exception $e) {
            return $this->generateAPIResponse(
                APIResponseStatus::FAILURE,
                [],
                [$e->getMessage()],
                500
            );
        }
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
    public function show(Request $request)
    {
        try {
            $validator = Validator($request->all(), [
                'id' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->generateAPIResponse(
                    APIResponseStatus::FAILURE,
                    [],
                    [$validator->errors()->all()],
                    400
                );
            }

            $this->eventService->getEvent($request->input('id'));

            return $this->generateAPIResponse(
                APIResponseStatus::SUCCESS,
                $this->eventService->getEvent($request->input('id')),
                [],
                200
            );
        } catch (\Exception $e) {
            return $this->generateAPIResponse(
                APIResponseStatus::FAILURE,
                [],
                [$e->getMessage()],
                500
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

    public function getLatestEvents()
    {
        try {
            return $this->generateAPIResponse(
                APIResponseStatus::SUCCESS,
                $this->eventService->getLatestEvents(),
                [],
                200
            );
        } catch (\Exception $e) {
            return $this->generateAPIResponse(
                APIResponseStatus::FAILURE,
                [],
                [$e->getMessage()],
                500
            );
        }
    }

    public function getFeaturedEvents()
    {
        try {
            return $this->generateAPIResponse(
                APIResponseStatus::SUCCESS,
                $this->eventService->getFeaturedEvents(),
                [],
                200
            );
        } catch (\Exception $e) {
            return $this->generateAPIResponse(
                APIResponseStatus::FAILURE,
                [],
                [$e->getMessage()],
                500
            );
        }
    }
}
