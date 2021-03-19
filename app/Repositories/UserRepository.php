<?php


namespace App\Repositories;


use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{

    /**
     * @return User[]|Collection
     */
    public function getAll() {
        return User::all();
    }

    /**
     * @return mixed
     */
    protected function getDisabled() {
        return $this->getAll()->where('disabled','=',1);
    }

    /**
     * @return mixed
     */
    protected function getEnabled() {
        return $this->getAll()->where('disabled','=',0);
    }

    /**
     * @return int
     */
    public function getTotal() {
        return $this->getAll()->count();
    }

    /**
     * @return mixed
     */
    public function getTotalDisabled() {
        return $this->getDisabled()->count();
    }

    /**
     * @return mixed
     */
    public function getTotalEnabled() {
        return $this->getEnabled()->count();
    }
}
