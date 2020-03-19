@extends('layouts.defaultv2')

@section('title','Frequently Asked Questions | idoag.com')

@section('metatags')
    <meta name="keywords" content="Frequently Asked Questions |idoag.com" />
    <meta name="description" content="Frequently Asked Questions |idoag.com" />
@stop

@section('css')

@stop


@section('content')
    @include('layouts.headerv2')
    <div class="container">
        <div id="accordion" class="myaccordion wow fadeInUp">
            <h1>FAQs</h1>
            @foreach($faq_categories as $faq_category)
                <h3>{{$faq_category->name}}</h3>
                @foreach($faq_category->faqS as $faq)
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{$faq->id}}" aria-expanded="false" aria-controls="collapseOne">
                                {{$faq->question}}
                                <span class="fa-stack fa-sm">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </span>
                            </button>
                        </h2>
                    </div>
                    <div id="collapse{{$faq->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <p>{{$faq->answer}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            @endforeach
        </div>
    </div>
    @include('layouts.footerv2')
@stop
@section('js')
    <script>
        var wow = new WOW();
        wow.init();

        $("#accordion").on("hide.bs.collapse show.bs.collapse", e => {
            $(e.target)
                .prev()
                .find("i:last-child")
                .toggleClass("fa-minus fa-plus");
        });
    </script>
@stop