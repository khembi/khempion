<?php

namespace App\Http\Controllers;

use App\Filament\Resources\QuestionResource;
use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(QuestionRequest $request)
    {
        return QuestionResource::collection(
            Question::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(QuestionRequest $request, Question $question)
    {
        return QuestionResource::make($question);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
