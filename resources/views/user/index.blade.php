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
                  
                        <button type="button" id="editer" class="btn btn-info btn-sm" onclick="handleedit('{{ $user }}')" >
                              {{ __('Editer') }}
                          </button>
                          <button type="button" id="supprimer" class="btn btn-danger btn-sm" onclick="handledelete(' {{ $user->id}} ')">
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
              <input type="text" name="matricule" id="matricule" required autofocus class="form-control" placeholder="{{__('matricule')}}"  
                                class="text-muted">
            </div>


            <div class="form-group">
              <label>{{__('Grade')}}</label>
              <select name="grade" class="form-control select2" style="width: 100%;">
                @foreach ($grades as $grade)
                  <option value="{{$grade->id}}" selected="selected">{{ $grade->nom_grade }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>{{__('Service')}}</label>
              <select name="service" class="form-control select2" style="width: 100%;">
                @foreach ($services as $service)
                  <option  value="{{$service->id}}" selected="selected">{{ $service->nom_service }}</option>
                @endforeach
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
                <label for="nom">{{__('Nom')}}</label>
                <input type="text" name="nom_edit" id="nom_edit" required autofocus class="form-control text-muted" value=""  >
            </div>
            <div class="form-group">
                <label for="prenom">{{__('Prenom')}}</label>
                <input type="text" name="prenom_edit" id="prenom_edit" required autofocus class="form-control text-muted" value=""  >
            </div>
            <div class="form-group">
                <label for="matricule">{{__('Matricule')}}</label>
                <input type="text" name="matricule_edit" id="matricule_edit" required autofocus class="form-control text-muted" value=""  >
            </div>

            <div class="form-group">
              <label for="grade">{{__('Grade')}}</label>
              <select class="form-control" name="grade_edit" id="grade_edit">
                @foreach ($grades as $grade)
                  <option value="{{$grade->id}}">{{$grade->nom_grade}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="service">{{__('Service')}}</label>
              <select class="form-control" name="service_edit" id="service_edit">
                @foreach ($services as $service)
                  <option value="{{$service->id}}">{{$service->nom_service}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="email">{{__('Email')}}</label>
              <input type="text" name="email_edit" id="email_edit" required autofocus class="form-control text-muted" value=""  >
          </div>
          <div class="form-group">
            <label for="telephone">{{__('Telephone')}}</label>
            <input type="text" name="telephone_edit" id="telephone_edit" autofocus class="form-control text-muted" value=""  >
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
        <form action="{{route('users.import')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="nom">{{__('Fichie exel')}}</label>
              <input type="file" name="file_exel" id="file_exel" required autofocus class="form-control" accept=".xlsx,.csv" placeholder="{{__('Fichie exel')}}"  
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






      function handleedit(data){
        var user = JSON.parse(data);
        console.log(user);
        document.getElementById('nom_edit').value = user.nom;
        document.getElementById('prenom_edit').value  = user.prenom;
        document.getElementById('matricule_edit').value = user.matricule;
        document.getElementById('grade_edit').value = user.grade_id;
        document.getElementById('service_edit').value = user.service_id;
        document.getElementById('email_edit').value = user.email;
        document.getElementById('telephone_edit').value = user.telephone;
        
        form = document.getElementById('form-edit');
        form.action = "/users/"+user.id;
        $('#modal-edit').modal('show');

      }
      function handledelete(id){

          form = document.getElementById('supprimer_form')
          form.action = "/users/"+id;
          $('#supprimer_modal').modal('show');

      }


  </script>



@endsection
