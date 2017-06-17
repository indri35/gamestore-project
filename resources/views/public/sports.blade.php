@include('layouts.header-public')
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="header">
                                <h2>
                                    <br/>Category: Sports
                                </h2>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#new-games" data-toggle="tab">
                                            New Games
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#most-played" data-toggle="tab">
                                            Most Played
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#most-rated" data-toggle="tab">
                                            Most Rated
                                        </a>
                                    </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="new-games">
                                            @foreach($new_game as $new_game)
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">  
                                                <div class="thumbnail">
                                                    <div class="container">
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
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">  
                                                <div class="thumbnail">
                                                    <div class="container">
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
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">  
                                                <div class="thumbnail">
                                                    <div class="container">
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
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <div class="list-group">
                                        <div class="list-group-item active">
                                                Top Games
                                            </div>
                                            @foreach($top_games as $top_games)
                                            <a href="{{ route('detail.id', ['id' => $top_games->id]) }}" class="list-group-item"><h4><img class="img-circle" src="{{ asset($top_games->img) }}" width="50" height="50" >&emsp;{{ $top_games->name }}</h4></a>
                                            @endforeach
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
