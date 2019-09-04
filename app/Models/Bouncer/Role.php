<?php

namespace App\Models\Bouncer;

use Silber\Bouncer\Database\Concerns\IsRole;
use Illuminate\Database\Eloquent\Model;

class Role extends Ability
{
    use IsRole;
}
