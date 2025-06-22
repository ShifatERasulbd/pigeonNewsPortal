@extends('backend.master')
@section('main')

<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="d-flex justify-content-end mb-2">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm d-flex align-items-center gap-1 text-dark" data-bs-toggle="modal" data-bs-target="#addAdvertiseModal">
            <i class="fa fa-plus"></i>
            Add Advertisement
        </button>
    </div>

    @if(session('success'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055">
            <div id="successToast" class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055">
            <div id="errorToast" class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    @include('backend.advertises.create')

    <div class="bg-secondary bg-white text-center rounded p-4">
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">SL</th>
                        <th scope="col">Location</th>
                        <th scope="col">Image</th>
                        <th scope="col">Video</th>
                        <th scope="col">Link</th>
                        <th scope="col">Option</th>
                    </tr>
                </thead>
                <tbody>
                    @if($advertisements->isNotEmpty())
                        @foreach($advertisements as $key => $advertisement)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $advertisement->location ? $advertisement->location->location : 'N/A' }}</td>
                                <td>
                                    @if($advertisement->image)
                                        <img src="{{ asset($advertisement->image) }}" alt="Advertisement" width="100">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>
                                    @if($advertisement->video)
                                        <a href="{{ $advertisement->video }}" target="_blank">View Video</a>
                                    @else
                                        No Video
                                    @endif
                                </td>
                                <td>
                                    @if($advertisement->link)
                                        <a href="{{ $advertisement->link }}" target="_blank">{{ Str::limit($advertisement->link, 30) }}</a>
                                    @else
                                        No Link
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editAdvertiseModal{{ $advertisement->id }}">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>
                                    <form action="{{ route('advertise.destroy', $advertisement->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this advertisement?')">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            @include('backend.advertises.edit', ['advertisement' => $advertisement])
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center text-dark">No advertisements found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->

@endsection