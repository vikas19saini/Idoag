@if (Session::has('error_message') && Session::get('error_message')!='' )

        <div class="alert alert-danger">

            {{ Session::get('error_message') }}
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        </div>


@endif

@if (Session::has('flash_message') && Session::get('flash_message')!='')
         <div class="alert alert-success">

        {{ Session::get('flash_message') }}
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        </div>

@endif