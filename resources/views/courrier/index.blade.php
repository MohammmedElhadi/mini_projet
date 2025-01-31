@extends('layouts.panel')

@section('css')
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<style>
</style>

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
        <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#modal-new">
          {{ __('Nouveau Courrier') }}
        </button>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>{{__('Objet')}}</th>
              <th>{{__('Expediteur')}}</th>
              <th style="width:8%">{{__('Etat')}}</th>
              <th style="width:8%">{{__('Classement')}}</th>
              <th style="width:8%">{{__('Mention')}}</th>
              <th style="width:8%">{{__('Type')}}</th>
              <th style="width: 30%">{{__('Action')}}</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($courriers as $index => $courrier )
            <tr>
              <td>{{ $courrier->objet_courrier }}</td>
              <td>{{ $courrier->expditeur->nom}}</td>
              <td >@switch($courrier->etat_courrier)
                @case(0)
                <span class="badge  badge-warning">{{__('en attente')}}</span>
                @break

                @case(1)
                <span class="badge  badge-primary">{{__('envoye')}}</span>
                @break

                @default
                <span class="badge  badge-success" onclick="vu_par({{$courrier->seen()->toJson()}})">{{__('vu par')}}</span>
                @endswitch
              </td>
              <td>{{ $courrier->classement->nom_class}}</td>
              <td>{{ $courrier->mention->nom_mention}}</td>
              <td>{{ $courrier->typecourrier->nom_typecourrier}}</td>


              <td>
                @hasanyrole('chef_service|admin')
                
                <button type="button" id="editer" class="btn btn-info btn-sm" onclick="handleedit('{{ $courrier }}')">
                  {{ __('Modifier') }}
                </button>
                @endhasanyrole
                <button type="button" id="supprimer" class="btn btn-danger btn-sm"
                  onclick="handledelete(' {{ $courrier->id }} ')">
                  {{ __('Supprimer ') }}
                </button>
                <button type="button" id="details" class="btn btn-default btn-sm" onclick="handleDetail('{{ $courrier }}' , '{{$courrier->classement->nom_class}}' ,
                        '{{$courrier->mention->nom_mention}}' , '{{$courrier->typecourrier->nom_typecourrier}}' , '{{$courrier->expditeur->nom}}' , '{{$courrier->expditeur->prenom}}' ,
                        '{{$courrier->expditeur->grade->abr_grade}}' ) ">
                  {{ __('Details ') }}
                </button>
                <a href="{{route('courrier.redirect',$courrier->id)}}" type="button" id="redirect" class="btn btn-success btn-sm" ><i class="fa fa-paper-plane" aria-hidden="true"></i>
                </a>
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



