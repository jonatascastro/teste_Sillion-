@extends('adminlte::page')

@section('title','Look Oferta')
@section('imgs','logo_img')

@section('content_header')

    <h1>Dashboard</h1>
@stop
@section('content')
 
<div class="card">
        <div class="card-header">
            <div class="row">
                  <div class="col-md-12">
                    
                  @if(!empty($mensagem))
                        <div class="{{$tipo_mensagem}}">
                            <p>{{$mensagem}}</p>
                        </div>
                   @endif
                  @if(!empty($query))
                    <!-- general form elements -->
                    <div class="card-body">
                    
                                <form method="POST" action="{{route('home.update')}}">
                                @csrf <!-- Adiciona um campo de token CSRF para proteção -->
                               
                                    <div class="form-group">
                                        <label for="produto">Nome</label>
                                        <input type="hidden" class="form-control" value="{{$query->id}}"  id="id" name="id" placeholder="Nome">
                                        <input type="text" class="form-control" value="{{$query->nome}}"  id="nome" name="nome" placeholder="Nome">
                                      </div>
                                      <div class="form-group">
                                        <label for="produto">E-mail</label>
                                        <input type="email" class="form-control" value="{{$query->email}}"  id="email" name="email" placeholder="E-mail">
                                      </div>
                                      <div class="form-group">
                                        <label for="telefone">CPF</label>
                                        <input type="text" class="form-control" value="{{$query->cpf}}" name="cpf"  id="cpf" placeholder="CPF">
                                      </div>
                                      <div class="form-group">
                                        <label for="periodo"> Data de filiação</label>
                                        <input type="text" class="form-control" name="periodo" value="{{$query->periodo}}" id="periodo" placeholder="Data de filiação">
                                      </div>
                                      <div class="form-group">
                                        <label for="valor">Valor</label>
                                        <input type="text" class="form-control" name="valor" value="{{$query->valor}}" id="valor" placeholder="valor da anuidade">
                                      </div>
                                      <div class="form-group">
                                        <label for="valor">Observação</label>
                                            <select class="form-select form-control" name="obs" id="obs" aria-label="Default select example">
                                            
                                                @if($query->obs ==1)
                                                <option value="1" selected >Pago</option>
                                                <option value="2" >Pêndencia</option>     
                                                <option  value="0" >Selecione</option>            
                                                @elseif($query->obs ==2)
                                                <option value="2" selected>Pêndencia</option>
                                                <option value="1"  >Pago</option>
                                                <option  value="0" >Selecione</option> 
                                                @else
                                                <option  value="0" >Selecione</option> 
                                                <option value="1"  >Pago</option>
                                                <option value="2" >Pêndencia</option>
                                               
                                                @endif
                                            </select>
                                      </div>  
                                      <div class="form-group">
                                        <label for="valor">Total pago</label>
                                        <input type="text" class="form-control mb-2 bg-success" name="total" value="R$ {{$soma_paga}}" id="total" disabled>
                                      </div>       
                                      <div class="form-group">
                                        <label for="valor">Total pendência</label>
                                        <input type="text" class="form-control bg-danger " name="soma_devendo" value="R$ {{$soma_devendo}}" id="soma_devendo" disabled>
                                      </div>                              
                                        <button type="submit" class="btn btn-success">Enviar</button> 
                            </form>
                        </div>
                      @endif
                    
                       </div>

                    </div>
                </div>
            </div>
     

@endsection

@section('css')


@stop

@section('js')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script type="text/javascript">

$(function() {

   
 $("#valor").mask('000.000.000.000.000,00', {reverse: true});



  $('#periodo').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Fechar'
      }
  });

  $('#periodo').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY  HH:mm:ss') + ' - ' + picker.endDate.format('MM/DD/YYYY  HH:mm:ss'));
  });

  $('#periodo').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

});
</script>
@stop


