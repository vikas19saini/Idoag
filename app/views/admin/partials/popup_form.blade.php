
                      <div class="form-group">

                          {{ Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) }}

                          <div class="col-sm-8">

                              {{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control','required'=>'required']) }}

                              {{ errors_for('name', $errors) }}

                          </div>

                      </div>

                      <div class="form-group">

                          {{ Form::label('url', 'Link', ['class' => 'col-sm-3 control-label']) }}

                          <div class="col-sm-8">

                              {{ Form::text('url', null, ['placeholder' => 'http://www.example.com', 'class' => 'form-control']) }}

                              {{ errors_for('url', $errors) }}

                          </div>

                      </div>


                      <div class="form-group">
                          
                          {{ Form::label('nam_val', 'Start Date', ['class' => 'col-sm-3 control-label']) }}
                          
                          <div class="col-sm-2">
                          
                              {{ Form::text('start_date', null, ['placeholder' => 'Start Date', 'class' => 'form-control', 'id'=>'start_date','required'=>'required']) }}
                          
                          </div>
                          
                          {{ Form::label('nam_val', 'End Date', ['class' => 'col-sm-3 control-label']) }}
                          
                          <div class="col-sm-2">
                          
                              {{ Form::text('end_date', null, ['placeholder' => 'End Date', 'class' => 'form-control', 'id'=>'end_date','required'=>'required']) }}
                          
                          </div>

                      </div>

                      <div class="form-group">

                          {{ Form::label('status', 'Status', ['class' => 'col-sm-3 control-label']) }}

                          <div class="col-sm-8">

                              {{ Form::checkbox('status', 1, null,  ['id' => 'status'] ) }} &nbsp;

                              <span> Check to make the Pop-up active </span>
                              
                              {{ errors_for('status', $errors) }}

                          </div>

                      </div>

                      <div class="form-group">
                          
                          {{ Form::label('image', 'Popup Image', ['class' => 'col-sm-3 control-label']) }}

                          @if(!isset($popup->image))

                            <div class="col-sm-4">

                                {{ Form::file('image',['id' => 'popup_image','required'=>'required']) }}

                                {{ errors_for('image', $errors) }}

                            </div>

                          @else

                            <div class="col-sm-4">

                                {{ Form::file('image',['id' => 'popup_image']) }}

                                {{ errors_for('image', $errors) }}

                            </div>

                          @endif


                          <div class="col-sm-5">

                              {{ HTML::image((isset($popup))?'uploads/popup_images/'.$popup->image:'assets/images/banner_img.jpg', '', ['class' => 'slider-img', 'id' => 'offer_image_preview']) }}
                          </div>

                      </div>