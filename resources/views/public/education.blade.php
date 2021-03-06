@include('layouts.header-public')
            <div class="clearfix">
                <!-- <div class="col-xs-12"> -->
                    <div class="card">
                        <div class="body">
                            <div class="row">
                                <div class="col-md-8">
                                    @include('components.tab-navigation')
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="new-games">
                                            @foreach($new_game as $new_game)
                                            <div class="col-sm-4 col-xs-6 no-pad">  
                                                <div class="thumbnail">
                                                    <div class="container no-pad">
                                                        <a href="{{ route('detail.id', ['id' => $new_game->id]) }}" ><img src="{{ asset($new_game->img) }}" class="image" width="900px" height="900px">
                                                        <div class="bottomright"><button type="button" class="btn bg-black waves-effect waves-light">{{ $new_game->category }}<br/><img src="{{ ('assets/images/icon-coin-sm.png') }}">{{ $new_game->coint }}</button></div>
                                                        <div class="overlay1">
                                                            <div class="text">
                                                                <h3>{{ $new_game->name }}</h3>
                                                                <p>
                                                                    <?php if($new_game->user_rate==NULL){ ?>
                                                                    <div class="font-15">No Review</div>
                                                                    <?php }else{ ?>
                                                                    <span class="rating" data-default-rating="{{ $new_game->avg_rate }}" disabled></span>
                                                                    ({{ $new_game->user_rate }})<br/>
                                                                    <?php } ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="most-played">
                                            @foreach($most_played as $most_played)
                                            <div class="col-sm-4 col-xs-6 no-pad">  
                                                <div class="thumbnail">
                                                    <div class="container no-pad">
                                                        <a href="{{ route('detail.id', ['id' => $most_played->id]) }}" ><img src="{{ asset($most_played->img) }}" class="image" width="900px" height="900px">
                                                        <div class="bottomright"><button type="button" class="btn bg-black waves-effect waves-light">{{ $most_played->category }}<br/><img src="{{ ('assets/images/icon-coin-sm.png') }}">{{ $most_played->coint }}</button></div>
                                                        <div class="overlay1">
                                                            <div class="text">
                                                                <h3>{{ $most_played->name }}</h3>
                                                                <p>
                                                                    <?php if($most_played->user_rate==NULL){ ?>
                                                                    <div class="font-15">No Review</div>
                                                                    <?php }else{ ?>
                                                                    <span class="rating" data-default-rating="{{ $most_played->avg_rate }}" disabled></span>
                                                                    ({{ $most_played->user_rate }})<br/>
                                                                    <?php } ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="most-rated">
                                            @foreach($most_rated as $most_rated)
                                            <div class="col-sm-4 col-xs-6 no-pad">  
                                                <div class="thumbnail">
                                                    <div class="container no-pad">
                                                        <a href="{{ route('detail.id', ['id' => $most_rated->id]) }}" ><img src="{{ asset($most_rated->img) }}" class="image" width="900px" height="900px">
                                                        <div class="bottomright"><button type="button" class="btn bg-black waves-effect waves-light">{{ $most_rated->category }}<br/><img src="{{ ('assets/images/icon-coin-sm.png') }}">{{ $most_rated->coint }}</button></div>
                                                        <div class="overlay1">
                                                            <div class="text">
                                                                <h3>{{ $most_rated->name }}</h3>
                                                                <p>
                                                                    <?php if($most_rated->user_rate==NULL){ ?>
                                                                    <div class="font-15">No Review</div>
                                                                    <?php }else{ ?>
                                                                    <span class="rating" data-default-rating="{{ $most_rated->avg_rate }}" disabled></span>
                                                                    ({{ $most_rated->user_rate }})<br/>
                                                                    <?php } ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 hidden-sm hidden-xs">
                                    <div class="list-group">
                                        <div class="list-group-item active">
                                            <h4> Top Games </h4>
                                        </div>
                                        @foreach($top_games as $top_games)
                                            <a href="{{ url('play', $top_games->id) }}" class="list-group-item top-games-list clearfix">
                                                <img class="img-circle pull-left" src="{{ asset($top_games->img) }}" width="50" height="50">
                                                <h4 class="top-games-list__h4 pull-left">{{ $top_games->name }}</h4>
                                                <button class="btn bg-green top-games-list__btn">Play</button>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Best User Section -->
                                @include('components.best-user')
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
            </div>
    </section>
@include('layouts.footer') 
