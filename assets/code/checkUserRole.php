<?php

[...]

class CheckUserRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if(!$request->user())
        {
            return abort(401, 'Unauthenticated.');
        }

	if($request->user()->hasRole($role) || !$role)
        {
            return $next($request);
        }

        return abort(403, 'Unauthorized.');
    }
}