<?php

Route::get('/questions-types', [QuestionController::class, 'getTypes']);
Route::get('/questions-difficulties',
    [QuestionController::class, 'getDifficulties']);
Route::get('/quizzes-types', [QuizController::class, 'getTypes']);