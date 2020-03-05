@extends('layouts.default')

@section('title','Frequently Asked Questions |idoag.com')

@section('metatags')
    <meta name="keywords" content="Frequently Asked Questions |idoag.com" />
    <meta name="description" content="Frequently Asked Questions |idoag.com" />
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
        <div class="faq_info">
            
            <div class="container_info">

                <div class="faqsearch">
                    
                    <h5>FAQs</h5>
                                            
                        <span><input type="text" id="search_input" class="search square" placeholder="search faq"></span>
                
                </div> 

                <div class="faq_hide"> 
                
                    @foreach($faq_categories as $faq_category)

                        <div class="faq_liststyle">

                            <h2>{{$faq_category->name}}</h2>

                            @foreach($faq_category->faqS as $faq)
                                
                                <div class="faq_list">

                                    <h4>{{$faq->question}}<span></span></h4>
                                    
                                    <div class="faq_cnt">

                                        {{$faq->answer}}
                                    
                                    </div>
                                </div>

                            @endforeach
                        
                        </div>

                    @endforeach
                
                </div>

                <div class="faq_search"> </div>


            </div>   

        </div>

    </div>        <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop

@section('js')
    <script>
        $(function(){
            $(".faq_liststyle .faq_list:first-child h4").addClass("closeimg");
            $(document).on('click', ".faq_list h4", function(){
                var thisclass=$(this).attr("class");
                if(thisclass!="closeimg"){
                    $(this).attr("class", "closeimg");
                    $(this).parents(".faq_list").find(".faq_cnt").slideDown();
                }
                else{
                    $(this).attr("class", "");
                    $(this).parents(".faq_list").find(".faq_cnt").slideUp();
                }
            });

            $("#search_input").keyup(function(){

                var keywords = $('#search_input').val();

                timer = setTimeout(function()
                {
                   
                    if(keywords.length > 0)
                    {
                        $.post('/searchFaq',{keywords: keywords},function(response){

                            if(response)
                            {   console.log(response);
                                $('.faq_hide').hide();
                                $('.faq_search').html(response);
                                // $('.brandoffer_list ul').html(response);

                           }
                        });
                    }
                    else
                    {
                        $('.faq_hide').show();
                        $('.faq_search').html('');
                    }
                }, 500);
            });


            $("#search_input").keydown(function(){

               clearTimeout(timer);

            });

        });
    </script>

@stop