@if (Session::has('error_message') && Session::get('error_message')!='')

    <div class="error_msg">

        <span class="close">{{ HTML::image('assets/images/errorclose_icon.png')}}</span>

        <p>{{ Session::get('error_message') }}</p>

    </div>
@endif

@if (Session::has('flash_message') && Session::get('flash_message')!='')

    <div class="success_msg">
        <span class="close">{{ HTML::image('assets/images/successclose_icon.png')}}</span>


        <p>{{ Session::get('flash_message') }}</p>

    </div>
@endif