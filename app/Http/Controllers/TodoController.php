<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if(auth()->check()){
                $todos = Todo::all();
                return response()->json($todos);
                // return response()->json(['message'=>'yes fetched']);
            }else{
                return response()->json(['error' => 'Unauthenticated'], 401);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Something went wrong'], 401);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TodoRequest $request)
    {
        try {
            if(auth()->check()){
                // dd(auth()->user()->id);
                $validated = $request->validated();
                // dd($validated);
                $validated['user_id'] = auth()->user()->id;
                dd($validated);
                Todo::create($validated);
                return response()->json(['message'=>'Todo successfully created','status'=>200]);
            }else{
                return response()->json(['error' => 'Unauthenticated'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong','status'=>401, 'error'=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        //
    }
}
