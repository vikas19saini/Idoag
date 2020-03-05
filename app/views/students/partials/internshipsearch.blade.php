
<div class="brandoffer_list newinternship_info">

 <div class="main-row row">
        @if(count($internships)>0)
        
        @foreach($internships as $internship)


            @include('brands.partial.internship')

        @endforeach
            @else
                <p class="norecords">No Internships with this keyword.</p>
            @endif
    </div>

</div>