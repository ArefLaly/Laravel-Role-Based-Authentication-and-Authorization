<?php
namespace App\Repository\implementation;

use App\Models\User;
use App\Repository\implementation\BaseRepository;
use App\Repository\interfaces\IUserRepository;

class UserRepository extends BaseRepository implements IUserRepository{
    public function __construct(User $model)
    {
        parent::__construct($model); // Inject the model that you need to build queries from
    }
    public function test()
    {
    return "as";
    }

}