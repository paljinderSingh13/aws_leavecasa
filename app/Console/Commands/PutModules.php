<?php

namespace App\Console\Commands;

use App\Model\Administrator\Accounts\Module;
use Illuminate\Console\Command;

class PutModules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:save';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To put all modules in database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $routes = \Route::getRoutes();
        $modulesArray = [];
        foreach($routes->getRoutes() as $key => $route) {
            if(@$route->action['module'] != null){
                if(!in_array($route->action['module'], $modulesArray)){
                    $modulesArray[] = $route->action['module'];
                }
            }
        }
//        Module::query()->truncate();
        foreach($modulesArray as $key => $module) {
            $model = Module::where('module_slug','like','%'.$module.'%')->first();
            if($model == null){
                $model = new Module;
            }
            $model->module_name = ucwords(str_replace('-', ' ', $module));
            $model->module_slug = $module;
            $model->save();
        }
        $this->info('Module Updated Successfully');
    }
}
