@extends('layouts.panel')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{__('Redirection du Courrier')}} "{{ $courrier->objet_courrier}}"</h3>

            </div>
            <div class="card-body">
                <form action="">
                    @foreach (Auth::user()->service->sous_service as $service)
                    <div id="" class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="{{$service->id}}" id=""
                                value="{{$service->id}}" >
                            {{$service->nom_service}}
                        </label>
                        @if($service->sous_service()->count() > 0 )
                        <span onclick="show_sub_services({{$service->id}} , {{$courrier->id}} )">
                            <i class="fa fa-arrow-down" aria-hidden="true"></i>
                        </span>

                        @endif
                    </div>
                    <div id="{{$service->id}}0" hidden class="m-10"></div>
                    @endforeach
                </form>
            </div>
            <!-- /.card-body -->

            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </section>
</div>
@endsection

@section('js')

<script>
    function show_sub_services (id,courrier){
            $.ajax({
            url: "{{URL::asset('/courrier/')}}"+"/"+courrier+"/redirect/sous_services",
            type: 'GET',
            data: {
                "id": id
            },
            success : function(data){
                var html = "";
                for(i = 0 ; i < data.length ; i++){
                   // console.log(data[i])
                   j= i+1
                   divId = id+""+j;
                    console.log(divId)
                   html =  '<div id="" class="form-check">'+
                        '<label class="form-check-label">'+
                           '<input type="checkbox" class="form-check-input" name="'+data[i].id+'" id="" value="checkedValue" >'+
                           data[i].nom_service+
                        '</label>'
                    if(data[i].nombre_sous_service>0){
                        html = html + '<span onclick="show_sub_services('+data[i].id+','+courrier+')">'+
                            '<i class="fa fa-arrow-down" aria-hidden="true"></i>'+
                        '</span>'+
                    '</div>'+
                    '<div id="'+data[i].id+divId+'" hidden class="m-10"></div>';}
                    newId = id+""+i
                    console.log(newId)
                    document.getElementById(newId).hidden = false;
                    document.getElementById(newId).innerHTML=html;          
              }
            },
         })

         
            // {
            // url: "courrier/"+courrier+"redirect/sous_services",
            // type: 'GET',
            // data: {
            //     "id": id
            // }
               
            // success : function(data){
            //   console.log(data)
            // }


            // });
    }

</script>

@endsection