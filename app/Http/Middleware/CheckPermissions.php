<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\RolePermission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckPermissions
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
        $path = head(explode('/', last(explode('/api/', $request->getRequestUri()))));
        $lastPath = last(explode('/', last(explode('/api/', $request->getRequestUri()))));

        if (is_string($path)) {
            if ($path == 'settings') {
                return $next($request);
            }
            $rolPermissions = Auth::User()->role;
            if (count($rolPermissions->permissions)) {

                $permission = Permission::whereModule($path)->first();
                if ($permission) {
                    $action = $this->checkRouteAction($lastPath);

                    if (RolePermission::wherePermissionId($permission->id)->whereRoleId($rolPermissions->id)->whereAction($action)->exists()) {
                        return $next($request);
                    } else return response()->json(['success' => false, 'message' => 'Access Denied'], ERROR_403);
                } else return response()->json(['success' => false, 'message' => 'Access Denied'], ERROR_403);
            } else return response()->json(['success' => false, 'message' => 'Access Denied'], ERROR_403);
        }
        return response()->json(['success' => false, 'message' => 'Access Denied'], ERROR_403);
    }



    private function checkRouteAction($lastPath)
    {
        $writeRequests = ['store', 'update', 'delete', 'change-status', 'update-multiple', 'change-status-to-factory', 'update-status', 'bulk-update-status', 'reorder', 'download', 'create-sale-invoice', 'retry-create-sage-invoice', 'reshuffle', 'update-order', 'download-pdf'];
        $readRequests = ['listing', 'products', 'stats', 'customer-total-listing', 'show', 'work-order-listing', 'charts', 'ticket-no', 'details', 'history', 'widgets', 'search-from-sage', 'fetch-from-sage'];
        if (in_array($lastPath, $writeRequests)) {
            return ROLE_ACTION_WRITE;
        } else if (in_array($lastPath, $readRequests)) {
            return ROLE_ACTION_READ;
        }
    }
}
