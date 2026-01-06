@extends('admin.master_layout')
@section('title')
    <title>{{ __('Edit Location') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.fee-structure-locations.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Edit Location') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.fee-structure-locations.index') }}">{{ __('Locations') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Edit Location') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Edit Location') }}</h4>
                                <div>
                                    <a href="{{ route('admin.fee-structure-locations.index') }}" class="btn btn-primary">
                                        <i class="fa fa-arrow-left"></i> {{ __('Back') }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.fee-structure-locations.update', $location->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="name">{{ __('Name') }} <span class="text-danger">*</span></label>
                                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $location->name) }}" placeholder="{{ __('Enter location name') }}">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="order">{{ __('Order') }}</label>
                                                <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $location->order) }}" placeholder="{{ __('Enter order number') }}">
                                                @error('order')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                                <small class="text-muted">{{ __('Lower numbers appear first') }}</small>
                                            </div>

                                            <div class="form-group">
                                                <label for="status">{{ __('Status') }} <span class="text-danger">*</span></label>
                                                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                                    <option value="1" {{ old('status', $location->status) == 1 ? 'selected' : '' }}>{{ __('Active') }}</option>
                                                    <option value="0" {{ old('status', $location->status) == 0 ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                                                </select>
                                                @error('status')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>

                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <x-admin.save-button :text="__('Update')"></x-admin.save-button>
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

