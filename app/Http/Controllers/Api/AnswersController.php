<?php

namespace App\Http\Controllers\Api;

use App\Answer;
use App\Question;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    public function index(Question $question)
    {
        return $question->answers()->with('user')->simplePaginate(3);
    }
    /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
    public function store(Question $question, Request $request)
    {
        $answer = $question->answers()->create($request->validate([
           'body' => 'required'
        ]) + ['user_id' => \Auth::id()]);

        return response()->json([
               'message' => "Your answer has been submitted successfully",
               'answer' => $answer->load('user')
               ]);
    }

  


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question, Request $request, Answer $answer)
    {
        $this->authorize('update', $answer);
        $answer->update($request->validate([
           'body' => 'required'
        ]));
        return response()->json([
            'message' => 'Your answer has been updated',
            'body_html' => $answer->body_html
        ]);
        
        return redirect()->route('questions.show', $question->slug)->with('success', 'Your answer has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {
        $this->authorize('delete', $answer);
        $answer->delete();
        if (request()->expectsJson()) {
            return response()->json([
                'message' => "Your answer has been removed"
            ]);
        }
        return back()->with('success', 'Your answer has been deleted');
    }
}
