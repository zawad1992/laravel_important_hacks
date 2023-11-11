<?php
/**
 * Bootstrap any application services.
 * 
 * Placement Instructions:
 * 1. Place this code in the `boot` method of your AppServiceProvider.
 *    The AppServiceProvider is usually located in the 'app/Providers' directory of your Laravel application.
 * 2. This code sets up view composers for 'layouts.admin' and 'layouts.blank' views. Adjust as necessary for your specific views.
 * 3. Ensure the views and routes referenced in the composers exist in your application.
 * 4. Modify user role and branch determination logic as per your application's requirements.
 *
 * The 'layouts.admin' composer:
 * - Extracts the current controller and action.
 * - Determines the current user's role and branch, storing them in the session.
 * - Passes these details along with the current URL to the view.
 *
 * The 'layouts.blank' composer:
 * - Only extracts and passes the current controller, action, and URL to the view.
 */

public function boot()
{
    // Composer for 'layouts.admin' view
    app('view')->composer('layouts.admin', function ($view) {
        // Extract current controller and action
        $action = app('request')->route()->getAction();    
        $currentUrl = app('request')->url();
        if (!empty($action['controller'])) {
            $controller = class_basename($action['controller']) ?: 'HomeController@index';
            list($controller, $action) = explode('@', $controller);
        } else {
            $controller = "HomeController";
            $action = "index";
        }

        // Fetch or determine role name
        $roleName = session('role_name');
        // ... (Role determination logic) ...
        if (empty($roleName)) {
            $userRole = Auth::user()->roles;
            if (!empty($userRole)) {
                $userRole = $userRole->toArray();
                if (!empty($userRole[0])) {
                    $roleName = $userRole[0]['display_name'];
                    session(['role_name'=>$roleName]);
                } else {
                    $roleName = "N/A";
                    session(['role_name'=>$roleName]);
                }
            } else {
                $roleName = "N/A";
                session(['role_name'=>$roleName]);
            }
        }

        // Fetch or determine branch name
        $branchName = session('branch_name');
        // ... (Branch determination logic) ...
        if (empty($branchName)) {
            $branchUsers = Auth::user()->branch_users;
            if (!empty($branchUsers)) {
                if (!empty($branchUsers->branches)) {
                    $branchName =strtoupper($branchUsers->branches->name);
                    session(['branch_name'=>$branchName]);
                } else {
                    $branchName = "N/A";
                    session(['branch_name'=>$branchName]);
                }
            } else {
                $branchName = "N/A";
                session(['branch_name'=>$branchName]);
            }
        }

        // Sharing data with the view
        $view->with(compact('controller', 'action', 'currentUrl', 'branchName', 'roleName'));
    });

    // Composer for 'layouts.blank' view
    app('view')->composer('layouts.blank', function ($view) {
        // Similar extraction for controller, action, and URL as above
        // ... (Controller and action extraction logic) ...
        $action = app('request')->route()->getAction(); 
        $currentUrl = app('request')->url();

        if (!empty($action['controller'])) {
            $controller = (class_basename($action['controller'])) ? class_basename($action['controller']) : 'HomeController@index';
            list($controller, $action) = explode('@', $controller);
        } else {
            $controller = "HomeController";
            $action = "index";
        }
        
        // Sharing data with the view
        $view->with(compact('controller', 'action', 'currentUrl'));
    });
}