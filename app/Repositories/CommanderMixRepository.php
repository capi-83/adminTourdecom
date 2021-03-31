<?php


namespace App\Repositories;


use App\Models\CommanderMix;
use Illuminate\Database\Eloquent\Collection;

class CommanderMixRepository
{
    public function getAll()
    {
        return CommanderMix::all();
    }

    public function getNumberCommander()
    {
        return $this->getAll()->count();
    }

    public function getById($id)
    {
        return CommanderMix::find($id);
        //return CommanderMix::where('id', $id)->get(); 
    }
}