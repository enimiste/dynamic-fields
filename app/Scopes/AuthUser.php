<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AuthUser implements Scope {

    /** @var int */
    protected $userId;

    function __construct(int $userId) {
        $this->userId =  $userId;
    }

    function apply(Builder $builder, Model $model) {
        $builder->where('user_id', '=', $this->userId);
    }
}
