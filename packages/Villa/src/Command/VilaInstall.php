<?php

namespace packages\Villa\src\Command;

use App\InstallDefualtCheck;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Setting;
use App\Models\Status;
use App\Models\User;
use Illuminate\Console\Command;

class VilaInstall extends Command
{
    use InstallDefualtCheck;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vila:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'install vila default cms database';

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
     * @return int
     */
    public function handle()
    {
        $defaults = config('vila');

        $dbs = [
            array('name' => 'Status' , 'module'=> null),
            array('name' => 'Permission' , 'module'=> null),
            array('name' => 'Setting' , 'module'=> null),
            array('name' => 'Page' , 'module'=> null),
        ];


        $conditions = [
            ['condition' => 'where' , 'key' => 'type' , 'value' => 3],
            ['condition' => 'whereIn' , 'key' => 'id' , 'value' => [33 , 34 , 35 , 36 , 37  , 38 ,39 , 40 , 41, 42]],
            ['condition' => 'where' , 'key' => 'name' , 'value' => 'residences'],
            ['condition' => 'where' , 'key' => 'slug' , 'value' => 'اقامتگاه-ها'],
        ];

        $res = $this->checking($dbs , $conditions);

        try {
            if ($res['Permission']) {
                foreach ($defaults['permission'] as $permission) {
                    Permission::query()->create($permission);
                }

                $this->info('Permission Vila Create');

                foreach ($defaults['permission_role'] as $perRole) {
                    $role = Role::query()->find($perRole['role_id']);
                    $role->permissions()->attach($perRole['permission_id']);
                }
                $this->info('Attach To Role Admin');
            }

           if ($res['Setting']) {
               foreach ($defaults['settings'] as $key => $setting) {
                   Setting::query()->create([
                       'name' =>$key,
                       'value'=> $setting
                   ]);
               }

               $this->info('Setting add');
           }

            if ($res['Status']) {
                foreach ($defaults['reserve_status'] as $key => $status) {
                    Status::query()->create($status);
                }

                $this->info('Status add');
            }

            if ($res['Page']) {
                foreach ($defaults['pages'] as $page) {
                    $user = User::query()->where('is_admin' , 1)->orderBy('id')->first();
                    $user->pages()->create($page);
                }

                $this->info('Page created');
            }


        } catch (\Exception $exception){
            $this->error("You Have Error: $exception");
        }

    }
}
