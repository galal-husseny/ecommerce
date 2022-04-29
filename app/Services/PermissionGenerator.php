<?php
namespace App\Services;

use Illuminate\Support\Facades\Route;

class PermissionGenerator {
    private array $perimssions = [];
    public function generate()
    {
        foreach(Route::getRoutes() AS $route){
            $action = $route->getAction();
            if(array_key_exists('controller',$action) && !in_array('api',$action['middleware'])
            && str_starts_with($action['controller'],"App\Http\Controllers\Admin") && str_contains($action['controller'],"@")){
                $actionArray = explode('@',$action['controller']);
                $controller = $actionArray[0];
                $method = $actionArray[1];
                $this->perimssions[$controller][] = $method;

            }
        }
        return $this;
    }

    public function exceptNamespaces(array $namespaces)
    {
        foreach ( $this->perimssions AS $fullNamespace => $methods){
            //App\Http\Controllers\Admin\BrandsController
            foreach( $namespaces AS $namespace){
                if(str_starts_with($fullNamespace,$namespace)){
                    unset($this->perimssions[$fullNamespace]);
                }
            }
        }
        return $this;
    }

    public function exceptControllers(array $controllers)
    {
        foreach ( $controllers AS $controller){
            if(array_key_exists($controller,$this->perimssions)){
                unset($this->perimssions[$controller]);
            }
        }
        return $this;
    }

    public function getFullNamespace()
    {
        return $this->perimssions;
    }

    public function get()
    {
        $permissions = [];
        foreach($this->perimssions AS $fullNamespace => $methods){
            $permissions[str_replace("Controller","",last(explode('\\',$fullNamespace)))] = $methods;
        }
        return $permissions;
    }
}
