@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        
                        <div class="container-fluid">
                                <table id="table"  class="table table-bordered table-striped">                                <thead>
                                        <tr>
                                            <th>Usuário</th>
                                            <th>Nome</th>
                                            <th>Sobrenome </th>
                                            <th>E-mail</th>
                                            <th>Gênero</th>
                                            <th>Telefone </th>
                                            <th>S. Social</th>
                                            <th>D. de Nascimento</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                         </div>
              
  
        
       
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="http://cdn.datatables.net/plug-ins/a5734b29083/integration/bootstrap/3/dataTables.bootstrap.css"/>
        <link rel="stylesheet" href="http://cdn.datatables.net/responsive/1.0.2/css/dataTables.responsive.css"/>
        
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.3/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" language="javascript" src="//cdn.datatables.net/responsive/1.0.2/js/dataTables.responsive.js"></script>
        <script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/a5734b29083/integration/bootstrap/3/dataTables.bootstrap.js"></script>
        


        <script type="text/javascript">
    $(document).ready(function () {
           var table = $('#table').DataTable({
                responsive: true,
                lengthChange: true, 
                autoWidth: false,
                processing: true,
                recalc: true,
                ajax:
                  {
                    type:'POST',
                    url: "{{route('home.listar')}}",
                    dataType: 'json',
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                  },
                  language: 
                  {
                        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json"
                  },
                  columnDefs: [{
                        orderable: false,
                        width: '100px', targets: '_all' ,
                    
                      }],
                  columns:
                  [
                      {data: 'username'},
                      {data: 'first_name'},
                      {data: 'last_name'},
                      {data: 'email'},
                      {data: 'gender'},
                      {data: 'phone_number'},
                      {data: 'social_insurance_number'},
                      {data: 'date_of_birth'}
                  ]
              });
             
            });
            
           
          </script>
    
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
