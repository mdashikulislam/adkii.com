@extends('admin.layouts.app')
@section('title',$title)
@section('admin-content')
    <div class="row justify-content-center">
        <div class="col-lg-12 col-12 mb-3">
            <div class="row">
                <div class="col-lg-7 col-xl-12 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-2">
                                <h6 class="card-title mb-0">Role List</h6>
                            </div>
                            <div>
                                <div class="table-responsive">
                                    <table  class="table table-bordered table-striped" id="dataTableExample">
                                        <thead>
                                        <tr>
                                            <th >No</th>
                                            <th>Name</th>
                                            <th>Users</th>
                                            <th>Created_at</th>
                                            <th style="width: 20%">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($roles as $role)
                                            <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>{{ formatRoleName($role->name) }}</td>
                                                <td>{{$role->users_count}}</td>
                                                <td>{{\Carbon\Carbon::parse($role->created_at)->isoFormat('Do, MMMM YYYY')}}</td>
                                                <td>
                                                    <a href="{{route('admin.manage-role.access',['id'=>$role->id])}}" class="btn  btn-outline-success btn-xs"><i class="fa fa-cogs"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
