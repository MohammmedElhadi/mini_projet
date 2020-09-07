@extends('layouts.panel')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{__('Types des courriers')}}</h3>
          <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#modal-new"  >
            {{ __('Nouveau Type') }}
          </button>
        </div>
        <div class="card-body">
                 <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 8%">#</th>
                      <th>{{__('Nom')}}</th>
                      <th style="width:15%">{{__('Nbr Total')}}</th>
                      <th style="width: 30%">{{__('Action')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($typecourriers as $index => $typecourrier )
                    <tr>
                        <td>{{ $index + 1 }} </td>
                        <td>{{$typecourrier->nom_typecourrier}}</td>
                        <td>{{$typecourrier->courriers()->count()}}</td>
                        <td >
                  
                        <button type="button" id="editer" class="btn btn-info btn-sm" onclick="handleedit('{{ $typecourrier->id }}' , '{{ $typecourrier->nom_typecourrier }}')" >
                              {{ __('Editer') }}
                          </button>
                          <button type="button" id="supprimer" class="btn btn-danger btn-sm" onclick="handledelete(' {{ $typecourrier->id }} ')">
                              {{ __('Supprimer ') }}
                          </button>
                      </td>
                    </tr>
                    @endforeach  
                  </tbody>
                </table>
        </div>
        <!-- /.card-body -->

        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  
  <div class="modal fade" id="modal-new">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">{{__('Ajouter un type du courrier')}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('typecourrier.store')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="nom_typecourrier">{{__('Nom du type ')}}</label>
              <input type="text" name="nom_typecourrier" id="nom_service" required autofocus class="form-control" placeholder="{{__('nom du type')}}"  
                                class="text-muted">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Ignore')}}</button>
                <button type="submit" class="btn btn-primary">{{__('Ajouter')}}</button>
            </div>            
        </form>
        </div>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


  <div class="modal fade" id="supprimer_modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">{{__('Supprimer un type du courrier')}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form id= "supprimer_form" action="" method="post">
            @csrf
            @method('DELETE')
            <div class="modal-body">
                <p>{{__('Etes-vous sûr que vous voulez supprimer ce type du courrier ? ')}}</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default " data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-danger ">Oui</button>
            </div>
        </form>
        </div>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">{{__('Modifier un type du courrier')}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form id= "form-edit" action="" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nom_typecourrier">{{__('Nom du type du courrier')}}</label>
                <input type="text" name="nom_typecourrier" id="nom_typecourrier_edit" required autofocus class="form-control text-muted" value=""  >
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default " data-dismiss="modal">{{__('Ignorer')}}</button>
                <button type="submit" class="btn btn-primary ">{{__('Modifier')}}</button>
            </div>
        </form>
        </div>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!-- /.modal -->



  <script>
    function handleedit(id , nom_typecourrier){
        form = document.getElementById('form-edit');
        form.action = "/typecourrier/"+id;

        field = document.getElementById('nom_typecourrier_edit');
        field.value = nom_typecourrier;

        $('#modal-edit').modal('show');

    }
    function handledelete(id){
        form = document.getElementById('supprimer_form')
        form.action = "/typecourrier/"+id;
        $('#supprimer_modal').modal('show');

    }


  </script>




@endsection