<div class="modal fade" id="modal-detail">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">{{__('Details ')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <table class="table table-sm table-striped">
          <tbody>
            <tr>
              <td style="width: 18%">{{__('Objet :')}} </td>
              <td id="objet_detail"></td>
            </tr>
            <tr>
              <td style="width: 18%">{{__('Description :')}} </td>
              <td id="description_detail"></td>
            </tr>
            <tr>
              <td style="width: 18%">{{__('Num du depart :')}} </td>
              <td id="num_depart_detail"></td>
            </tr>
            <tr>
              <td style="width: 18%">{{__('Num d arrive :')}} </td>
              <td id="num_arrive_detail"></td>
            </tr>
            <tr>
              <td style="width: 18%">{{__('Expiditeur :')}} </td>
              <td id="expiditeur_detail"></td>
            </tr>
            <tr>
              <td style="width: 18%">{{__('Distinateurs :')}} </td>
              <td id="distinateur_detail"></td>
            </tr>

            <tr>
              <td style="width: 18%">{{__('Date du depart :')}} </td>
              <td id="date_depart_detail"></td>
            </tr>
            <tr>
              <td style="width: 18%">{{__('Date d arrive :')}} </td>
              <td id="date_arrive_detail"></td>
            </tr>
            <tr>
              <td style="width: 18%">{{__('Etat :')}} </td>
              <td id="etat_detail"></td>
            </tr>
            <tr>
              <td style="width: 18%">{{__('Type :')}} </td>
              <td id="typecourrier_detail"></td>
            </tr>
            <tr>
              <td style="width: 18%">{{__('Classement :')}} </td>
              <td id="classement_detail"></td>
            </tr>
            <tr>
              <td style="width: 18%">{{__('Mention :')}} </td>
              <td id="mention_detail"></td>
            </tr>
            <tr>
              <td style="width: 20%"></td>
              <td><img id="image_detail" style="width: 80%;"></td>
            </tr>
          </tbody>
        </table>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Retour')}}</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">{{__('OK')}}</button>
        </div>
      </div>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-edit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">{{__('Ajouter un courrier')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-edit" action="" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="objet">{{__('Objet')}}</label>
            <input type="text" name="objet" id="objet_edit" required autofocus class="form-control"
              placeholder="{{__('Objet du courrier')}}" value="" class="text-muted">
          </div>
          <div class="form-group">
            <label for="objet">{{__('Description')}}</label>
            <textarea type="text" name="description_edit" id="description_edit" required autofocus class="form-control"
              placeholder="{{__('Description du courrier')}}" value="" class="text-muted"></textarea>
          </div>
          <div class="form-group">
            <label for="date_depart">{{__('date du depart')}}</label>
            <input type="date" name="date_depart" id="date_depart_edit" required autofocus class="form-control"
              placeholder="{{__('date du depart')}}" value="" class="text-muted">
          </div>
          <div class="form-group">
            <label for="date_arrive">{{__('date d arrive')}}</label>
            <input type="date" name="date_arrive" id="date_arrive_edit" required autofocus class="form-control"
              placeholder="{{__('date d arrive')}}" value="" class="text-muted">
          </div>
          <div class="form-group">
            <label for="num_depart">{{__('Num du depart')}}</label>
            <input type="number" name="num_depart" id="num_depart_edit" required autofocus class="form-control"
              placeholder="{{__('Num du depart')}}" value="" class="text-muted">
          </div>
          <div class="form-group">
            <label for="num_arrive">{{__('Num d arrive')}}</label>
            <input type="number" name="num_arrive" id="num_arrive_edit" required autofocus class="form-control"
              placeholder="{{__('Num d arrive')}}" value="2014-02-09" class="text-muted">
          </div>

          <div class="form-group">
            <label for="typecourrier">{{__('Type du courrier')}}</label>
            <select class="form-control" name="typecourrier" id="typecourrier_edit">
              @foreach ($types as $type)
              <option value="{{$type->id}}">{{$type->nom_typecourrier}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="classement">{{__('Classement du courrier')}}</label>
            <select class="form-control" name="classement" id="classement_edit">
              @foreach ($classements as $classement)
              <option value="{{$classement->id}}">{{$classement->nom_class}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="mention">{{__('Mention du courrier')}}</label>
            <select class="form-control" name="mention" id="mention_edit">
              @foreach ($mentions as $mention)
              <option value="{{$mention->id}}">{{$mention->nom_mention}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="source">{{__('Fichier')}}</label>
            <input hidden default="false" id="url_courrier_edit">
            <input class="form-control" type="file" name="source" id="source_edit" accept="image/*">
          </div>
          <div class="form-group">
            <label for="source">{{__('Piece Jointes')}}</label>
            <div id="pj_div"></div>
          </div>

          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Ignore')}}</button>
            <button type="submit" class="btn btn-primary">{{__('Modifier')}}</button>
          </div>
        </form>

      </div>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-new">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">{{__('Ajouter un courrier')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('courrier.store')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="objet">{{__('Objet')}}</label>
            <input type="text" name="objet" id="objet" required autofocus class="form-control"
              placeholder="{{__('Objet du courrier')}}" class="text-muted">
          </div>
          <div class="form-group">
            <label for="description">{{__('Description')}}</label>
            <textarea type="text" name="description_courrier" id="description_courrier" autofocus class="form-control"
              placeholder="{{__('Description du courrier')}}" class="text-muted">
            </textarea>
          </div>

          <div class="form-group">
            <label for="date_depart">{{__('date du depart')}}</label>
            <input type="date" name="date_depart" id="date_depart" required autofocus class="form-control"
              placeholder="{{__('date du depart')}}" class="text-muted">
          </div>
          <div class="form-group">
            <label for="date_arrive">{{__('date d arrive')}}</label>
            <input type="date" name="date_arrive" id="date_arrive" required autofocus class="form-control"
              placeholder="{{__('date d arrive')}}" class="text-muted">
          </div>
          <div class="form-group">
            <label for="num_depart">{{__('Num du depart')}}</label>
            <input type="number" name="num_depart" id="num_depart" required autofocus class="form-control"
              placeholder="{{__('Num du depart')}}" class="text-muted">
          </div>
          <div class="form-group">
            <label for="num_arrive">{{__('Num d arrive')}}</label>
            <input type="number" name="num_arrive" id="num_arrive" required autofocus class="form-control"
              placeholder="{{__('Num d arrive')}}" class="text-muted">
          </div>

          <div class="form-group">
            <label for="typecourrier">{{__('Type du courrier')}}</label>
            <select class="form-control" name="typecourrier" id="typecourrier">
              @foreach ($types as $type)
              <option value="{{$type->id}}">{{$type->nom_typecourrier}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="classement">{{__('Classement du courrier')}}</label>
            <select class="form-control" name="classement" id="classement">
              @foreach ($classements as $classement)
              <option value="{{$classement->id}}">{{$classement->nom_class}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="mention">{{__('Mention du courrier')}}</label>
            <select class="form-control" name="mention" id="mention">
              @foreach ($mentions as $mention)
              <option value="{{$mention->id}}">{{$mention->nom_mention}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="source">{{__('Charger le Courrier')}}</label>
            <input class="form-control" type="file" name="source" id="source" accept="image/*">
          </div>
          <div>
            <label for="source">{{__('Pieces jointes')}}</label><span
              class="badge badge-warning">{{__('Ajouter multiple pieces jointes')}}</span>
            <input multiple class="form-control" type="file" name="piece_jointes[]" id="piece_jointes" accept="image/*"
              placeholder="{{__('Selectioner multiple piece jointes')}}">
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
        <form id="supprimer_form" action="" method="post">
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

<div class="modal fade" id="send_modal">
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

<div class="modal fade" id="vu_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">{{__('Vu par:')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="vu_list">
        
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<script>
  function handleedit(data){
        var courrier = JSON.parse(data);
        var base  = '{{ URL::asset('storage/') }}' +'/' + courrier.url_courrier;
        ajax_get_pjs(courrier.id);
        document.getElementById('objet_edit').value = courrier.objet_courrier;
        document.getElementById('description_edit').value  = courrier.description_courrier;
        document.getElementById('date_depart_edit').value = courrier.date_depart.toString().split(" ")[0];
        document.getElementById('date_arrive_edit').value = courrier.date_arrive.toString().split(" ")[0];
        document.getElementById('num_depart_edit').value = courrier.num_depart;
        document.getElementById('num_arrive_edit').value = courrier.num_arrive;
        document.getElementById('classement_edit').value = courrier.classement_id;
        document.getElementById('mention_edit').value = courrier.mention_id;
        document.getElementById('typecourrier_edit').value = courrier.typecourrier_id;
        //document.getElementById('source_edit').value = courrier.url_courrier;
        form = document.getElementById('form-edit');
        form.action = "/courrier/"+courrier.id;


        $('#modal-edit').modal('show');

    }
    function handleDetail(data,classement,mention,type,nom,prenom,grade_abr){
      var courrier = JSON.parse(data);

        document.getElementById('objet_detail').innerHTML  = courrier.objet_courrier;
        document.getElementById('description_detail').innerHTML  = courrier.description_courrier;
        document.getElementById('date_depart_detail').innerHTML  = courrier.date_depart;
        document.getElementById('date_arrive_detail').innerHTML  = courrier.date_arrive;
        document.getElementById('num_depart_detail').innerHTML  = courrier.num_depart;
        document.getElementById('num_arrive_detail').innerHTML  = courrier.num_arrive;
        document.getElementById('classement_detail').innerHTML  = classement;
        document.getElementById('mention_detail').innerHTML  = mention;
        document.getElementById('typecourrier_detail').innerHTML  = type;
        document.getElementById('objet_detail').innerHTML  = courrier.objet_courrier;
        document.getElementById('expiditeur_detail').innerHTML  = grade_abr + '.' + nom + " " +prenom ;
        switch(courrier.etat_courrier) {
          case 0:
              document.getElementById('etat_detail').innerHTML  = 'en attente';
            break;
          case 1:
              document.getElementById('etat_detail').innerHTML  = 'envoye';
            break;
          case 2:
              document.getElementById('etat_detail').innerHTML  = 'vu par';
            break;
          default:
            // code block
          }
        img =  document.getElementById('image_detail')
        img.src = '{{ URL::asset('storage/') }}' +'/' + courrier.url_courrier;


        console.log('why-----------------------')
        $('#modal-detail').modal('show');

    }
    function handledelete(id){

        form = document.getElementById('supprimer_form')
        form.action = "/courrier/"+id;
        $('#supprimer_modal').modal('show');
    }

    function handlesend(id){
        form = document.getElementById('supprimer_form')
        form.action = "/courrier/"+id;
        $('#send_modal').modal('show');
}


    function handle( id ,courrier_id ){
      var token = $("meta[name='csrf-token']").attr("content");
      $.ajax(
      {
          url: "piecejointes/" +  id,
          type: 'DELETE',
          data: {
              "id": id,
              "_token": token,
          },

      });
             ajax_get_pjs(courrier_id)  
      };

      function add(id){
        $('#add_piecejointe').change(function () { 
          
          var formData =new FormData();
          formData.append('image', $('#add_piecejointe').prop('files')[0]);
          console.log($("meta[name='csrf-token']").attr("content"))

          $.ajax(
            {
            url: "piecejointe",
            type: 'POST',
            data: {
                "id": id,
                "formData" : formData,
                "_token": $("meta[name='csrf-token']").attr("content"),
            },
            processData: false,
            contentType: false,
            cache: false,

            success : function(data){
            console.log('*****************************')
            console.log(data.success)
         }
      });
        });

      };
        // function performClick(elemId) {
        //   var elem = document.getElementById(elemId);
        //   if(elem && document.createEvent) {
        //       var evt = document.createEvent("MouseEvents");
        //       evt.initEvent("click", true, false);
        //       elem.dispatchEvent(evt);
        //   }
        // }



    
    
   


// elhadi /****/*/*/*/*/*/*/*/*/*/*/


function ajax_get_pjs(id){
  div = document.getElementById('pj_div');
  div.innerHTML = '<button disabled id="add_piecejointe_btn" class="btn btn-app" style="width: 8%"><i class="fas fa-plus"></i></button>'
  // alimenter
  $.ajax(
            {
            url: "get_piecejointe/"+id,
            type: 'GET',
            data: {
                "id": id,
                  },
           

            success : function(data){
              for(piece of data){
              img = document.createElement('img');
              a = document.createElement('a');
              i = document.createTextNode('i');
              img.src = '{{ URL::asset('storage/') }}' +'/' + piece.url_piece_jointe;
              img.setAttribute("class","btn btn-app");
              a.innerHTML='<i class="fa fa-window-close" aria-hidden="true"></i>';
              a.setAttribute("onclick", "handle('"+piece.id +"' , '"+ id +"' )");
              div.appendChild(img);
              div.appendChild(a);
            }
         }
      });
}

function show_pjs_modal(id){
  ajax_get_pjs(id);
  $('#piece_jointe_modal').modal('show')
  $('#add_pj_form').on('submit', function (event){
            event.preventDefault();
            $.ajax(
            {
            url: "set_piecejointe/",
            type: 'POST',
            data: {
                "id": id,
                "data": $(this).serialize(),
                },
                processData: false,
                contentType: 'multipart/form-data',
            success : function(data){
              console.log(data.id)
            }


            });
            
      });
  
 
}
function submit_pj(id){
  form = document.getElementById('add_pj_form');
  console.log(form.serialize())
  
 
}


function vu_par(data){
  
  //console.log(data)
  for(i in data )
   //console.log(data[i].nom_service)
  var list = "";
  for(i in data ){
    list = list + "<li>" + data[i].nom_service + "</li>"
  }
  //console.log(list)

  document.getElementById('vu_list').innerHTML = list
   $('#vu_modal').modal('show');
}
</script>
<!-- /.modal -->
</div>









@endsection