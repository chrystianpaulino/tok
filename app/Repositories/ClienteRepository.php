<?php


namespace App\Repositories;

use App\Models\Cliente;

class ClienteRepository{

    public function all(){
        return Cliente::all();
    }


}
