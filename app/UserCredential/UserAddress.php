<?php

namespace App\UserCredential;

use Illuminate\Database\Eloquent\Model;
use App\UserCredential\Traitable\BelongsToUser;

class UserAddress extends Model
{
    use BelongsToUser;
}
