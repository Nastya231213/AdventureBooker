@extends('layouts.admin.admin_main')
@section('title', 'Dashboard')
@section('content')
<div class="main-content" id="mainContent">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i>Go Back</a>

    <div class="container">
        <h4 class="my-4 text-center">Amenities Management Dashboard</h4>
        <div class="mb-3 text-end">
            <a href="{{route('admin.amenities.create')}}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Add New Amenity
            </a>
        </div>
        <div class="table-responsive">

            @if($amenities->isEmpty())
            <div class="alert alert-info text-center">
                No amenities available.
            </div>
            @else
            <table class="table table-striped px-3 py-2">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($amenities as $amenity)
                    <tr>

                        <td>{{$amenity->id}}</td>
                        <td>{{$amenity->name}}</td>
                        <td><img src="{{ asset('storage/'.$amenity->icon) }}" class="photo_amenity" alt=""></td>
                        <td>
                            <a href="{{ route('admin.amenities.edit', $amenity->id) }}"  class="btn btn-primary mt-1"><i class="bi bi-pencil-square"></i> Edit</a>
                            <a href="#" class="btn btn-danger delete-button mt-1" data-id="{{$amenity->id}}"> <i class="bi bi-x-circle-fill"></i> Delete </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @endif
            <div class="mt-4 p-4">
                {{$amenities->links('pagination::bootstrap-5')}}
            </div>

        </div>
    </div>
</div>
<script>
    document.querySelectorAll('.delete-button').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this amenity?')) {
                return false;
            }
            var id = this.getAttribute('data-id');
            var url = '/admin/amenities/' + id;
            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => {
                if (response.ok) {
                    alert('Amenity deleted successfully');
                    this.closest('tr').remove();
                } else {
                    alert('Failed to delete the amenity.');
                }
            }).catch(error => {
                console.error('Error:', error);
            });

        });
    })
</script>
@endsection