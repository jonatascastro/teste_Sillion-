<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\cadastro;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
    
        $response = json_decode(file_get_contents('https://random-data-api.com/api/v2/users?size=100'));

        $quant= count($response);
         
        return view('home', compact('quant'));
    }
    public function create(Request $request)
    {
  
        return view('cadastro');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|min:5',
            'email' => 'required|min:5',
            'cpf' => 'required|min:5',
            'periodo' => 'required|min:5',   
            'valor' => 'required|min:5',           
            // Other validation rules here
        ]);
      
        if ($validator->fails()) 
        {
            $tipo_mensagem="alert alert-danger";
            $mensagem="Favor verificar todos os campos!";
            return view('cadastro', compact('mensagem','tipo_mensagem'));
        }

        $tipo_mensagem="alert alert-success"; 
        $mensagem="Dados salvos com sucesso";


        $query= new cadastro;
        $query->nome=$request->nome;
        $query->email=$request->email;
        $query->cpf=$request->cpf;
        $query->periodo=$request->periodo;
        $query->valor=$request->valor;
        $query->obs='0';
        $query->save();

        $query= cadastro::get();
        $quant= $query->count();
        
        return view('home', compact('mensagem','tipo_mensagem','quant'));
    }

    public function delete($id)
    {
        $query= cadastro::find($id);     
        $query->delete();

        $total= cadastro::get();
        $quant= $total->count();
        $tipo_mensagem="alert alert-success"; 
        $mensagem="Dados salvos com sucesso";
        return view('home', compact('mensagem','tipo_mensagem',"quant"));
    }

    public function edit($id)
    {
        $soma="";
        $total="";
    
        $query= cadastro::find($id);
        $soma_paga= number_format(cadastro::select('valor')->where('obs',1)->where('cpf',$query->cpf)->sum("valor"),3);  
        $soma_devendo= number_format(cadastro::select('valor')->where('obs',2)->where('cpf',$query->cpf)->sum("valor"),3);  
  
        if(empty($id))
        {
            $tipo_mensagem="alert alert-danger";
            $mensagem="Favor verificar todos os campos!";
            return view('edit', compact('query','soma_paga','mensagem','tipo_mensagem','soma_devendo'));
        }
        return view('edit', compact('query','soma_paga','soma_devendo'));
    }

    public function update(Request $request)
    {
        $query="";
        $soma="";
      
        $validator = \Validator::make($request->all(), [
            'nome' => 'required|min:5',
            'email' => 'required|min:5',
            'cpf' => 'required|min:5',
            'periodo' => 'required|min:5',   
            'valor' => 'required|min:5', 
            'obs'  => 'required|min:1',    
            'id' =>'required|min:1',     
            // Other validation rules here
           
        ]);

        $query= cadastro::find($request->id);
        $soma_paga= number_format(cadastro::select('valor')->where('obs',1)->where('cpf',$query->cpf)->sum("valor"),3);  
        $soma_devendo= number_format(cadastro::select('valor')->where('obs',2)->where('cpf',$query->cpf)->sum("valor"),3);  
    
        if ($validator->fails()) 
        {
            $tipo_mensagem="alert alert-danger";
            $mensagem="Favor verificar todos os campos!";

            return view('edit', compact('query','soma_paga','mensagem','tipo_mensagem','soma_devendo'));
        }           
        $tipo_mensagem="alert alert-success"; 
        $mensagem="Dados salvos com sucesso";
        $query->delete();

        $query= new cadastro;
        $query->nome=$request->nome;
        $query->email=$request->email;
        $query->cpf=$request->cpf;
        $query->periodo=$request->periodo;
        $query->valor=$request->valor;
        $query->obs=$request->obs;
        $query->save();

        return view('edit', compact('query','soma_paga','mensagem','tipo_mensagem','soma_devendo'));
    }
    public function listar(Request $request)
    {
        
        $data = json_decode(file_get_contents('https://random-data-api.com/api/v2/users?size=100'));

        return Datatables::of($data)
        ->addColumn('username', function($data)
        {
            return  $data->last_name;
        })
        ->addColumn('first_name', function($data)
        {
            return  $data->first_name;
        })
        ->addColumn('last_name', function($data)
        {
            return  $data->last_name;
        })
    
        ->addColumn('email', function($data)
        {
            return $data->email;
        })
        ->addColumn('gender', function($data)
        {
            return $data->gender;
        })
        ->addColumn('phone_number', function($data)
        {
            return $data->phone_number;
        })
        ->addColumn('social_insurance_number', function($data)
        {
            return $data->social_insurance_number;
        })
        ->addColumn('date_of_birth', function($data)
        {
            return date('d-m-Y', strtotime($data->date_of_birth));
        })
        ->make(true);
    }
}
