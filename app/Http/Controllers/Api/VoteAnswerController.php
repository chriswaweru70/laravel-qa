<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Answer;

class VoteAnswerController extends Controller
{
    public function __invoke(Answer $answer)
    {
        $vote = (int) request()->vote;
        $votesCount = auth()->user()->voteAnswer($answer, $vote);
     
        return response()->json([
                'message' => "Thanks for the feedback",
                'votesCount' => $votesCount
            ]);
    }
}
