@include('layouts.header')
    <section class="content">
        <div class="container-fluid">
            <!-- Custom Content -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                                @if(Auth::user()->role=='1')
                                    <a href="{{ url('/addgameaction') }}" ><button type="button" class="btn bg-deep-orange waves-effect font-italic"><h2>Add Games</h2></button></a>
                                @endif
                            <h2><br/>
                                Category : Action
                            </h2>
                        </div>
                        <div class="body">
                            <div class="tooltip">Hover over me
  <span class="tooltiptext">Tooltip text</span>
                            <div class="row">
                            @foreach($most_played as $most_played)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                                    <div class="thumbnail">
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
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Custom Content -->
        </div>
    </section>
@include('layouts.footer') 
