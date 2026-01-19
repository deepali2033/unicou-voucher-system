@extends('user.layouts.app')

@section('title', 'Book New Service')
@section('page-title', 'Book New Service')

@section('page-actions')
    <a href="{{ route('user.book-services.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Bookings
    </a>
@endsection

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header">
            <h3 class="card-title mb-0">Book a New Service</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('user.book-services.store') }}" method="POST">
                @csrf

                <div class="row g-4">
                    <!-- Service Selection -->
                    <div class="col-md-6">
                        <label for="service_name" class="form-label">Service Type <span class="text-danger">*</span></label>
                        <select name="service_name" id="service_name" class="form-select @error('service_name') is-invalid @enderror" required>
                            <option value="">Select a service...</option>
                            @foreach($services as $service)
                                <option value="{{ $service->name }}" {{ old('service_name') === $service->name ? 'selected' : '' }}>
                                    {{ $service->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('service_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Property Details -->
                    <div class="col-md-3">
                        <label for="bedrooms" class="form-label">Bedrooms <span class="text-danger">*</span></label>
                        <select name="bedrooms" id="bedrooms" class="form-select @error('bedrooms') is-invalid @enderror" required>
                            <option value="">Select...</option>
                            @for($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}" {{ old('bedrooms') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        @error('bedrooms')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="bathrooms" class="form-label">Bathrooms <span class="text-danger">*</span></label>
                        <select name="bathrooms" id="bathrooms" class="form-select @error('bathrooms') is-invalid @enderror" required>
                            <option value="">Select...</option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('bathrooms') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        @error('bathrooms')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Additional Service Details -->
                    <div class="col-md-6">
                        <label for="extras" class="form-label">Extras <span class="text-danger">*</span></label>
                        <select name="extras" id="extras" class="form-select @error('extras') is-invalid @enderror" required>
                            <option value="">Select extras...</option>
                            <option value="none" {{ old('extras') === 'none' ? 'selected' : '' }}>No extras</option>
                            <option value="inside_oven" {{ old('extras') === 'inside_oven' ? 'selected' : '' }}>Inside Oven</option>
                            <option value="inside_fridge" {{ old('extras') === 'inside_fridge' ? 'selected' : '' }}>Inside Fridge</option>
                            <option value="inside_cabinets" {{ old('extras') === 'inside_cabinets' ? 'selected' : '' }}>Inside Cabinets</option>
                            <option value="windows" {{ old('extras') === 'windows' ? 'selected' : '' }}>Windows</option>
                        </select>
                        @error('extras')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="frequency" class="form-label">Frequency <span class="text-danger">*</span></label>
                        <select name="frequency" id="frequency" class="form-select @error('frequency') is-invalid @enderror" required>
                            <option value="">Select frequency...</option>
                            <option value="one_time" {{ old('frequency') === 'one_time' ? 'selected' : '' }}>One Time</option>
                            <option value="weekly" {{ old('frequency') === 'weekly' ? 'selected' : '' }}>Weekly</option>
                            <option value="biweekly" {{ old('frequency') === 'biweekly' ? 'selected' : '' }}>Bi-weekly</option>
                            <option value="monthly" {{ old('frequency') === 'monthly' ? 'selected' : '' }}>Monthly</option>
                        </select>
                        @error('frequency')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="square_feet" class="form-label">Square Feet <span class="text-danger">*</span></label>
                        <select name="square_feet" id="square_feet" class="form-select @error('square_feet') is-invalid @enderror" required>
                            <option value="">Select range...</option>
                            <option value="less_than_1000" {{ old('square_feet') === 'less_than_1000' ? 'selected' : '' }}>Less than 1,000 sq ft</option>
                            <option value="1000_2000" {{ old('square_feet') === '1000_2000' ? 'selected' : '' }}>1,000 - 2,000 sq ft</option>
                            <option value="2000_3000" {{ old('square_feet') === '2000_3000' ? 'selected' : '' }}>2,000 - 3,000 sq ft</option>
                            <option value="more_than_3000" {{ old('square_feet') === 'more_than_3000' ? 'selected' : '' }}>More than 3,000 sq ft</option>
                        </select>
                        @error('square_feet')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Scheduling -->
                    <div class="col-md-6">
                        <label for="booking_date" class="form-label">Preferred Date <span class="text-danger">*</span></label>
                        <input type="date" name="booking_date" id="booking_date" class="form-control @error('booking_date') is-invalid @enderror" value="{{ old('booking_date') }}" required min="{{ date('Y-m-d') }}">
                        @error('booking_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="booking_time" class="form-label">Preferred Time <span class="text-danger">*</span></label>
                        <select name="booking_time" id="booking_time" class="form-select @error('booking_time') is-invalid @enderror" required>
                            <option value="">Select time...</option>
                            <option value="morning" {{ old('booking_time') === 'morning' ? 'selected' : '' }}>Morning (8AM - 12PM)</option>
                            <option value="afternoon" {{ old('booking_time') === 'afternoon' ? 'selected' : '' }}>Afternoon (12PM - 4PM)</option>
                            <option value="evening" {{ old('booking_time') === 'evening' ? 'selected' : '' }}>Evening (4PM - 8PM)</option>
                            <option value="flexible" {{ old('booking_time') === 'flexible' ? 'selected' : '' }}>Flexible</option>
                        </select>
                        @error('booking_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Customer Information -->
                    <div class="col-12">
                        <h5 class="mb-3 mt-4">Contact Information</h5>
                    </div>

                    <div class="col-md-6">
                        <label for="customer_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="customer_name" id="customer_name" class="form-control @error('customer_name') is-invalid @enderror" value="{{ old('customer_name', auth()->user()->name) }}" required>
                        @error('customer_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->user()->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                        <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Address Information -->
                    <div class="col-12">
                        <h5 class="mb-3 mt-4">Service Address</h5>
                    </div>

                    <div class="col-12">
                        <label for="street_address" class="form-label">Street Address <span class="text-danger">*</span></label>
                        <input type="text" name="street_address" id="street_address" class="form-control @error('street_address') is-invalid @enderror" value="{{ old('street_address') }}" required>
                        @error('street_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                        <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}" required>
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="state" class="form-label">State <span class="text-danger">*</span></label>
                        <select name="state" id="state" class="form-select @error('state') is-invalid @enderror" required>
                            <option value="">Select state...</option>
                            <option value="AL" {{ old('state') === 'AL' ? 'selected' : '' }}>Alabama</option>
                            <option value="AK" {{ old('state') === 'AK' ? 'selected' : '' }}>Alaska</option>
                            <option value="AZ" {{ old('state') === 'AZ' ? 'selected' : '' }}>Arizona</option>
                            <option value="AR" {{ old('state') === 'AR' ? 'selected' : '' }}>Arkansas</option>
                            <option value="CA" {{ old('state') === 'CA' ? 'selected' : '' }}>California</option>
                            <option value="CO" {{ old('state') === 'CO' ? 'selected' : '' }}>Colorado</option>
                            <option value="CT" {{ old('state') === 'CT' ? 'selected' : '' }}>Connecticut</option>
                            <option value="DE" {{ old('state') === 'DE' ? 'selected' : '' }}>Delaware</option>
                            <option value="FL" {{ old('state') === 'FL' ? 'selected' : '' }}>Florida</option>
                            <option value="GA" {{ old('state') === 'GA' ? 'selected' : '' }}>Georgia</option>
                            <!-- Add more states as needed -->
                        </select>
                        @error('state')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="zip_code" class="form-label">ZIP Code <span class="text-danger">*</span></label>
                        <input type="text" name="zip_code" id="zip_code" class="form-control @error('zip_code') is-invalid @enderror" value="{{ old('zip_code') }}" required>
                        @error('zip_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Additional Information -->
                    <div class="col-12">
                        <h5 class="mb-3 mt-4">Additional Information</h5>
                    </div>

                    <div class="col-md-6">
                        <label for="parking_info" class="form-label">Where to Park? <span class="text-danger">*</span></label>
                        <select name="parking_info" id="parking_info" class="form-select @error('parking_info') is-invalid @enderror" required>
                            <option value="">Select parking option...</option>
                            <option value="driveway" {{ old('parking_info') === 'driveway' ? 'selected' : '' }}>Driveway</option>
                            <option value="street" {{ old('parking_info') === 'street' ? 'selected' : '' }}>Street</option>
                            <option value="parking_lot" {{ old('parking_info') === 'parking_lot' ? 'selected' : '' }}>Parking Lot</option>
                            <option value="garage" {{ old('parking_info') === 'garage' ? 'selected' : '' }}>Garage</option>
                        </select>
                        @error('parking_info')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="flexible_time" class="form-label">Flexible with Time? <span class="text-danger">*</span></label>
                        <select name="flexible_time" id="flexible_time" class="form-select @error('flexible_time') is-invalid @enderror" required>
                            <option value="">Select option...</option>
                            <option value="yes" {{ old('flexible_time') === 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ old('flexible_time') === 'no' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('flexible_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="entrance_info" class="form-label">Entrance Information <span class="text-danger">*</span></label>
                        <select name="entrance_info" id="entrance_info" class="form-select @error('entrance_info') is-invalid @enderror" required>
                            <option value="">Select entrance type...</option>
                            <option value="front_door" {{ old('entrance_info') === 'front_door' ? 'selected' : '' }}>Front Door</option>
                            <option value="side_door" {{ old('entrance_info') === 'side_door' ? 'selected' : '' }}>Side Door</option>
                            <option value="back_door" {{ old('entrance_info') === 'back_door' ? 'selected' : '' }}>Back Door</option>
                            <option value="garage" {{ old('entrance_info') === 'garage' ? 'selected' : '' }}>Through Garage</option>
                        </select>
                        @error('entrance_info')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="pets" class="form-label">Do you have pets? <span class="text-danger">*</span></label>
                        <select name="pets" id="pets" class="form-select @error('pets') is-invalid @enderror" required>
                            <option value="">Select option...</option>
                            <option value="no" {{ old('pets') === 'no' ? 'selected' : '' }}>No pets</option>
                            <option value="dog" {{ old('pets') === 'dog' ? 'selected' : '' }}>Dog(s)</option>
                            <option value="cat" {{ old('pets') === 'cat' ? 'selected' : '' }}>Cat(s)</option>
                            <option value="other" {{ old('pets') === 'other' ? 'selected' : '' }}>Other pets</option>
                        </select>
                        @error('pets')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="special_instructions" class="form-label">Special Instructions</label>
                        <textarea name="special_instructions" id="special_instructions" class="form-control @error('special_instructions') is-invalid @enderror" rows="4" placeholder="Any special instructions or requests...">{{ old('special_instructions') }}</textarea>
                        @error('special_instructions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('user.book-services.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-calendar-check me-2"></i>Book Service
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
