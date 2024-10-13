@extends('layouts.admin.admin_main')
@section('title', 'Dashboard')
@section('content')
<div class="main-content" id="mainContent">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i>Go Back</a>

    <div class="container">
        <h4 class="my-4 text-center">User Management Dashboard</h4>
        <div class="mb-3 text-end">
            <a href="{{route('admin.users.create')}}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Add New User
            </a>
        </div>
        <div class="table-responsive">

            @if($users->isEmpty())
            <div class="alert alert-info text-center">
                No users available.
            </div>
            @else
            <table class="table table-striped px-3 py-2">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Surname</th>
                        <th scope="col">Email</th>
                        <th scope="col">Profile photo</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key=>$user)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->surname}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if(isset($user->profile_photo))
                            <img src="{{asset('storage/profile_photos/'.$user->profile_photo) }}" alt="Profile photo">
                            @else
                            None
                            @endif
                        </td>
                        <td> @if($user->is_admin)
                            Admin
                            @else
                            User
                            @endif
                        </td>
                        <td class="text-center align-middle">
                            <a href="{{route('admin.users.edit',$user->id)}}" class="btn btn-primary mt-1"><i class="bi bi-pencil-square"></i> Edit</a>
                            <a href="#" class="btn btn-danger delete-button mt-1" data-id="{{ $user->id }}"> <i class="bi bi-x-circle-fill"></i> Delete </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @endif
            <div class="mt-4 p-4">
                {{$users->links('pagination::bootstrap-5')}}
            </div>

        </div>
    </div>
</div>
<script>
    document.querySelectorAll('.delete-button').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this user?')) {
                return false;
            }

            var userId = this.getAttribute('data-id');
            var url = '/admin/users/' + userId;
            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => {
                if (response.ok) {
                    alert('User deleted successfully');
                    this.closest('tr').remove();
                } else {
                    alert('Failed to delete the user.');
                }
            }).catch(error => {
                console.error('Error:', error);
            });
        });

    });
</script>
@endsection