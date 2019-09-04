<?php

use \Bouncer as Bouncer;
use App\Models\User;
use App\Models\Member;
use App\Models\Record;
use App\Models\SpecialOffering;
use App\Models\Bouncer\Role;
use App\Models\Bouncer\Ability;
use Illuminate\Database\Seeder;

class BouncerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bouncer::allow('superadmin')->toOwnEverything();

        Bouncer::allow('admin')->everything();
        Bouncer::forbid('admin')->toManage(User::class);
        Bouncer::forbid('admin')->toManage(Role::class);
        Bouncer::forbid('admin')->toManage(Ability::class);

        Bouncer::allow('checker')->toOwn(Record::class)->to(['view', 'update']);
        Bouncer::allow('checker')->toOwn(Member::class)->to(['view', 'update']);
        Bouncer::forbid('checker')->toManage(User::class);
        Bouncer::forbid('checker')->toManage(Role::class);
        Bouncer::forbid('checker')->toManage(Ability::class);

        Bouncer::allow('maker')->toOwn(Record::class)->to(['view', 'create', 'update']);
        Bouncer::allow('maker')->toOwn(Member::class)->to(['view', 'create', 'update']);
        Bouncer::forbid('maker')->toManage(User::class);
        Bouncer::forbid('maker')->toManage(Role::class);
        Bouncer::forbid('maker')->toManage(Ability::class);
    }
}
