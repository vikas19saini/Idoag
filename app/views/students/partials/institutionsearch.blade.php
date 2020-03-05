
<div class="mybrandoffer_list">
    <ul>
        @foreach($institutions as $institution)
            @include('institutions.partial.institution')
        @endforeach
    </ul>

</div>