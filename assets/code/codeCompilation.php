<?php

function compilation(Request $request)
    {
        $compilerUrl = env('CODE_COMPILER_URL', NULL);
        $url = $compilerUrl .
                'api/compile?language=PYTHON&memoryLimit=100&timeLimit=15';
        $code = $request->code;

        $response = Http::attach('inputFile', '1', 'input.txt')
            ->attach('expectedOutputs', '', 'output.txt')
            ->attach('sourcecode', $code, 'sourceCode.py')
            ->post($url);

        return $response;
    }