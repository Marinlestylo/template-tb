<?php
[...]
class Question extends Model
{
    [...]
    protected function validateShortAnswer($value)
    {
        // Vérification exacte
        if (Arr::has($this, 'validation.expected') && strval($value)
                == Arr::get($this, 'validation.expected')){
            return true;
        }
        // Utilisation d'une expression régulière
        if (Arr::has($this, 'validation.pattern')) {
            if (preg_match(Arr::get($this, 'validation.pattern'), strval($value))){
                return true;
            }
        }
        return false;
    }

    protected function validateMultipleChoice($value)
    {
        $target = array_unique($this->validation);
        sort($target);
        sort($value);
        return $value == $target;
    }

    protected function validateFillInTheGaps($value)
    {
        return $value == $this->validation;
    }

    protected function validateLongAnswer($value) { return false; }

    protected function validateCode($value) { return false; }
}
