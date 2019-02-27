@include('layouts.header-profile')
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12col-xs-12">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="list-group">
                                        <div class="list-group-item active">
                                            <h4>Top Monthly </h4>
                                        </div>
                                        @foreach($top_games as $top_games)
                                        <a href="#" class="list-group-item top-games-list clearfix">
                                            @if($top_games->img)
                                            <img class="img-circle pull-left" src="{{ asset($top_games->img) }}" width="50" height="50" >
                                            @else
                                            <img class="img-circle pull-left" src="{{ asset('/assets/images/user.png') }}" width="50" height="50" >
                                            @endif
                                            <h4 class="top-games-list__h4 pull-left">{{ substr($top_games->hp,0,9) }}***</h4>
                                            @if($top_games->score<5000)
                                                <span class="top-games-list__btn">{{ $top_games->score}}</span>
                                            @else
                                                <button class="btn bg-green top-games-list__btn">Redeem {{ $top_games->score}}</button>
                                            @endif
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
                </div>
            </div>
    </section>
@include('layouts.footer') 