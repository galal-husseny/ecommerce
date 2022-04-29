<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PermissionGenerator;
use Spatie\Permission\Models\Permission;

class PermissionsUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command To Update All Permissions in DB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try{
            $controllers_permissions = (new PermissionGenerator)->generate()->exceptNamespaces(["App\Http\Controllers\Admin\Auth"])->get();
            foreach($controllers_permissions AS $controller => $permissions){
                foreach($permissions AS $permission){
                    Permission::updateOrCreate(['name'=>"{$permission} {$controller}",'guard_name'=>'admin','controller'=>$controller],[
                        'name',
                        'guard_name',
                        'controller'
                    ]);
                }
            }
            $this->info("Pemissions Updated Successfully");
        }catch(\Exception $e){
            $this->error("Something Went Wrong {$e->getMessage()}");
        }
    }
}
