@extends('layouts.panel')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{__('Redirection du Courrier')}}: "{{ $courrier->objet_courrier}}"</h3>

            </div>
            <div class="card-body">
                <form action="{{route('courrier.redirect.go' , $courrier->id)}}" method="POST">
                    @csrf
                    <input type="hidden" name="courrier" value="{{$courrier->id}}">
                    <ul>
                        @foreach (Auth::user()->service->sous_service as $service)
                        <li>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" name="{{$service->id}}" type="checkbox"
                                        id="input{{$service->id}}" value="{{$service->id}}"
                                        @if($courrier->getDests()->contains('id',$service->id))
                                            checked
                                        @endif
                                    />
                                    <label for="input{{$service->id}}"
                                        class="custom-control-label">{{$service->nom_service}}

                                    </label>
                                    <span id="span{{$service->id}}" onclick="showSubService('{{$service->id}}')"><i
                                            class="fa fa-arrow-down" aria-hidden="true"></i></span>

                                </div>
                            </div>
                        </li>
                        <div id="{{$service->id}}" toggle="0" hidden>
                            @include('partials.services')
                        </div>

                        @endforeach
                    </ul>
                    <button type="submit" class="btn btn-success">Envoyer</button>
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
    function showSubService(sous_service){
            var span = document.getElementById("span"+sous_service)
           
        var ss = document.getElementById(sous_service)
        var toggle = ss.getAttribute('toggle')
       // console.log(toggle)
        if(toggle =="0"){
            ss.hidden = false
            toggle="1"
            ss.setAttribute('toggle' , toggle)
            span.innerHTML=' <i class="fa fa-arrow-right" aria-hidden="true"></i>'
            //console.log(toggle)
           }
           else{
            ss.hidden = true
            ss.setAttribute('toggle' , '0')
            span.innerHTML=' <i class="fa fa-arrow-down" aria-hidden="true"></i>'
            //console.log(toggle)
           }
            
        }
</script>
@endsection