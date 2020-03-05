<div class="dashboard_list">

    <h4><a @if(Sentry::check())
            href="{{ URL::route('inst_text_details',array('slug1' => getInstitutionSlug($link->institution_id), 'slug2' => $link->slug ))}}"
            @else  href="#" data-toggle="modal"  data-target="#login_required" class="login_btnpop"  @endif> {{ $link->name }}</a></h4>

    <h6>{{$link->created_at->format('Y-m-d')}}</h6>

    <p class="text-justify">{{ ShortenText($link->description,200) }}</p>

    <div class="editdelete">

        @if(isset($institution) && isset($loggedin_user) &&  $loggedin_user->institution_id == $link->institution_id)



            <a href="{{URL::route('update_inst_text',array('slug1' => getInstitutionSlug($link->institution_id), 'slug2' => $link->slug ))}}"
               data-toggle="tooltip" data-toggle="tooltip" data-placement="bottom" title="Edit"><i
                        class="fa fa-pencil"></i></a>

            <span data-form="#frmDelete-{{$link->id}}" data-title="Delete Text"
                  data-message="Are you sure you want to delete this text ?">
        <a class="formConfirm" href="" data-toggle="tooltip" data-placement="bottom" title="Delete"> <i
                    class="fa fa-trash-o"></i></a>
                                </span>
            {{ Form::open(array(
                    'url' => route('inst_posts.destroy', array($link->id)),
                    'method' => 'delete',
                    'style' => 'display:none',
                    'id' => 'frmDelete-' . $link->id
                ))
            }}
            {{ Form::submit('Submit') }}
            {{ Form::close() }}

        @endif
    </div>
    <div class="share_like_txt dashlinks_sharelike share_like_info share_like_txt3">
        <p><i class="fa fa-eye"></i> {{getPostInfoCount($link->id, 'visits')}}</p>

        <p><i class="fa likeicons @if(checkLikes($link->id)) fa-heart @else fa-heart-o  @endif" id="{{$link->id}}"></i>
            <b class="id_{{$link->id}}">{{getPostInfoCount($link->id, 'likes')}}</b></p>

        <p><a class="share_social"><i class="fa fa-share-alt"></i> Share </a></p>
        @if(Sentry::check())
            <div class="addthis_sharing_toolbox">

                <span class="share_fb"><a
                            href="https://www.facebook.com/sharer/sharer.php?u={{ URL::route('get_inst_links',array('slug1' => getInstitutionSlug($link->institution_id)))}}"><i
                                class="fa fa-facebook"></i></a></span>

                <span class="share_tw"><a
                            href="https://twitter.com/home?status={{$link->name}} - {{ URL::route('inst_text_details',array('slug1' => getInstitutionSlug($link->institution_id), 'slug2' => $link->slug ))}} via idoagcard"><i
                                class="fa fa-twitter"></i></a></span>

                <span class="share_pin"><a
                            href="https://pinterest.com/pin/create/button/?url={{URL::route('inst_text_details',array('slug1' => getInstitutionSlug($link->institution_id), 'slug2' => $link->slug ))}}&description={{ $link->name }} "><i
                                class="fa fa-pinterest"></i></a></span>

                <span class="share_gplus"><a
                            href="https://plus.google.com/share?url={{ URL::route('inst_text_details',array('slug1' => getInstitutionSlug($link->institution_id), 'slug2' => $link->slug ))}}"><i
                                class="fa fa-google-plus"></i></a></span>

            </div>
        @endif
    </div>

    <div class="clear"></div>
</div>
