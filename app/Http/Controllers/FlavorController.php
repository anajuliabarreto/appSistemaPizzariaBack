<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlavorCreatRequest;
use App\Services\Contracts\FlavorServiceInterface;
use Illuminate\Http\Request;

/**
 * Class FlavorController
 *
 * @package App\Http\Controllers
 * @author Ana Julia Dias 
 * @link https://github.com/anajuliabarreto
 * @date 2024-10-19 
 * @copyright UniEVANGÉLICA
 */


 /*
    Antes, o FlavorController tinha a lógica de manipulação dos dados de sabores, incluindo o CRUD.
    Depois, eu adicionei o FlavorService com a lógica de negócios relacionada aos sabores.
    
    O controller agora apenas se preocupa em gerenciar as requisições HTTP e a resposta.  
*/


class FlavorController extends Controller
{
    protected $flavorService;

    public function __construct(FlavorServiceInterface $flavorService)
    {
        $this->flavorService = $flavorService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flavors = $this->flavorService->getAll();

        return [
            'status' => 200,
            'message' => 'Sabores encontrados!!',
            'sabores' => $flavors
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FlavorCreatRequest $request)
    {
        $data = $request->validated(); // Use validated() para obter os dados validados

        $flavor = $this->flavorService->create($data);

        return [
            'status' => 200,
            'message' => 'Sabor cadastrado com sucesso!!',
            'sabor' => $flavor
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $flavor = $this->flavorService->findById($id);

        if (!$flavor) {
            return [
                'status' => 404,
                'message' => 'Sabor não encontrado! Que triste!'
            ];
        }

        return [
            'status' => 200,
            'message' => 'Sabor encontrado com sucesso!!',
            'sabor' => $flavor
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validated(); // Utilize validated() para obter dados validados

        $flavor = $this->flavorService->update($id, $data);

        if (!$flavor) {
            return [
                'status' => 404,
                'message' => 'Sabor não encontrado! Que triste!'
            ];
        }

        return [
            'status' => 200,
            'message' => 'Sabor atualizado com sucesso!!',
            'sabor' => $flavor
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = $this->flavorService->delete($id);

        if (!$deleted) {
            return [
                'status' => 404,
                'message' => 'Sabor não encontrado! Que triste!'
            ];
        }

        return [
            'status' => 200,
            'message' => 'Sabor deletado com sucesso!!'
        ];
    }
}
