@extends('admin.master_layout')
@section('title')
    <title>{{ __('Manage Course Fee Structures') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Manage Course Fee Structures') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Fee Structure') }}</div>
                    <div class="breadcrumb-item">{{ __('Course Fees') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Manage Course Fee Structures') }}</h4>
                                <div>
                                    <a href="{{ route('admin.course-fee-structures.create') }}" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> {{ __('Add New') }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Filter Form -->
                                <form method="GET" action="{{ route('admin.course-fee-structures.index') }}" class="mb-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>{{ __('Location') }}</label>
                                                <select name="location_id" class="form-control">
                                                    <option value="">{{ __('All Locations') }}</option>
                                                    @foreach($locations as $location)
                                                        <option value="{{ $location->id }}" {{ request('location_id') == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>{{ __('Duration') }}</label>
                                                <select name="duration_id" class="form-control">
                                                    <option value="">{{ __('All Durations') }}</option>
                                                    @foreach($durations as $duration)
                                                        <option value="{{ $duration->id }}" {{ request('duration_id') == $duration->id ? 'selected' : '' }}>{{ $duration->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <button type="submit" class="btn btn-primary btn-block">{{ __('Filter') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th width="5%">{{ __('SN') }}</th>
                                                <th>{{ __('Course') }}</th>
                                                <th>{{ __('Location') }}</th>
                                                <th>{{ __('Duration') }}</th>
                                                <th>{{ __('Course Fee') }}</th>
                                                <th>{{ __('Registration Fee') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($feeStructures as $index => $feeStructure)
                                                <tr>
                                                    <td>{{ $feeStructures->firstItem() + $index }}</td>
                                                    <td>{{ $feeStructure->course->title }}</td>
                                                    <td>{{ $feeStructure->location->name }}</td>
                                                    <td>{{ $feeStructure->duration->name }}</td>
                                                    <td>Rs. {{ number_format($feeStructure->course_fee, 2) }}</td>
                                                    <td>Rs. {{ number_format($feeStructure->registration_fee, 2) }}</td>
                                                    <td>
                                                        @if ($feeStructure->status == 1)
                                                            <span class="badge badge-success">{{ __('Active') }}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.course-fee-structures.edit', $feeStructure->id) }}" class="btn btn-warning btn-sm">
                                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                                        </a>
                                                        <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $feeStructure->id }})">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">{{ __('No Data Found') }}</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $feeStructures->links() }}
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
            var url = "{{ route('admin.course-fee-structures.destroy', ':id') }}";
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }
    </script>
@endpush

