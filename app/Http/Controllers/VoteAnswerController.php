<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Answer;

class VoteAnswerController extends Controller
{
    public function __counstruct()
    {
        $this->middleware('auth');
    }
    public function __invoke(Answer $answer)
    {
        $vote = (int) request()->vote;
        auth()->user()->voteAnswer($answer, $vote);
        return back();
    }
}
