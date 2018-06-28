@include('layouts.header-profile')
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-12col-xs-12">
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                    <div class="list-group">
                                        <div class="list-group-item active">
                                            <h4>Top Global Users </h4>
                                        </div>
                                        @foreach($top_games as $top_games)
                                        <a href="#" class="list-group-item top-games-list clearfix">
                                            <img class="img-circle pull-left" src="{{ asset($top_games->img) }}" width="50" height="50" >
                                            <h4 class="top-games-list__h4 pull-left">{{ $top_games->name }}</h4>
                                            <span class="top-games-list__btn">{{ $top_games->score}}</span>
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