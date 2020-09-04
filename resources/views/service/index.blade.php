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
                              <th style="width:20%">{{__('nom du Service')}}</th>
                              <th style="width:20%">{{__('Chef Service')}}</th>
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
                                <td>{{ $service->chef_service->nom }} {{ $service->chef_service->prenom }}({{ $service->chef_service->grade->abr_grade }})</td>
                                <td>{{$service->abr_service}}</td>
                                <td>
                                  @if($service->service_pere) 
                                     {{ $service->service_pere->nom_service}}
                                  @endif
                                </td>
                                <td>{{$service->courriers()->count()}}</td>
                                <td >
                                  <button type="button" class="btn btn-success btn-sm" onclick="handleAddElements('{{ $service->id }}')" >
                                    {{ __('Ajouter des éléments') }}
                                  </button>
                                <button type="button" id="editer" class="btn btn-info btn-sm" onclick="handleedit('{{ $service }}' , '{{$service->users}}')" >
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
              <form  action="{{route('service.store')}}" method="post">
                @csrf
                <div class="form-group">
                  <label for="nom_service">{{__('Nom du service')}}</label>
                  <input type="text" name="nom_service" id="nom_service" class="form-control" placeholder="nom du service"  
                                    class="text-muted">
                </div>
                <div class="form-group">
                  <label for="abr">{{__('Abreviation')}}</label>
                  <input type="text" name="abr_service" id="abr" class="form-control" placeholder="Abreviation">
                </div>
                <div class="form-group">
                    <label>{{__('Serevice père')}}</label>
                    <select name="service_id" id = "service_id" class="form-control select2" style="width: 100%;">
                      @foreach ($services as $service)
                          <option value="{{$service->id}}"> {{$service->nom_service}}</option>
                       @endforeach
                    </select>
                  </div>
                <div class="form-group">
                    <label>{{__('Chef service')}}</label>
                    <select  required name="user_id" id = "user_id" class="form-control select2" style="width: 100%;">
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
            <h4 class="modal-title">{{__('Modifier un service')}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="edit_form" action="" method="POST">
            <div class="modal-body">
              @csrf 
              @method('PUT')
              <div class="form-group">
                <label for="nom_service">{{__('Nom du service')}}</label>
                <input type="text" name="nom_service" id="nom_service_e" class="form-control" placeholder="nom du service"  
                class="text-muted">
              </div>
              <div class="form-group">
                <label for="abr">{{__('Abreviation')}}</label>
                <input type="text" name="abr_service" id="abr_e" class="form-control" placeholder="Abreviation">
              </div>
              <div class="form-group">
                <label>{{__('Serevice père')}}</label>
                <select name="service_id" id = "service_id_e" class="form-control select2" style="width: 100%;">
                  @foreach ($services as $service)
                  <option id="option_service-{{$service->service_id}}" value="{{$service->id}}"> {{$service->nom_service}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>{{__('Chef service')}}</label>
                <select  required name="user_id" id = "user_id_e" class="form-control select2" style="width: 100%;">
                </select>
              </div>
              
            </div>
         
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
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
          <form action="" method="post">  
            <button type="submit" class="btn btn-default " data-dismiss="modal">No</button>
          </form>
          <button type="button" class="btn btn-danger ">Oui</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
{{-- modal add elements --}}
<div class="modal fade" id="modal-new_elem">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">{{__('Ajouter des élement')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="post">
        @csrf
        <div class="form-group">
          <label for="nom_service">{{__('Nom du service')}}</label>
          <input type="text" name="nom_service" id="nom_service" class="form-control" placeholder="nom du service"  
                            class="text-muted">
        </div>
        <div class="form-group">
          <label for="abr">{{__('Abreviation')}}</label>
          <input type="text" name="abr_service" id="abr" class="form-control" placeholder="Abreviation">
        </div>
        <div class="form-group">
            <label>{{__('Serevice père')}}</label>
            <select name="service_id" id = "service_id" class="form-control select2" style="width: 100%;">
              @foreach ($services as $service)
                  <option value="{{$service->id}}"> {{$service->nom_service}}</option>
               @endforeach
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


@endsection
<!-- DataTables -->
@section('js')
<script>
   function handleedit( dataa ,users_elements ){
      form = document.getElementById('edit_form');
     var service = JSON.parse(dataa);
     var elements = JSON.parse(users_elements);
     
     form.action = '{{URL::asset('service/')}}'+'/' + service.id;
     form.setAttribute('method', 'PUT');
     console.log(form.action)
     console.log(form.method)
     //console.log(elements);
     document.getElementById('nom_service_e').value = service.nom_service;
     document.getElementById('abr_e').value = service.abr_service;
     // var opt_service = document.getElementById('option_service-'+service.service_id);
     //opt_service.setAttribute('selected' , true);
    
     var select_chef = document.getElementById('user_id_e');
     select_chef.innerHTML = ''
     for(element of elements){
       console.log(element.nom)
        // create new option element
        var opt = document.createElement('option');

        // create text node to add to option element (opt)
        opt.appendChild( document.createTextNode(element.nom + " " + element.prenom) );

        // set value property of opt
        opt.value = element.id; 

        // add opt to end of select box (sel)
        select_chef.appendChild(opt); 
     }
     $('#modal-edit').modal('show')
    }
</script>

@endsection



