<?php
[...]
class DrillController extends Controller
{
    function answerDrill(Request $request){
        $question_id = $request->question_id;
        $correct = false;
        $q = Question::findOrFail($question_id);
        $drill = Drill::findOrFail($request->drill_id);

        $correct = $q->validate($request->answer);

        $rank = $this->getRank($request->time, $correct);

        if($rank >= 3) {
            if($drill->repetitions == 0) {
                $drill->interval = 1;
            } else if($drill->repetitions == 1) {
                $drill->interval = 6;
            } else {
                $drill->interval *= $drill->easiness;
            }
            $drill->repetitions += 1;
        } else {
            $drill->repetitions = 0;
            $drill->interval = 1;
        }

        $drill->easiness = max(1.3,
            $drill->easiness + (0.1 - (5 - $rank) * (0.08 + (5 - $rank) * 0.02)));
        $nextRepetition = Carbon::parse($drill->next_repetition);
        $drill->next_repetition = $nextRepetition->addDays($drill->interval);

        $drill->save();

        return response()->json([
            'correct' => $correct,
            'drill' => fractal($drill, new DrillTransformer),
        ]);
    }

    protected function getRank($time, $correct){
        $rank = 5;
        if ($time > 40){
            $rank -= 2;
        } else if ($time > 20){
            $rank -= 1;
        }

        if (!$correct){
            $rank -= 3;
        }
        return $rank;
    }
}
