<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if (Auth::check()) {
                $loggedInUserId = Auth::id();
                $peoples = People::whereIn('user_id', [$loggedInUserId, 1])->paginate(10);
            } else {
                $peoples = People::where('user_id', 1)->paginate(10);
            }

            return Response($peoples);
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request['user_id'] = Auth::id();
            return People::create($request->all());
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $obj = $this->findObjectById($id);

            if ($obj->user_id !== Auth::id()) {
                return Response(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
            }

            return Response($obj);
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $object = $this->findObjectById($id);

            if ($object->user_id !== Auth::id()) {
                return Response(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
            }

            return Response($object);
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            //code...
        } catch (Exception $e) {
            return Response(['error' => $e->getMessage()], $e->getCode());
        }
    }

    protected function findObjectById($id)
    {
        $obj = People::find($id);

        if (!$obj) {
            throw new Exception('People not found', Response::HTTP_NOT_FOUND);
        }

        return $obj;
    }
}