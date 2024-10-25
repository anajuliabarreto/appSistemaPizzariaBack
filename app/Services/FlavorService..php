<?php

// Aqui vai contar a lógica de manipulação de dados, criação, atualização, exclusão e busca de sabores.

namespace App\Services;

use App\Models\Flavor;
use App\Services\Contracts\FlavorServiceInterface;
use App\Http\Enums\TamanhoEnum;

class FlavorService implements FlavorServiceInterface
{
    public function getAll()
    {
        return Flavor::select('id', 'sabor', 'preco', 'tamanho')
            ->paginate(10);
    }

    public function create(array $data)
    {
        return Flavor::create([
            'sabor' => $data['sabor'],
            'preco' => $data['preco'],
            'tamanho' => TamanhoEnum::from($data['tamanho']),
        ]);
    }

    public function findById(string $id)
    {
        return Flavor::find($id);
    }

    public function update(string $id, array $data)
    {
        $flavor = $this->findById($id);
        if ($flavor) {
            $flavor->update($data);
        }
        return $flavor;
    }

    public function delete(string $id)
    {
        $flavor = $this->findById($id);
        if ($flavor) {
            $flavor->delete();
            return true;
        }
        return false;
    }
}
