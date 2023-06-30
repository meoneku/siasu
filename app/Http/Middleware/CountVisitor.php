<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;

class CountVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        $visit_id = hash('sha256', date('Ymd H'));
        if (Visitor::where('visit_id', $visit_id)->where('ip', $ip)->count() < 1) {
            Visitor::create([
                'visit_id'  => $visit_id,
                'ip'        => $ip,
            ]);
        }
        return $next($request);
    }
}
