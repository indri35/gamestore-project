@include('admin.layout.header')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="info-box-4">
                        <div class="icon">
                            <i class="material-icons col-indigo">person</i>
                        </div>
                        <div class="content">
                            <div class="text">Player</div>
                            @foreach($player_count as $player_count)
                            <div class="number count-to" data-from="0" data-to="{{ $player_count->player }}" data-speed="1000" data-fresh-interval="20">{{ $player_count->player }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="info-box-4">
                        <div class="icon">
                            <i class="material-icons col-red">videogame_asset</i>
                        </div>
                        <div class="content">
                            <div class="text">GAMES TOTAL</div>
                            @foreach($dashboard_count as $dashboard_count)
                            <div class="number count-to" data-from="0" data-to="{{ $dashboard_count->games }}" data-speed="1000" data-fresh-interval="20">{{ $dashboard_count->games }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="info-box-4">
                        <div class="icon">
                            <i class="material-icons col-purple">play_arrow</i>
                        </div>
                        <div class="content">
                            <div class="text">PLAYED</div>
                            <div class="number count-to" data-from="0" data-to="{{ $dashboard_count->played }}" data-speed="1000" data-fresh-interval="20">{{ $dashboard_count->played }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Counter Examples -->
                    <div class="card">
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12col-xs-12">
                                    <a href="{{ url('/addgame') }}" ><button type="button" class="btn bg-deep-orange waves-effect font-italic"><h6>Add Games</h6></button></a>
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#all-category" data-toggle="tab">
                                            All Category
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#action" data-toggle="tab">
                                            Action
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#adventure" data-toggle="tab">
                                            Adventure
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#casino" data-toggle="tab">
                                            Casino
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#puzzle" data-toggle="tab">
                                            Puzzle
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#sports" data-toggle="tab">
                                            Sports
                                        </a>
                                    </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="all-cattegory">
                                            <table class="table table-bordered table-striped table-hover js-basic-example">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Category</th>
                                                        <th>Rate</th>
                                                        <th>Played</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($master_datas as $master_datas)
                                                    <tr>
                                                        <td>{{ $master_datas->name }}</td>
                                                        <td>{{ $master_datas->category }}</td>
                                                        <td><span class="rating" data-default-rating="{{ $master_datas->avg_rate }}" disabled></span></td>
                                                        <td>{{ $master_datas->count_play }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>                                        
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="action">
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Category</th>
                                                        <th>Rate</th>
                                                        <th>Played</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($action as $master_datas)
                                                    <tr>
                                                        <td>{{ $master_datas->name }}</td>
                                                        <td>{{ $master_datas->category }}</td>
                                                        <td><span class="rating" data-default-rating="{{ $master_datas->avg_rate }}" disabled></span></td>
                                                        <td>{{ $master_datas->count_play }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>  
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="puzzle">
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Category</th>
                                                        <th>Rate</th>
                                                        <th>Played</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($puzzle as $master_datas)
                                                    <tr>
                                                        <td>{{ $master_datas->name }}</td>
                                                        <td>{{ $master_datas->category }}</td>
                                                        <td><span class="rating" data-default-rating="{{ $master_datas->avg_rate }}" disabled></span></td>
                                                        <td>{{ $master_datas->count_play }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>  
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="adventure">
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Category</th>
                                                        <th>Rate</th>
                                                        <th>Played</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($adventure as $master_datas)
                                                    <tr>
                                                        <td>{{ $master_datas->name }}</td>
                                                        <td>{{ $master_datas->category }}</td>
                                                        <td><span class="rating" data-default-rating="{{ $master_datas->avg_rate }}" disabled></span></td>
                                                        <td>{{ $master_datas->count_play }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>  
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="casino">
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Category</th>
                                                        <th>Rate</th>
                                                        <th>Played</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($casino as $master_datas)
                                                    <tr>
                                                        <td>{{ $master_datas->name }}</td>
                                                        <td>{{ $master_datas->category }}</td>
                                                        <td><span class="rating" data-default-rating="{{ $master_datas->avg_rate }}" disabled></span></td>
                                                        <td>{{ $master_datas->count_play }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>  
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="sports">
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Category</th>
                                                        <th>Rate</th>
                                                        <th>Played</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($sports as $master_datas)
                                                    <tr>
                                                        <td>{{ $master_datas->name }}</td>
                                                        <td>{{ $master_datas->category }}</td>
                                                        <td><span class="rating" data-default-rating="{{ $master_datas->avg_rate }}" disabled></span></td>
                                                        <td>{{ $master_datas->count_play }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
@include('layouts.footer') 