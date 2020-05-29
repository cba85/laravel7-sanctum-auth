<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepositoryController extends Controller
{
    public function index(Request $request)
    {
        /*
        if (!$request->user()->tokenCan('view')) {
            return response(null, 401);
        }
        */

        $this->authorize('view', $request->user()->currentAccessToken());

        dd($request->user());
    }

    public function store(Request $request)
    {
        /*
        if (!$request->user()->tokenCan('create')) {
            return response(null, 401);
        }
        */

        $this->authorize('create', $request->user()->currentAccessToken());
    }
}
