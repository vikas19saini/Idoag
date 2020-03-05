<div class="faq_liststyle">
<h2></h2>
@foreach($faqs as $faq)
                                
    <div class="faq_list">

        <h4>{{$faq->question}}<span></span></h4>
        
        <div class="faq_cnt">

            {{$faq->answer}}
        
        </div>
    </div>
@endforeach
</div>
