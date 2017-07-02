@include('layouts.header-public')
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                    @foreach($master_datas as $master_datum)
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <div class="bs-example" data-example-id="media-alignment">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="javascript:void(0);">
                                                    <img class="media-object" src="{{ asset($master_datum->img) }}" width="200" height="200">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading"> {{ $master_datum->name }}</h4>
                                                <div class="algin-left">Category : {{ $master_datum->category }}</div>
                                                </br>
                                                <p>
                                                   {{ $master_datum->desc }} 
                                                </p>
                                                <?php if($master_datum->user_rate==0){ ?>
                                                <p> No Review </p>
                                                <?php }else{ ?>
                                                <p>
                                                    <span class="rating" data-default-rating="{{ $master_datum->avg_rate }}" disabled></span> {{ $master_datum->avg_rate }}/5.00<br/>
                                                    Based on {{ $master_datum->user_rate }} votes & user reviews.
                                                </p>
                                                <?php } ?>
                                                <p>
                                                   <a href="{{ url('play', $master_datum->id) }}">
                                                        <img data-toggle="tooltip" title="Play" class="media-object" src="{{ asset('/img_game/play.png') }}" width="50" height="50">
                                                   </a>
                                                   
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @if (1==1) @break; @endif
                                    @endforeach
                                    <div class="header">
                                        <h2>
                                            User Reviews
                                        </h2>
                                    </div>
                                    @if(Auth::user()!=null)
                                    <div class="body">
                                        <form  role="form" method="POST" action="{{ url('/addreviewgame') }}">
                                            {{ csrf_field() }}
                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="rate">Game Rate</label>
                                                    </div>
                                                    <div class="col-lg-3 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <select id="rate-field" name="rate">                    
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                            </select>                       
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="comment">Comment</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <textarea id="comment" rows="5" type="text" class="form-control" name="comment" placeholder="Input Your Comment"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="id_user" value="{{ (Auth::user()->id) }}">
                                                <input type="hidden" name="user_name" value="{{ (Auth::user()->name) }}">
                                                <input type="hidden" name="email" value="{{ (Auth::user()->email) }}">
                                                @foreach($master_datas as $master_datum)
                                                <input type="hidden" name="id_game" value="{{ $master_datum->id }}">
                                                @endforeach
                                                <div class="form-group">
                                                    <div class="col-md-4 col-md-offset-2">
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fa fa-btn fa-user"></i> Submit
                                                        </button>
                                                    </div>
                                                </div>
                                        </form>
                                    </div>
                                    @endif
                                    <div class="body">
                                        @foreach($master_datas as $master_datum)
                                                <?php if($master_datum->user_rate==0){ ?>
                                                    <p> No Review </p>
                                                <?php }else{ ?>
                                                <span class="rating" data-default-rating="{{ $master_datum->rate }}" disabled></span><br/>
                                                by <i class="font-italic col-orange">{{ $master_datum->user_name }}</i> - {{ $master_datum->created_at }} <br/>
                                                {{ $master_datum->comment }} <br/>
                                                <hr>
                                                <?php } ?> 
                                        @endforeach   
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <div class="list-group">
                                        <div class="list-group-item active">
                                            Top Games
                                        </div>
                                        @foreach($top_games as $top_games)
                                        <a href="{{ route('detail.id', ['id' => $top_games->id]) }}" class="list-group-item"><h4><img class="img-circle" src="{{ asset($top_games->img) }}" width="50" height="50" >&emsp;  {{ $top_games->name }} </h4></a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <p><center><b><div class="font-32">Best users</div></b><div class="font-24">This are the best users. Can you beat them?</div></center></p>
                                    <div class="col-xs-5 col-sm-2 col-md-1 col-lg-1">
                                    </div>
                                    <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">
                                        <button type="button" class="btn bg-red btn-block btn-lg waves-effect">DAY</button>
                                    </div>
                                    <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">
                                        <button type="button" class="btn bg-red btn-block btn-lg waves-effect">WEEK</button>
                                    </div>
                                    <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">
                                        <button type="button" class="btn bg-red btn-block btn-lg waves-effect">MONTH</button>
                                    </div>
                                    <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">
                                        <button type="button" class="btn bg-red btn-block btn-lg waves-effect">YEAR</button>
                                    </div>
                                    <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">
                                        <button type="button" class="btn bg-red btn-block btn-lg waves-effect">EVER</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@include('layouts.footer') 