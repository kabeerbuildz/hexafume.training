@extends('admin.master_layout')
@section('title')
    <title>{{ __('Manage Locations') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Manage Locations') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Fee Structure') }}</div>
                    <div class="breadcrumb-item">{{ __('Locations') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Manage Locations') }}</h4>
                                <div>
                                    <a href="{{ route('admin.fee-structure-locations.create') }}" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> {{ __('Add New') }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th width="5%">{{ __('SN') }}</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Slug') }}</th>
                                                <th>{{ __('Order') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($locations as $index => $location)
                                                <tr>
                                                    <td>{{ $locations->firstItem() + $index }}</td>
                                                    <td>{{ $location->name }}</td>
                                                    <td>{{ $location->slug }}</td>
                                                    <td>{{ $location->order }}</td>
                                                    <td>
                                                        @if ($location->status == 1)
                                                            <span class="badge badge-success">{{ __('Active') }}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.fee-structure-locations.edit', $location->id) }}" class="btn btn-warning btn-sm">
                                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                                        </a>
                                                        <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $location->id }})">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">{{ __('No Data Found') }}</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $locations->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <x-admin.delete-modal />
@endsection

@push('js')
    <script>
        function deleteData(id) {
            var url = "{{ route('admin.fee-structure-locations.destroy', ':id') }}";
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }
    </script>
@endpush

