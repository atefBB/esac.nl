<?php
/**
 * Created by PhpStorm.
 * User: Niek
 * Date: 14-12-2018
 * Time: 20:30
 */

namespace App\repositories\Declaration;


use App\Model\Declaration\Declaration;
use App\repositories\IRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DeclarationRepository implements IRepository
{

    public function create(array $data)
    {
        $data['date'] = Carbon::createFromFormat('d/m/Y',$data['date']);
        $data['user_id'] = Auth::id();
        return Declaration::create($data);
    }

    public function update($id, array $data)
    {
        $declaration = Declaration::find($id);
        $data['date'] = Carbon::createFromFormat('d/m/Y',$data['date']);

        $declaration->update($data);
        return $declaration;
    }

    public function delete($id)
    {
        Declaration::destroy($id);
    }

    public function find($id, $columns = array('*'))
    {
        // TODO: Implement find() method.
    }

    public function findBy($field, $value, $columns = array('*'))
    {
        // TODO: Implement findBy() method.
    }

    public function all($columns = array('*'))
    {
        // TODO: Implement all() method.
    }
}