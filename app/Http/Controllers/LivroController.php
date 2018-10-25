<?php

namespace App\Http\Controllers;
use App\Livro;
use Illuminate\Http\Request;


class LivroController extends Controller
{
	
	public function __construct(){
		header('Access-Control-Allow-Origin: *');
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $livros = Livro::all();
		return response()->json([
				'data' => $livros,
                'status' => true ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
		$livro = Livro::create($data);
		if($livro){
			return response()->json([
				'data' => $livro,
                'status' => true ]);				
		}else{
			return response()->json([
				'data' => 'Erro ao adicionar o livro',
                'status' => false ]);	
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $livro = Livro::find($id);
		return response()->json([
				'data' => $livro,
                'status' => false ]);	
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dados = $request->all();
        $livro = Livro::find($id);        
        if($livro){
            $livro->update($dados);
            return response()->json(['data'=>$livro, 'status'=>true]);
        }else{
            return response()->json(['data'=>'Houve um erro ao realizar a operação', 'status'=>false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$livro = Livro::find($id);
		if($livro){
			$nome = $livro->nome;
			$livro->delete();
				return response()->json(['data'=>$nome.' foi removido', 'status'=>true]);
		}else{
			return response()->json(['data'=>'Houve um erro ao realizar a operação', 'status'=>false]);
		}
    }
}
