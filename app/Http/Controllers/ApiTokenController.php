<?php

namespace App\Http\Controllers;

use App\Ability;
use Illuminate\Http\Request;

class ApiTokenController extends Controller
{
    public function index(Request $request)
    {
        $tokens = $request->user()->tokens;
        $abilities = Ability::get();
        return view('api.index', compact('tokens', 'abilities'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        //dd($request->abilities);

        //dd(Ability::find($request->abilities)->pluck('name')->toArray());

        $this->validate($request, [
            'name' => 'required',
            'abilities' => 'nullable|array',
            'abilities.*' => "exists:abilities,id"
        ]);

        $token = $request->user()->createToken(
            $request->name,
            optional(optional(Ability::find($request->abilities))->pluck('name'))->toArray() ?? []
        );

        //dd($token);

        return back()->withStatus("Token created {$token->plainTextToken}");
    }

    public function destroy($id, Request $request)
    {
        //dd($id);
        $request->user()->tokens()->whereId($id)->delete();
        return back();
    }
}
