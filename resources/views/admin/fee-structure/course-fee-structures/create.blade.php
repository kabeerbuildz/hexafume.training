@extends('admin.master_layout')
@section('title')
    <title>{{ __('Create Course Fee Structure') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.course-fee-structures.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Create Course Fee Structure') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.course-fee-structures.index') }}">{{ __('Course Fees') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Create Course Fee Structure') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Create Course Fee Structure') }}</h4>
                                <div>
                                    <a href="{{ route('admin.course-fee-structures.index') }}" class="btn btn-primary">
                                        <i class="fa fa-arrow-left"></i> {{ __('Back') }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.course-fee-structures.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-8">
                                            @if($errors->has('error'))
                                                <div class="alert alert-danger">
                                                    {{ $errors->first('error') }}
                                                </div>
                                            @endif

                                            <div class="form-group">
                                                <label for="course_id">{{ __('Course') }} <span class="text-danger">*</span></label>
                                                <select name="course_id" id="course_id" class="form-control @error('course_id') is-invalid @enderror">
                                                    <option value="">{{ __('Select Course') }}</option>
                                                    @foreach($courses as $course)
                                                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                                                    @endforeach
                                                </select>
                                                @error('course_id')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="location_id">{{ __('Location') }} <span class="text-danger">*</span></label>
                                                <select name="location_id" id="location_id" class="form-control @error('location_id') is-invalid @enderror">
                                                    <option value="">{{ __('Select Location') }}</option>
                                                    @foreach($locations as $location)
                                                        <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('location_id')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="duration_id">{{ __('Duration') }} <span class="text-danger">*</span></label>
                                                <select name="duration_id" id="duration_id" class="form-control @error('duration_id') is-invalid @enderror">
                                                    <option value="">{{ __('Select Duration') }}</option>
                                                    @foreach($durations as $duration)
                                                        <option value="{{ $duration->id }}" {{ old('duration_id') == $duration->id ? 'selected' : '' }}>{{ $duration->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('duration_id')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="course_fee">{{ __('Course Fee (Rs.)') }} <span class="text-danger">*</span></label>
                                                <input type="number" step="0.01" name="course_fee" id="course_fee" class="form-control @error('course_fee') is-invalid @enderror" value="{{ old('course_fee') }}" placeholder="{{ __('Enter course fee') }}">
                                                @error('course_fee')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="registration_fee">{{ __('Registration Fee (Rs.)') }}</label>
                                                <input type="number" step="0.01" name="registration_fee" id="registration_fee" class="form-control @error('registration_fee') is-invalid @enderror" value="{{ old('registration_fee', 0) }}" placeholder="{{ __('Enter registration fee') }}">
                                                @error('registration_fee')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="serial_number">{{ __('Serial Number') }}</label>
                                                <input type="number" name="serial_number" id="serial_number" class="form-control @error('serial_number') is-invalid @enderror" value="{{ old('serial_number', 0) }}" placeholder="{{ __('Enter serial number') }}">
                                                @error('serial_number')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                                <small class="text-muted">{{ __('Used for ordering courses in the fee structure table') }}</small>
                                            </div>

                                            <div class="form-group">
                                                <label for="status">{{ __('Status') }} <span class="text-danger">*</span></label>
                                                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                                    <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>{{ __('Active') }}</option>
                                                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                                                </select>
                                                @error('status')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>

                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <x-admin.save-button :text="__('Save')"></x-admin.save-button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

