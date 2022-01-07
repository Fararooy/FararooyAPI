<?php

namespace App\Http\Controllers;

use App\Enums\APIResponseStatus;
use App\Services\ParticipantService;
use App\Traits\APIResponseTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ParticipantController extends Controller
{
    use APIResponseTrait;

    protected ParticipantService $participantService;

    public function __construct(ParticipantService $participantService)
    {
        $this->participantService = $participantService;
    }

    public function register(Request $request)
    {
        try {
            $validator = Validator($request->all(), [
                'event_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response([
                    'status' => 'failure',
                    'content' => '',
                    'error' => $validator->errors()->all()
                ])->header('Content-Type', 'application/json');
            }

            return $this->generateAPIResponse(
                APIResponseStatus::SUCCESS,
                $this->participantService->register(
                    $request->input('event_id'),
                    auth()->id()
                ),
                [],
                ResponseAlias::HTTP_OK
            );
        } catch (\Exception $e) {
            return $this->generateAPIResponse(
                APIResponseStatus::FAILURE,
                [],
                [$e->getMessage()],
                ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function deregister(Request $request)
    {
        try {
            $validator = Validator($request->all(), [
                'event_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response([
                    'status' => 'failure',
                    'content' => '',
                    'error' => $validator->errors()->all()
                ])->header('Content-Type', 'application/json');
            }

            return $this->generateAPIResponse(
                APIResponseStatus::SUCCESS,
                $this->participantService->deregister(
                    $request->input('event_id'),
                    auth()->id()
                ),
                [],
                ResponseAlias::HTTP_OK
            );
        } catch (\Exception $e) {
            return $this->generateAPIResponse(
                APIResponseStatus::FAILURE,
                [],
                [$e->getMessage()],
                ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
            );
        }
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
}
