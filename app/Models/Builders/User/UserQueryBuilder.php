<?php

namespace App\Models\Builders\User;

use Illuminate\Database\Eloquent\Builder;

class UserQueryBuilder extends Builder
{
    use UserBuilderScopes;
}
