<?php

namespace App\Console\Commands;

use App\Console\InstallDefualtCheck;
use App\Models\Link;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Setting;
use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class InstallCMS extends Command
{
    use InstallDefualtCheck;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:cms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'install defaults your cms';

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
        $defaults = config('defaults');

        $dbs = [
            array('name' => 'Status' , 'module'=> null),
            array('name' => 'Role' , 'module'=> null),
            array('name' => 'Permission' , 'module'=> null),
            array('name' => 'Setting' , 'module'=> null),
            array('name' => 'Link' , 'module'=> null),
            array('name' => 'User' , 'module'=> null),
            array('name' => 'Post' , 'module'=> null)
        ];

        $keys = array_keys($defaults['settings']);

        $conditions = [
            null,
            null,
            null,
            ['condition' => 'whereIn' , 'key' => 'name' , 'value' => $keys],
            null,
            ['condition' => 'where' , 'key' => 'role_id' , 'value' => 1],
            null
        ];

        $res = $this->checking($dbs , $conditions);

        if ($res['User']) {
            $name = $this->ask('What is your name?');
            $family = $this->ask('What is your family?');
            $username = $this->ask('What is your username?');
            $password = $this->ask('What is your password?');
        }
        try {
            if ($res['Status']) {
                foreach ($defaults['statuses'] as $status) {
                    Status::query()->create($status);
                }

                $this->info('Status create Successful');
            }

            if ($res['Role']) {
                foreach ($defaults['roles'] as $role) {
                    Role::query()->create($role);
                }

                $this->info('Role create Successful');
            }

            if ($res['Permission']) {
                foreach ($defaults['permission'] as $permission) {
                    Permission::query()->create($permission);
                }

                $this->info('Permission create Successful');
            }

            if ($res['Role'] && $res['Permission']) {
                foreach ($defaults['permission_role'] as $pr) {
                    $role = Role::find($pr['role_id']);
                    $role->permissions()->sync($pr['permission_id']);
                }

                $this->info('Permission And Role sync Successful');
            }

            if ($res['Setting']) {
                foreach ($defaults['settings'] as $key => $setting) {
                    Setting::query()->create([
                        'name' => $key,
                        'value' => $setting
                    ]);
                }

                $this->info('setting generate Successful');
            }


            if ($res['Link']) {
                foreach ($defaults['menus'] as $menu) {
                    $link = Link::query()->create([
                        'type' => $menu['type'] , 'used' => $menu['used']
                    ]);
                    foreach ($menu['children'] as $child) {
                        $link->linkContents()->create($child);
                    }
                }

                $this->info('Menus create Successful');
            }
            $user = null;
            if ($res['User']) {
                $user = User::query()->create([
                    'role_id' => 1,
                    'name' => $name,
                    'family' => $family,
                    'username' => $username,
                    'password' => Hash::make($password),
                    'email_verified_at' => Carbon::now(),
                    'phone_verified_at' => Carbon::now(),
                    'status_id' => 1,
                ]);

                $this->info('Admin create successful');
            }
            if ($res['Post']) {
                if (is_null($user))
                    $user = User::query()->where('role_id' , 1)->first();

                foreach ($defaults['posts'] as $page) {
                    $user->posts()->create($page);
                }
                $this->info('Post and Page create Successful');
            }
            $this->info('Command finish successful');
        } catch (\Exception $exception){
            $this->error("You Have Error: $exception");
        }
    }
}
