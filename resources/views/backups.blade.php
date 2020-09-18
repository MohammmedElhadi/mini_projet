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
          <h3 class="card-title">{{__('Backup log')}}</h3>
          <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#modal-new"  >
            {{ __('nouveau BackUp') }}
          </button>
        </div>
        <div class="card-body">
                 <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 8%">#</th>
                      <th>{{__('Fichier')}}</th>
                      <th>{{__('taille (o)')}}</th>
                      <th style="width: 30%">{{__('Action')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (count($files) > 0)
                      @foreach ($files as $index => $file )
                      <tr>
                          <td>{{ $index + 1 }} </td>
                          <td>{{$file}}</td>
                          <td>{{Storage::size($file)}}</td>
                          <td>
                            <a type="button" id="download" class="btn btn-success btn-sm" href="{{ route('backup.telecharger',$index+1) }}" >
                                  {{ __('Telecharger') }}
                            </a>
                            <button type="button" id="supprimer" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-supprimer">
                                  {{ __('Supprimer ') }}
                            </button>
                          </td>
                      </tr>
                      @endforeach  
                    @else
                      <p hidden>"{{ $index = 0}}" </p>
                    @endif

                    
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

  <div class="modal fade" id="modal-supprimer">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">{{__('Supprimer un classement')}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form id= "supprimer_form" action="" method="post">
            @csrf
            @method('DELETE')
            <div class="modal-body">
                <p>{{__('Etes-vous sûr que vous voulez supprimer ce BackUp ? ')}}</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default " data-dismiss="modal">No</button>
            <a href="{{ route('backup.supprimer',$index+1) }}" class="btn btn-danger ">Oui</a>
            </div>
        </form>
        </div>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


  <div class="modal fade" id="modal-new">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">{{__('Nouveau BackUp')}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="modal-body">
                <p>{{__('Etes-vous sûr que vous voulez faire un backup ? ')}}</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default " data-dismiss="modal">No</button>
                <a href=" {{ route('backup.nouveau')}} " class="btn btn-success ">Oui</a>
            </div>
        </div>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>







  <script>
      function handleedit(id , nom_class){
          form = document.getElementById('form-edit');
          form.action = "/classement/"+id;

          field = document.getElementById('nom_class_edit');
          field.value = nom_class;

          $('#modal-edit').modal('show');

      }
      function handledelete(id){
          form = document.getElementById('supprimer_form')
          form.action = "/classement/"+id;
          $('#supprimer_modal').modal('show');
      }


  </script>




@endsection
