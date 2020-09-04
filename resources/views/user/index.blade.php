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
          <h3 class="card-title">{{__('Utilisateurs')}}</h3>
          <div class="float-right">
            <button type="button" class="btn btn-info " data-toggle="modal" data-target="#modal-new"  >
              {{ __('Nouveau Utilisateur') }}
            </button>
            <button type="button" class="btn btn-success " data-toggle="modal" data-target="#modal-import"  >
              {{ __('Importer') }}
            </button>
          </div>
        </div>
        <div class="card-body">
                 <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 8%">{{__('Grade')}}</th>
                      <th>{{__('Nom')}}</th>
                      <th>{{__('Prenom')}}</th>
                      <th>{{__('Matricule')}}</th>
                      <th style="width:15%">{{__('Service')}}</th>
                      <th>{{__('Nbr Total')}}</th>
                      <th style="width: 30%">{{__('Action')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $index => $user )
                    <tr>
                        <td>{{$user->grade->abr_grade }} </td>
                        <td>{{$user->nom }} </td>
                        <td>{{$user->prenom }} </td>
                        <td>{{$user->matricule }} </td>
                        <td>{{$user->service->abr_service}}</td>
                        <td>{{$user->courriers_envoyer()->count() }} </td>
                        <td >
                  
                          <button type="button" id="editer" class="btn btn-info btn-sm" onclick="handleedit('{{ $user->id }}' , '{{ $user->nom }}')" >
                              {{ __('Editer') }}
                          </button>
                          <button type="button" id="supprimer" class="btn btn-danger btn-sm" onclick="handledelete(' {{ $user->id }} ')">
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
          <h4 class="modal-title">{{__('Ajouter un utilisateur')}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('users.store')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="nom">{{__('Nom')}}</label>
              <input type="text" name="nom" id="nom" required autofocus class="form-control" placeholder="{{__('nom ')}}"  
                                class="text-muted">
            </div>
            <div class="form-group">
              <label for="Prenom">{{__('Prenom')}}</label>
              <input type="text" name="prenom" id="prenom" required autofocus class="form-control" placeholder="{{__('prenom ')}}"  
                                class="text-muted">
            </div>
            
            <div class="form-group">
              <label for="matricule">{{__('Matricule')}}</label>
              <input type="text" name="matricule" id="matricule" required autofocus class="form-control" placeholder="{{__('')}}"  
                                class="text-muted">
            </div>

            <div class="form-group">
              <label>Minimal</label>
              <select class="form-control select2" style="width: 100%;">
                <option selected="selected">Alabama</option>
                <option>Alaska</option>
                <option>California</option>
                <option>Delaware</option>
                <option>Tennessee</option>
                <option>Texas</option>
                <option>Washington</option>
              </select>
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
          <h4 class="modal-title">{{__('Supprimer un utilisateur')}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form id= "supprimer_form" action="" method="post">
            @csrf
            @method('DELETE')
            <div class="modal-body">
                <p>{{__('Etes-vous sûr que vous voulez supprimer ce utilisateur ? ')}}</p>
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
          <h4 class="modal-title">{{__('Modifier un utilisateur')}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form id= "form-edit" action="" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nom">{{__('Nom de utilisateur')}}</label>
                <input type="text" name="nom" id="nom_edit" required autofocus class="form-control text-muted" value=""  >
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

  <div class="modal fade" id="modal-import">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">{{__('Importer des utilisateurs')}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('users.store')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="nom">{{__('Nom de utilisateur')}}</label>
              <input type="text" name="nom" id="nom_service" required autofocus class="form-control" placeholder="{{__('nom de utilisateur')}}"  
                                class="text-muted">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Ignore')}}</button>
                <button type="submit" class="btn btn-primary">{{__('Import')}}</button>
            </div>            
        </form>
        </div>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>



  <script>

      function handleedit(id , nom){
          form = document.getElementById('form-edit');
          form.action = "/utilisateur/"+id;

          field = document.getElementById('nom_edit');
          field.value = nom;

          $('#modal-edit').modal('show');

      }
      function handledelete(id){
          form = document.getElementById('supprimer_form')
          form.action = "/utilisateur/"+id;
          $('#supprimer_modal').modal('show');

      }


  </script>



@endsection
