<ul>
    @foreach ($service->sous_service as $service)
    <li>
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" name="{{$service->id}}" type="checkbox" id="input{{$service->id}}"
                @if($courrier->getDests()->contains('id',$service->id))
                checked
                @endif    
                value="{{$service->id}}">
                <label  for="input{{$service->id}}" class="custom-control-label">{{$service->nom_service}}</label>
                @if($service->sous_service()->count() > 0) <span id = "span{{$service->id}}" onclick ="showSubService('{{$service->id}}')"><i class="fa fa-arrow-down" aria-hidden="true"></i></span>@endif
            </div>
        </div>

    </li>
    <div id="{{$service->id}}" toggle="0" hidden>
        @include('partials.services')
    </div>
    @endforeach
</ul>