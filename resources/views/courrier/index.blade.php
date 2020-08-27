@extends('layouts.panel')

@section('css')
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-12"> 
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ __('Courriers') }}</h3>
                <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#modal-new"  >
                    {{ __('Nouveau Courrier') }}
                  </button>

              </div>



              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>{{ __('N°Depart') }}</th>
                        <th>{{ __('Objet') }}</th>
                        <th>{{ __('Envoyer par') }}</th>
                        <th>{{ __('Date Depart') }}</th>
                        <th>{{ __('...') }}</th>
                        <th>{{ __('Action') }}</th>
                      </tr>
                  </thead>
                  <tbody>
                  
                  <tr>
                    <td>Trident</td>
                    <td>Trident</td>

                    <td> 4</td>
                    <td> 4</td>
                    <td> 
                        <a href="">{{ __('Voir courrier') }}</a>
                    </td>

                    <td >
                
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-edit">
                            {{ __('Editer') }}
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-danger">
                            {{ __('Supprimer ') }}
                        </button>
                    </td>
                  </tr>

                  </tbody>
                  <tfoot>
                    <tr>
                        <th>{{ __('N°Depart') }}</th>

                        <th>{{ __('Objet') }}</th>
                        <th>{{ __('Envoyer par') }}</th>

                        <th>{{ __('Date Depart') }}</th>
                        <th>{{ __('...') }}</th>
                        <th>{{ __('Action') }}</th>
                      </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
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
                <div class="form-group">
                  <label for="nom_service">Nom du service</label>
                  <input type="text" name="nom_service" id="nom_service" class="form-control" placeholder="nom du service"  
                                    class="text-muted">
                </div>
                <div class="form-group">
                  <label for="abr">Abreviation</label>
                  <input type="text" name="abr_service" id="abr" class="form-control" placeholder="Abreviation">
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
                
            </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  </div>


  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">{{__('Editer un courrier')}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('courrier.store')}}" method="post">
            <div class="form-group">
              <label for="nom_service">Nom du service</label>
              <input type="text" name="nom_service" id="nom_service" class="form-control" placeholder="nom du service"  
                                class="text-muted">
            </div>
            <div class="form-group">
              <label for="abr">Abreviation</label>
              <input type="text" name="abr_service" id="abr" class="form-control" placeholder="Abreviation">
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
            
        </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</div>






  <div class="modal fade" id="modal-danger">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">{{__('Supprimer un service')}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                <p>{{__('Etes-vous sûr que vous voulez supprimer ce courrier ? ')}}</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default " data-dismiss="modal">No</button>
          <button type="button" class="btn btn-danger ">Oui</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
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
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>




@endsection



