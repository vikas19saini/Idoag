<div class="dashboard_list">

    <h4><a @if(Sentry::check())
            href="{{ URL::route('link_details',array('slug1' => getBrandSlug($link->brand_id), 'slug2' => $link->slug ))}}"
            @else  href="#" data-toggle="modal"  data-target="#login_required" class="login_btnpop"  @endif> {{ $link->name }}</a></h4>

    <h6>{{$link->created_at->format('Y-m-d')}}</h6>

    <p class="text-justify">
        <?php 
            echo preg_replace('#<a.*?>.*?</a>#i', '', $link->description);
            preg_match_all('~<a(.*?)href="([^"]+)"(.*?)>~',$link->description, $matches);
            if(!empty($matches[2])){
                $tags = [];
                $links = [];
                foreach ($matches[2] as $value) {
                    array_push($links, $value);
                    $t = get_meta_tags($value);
                    array_push($tags, $t);
                }
                //print_r($tags);
                $i=0;
                foreach ($tags as $value) {
                    ?>
                    <a href="<?php echo $links[$i]?>" target="_blank" style="text-decoration:none;color: initial;">
                        <div class="link_fetch clearfix">
                            <div class="left">
                                <?php
                                    if(!isset($value['twitter:image'])){
                                        $sites_html = file_get_contents($links[$i]);

                                        $html = new DOMDocument();
                                        @$html->loadHTML($sites_html);
                                        $meta_og_img = null;
                                        //Get all meta tags and loop through them.
                                        foreach($html->getElementsByTagName('meta') as $meta) {
                                            //If the property attribute of the meta tag is og:image
                                            if($meta->getAttribute('property')=='og:image'){ 
                                                //Assign the value from content attribute to $meta_og_img
                                                $meta_og_img = $meta->getAttribute('content');
                                            }
                                        }
                                        //echo $meta_og_img;
                                        ?>
                                        <img src="<?php echo $meta_og_img?>" />
                                        <?php
                                    }else{
                                    ?>
                                        <img src="<?php echo $value['twitter:image']?>" />
                                        <?php 
                                    } 
                                ?>
                                
                            </div>
                            <div class="right">
                                <?php if(isset($value['title'])) { ?>
                                    <h6><?php echo $value['title']?></h6>
                                <?php } else {?>
                                    <h6><?php echo $value['twitter:title']?></h6>
                                <?php } ?>
                            </div>
                        </div>
                    </a>
                    <?php
                    $i++;
                }
            }
        ?>
    </p>


        @if(isset($brand) && isset($loggedin_user) &&  $loggedin_user->brand_id == $link->brand_id)
        <div class="editdelete">

            <a href="{{URL::route('update_text',array('slug1' => getBrandSlug($link->brand_id), 'slug2' => $link->slug ))}}"
               data-toggle="tooltip" data-toggle="tooltip" data-placement="bottom" title="Edit"><i
                        class="fa fa-pencil"></i></a>

            <span data-form="#frmDelete-{{$link->id}}" data-title="Delete Text"
                  data-message="Are you sure you want to delete this text ?">
            <a class="formConfirm" href="" data-toggle="tooltip" data-placement="bottom" title="Delete"> <i
                    class="fa fa-trash-o"></i></a>
                                </span>
            {{ Form::open(array(
                    'url' => route('posts.destroy', array($link->id)),
                    'method' => 'delete',
                    'style' => 'display:none',
                    'id' => 'frmDelete-' . $link->id
                ))
            }}
            {{ Form::submit('Submit') }}
            {{ Form::close() }}
        </div>

        @endif
    <div class="share_like_txt dashlinks_sharelike share_like_info share_like_txt3">
        
        <p><i class="fa fa-eye"></i> {{getPostInfoCount($link->id, 'visits')}}</p>

        <p><i class="fa likeicons @if(checkLikes($link->id)) fa-heart @else fa-heart-o  @endif"  id="{{$link->id}}"></i>
            <b class="id_{{$link->id}}">{{getPostInfoCount($link->id, 'likes')}}</b>
        </p>

        <p><a class="share_social"><i class="fa fa-share-alt"></i> Share </a></p>

        @if(Sentry::check())

            <div class="addthis_sharing_toolbox">

                <span class="share_fb"><a class="share_fb_db" target="_blank" onclick="FBShareOpDB('{{$link->image}}','{{$link->short_description}}','{{$link->name}}','{{ URL::route('link_details',array('slug1' => getBrandSlug($link->brand_id), 'slug2' => $link->slug ))}}')"><i class="fa fa-facebook"></i></a></span>

                <span class="share_tw"><a  target="_blank"
                            href="https://twitter.com/home?status={{$link->name}} - {{ URL::route('link_details',array('slug1' => getBrandSlug($link->brand_id), 'slug2' => $link->slug ))}} via idoagcard"><i
                                class="fa fa-twitter"></i></a></span>

                <span class="share_pin"><a  target="_blank"
                            href="https://pinterest.com/pin/create/button/?url={{URL::route('link_details',array('slug1' => getBrandSlug($link->brand_id), 'slug2' => $link->slug ))}}&description={{ $link->name }} "><i
                                class="fa fa-pinterest"></i></a></span>

                <span class="share_gplus"><a  target="_blank"
                            href="https://plus.google.com/share?url={{ URL::route('link_details',array('slug1' => getBrandSlug($link->brand_id), 'slug2' => $link->slug ))}}"><i
                                class="fa fa-google-plus"></i></a></span>

            </div>

        @endif
        
    </div>

    <div class="clear"></div>
</div>
