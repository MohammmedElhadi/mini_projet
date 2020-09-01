@extends('layouts.panel')

@section('css')
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->


  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">{{__('Courriers')}}</h3>
        <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#modal-new"  >
          {{ __('Nouveau Courrier') }}
        </button>
      </div>
      <div class="card-body">
               <table class="table table-bordered">
                <thead>                  
                  <tr>
                    <th style="width: 8%">#</th>
                    <th>{{__('Objet')}}</th>
                    <th>{{__('Expediteur')}}</th>
                    <th style="width:15%">{{__('Etat')}}</th>
                    <th style="width: 30%">{{__('Action')}}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($courriers as $index => $courrier )
                  <tr>
                      <td>{{ $index + 1 }} </td>
                      <td>{{ $courrier->objet_courrier }}</td>
                      <td>{{ $courrier->expditeur->nom}}</td>
                      <td>{{ $courrier->etat_courrier}}</td>
                      <td >
                
                      <button type="button" id="editer" class="btn btn-info btn-sm" onclick="handleedit('{{ $courrier->id }}' , '{{ $courrier->nom_class }}')" >
                            {{ __('Editer') }}
                        </button>
                        <button type="button" id="supprimer" class="btn btn-danger btn-sm" onclick="handledelete(' {{ $courrier->id }} ')">
                            {{ __('Supprimer ') }}
                        </button>
                        <button type="button" id="details" class="btn btn-default btn-sm" onclick="">
                          {{ __('Details ') }}
                        </button>
                        <button type="button" id="redirect" class="btn btn-success btn-sm" onclick="">
                          {{ __('Redirect ') }}
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





<div class="modal fade" id="modal-new">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">{{__('Ajouter un courrier')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{route('courrier.store')}}" method="post">
          @csrf
          <div class="form-group">
            <label for="nom_class">{{__('Nom de courrier')}}</label>
            <input type="text" name="nom_class" id="nom_service" required autofocus class="form-control" placeholder="{{__('nom de courrier')}}"  
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
        <h4 class="modal-title">{{__('Supprimer un courrier')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id= "supprimer_form" action="" method="post">
          @csrf
          @method('DELETE')
          <div class="modal-body">
              <p>{{__('Etes-vous sûr que vous voulez supprimer ce courrier ? ')}}</p>
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
        <h4 class="modal-title">{{__('Modifier un courrier')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id= "form-edit" action="" method="post">
          @csrf
          @method('PUT')
          <div class="form-group">
              <label for="nom_class">{{__('Nom de courrier')}}</label>
              <input type="text" name="nom_class" id="nom_class_edit" required autofocus class="form-control text-muted" value=""  >
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





<script>
    function handleedit(id , nom_class){
        form = document.getElementById('form-edit');
        form.action = "/courrier/"+id;

        field = document.getElementById('nom_class_edit');
        field.value = nom_class;

        $('#modal-edit').modal('show');

    }
    function handledelete(id){
        form = document.getElementById('supprimer_form')
        form.action = "/courrier/"+id;
        $('#supprimer_modal').modal('show');
    }


</script>
  <!-- /.modal -->
</div>


<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('lugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<!-- page script -->
<script>
    form = document.getElementById("")
</script>




@endsection



