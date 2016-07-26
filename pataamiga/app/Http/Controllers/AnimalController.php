<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Animal;
use App\Models\Cliente;
use App\Models\Raca;
use App\Models\Especie;
use App\Models\Porte;
use App\Models\Cor;

class AnimalController extends Controller
{
     public function index(){


        $Listar= Animal::with('cliente')->get();
       
        $cliente = Cliente::all();
        $racas = Raca::all();
        $especie = Especie::all();
        $porte = Porte::all();
        $cor = Cor::all();
        

    	return view('animal.index',['animais'=>$Listar, 'clientes'=>$cliente , 'racas' =>$racas, 'especies'=>$especie,'portes'=>$porte, 'cores'=>$cor]);
    } 

    public function novo(){
    
        $cliente = Cliente::all();
        $racas = Raca::all();
        $especie = Especie::all();
        $porte = Porte::all();
        $cor = Cor::all();


    	return view ('animal.novoAnimal', ['clientes'=>$cliente , 'racas' =>$racas, 'especies'=>$especie, 'portes' =>$porte, 'cores' =>$cor]);
    }

    public function salvar(Request $request){
        $DadosAnimal= $request->all();
        
        //depois inserir o validador de dados, ou por um no html, pois o mesmo esta dando erro.
        $Animal = Animal::create($DadosAnimal);
        return redirect('animais');
    }

    public function pesquisar(){
    	return view ('animal.pesquisarAnimal');

    }


    public function alterar($id){
        $cliente = Cliente::all();
        $animals = Animal::find($id);
        
        #dd($animals);
    	return view ('animal.alterarAnimal', ['animals' => $animals ,'clientesok'=>$cliente]);
    }

    public function update(Request $request){
        $DadosUpdate = $request->all();
        $cod_animal= $DadosUpdate['cod_animal'];
        unset($DadosUpdate['_token']);
        unset($DadosUpdate['cod_animal']);
        #dd($DadosUpdate);

        Animal::where('cod_animal', $cod_animal)->update($DadosUpdate);

        return redirect('animais');

    }


}
