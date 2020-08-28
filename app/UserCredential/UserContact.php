<?php

namespace App\UserCredential;

use Illuminate\Database\Eloquent\Model;
use App\UserCredential\Trait\BelongsToUser;

class UserContact extends Model
{
    use BelongsToUser;
}
