<?php
/**
 * Register any application services.
 *
 * This method in the service provider is used for setting up view composers for the 'admin' and 'blank' layouts.
 * View composers are callbacks or class methods that are called when a view is rendered. 
 *
 * For 'layouts.admin', the view composer:
 * - Extracts the current controller and action.
 * - Determines the current user's role and branch (if applicable) and stores them in the session.
 * - Passes these details along with the current URL to the view.
 *
 * For 'layouts.blank', the view composer:
 * - Only extracts and passes the current controller, action, and URL to the view.
 *
 * This setup enhances the views by providing them with contextual data about the current request and user.
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