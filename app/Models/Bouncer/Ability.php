<?php

namespace App\Models\Bouncer;

use Silber\Bouncer\Database\Concerns\IsAbility;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use IsAbility;
}
