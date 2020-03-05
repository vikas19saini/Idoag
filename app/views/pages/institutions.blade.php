@extends('layouts.default')

@section('title','Institute Partners - View and Follow Institutes and Colleges Connected with IDOAG |idoag.com')
@section('metatags')
    <meta name="keywords" content="Institute Partners - View and Follow Institutes and Colleges Connected with IDOAG |idoag.com" />
    <meta name="description" content="Institute Partners - View and Follow Institutes and Colleges Connected with IDOAG |idoag.com" />
@stop

@section('css')

@stop

@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->
        @include('partials.flash')
        <div class="search_info">
            
            <div class="container_info">
                <input type="text" class="form-control offersearch_icon"  id="search_input" value="" placeholder="Search for Institutions and companies">
			</div>

        </div>

        <div class="brandoffer_info institutionoffer_info">
            
            <div class="container_info">
            
                <div class="brandoffer_contleft">
            
                    <div class="original_result ">
            
                        <div class="mybrandoffer_list">

                            @if(count($institutions)>0)
                            
                                <ul>
                                    @foreach($institutions as $institution)
                                        @include('institutions.partial.institution')
                                    @endforeach
                                </ul>
                            @else
                                <div class="allnotfund_msg">
                                    <div class="allnotfund_msgleft brands_errorleft">{{ HTML::image('assets/images/institutions_errorimg.png')}} </div>
                                    <div class="allnotfund_msgright brands_errorright">
                                        <p><span class="bold_msg"> We are in the process of adding new Institutions on IDOAG.</span><br/>
                                            Kindly bear with us for sometime and we will notify you once this is active.</p>
                                    </div>
                                </div>

                            @endif

                        </div>

                    </div>

                    <div class="search_result"> </div>
					<br/>	<br/>	 

                </div>


                <div class="notice_feed_info">

                    <div class="brandsnearyou_info">

                         @include('partials.ad')

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop

@section('js')

    <script>

        $(document).ready(function() {

            var timer;

            $("#search_input").keyup(function(){

                var keywords = $('#search_input').val();

                timer = setTimeout(function()
                {

                    if(keywords.length > 0)
                    {
                        $.post('/searchInstitution',{keywords: keywords},function(response){

                            if(response)
                            {
                                $('.mybrandoffer_list').hide();
                                $('.search_result').html(response);
                            }
                        });
                    }
                    else
                    {
                        $('.mybrandoffer_list').show();
                        $('.search_result').html('');
                    }
                }, 500);
            
            });

            $("#search_input").keydown(function(){

                clearTimeout(timer);

            });

            // $('.brandoffer_follow').on('click', function() {

            //     var institution_id        = $(this).attr('id');

            //     var data            = "institution_id="+institution_id;

            //     $.ajax({
            //         url: '/userInstitutionFollows',
            //         type: 'POST',
            //         data: data,

            //         success: function(response) {

            //             if(response)
            //             {
            //                 $('div.id_'+institution_id).html('<a href="javascript:void(0);">'+response.message+'</a>');
            //                 $('span.id_'+institution_id).html('+'+response.count);
            //             }

            //         }
            //     });
            
            // });
        
        });

    </script>

@stop