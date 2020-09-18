@extends('layouts.panel')
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
<style>
    .tree, .tree ul {
    margin:0;
    padding:0;
    list-style:none
    }
    .tree ul {
    margin-left:1em;
    position:relative
    }
    .tree ul ul {
    margin-left:.5em
    }
    .tree ul:before {
    content:"";
    display:block;
    width:0;
    position:absolute;
    top:0;
    bottom:0;
    left:0;
    border-left:1px solid
    }
    .tree li {
    margin:0;
    padding:0 1em;
    line-height:2em;
    color:#369;
    font-weight:700;
    position:relative
    }

    .tree ul li:before {
    content:"";
    display:block;
    width:10px;
    height:0;
    border-top:1px solid;
    margin-top:-1px;
    position:absolute;
    top:1em;
    left:0
    }

    .tree ul li:last-child:before {
    background:#fff;
    height:auto;
    top:1em;
    bottom:0
    }

    .indicator {
    margin-right:5px;
    }

    .tree li a {
    text-decoration: none;
    color:#369;
    }

    .tree li button, .tree li button:active, .tree li button:focus {
    text-decoration: none;
    color:#369;
    border:none;
    background:transparent;
    margin:0px 0px 0px 0px;
    padding:0px 0px 0px 0px;
    outline: 0;
    }
</style>
@section('css')



@endsection

@section('content')
  <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="container">     
            <div class="panel panel-primary">
                <div class="panel-heading">Manage Category TreeView</div>
                  <div class="panel-body">
                      <div class="row">
                          <div class="col-md-6">
                              <h3>Category List</h3>
                              <div class="btn-group" data-toggle="buttons">
                            <ul id="tree1">
                                @foreach($services as $service)
                                    <li>
                                        <label class="">
                                            <input type="checkbox" name="" id="" autocomplete="off">
                                            {{ $service->nom_service }}
                                        </label>
                                        @if(count($service->sous_service))
                                            @include('mangeChild',['childs' => $service->sous_service])
                                        @endif
                                    </li>
                                @endforeach
                            </div>

                            </ul>
                          </div>
                      </div>
    
                  </div>
    
            </div>
    
        </div>
        </section>
<!-- /.modal -->
</div>


@endsection
<!-- DataTables -->
@section('js')

@endsection



