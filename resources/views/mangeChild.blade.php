<ul>
    @foreach($childs as $child)
        <li>
                <label class="">
                    {{ $child->nom_service }}
                </label>
        @if($child->sous_service()->count())
                @include('mangeChild',['childs' => $child->sous_service])
            @endif
        </li>
    @endforeach
</ul>