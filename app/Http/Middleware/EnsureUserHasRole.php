<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * @param  array<string>  $roles  e.g. ['super_admin'], ['admin'], ['lecturer', 'super_admin']
     *        Use 'admin' to allow any admin-type role (Super Admin, Dean, HOD, Registrar).
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        $user = $request->user();
        $effectiveType = $user->effectiveType();

        if (in_array('admin', $roles, true) && $effectiveType === 'admin') {
            return $next($request);
        }

        $legacyRole = $user->role;
        $roleSlug = $user->role_id && $user->roleRelation ? $user->roleRelation->slug : $legacyRole->value;

        foreach ($roles as $r) {
            if ($r === 'admin') {
                continue;
            }
            if ($r === $roleSlug) {
                return $next($request);
            }
            try {
                $enumRole = UserRole::from($r);
                if ($legacyRole === $enumRole) {
                    return $next($request);
                }
            } catch (\ValueError) {
                // not an enum value, already checked as slug
            }
        }

        abort(403, 'You do not have permission to access this area.');
    }
}
