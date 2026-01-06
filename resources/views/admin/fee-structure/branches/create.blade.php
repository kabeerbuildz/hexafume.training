@extends('admin.master_layout')
@section('title')
    <title>{{ __('Create Branch') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.fee-structure-branches.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Create Branch') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.fee-structure-branches.index') }}">{{ __('Branches') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Create Branch') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Create Branch') }}</h4>
                                <div>
                                    <a href="{{ route('admin.fee-structure-branches.index') }}" class="btn btn-primary">
                                        <i class="fa fa-arrow-left"></i> {{ __('Back') }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.fee-structure-branches.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="name">{{ __('Branch Name') }} <span class="text-danger">*</span></label>
                                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="{{ __('Enter branch name') }}">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="tag">{{ __('Tag') }}</label>
                                                <input type="text" name="tag" id="tag" class="form-control @error('tag') is-invalid @enderror" value="{{ old('tag') }}" placeholder="{{ __('e.g., ON-CAMPUS, INTERNATIONAL DESK') }}">
                                                @error('tag')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="address">{{ __('Address') }} <span class="text-danger">*</span></label>
                                                <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror" placeholder="{{ __('Enter branch address') }}">{{ old('address') }}</textarea>
                                                @error('address')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="icon_color">{{ __('Icon Color') }}</label>
                                                <select name="icon_color" id="icon_color" class="form-control @error('icon_color') is-invalid @enderror">
                                                    <option value="blue" {{ old('icon_color') == 'blue' ? 'selected' : '' }}>Blue</option>
                                                    <option value="green" {{ old('icon_color') == 'green' ? 'selected' : '' }}>Green</option>
                                                    <option value="red" {{ old('icon_color') == 'red' ? 'selected' : '' }}>Red</option>
                                                    <option value="orange" {{ old('icon_color') == 'orange' ? 'selected' : '' }}>Orange</option>
                                                    <option value="purple" {{ old('icon_color') == 'purple' ? 'selected' : '' }}>Purple</option>
                                                    <option value="pink" {{ old('icon_color') == 'pink' ? 'selected' : '' }}>Pink</option>
                                                    <option value="grey" {{ old('icon_color') == 'grey' ? 'selected' : '' }}>Grey</option>
                                                </select>
                                                @error('icon_color')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="icon">{{ __('Icon Class') }}</label>
                                                <input type="text" name="icon" id="icon" class="form-control @error('icon') is-invalid @enderror" value="{{ old('icon', 'fas fa-map-marker-alt') }}" placeholder="{{ __('e.g., fas fa-building, fas fa-map-marker-alt') }}">
                                                @error('icon')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                                <small class="text-muted">{{ __('FontAwesome icon class (e.g., fas fa-building)') }}</small>
                                            </div>

                                            <div class="form-group">
                                                <label for="link">{{ __('Branch Page URL') }}</label>
                                                <input type="text" name="link" id="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link') }}" placeholder="{{ __('Enter branch page URL (optional)') }}">
                                                @error('link')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="order">{{ __('Order') }}</label>
                                                <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', 0) }}" placeholder="{{ __('Enter order number') }}">
                                                @error('order')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                                <small class="text-muted">{{ __('Lower numbers appear first') }}</small>
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

