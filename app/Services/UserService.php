<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Collection;

class UserService extends BaseService
{

    const NOT_FOUND_MSG = 'User doesn\'t exists.';

    public function all(): Collection
    {
        return User::with(['projects', 'company:id,name'])->get();
    }

    public function create($userData): User
    {
        $user = User::create($userData);
        $user->createToken('MyApp')->plainTextToken;

        return $user;
    }

    public function show($id): User
    {
        $user = User::find($id);
        if (empty($user)) throw new \Exception(self::NOT_FOUND_MSG);

        return $user;
    }

    public function update($userData, $id): User
    {
        $user = User::find($id);
        if (empty($user)) throw new \Exception(self::NOT_FOUND_MSG);

        $user->update($userData);
///check roles
        return $user;
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($this->ifNotExists($user)) throw new \Exception(self::NOT_FOUND_MSG);

        $user->projects()->detach();

    }
}
