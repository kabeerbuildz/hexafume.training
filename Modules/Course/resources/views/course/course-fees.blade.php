@extends('admin.master_layout')
@section('title')
    <title>{{ __('Course Fees') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1 class="text-primary">{{ __('Course') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Course Create') }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('course::course.navigation')

                        <div class="card">
                            <div class="card-body">
                                <div class="instructor__profile-form-wrap">
                                    <h4 class="mb-4">{{ __('Course Fee Structure') }}</h4>
                                    <p class="text-muted mb-4">{{ __('Add fee structures for different locations and durations for this course.') }}</p>

                                    <!-- Existing Fee Structures -->
                                    @if($existingFeeStructures->count() > 0)
                                    <div class="mb-4">
                                        <!-- Search Bar -->
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                                                        </div>
                                                        <input type="text" id="courseSearchInput" class="form-control" placeholder="{{ __('Search by location, duration, or fee...') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <span class="badge badge-info" id="courseCountBadge">
                                                    {{ $existingFeeStructures->count() }} {{ __('Fee Structures') }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Table -->
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="feeStructuresTable">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('Location') }}</th>
                                                        <th>{{ __('Duration') }}</th>
                                                        <th>{{ __('Course Fee') }}</th>
                                                        <th>{{ __('Registration Fee') }}</th>
                                                        <th>{{ __('Status') }}</th>
                                                        <th>{{ __('Action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($existingFeeStructures as $feeStructure)
                                                    <tr class="fee-structure-row" data-search="{{ strtolower($feeStructure->location->name . ' ' . $feeStructure->duration->name . ' ' . $feeStructure->course_fee . ' ' . $feeStructure->registration_fee) }}">
                                                        <td>{{ $feeStructure->location->name }}</td>
                                                        <td>{{ $feeStructure->duration->name }}</td>
                                                        <td>Rs. {{ number_format($feeStructure->course_fee, 2) }}</td>
                                                        <td>Rs. {{ number_format($feeStructure->registration_fee, 2) }}</td>
                                                        <td>
                                                            @if($feeStructure->status == 1)
                                                                <span class="badge badge-success">{{ __('Active') }}</span>
                                                            @else
                                                                <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.course-fee-structures.edit', $feeStructure->id) }}" class="btn btn-warning btn-sm" target="_blank">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('admin.course-fee-structures.destroy', $feeStructure->id) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this fee structure?') }}');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @endif

                                    <!-- Add New Fee Structure Form -->
                                    <div class="card border-primary">
                                        <div class="card-header bg-primary text-white">
                                            <h5 class="mb-0">{{ __('Add New Fee Structure') }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('admin.course-fee-structures.store') }}" method="POST" id="feeStructureForm">
                                                @csrf
                                                <input type="hidden" name="course_id" value="{{ $courseId }}">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="location_id">{{ __('Location') }} <span class="text-danger">*</span></label>
                                                            <select name="location_id" id="location_id" class="form-control select2 @error('location_id') is-invalid @enderror" required>
                                                                <option value="">{{ __('Select Location') }}</option>
                                                                @foreach($locations as $location)
                                                                    <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('location_id')
                                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="duration_id">{{ __('Duration') }} <span class="text-danger">*</span></label>
                                                            <select name="duration_id" id="duration_id" class="form-control select2 @error('duration_id') is-invalid @enderror" required>
                                                                <option value="">{{ __('Select Duration') }}</option>
                                                                @foreach($durations as $duration)
                                                                    <option value="{{ $duration->id }}" {{ old('duration_id') == $duration->id ? 'selected' : '' }}>{{ $duration->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('duration_id')
                                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="course_fee">{{ __('Course Fee (Rs.)') }} <span class="text-danger">*</span></label>
                                                            <input type="number" step="0.01" name="course_fee" id="course_fee" class="form-control @error('course_fee') is-invalid @enderror" value="{{ old('course_fee') }}" placeholder="{{ __('Enter course fee') }}" required>
                                                            @error('course_fee')
                                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="registration_fee">{{ __('Registration Fee (Rs.)') }}</label>
                                                            <input type="number" step="0.01" name="registration_fee" id="registration_fee" class="form-control @error('registration_fee') is-invalid @enderror" value="{{ old('registration_fee', 0) }}" placeholder="{{ __('Enter registration fee') }}">
                                                            @error('registration_fee')
                                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="serial_number">{{ __('Serial Number') }}</label>
                                                            <input type="number" name="serial_number" id="serial_number" class="form-control @error('serial_number') is-invalid @enderror" value="{{ old('serial_number', 0) }}" placeholder="{{ __('Enter serial number') }}">
                                                            <small class="text-muted">{{ __('Used for ordering courses in the fee structure table') }}</small>
                                                            @error('serial_number')
                                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="status">{{ __('Status') }} <span class="text-danger">*</span></label>
                                                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                                                <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>{{ __('Active') }}</option>
                                                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                                                            </select>
                                                            @error('status')
                                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mt-3">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa fa-plus"></i> {{ __('Add Fee Structure') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Continue Button -->
                                    <div class="mt-4">
                                        <form action="{{ route('admin.courses.update') }}" method="POST" class="instructor__profile-form course-form d-inline">
                                            @csrf
                                            <input type="hidden" name="course_id" value="{{ $courseId }}">
                                            <input type="hidden" name="step" value="4">
                                            <input type="hidden" name="next_step" value="5">
                                            <button type="submit" class="btn btn-success">
                                                {{ __('Continue to Analytics') }} <i class="fa fa-arrow-right"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('js')
<script src="{{ asset('backend/js/default/courses.js') }}"></script>
<script>
    $(document).ready(function() {
        // Initialize select2
        if ($.fn.select2) {
            $('.select2').select2();
        }

        // Search functionality
        $('#courseSearchInput').on('keyup', function() {
            const searchTerm = $(this).val().toLowerCase();
            const rows = $('.fee-structure-row');
            let visibleCount = 0;

            rows.each(function() {
                const searchData = $(this).data('search');
                if (searchData && searchData.indexOf(searchTerm) > -1) {
                    $(this).show();
                    visibleCount++;
                } else {
                    $(this).hide();
                }
            });

            // Update count badge
            $('#courseCountBadge').text(visibleCount + ' {{ __("Fee Structures") }}');
        });

        // Handle form submission with AJAX
        $('#feeStructureForm').on('submit', function(e) {
            e.preventDefault();
            
            const form = $(this);
            const formData = form.serialize();
            const submitBtn = form.find('button[type="submit"]');
            const originalText = submitBtn.html();

            submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> {{ __("Adding...") }}');

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success || response.redirect) {
                        // Show success message
                        if (typeof toastr !== 'undefined') {
                            toastr.success('{{ __("Fee structure added successfully!") }}');
                        } else {
                            alert('{{ __("Fee structure added successfully!") }}');
                        }
                        
                        // Reload page to show new fee structure
                        setTimeout(function() {
                            location.reload();
                        }, 500);
                    }
                },
                error: function(xhr) {
                    let errorMessage = '{{ __("An error occurred. Please try again.") }}';
                    
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                        const errors = xhr.responseJSON.errors;
                        errorMessage = Object.values(errors).flat().join('<br>');
                    }

                    if (typeof toastr !== 'undefined') {
                        toastr.error(errorMessage);
                    } else {
                        alert(errorMessage);
                    }
                },
                complete: function() {
                    submitBtn.prop('disabled', false).html(originalText);
                }
            });
        });
    });
</script>
@endpush

