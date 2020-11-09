<?php

namespace App\Http\Controllers;

use App\Model\Question;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\Http\Resources\QuestionResource;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['index','show']]);
        //$this->middleware('auth:api', ['except' => ['login']]);
    }

    public function index()
    {
        return QuestionResource::collection(Question::latest()->paginate(5));
        //return QuestionResource::collection(Question::latest()->get());
        //return Question::all();
        //return QuestionResource::collection(Question::orderBy('id','desc')->get());
    }


    public function store(QuestionRequest $request)
    {
        //$request['question_slug'] = Str::slug($request->question_title);
        //$request['user_id'] = auth()->user()->id;

        $question = auth()->user()->questions()->create($request->all());
        
        return response( new QuestionResource($question), Response::HTTP_CREATED);

    }


    public function show(Question $question)
    {
        return new QuestionResource($question);
    }

    public function update(Request $request, Question $question)
    {
        $question->update($request->all());
        return response('Updated', Response::HTTP_ACCEPTED);

    }

    public function destroy(Question $question)
    {
        $question->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
