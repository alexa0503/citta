<?php

namespace Alix\Cms\Console;

use Illuminate\Console\Command;
use Alix\Cms\Models\Administrator;
use Illuminate\Support\Str;

class CreateAdminCommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'admin:create {name?} {password?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '创建后台账号';

    public function handle()
    {
        $name = $this->argument('name') ?: 'admin';
        $password = $this->argument('password') ?: Str::random(10);
        if ($admin = Administrator::where('name', $name)->first()) {
            $admin->password = bcrypt($password);
        } else {
            $admin = new Administrator();
            $admin->name = $name;
            $admin->password = bcrypt($password);
            $admin->email = $name . '@cms::partialscom';
        }
        $admin->save();
        $this->info($password);
        // if (Administrator::where('name', $name)->count() == 0) {

        // } else {
        //     $this->error('已存在的管理员账户');
        // }
    }
}
