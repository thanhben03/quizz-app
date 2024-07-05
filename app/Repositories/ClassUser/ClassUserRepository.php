<?php

namespace App\Repositories\ClassUser;

use App\Http\Traits\ResponseTrait;
use App\Models\ClassUser;
use App\Repositories\BaseRepository;


class ClassUserRepository extends BaseRepository implements ClassUserRepositoryInterface
{
    use ResponseTrait;
    public function getModel()
    {
        return ClassUser::class;
    }


}
