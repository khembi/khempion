<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('portal.question.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('portal.question.create');
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
    public function show(Question $question)
    {
        return view('portal.question.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        return view('portal.question.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionRequest $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }
}
