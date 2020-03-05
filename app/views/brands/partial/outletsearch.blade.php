@foreach($outlets as $key=>$outlet)
    
    @if($key%3==0)
        
        <div class="outlettable-row"> 

    @endif
            
            <div class="registoff_info">

                <h4>{{ $outlet->name }}</h4>

                <ul>

                    <li>

                        <div class="outlet_locaicon"> {{ HTML::image('assets/images/location_icon.png')}}</div>

                        <div class="outlet_locacnt">
                            @if($outlet->address!='')
                                {{ $outlet->address.', '}}
                            @endif
                            {{ $outlet->locality}} <br/>
                            @if($outlet->city!='')
                                {{ $outlet->city.', '}}
                            @endif
                            {{ $outlet->state}}
                        </div>

                    </li>

                    @if($outlet->contact_info != '')

                        <li>
                            <div class="outlet_locaicon"> {{ HTML::image('assets/images/office_callicon.png')}}</div>

                            <div class="outlet_locacnt">{{ $outlet->contact_info}}</div>
                        </li>

                    @endif

                </ul>

                @if(isset($loggedin_user) && $loggedin_user->brand_id == $brand->id)

                    <span class="edit_del-btns">

                        <a href="{{ URL::route('update_outlet',array('slug'=>$brand->slug,'id'=>$outlet->id))}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                        
                        <span data-form="#frmDelete-{{$outlet->id}}" data-title="Delete Outlet" data-message="Are you sure you want to delete this Outlet ?">
                            
                            <a class="formConfirm" href="" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a>
                        
                        </span>

                            {{ Form::open(array(
                                    'url' => route('outlets.destroy', array($outlet->id)),
                                    'method' => 'delete',
                                    'style' => 'display:none',
                                    'id' => 'frmDelete-' . $outlet->id
                                ))
                            }}
                            {{ Form::submit('Submit') }}
                            {{ Form::close() }}

                    </span>

                @endif

            </div>

        @if($key%3==2)
        
            </div> 
        
        @endif

@endforeach

@if($key%3!=2)

    </div>

@endif