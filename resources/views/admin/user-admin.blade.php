@include('admin.layout.header')
    <section class="content">
        <div class="container-fluid">
                    <div class="card">
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12col-xs-12">
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="all-category">
                                            <table class="table table-bordered table-striped table-hover js-basic-example">
                                                <thead>
                                                    <tr>
                                                        <th>MSISDN</th>
                                                        <th>Name</th>
                                                        <th>Register Date</th>
                                                        <th>Subscription Date</th>
                                                        <th>Coint</th>
                                                        <th>Status Login</th>
                                                        <th>Action</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($users as $master_datas)
                                                    <tr>
                                                        <td>{{ $master_datas->phone_number }}</td>
                                                        <td>{{ $master_datas->name }}</td>
                                                        <td>{{ $master_datas->created_at }}</td>
                                                        <td>{{ $master_datas->subdate }}</td>
                                                        <td>{{ $master_datas->coint }}</td>
                                                        <td>{{ $master_datas->is_login }}</td>
                                                        <td width="20%" align="center">
                                                            @if( $master_datas->is_login)
                                                            <a class="btn btn-xs btn-danger" href="{{ url('/unactive', $master_datas->id)}}"><i class="glyphicon glyphicon-edit"></i> Unactive</a>
                                                            @else
                                                            <a class="btn btn-xs btn-success" href="{{ url('/active', $master_datas->id)}}"><i class="glyphicon glyphicon-edit"></i> Active</a>
                                                            @endif
                                                        </td>
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
                </div>
    </section>
@include('layouts.footer') 