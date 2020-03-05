@if (Session::has('error_message') && Session::get('error_message')!='')
                                
   <div class="alert alert-danger" role="alert">

        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
        <strong>Oops!</strong> {{ Session::get('error_message') }}
            
    </div>
    
@endif

@if (Session::has('flash_message') && Session::get('flash_message')!='')
        
   <div class="alert alert-success" role="alert">

        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
        <strong>Yay!</strong> {{ Session::get('flash_message') }}
            
    </div>
    
@endif