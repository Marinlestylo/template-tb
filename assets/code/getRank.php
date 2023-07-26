<?php
[...]
class DrillController extends Controller
{
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
