<?php
[...]
class DrillController extends Controller
{
    function makeDrill($keyword)
    {
        $k = Keyword::where('name', $keyword)->first();
        $q = Question::where('is_public', true)
            ->whereHas('keywords', function ($query) use ($keyword) {
                return $query->where('name', 'like', $keyword);
            })->get();

        $student_id = Auth::user()->student->id;

        $drills = [];
        foreach ($q as $question) {

            $existingDrill = Drill::where('student_id', $student_id)
                ->where('question_id', $question->id)
                ->where('keyword_id', $k->id)
                ->first();

            if (!$existingDrill) {
                Drill::create([
                    'student_id' => $student_id,
                    'question_id' => $question->id,
                    'keyword_id' => $k->id,
                ]);
            } else {
                $drills[] = $existingDrill;
            }
        }

        return fractal($drills, new DrillTransformer())->toArray();
    }
}