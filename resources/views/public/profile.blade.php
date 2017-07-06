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
                                        <a href="{{ url('play', $top_games->id) }}" class="list-group-item"><h4><img class="img-circle" src="{{ asset($top_games->img) }}" width="50" height="50" >&emsp;&emsp;&emsp;&emsp;{{ $top_games->name }} <span class="pull-right">{{ $top_games->score}}</span></h4></a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <p><center><b><div class="font-32">Best users</div></b><div class="font-24">This are the best users. Can you beat them?</div></center></p>
                                    <div class="col-xs-0 col-sm-1 col-md-1 col-lg-1">
                                    </div>
                                    <div class="col-xs-2 col-sm-3 col-md-2 col-lg-2">
                                        <button type="button" class="btn bg-red btn-block btn-lg waves-effect">DAY</button>
                                    </div>
                                    <div class="col-xs-2 col-sm-3 col-md-2 col-lg-2">
                                        <button type="button" class="btn bg-red btn-block btn-lg waves-effect">WEEK</button>
                                    </div>
                                    <div class="col-xs-2 col-sm-3 col-md-2 col-lg-2">
                                        <button type="button" class="btn bg-red btn-block btn-lg waves-effect">MONTH</button>
                                    </div>
                                    <div class="col-xs-2 col-sm-3 col-md-2 col-lg-2">
                                        <button type="button" class="btn bg-red btn-block btn-lg waves-effect">YEAR</button>
                                    </div>
                                    <div class="col-xs-2 col-sm-3 col-md-2 col-lg-2">
                                        <button type="button" class="btn bg-red btn-block btn-lg waves-effect">EVER</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@include('layouts.footer') 