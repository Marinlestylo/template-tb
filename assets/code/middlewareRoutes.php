<?php

[...]

// Routes for teacher only
Route::middleware('checkUserRole:teacher')->group(function () {
    Route::get('/quizzes', [QuizController::class, 'index']);
    [...]
});