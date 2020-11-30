<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\ClientStoreRequest;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Index resource
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        $clients = Client::with('file')->get();

        $clients->each(function ($client) {
            $client->append('avatar');
        });

        return response()->json([
            'data' => $clients
        ]);
    }

    /**
     * Get single resource
     *
     * @param Client $client
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show( Client $client ) {
        $client->append('avatar');
        $client->append('avatar_filename');
        $client->append('created_mm_dd_yyyy');

        return response()->json([
            'data' => $client
        ]);
    }

    /**
     * Update single resource
     *
     * @param ClientStoreRequest $request
     * @param Client $client
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update( ClientStoreRequest $request, Client $client ) {
        $client->fill($request->all());
        $client->save();

        $client->append('avatar');

        return response()->json([
            'status' => true,
            'data' => $client
        ]);
    }

    /**
     * Store new resource
     *
     * @param ClientStoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store( ClientStoreRequest $request ) {
        $client = new Client;
        $client->fill($request->all());
        $client->save();

        return response()->json([
            'status' => true,
            'created' => true,
            'data' => [
                'id' => $client->id
            ]
        ]);
    }

    /**
     * Destroy single resource
     *
     * @param Client $client
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy( Client $client ) {
        $client->delete();

        return response()->json([
            'status' => true
        ]);
    }

    /**
     * Destroy resources by ids
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroyMass( Request $request ) {
        $request->validate([
            'ids' => 'required|array'
        ]);

        Client::destroy($request->ids);

        return response()->json([
            'status' => true
        ]);
    }
}
