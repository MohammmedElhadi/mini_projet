@extends('layouts.panel')

@section('css')
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection

@section('content')
  <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
          <div class="row">
            <div class="col-12"> 
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">{{__('services')}}</h3>
                  <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#modal-new"  >
                    {{ __('Nouveau service') }}
                  </button>
                </div>
                <div class="card-body">
                        <table class="table table-bordered">
                          <thead>                  
                            <tr>
                              <th style="width: 8%">#</th>
                              <th style="width:40%">{{__('nom du Service')}}</th>
                              <th style="width:8%">{{__('Abreviation')}}</th>
                              <th style="width:8%">{{__('Service père')}}</th>
                              <th style="width:8%">{{__('nbr de courriers')}}</th>
                              <th style="width: 15%">{{__('Action')}}</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($services as $index => $service )
                            <tr>
                                <td>{{ $index + 1 }} </td>
                                <td>{{$service->nom_service}}</td>
                                <td>{{$service->abr_service}}</td>
                                <td>
                                  @if($service->service_pere) 
                                     {{ $service->service_pere->nom_service}}
                                  @endif
                                </td>
                                <td>{{$service->courriers()->count()}}</td>
                                <td >
                          
                                <button type="button" id="editer" class="btn btn-info btn-sm" onclick="handleedit('{{ $service->id }}' , '{{ $service->nom_class }}')" >
                                      {{ __('Editer') }}
                                  </button>
                                  <button type="button" id="supprimer" class="btn btn-danger btn-sm" onclick="handledelete(' {{ $service->id }} ')">
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
                <h4 class="modal-title">{{__('Ajouter un service')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form action="{{route('service.store')}}" method="post">
                @csrf
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
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
              </form>
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
            <h4 class="modal-title">{{__('Editer un service')}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form action="{{route('service.store')}}" method="post">
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
                <p>{{__('Etes-vous sûr que vous voulez supprimer ce service ? ')}}</p>
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
@endsection
<!-- DataTables -->
@section('js')


@endsection



