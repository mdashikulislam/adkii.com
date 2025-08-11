@extends('admin.layouts.app')
@section('title',$title)
@push('admin.style')
    <style>
        .permission ul{
            padding: 20px 30px;
            display: table;
            width: 100%;
            clear: both;
            margin-bottom: 0;
        }
        .permission ul li{
            list-style: none;
            width: 25%;
            float: left;
        }
        .permission .head {
            background:#6571FF;
            color: #fff;
            padding: 8px 15px;
            font-size: 10.5pt;
            font-weight: bold;
        }
        .all_check{
            margin-bottom: 10px;
            padding-left: 5px;
        }
    </style>
@endpush
@section('admin-content')
    <div class="row justify-content-center">
        <div class="col-lg-12 col-12 mb-3">
            <div class="row">
                <div class="col-lg-7 col-xl-12 stretch-card">
                    <div class="card">
                        <div class="card-body permission">
                            <div class="all_check">
                                <div class="form-check">
                                    <input  type="checkbox" class="form-check-input checkedAll" />
                                    <label class="form-check-label">
                                        Mark All Access Key - for <strong>{{formatRoleName($role->name)}}</strong> Role
                                    </label>
                                </div>
                            </div>
                            <form action="{{route('admin.manage-role.access',['id'=>$role->id])}}" method="POST">
                                @csrf
                                {{method_field('PUT')}}
                                @if($permissionGroups)
                                    @foreach($permissionGroups as $permissionGroup)
                                        <div class="head">
                                            {{$permissionGroup}}
                                        </div>
                                        <ul>
                                            @foreach($permissions as $permission)
                                                @if($permission->group === $permissionGroup)
                                                    <li>
                                                        <div class="form-check form-check-inline">
                                                            <input value="{{$permission->id}}" name="permission[]" {{@$role->hasPermissionTo(@$permission->id) ? 'checked':''}} type="checkbox" class="form-check-input checkSingle" />
                                                            <label class="form-check-label">
                                                                 {{$permission->name}}
                                                            </label>
                                                        </div>

                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endforeach
                                    <div class="form-group mt-3">
                                        <a href="{{route('admin.manage-role')}}" class="btn btn-dark"><i class="fas fa-arrow-left fa-fw"></i>Back</a>
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save fa-fw"></i>Update</button>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('admin.script')
    <script>
        $(".checkedAll").change(function () {
            if (this.checked) {
                $(".checkSingle").each(function () {
                    this.checked = true;
                })
            } else {
                $(".checkSingle").each(function () {
                    this.checked = false;
                })
            }
        });
    </script>
@endpush
