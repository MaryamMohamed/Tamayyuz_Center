@extends('admin.layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row justify-content-center">
                <div class="">
                    <a href="{{route('userCreate')}}" class="btn btn-primary btn-sm"><i class="fa fa-user-plus">Create New User</i></a>
                </div>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Users Manage') }}</div>

                <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        @foreach ($user->roles as $role)
                                        <td>{{ $role->name }}</td>
                                        @endforeach
                                        
                                        <td>
                                            <a href="{{route('userEdit', $user->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                            <a href="{{route('userDelete', $user->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                   
                                </tbody>
                            </thead>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
