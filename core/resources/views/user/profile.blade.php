@extends('backend.layouts.main') 
@section('title', 'Profile')
@section('content')
@push('head')
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/datedropper/datedropper.min.css') }}">
@endpush

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-file-text bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Profile')}}</h5>
                            <span>{{ __('Update Profile')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('panel.dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            {{-- <li class="breadcrumb-item">
                                <a href="#">{{ __('Pages')}}</a>
                            </li> --}}
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Profile')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            @include('backend.include.message')
            <div class="col-lg-4 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center"> 
                            <div style="width: 150px; height: 150px; position: relative" class="mx-auto">
                                <img src="{{ ($user && $user->avatar) ? asset('storage/backend/users/'.$user->avatar) : asset('backend/default/default-avatar.png') }}" class="rounded-circle" width="150" style="object-fit: cover; width: 150px; height: 150px" />
                                <button class="btn btn-dark rounded-circle position-absolute" style="width: 30px; height: 30px; padding: 8px; line-height: 1; top: 0; right: 0"  data-toggle="modal" data-target="#updateProfileImageModal"><i class="ik ik-camera"></i></button>
                            </div>
                            <h4 class="card-title mt-10">{{auth()->user()->name}}</h4>
                            <p class="card-subtitle">{{ ucfirst(auth()->user()->roles[0]->name ?? '') }}</p>
                        </div>
                    </div>
                    <hr class="mb-0"> 
                    <div class="card-body"> 
                        <small class="text-muted d-block">{{ __('Email address')}} </small>
                        <h6>{{ $user->email }}</h6> 
                        <small class="text-muted d-block pt-10">{{ __('Phone')}}</small>
                        <h6>{{ $user->phone }}</h6> 
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="card">
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link @if(!request()->get('active')) active @endif" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false">{{ __('Profile')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">{{ __('Setting')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true">{{ __('Account')}}</a>
                        </li>
                        @if(AuthRole() == 'Partner')
                            <li class="nav-item">
                                <a class="nav-link @if(request()->get('active') == 'eKyc') active @endif" id="pills-timeline-tab" data-toggle="pill" href="#eKyc" role="tab" aria-controls="pills-timeline" aria-selected="true">{{ __('eKyc')}}</a>
                            </li>
                        @endif
                   
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade  @if(!request()->get('active')) show active @endif" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 col-6"> <strong>{{ __('Full Name')}}</strong>
                                        <br>
                                        <p class="text-muted">{{ $user->name .' '.$user->last_name }}</p>
                                    </div>
                                   
                                    <div class="col-md-3 col-6"> <strong>{{ __('Gender')}}</strong>
                                        <br>
                                        <p class="text-muted">{{ $user->gender }}</p>
                                    </div>
                                    <div class="col-md-3 col-6"> <strong>{{ __('Status')}}</strong>
                                        <br>
                                        <p class="text-muted">{{ getStatus($user->status)['name'] }}</p>
                                    </div>
                                    <div class="col-md-3 col-6"> <strong>{{ __('DOB')}}</strong>
                                        <br>
                                        <p class="text-muted">{{ $user->dob }}</p>
                                    </div>
                                    <div class="col-md-3 col-6"> <strong>{{ __('Country')}}</strong>
                                        <br>
                                        <p class="text-muted">{{ fetchFirst('App\Models\Country',$user->country,'name') }} </p>
                                    </div>
                                    <div class="col-md-3 col-6"> <strong>{{ __('Location')}}</strong>
                                        <br>
                                        <p class="text-muted">{{ fetchFirst('App\Models\City',$user->city,'name') }} , {{ fetchFirst('App\Models\State',$user->state,'name') }}</p>
                                    </div>
                                    <div class="col-md-3 col-6"> <strong>{{ __('Pincode')}}</strong>
                                        <br>
                                        <p class="text-muted">{{ $user->pincode }}</p>
                                    </div>
                                    <div class="col-md-3 col-6"> <strong>{{ __('Role')}}</strong>
                                        <br>
                                        <p class="text-muted">{{ authRole() }}</p>
                                    </div>

                                    {{-- <div class="col-md-3 col-6"> <strong>{{ __('Timezone')}}</strong>
                                        <br>
                                        <p class="text-muted">{{ $user->timezone }}</p>
                                    </div>
                                    <div class="col-md-3 col-6"> <strong>{{ __('Language')}}</strong>
                                        <br>
                                        <p class="text-muted">{{ $user->language }}</p>
                                    </div> --}}

                                    <div class="col-md-6"> <strong>{{ __('Address')}}</strong>
                                        <br>
                                        <p class="text-muted">{{ $user->address }}</p>
                                    </div>
                                </div>
                                <hr>
                                
                                {{-- <p class="mt-30">{{ __('Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.')}}</p>
                                <p>{{ __('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries')}} </p>
                                <p>{{ __('It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.')}}</p>
                                <h4 class="mt-30">{{ __('Skill Set')}}</h4>
                                <hr>
                                <h6 class="mt-30">{{ __('Wordpress')}} <span class="pull-right">80%</span></h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%;"> <span class="sr-only">50% Complete</span> </div>
                                </div>
                                <h6 class="mt-30">{{ __('HTML 5')}} <span class="pull-right">90%</span></h6>
                                <div class="progress  progress-sm">
                                    <div class="progress-bar bg-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%;"> <span class="sr-only">50% Complete</span> </div>
                                </div>
                                <h6 class="mt-30">{{ __('jQuery')}} <span class="pull-right">50%</span></h6>
                                <div class="progress  progress-sm">
                                    <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%;"> <span class="sr-only">50% Complete</span> </div>
                                </div>
                                <h6 class="mt-30">{{ __('Photoshop')}} <span class="pull-right">70%</span></h6>
                                <div class="progress  progress-sm">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%;"> <span class="sr-only">50% Complete</span> </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <form action="{{ route('panel.update-user-profile', $user->id) }}" method="POST" class="form-horizontal">
                                    @csrf
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">{{ __('First Name')}}<span class="text-danger">*</span></label>
                                                <input required type="text" placeholder="First Name" class="form-control" name="name" id="name" value="{{ $user->name }}">
                                            </div>  
                                        </div>
                                        <!--<div class="col-md-6">-->
                                        <!--    <div class="form-group">-->
                                        <!--        <label for="lastname">{{ __('Last Name')}}<span class="text-danger">*</span></label>-->
                                        <!--        <input required type="text" placeholder="Last Name" class="form-control" name="lastname" id="lastname" value="{{ $user->last_name }}">-->
                                        <!--    </div>  -->
                                        <!--</div>-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">{{ __('Email')}}<span class="text-danger">*</span></label>
                                                <input required type="email" placeholder="test@test.com" class="form-control" name="email" id="email" value="{{ $user->email }}" readonly>
                                            </div>  
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone">{{ __('Phone No')}}<span class="text-danger">*</span></label>
                                                <input required type="text" placeholder="123 456 7890" id="phone" name="phone" class="form-control" value="{{ $user->phone }}">
                                            </div>  
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dob">{{ __('DOB')}}</label>
                                                <input class="form-control" type="date" name="dob" max="{{ now()->format('Y-m-d') }}"placeholder="Select your date" value="{{ $user->dob }}" />
                                                <div class="help-block with-errors"></div>
                                            </div>  
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="gender">{{ __('Gender')}}<span class="text-red">*</span></label>
                                                <div class="form-radio">
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" name="gender" value="Male" {{ $user->gender == 'Male' ? 'checked' : '' }}>
                                                                <i class="helper"></i>{{ __('Male')}}
                                                            </label>
                                                        </div>
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" name="gender" value="Female" {{ $user->gender == 'Female' ? 'checked' : '' }}>
                                                                <i class="helper"></i>{{ __('Female')}}
                                                            </label>
                                                        </div>
                                                </div>                                        
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="country">{{ __('Country')}}</label>
                                                <select name="country" id="country" class="form-control select2">
                                                    <option value="" readonly>{{ __('Select Country')}}</option>
                                                    @foreach (\App\Models\Country::all() as  $country)
                                                        <option value="{{ $country->id }}" @if($user->country != null) {{ $country->id == $user->country ? 'selected' : '' }} @elseif($country->name == 'India') selected @endif>{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                                
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="state">{{ __('State')}}</label> 
                                                <select name="state" id="state" class="form-control select2">
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="city">{{ __('City')}}</label>
                                                <select name="city" id="city" class="form-control select2">
                                                </select> 
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="pincode">{{ __('Pincode')}}</label>
                                                <input id="pincode" type="number" class="form-control" name="pincode" placeholder="Enter Pincode" value="{{ $user->pincode }}" >
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="pincode">{{ __('Timezone')}}</label>
                                                <select name="timezone" class="form-control" id="timezone">
                                                    @foreach (config('time-zone') as $zone)
                                                        <option value="{{ $zone['name'] }}" {{ $zone['name'] == $user->timezone ? 'selected' : '' }}>{{ $zone['name'] }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="pincode">{{ __('language')}}</label>
                                                <select name="language" class="form-control" id="language">
                                                    @foreach (config('language') as $lang)
                                                        <option value="{{ $lang['code'] }}" {{ $lang['code'] == $user->language ? 'selected' : '' }}>{{ $lang['name'] }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div> --}}

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="address">{{ __('Address')}}<span class="text-danger">*</span></label>
                                                <textarea required name="address" name="address" rows="5" class="form-control">{{ $user->address }}</textarea>
                                            </div>  
                                        </div>                                    
                                    </div>
                                    
                                    <button type="submit" class="btn btn-success"  >Update Profile</button>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                            <div class="card-body">
                                
                                <div class="row">
                                    <div class="col-6">
                                        {{-- <div class="card"> --}}
                                            <h5 class="card-title m-0">Change Password</h5>
                                            <div class="card-body">
                                                <form action="{{ route('panel.update-password', $user->id) }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="password">New Password</label>
                                                        <input type="password" class="form-control" name="password" placeholder="New Password" id="password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="confirm-password">Confirm Password</label>
                                                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" id="confirm-password">
                                                    </div>
                                                    <button class="btn btn-success" type="submit">Update Password</button>
                                                </form>
                                            </div>
                                        {{-- </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade @if(request()->get('active') == 'eKyc') show active @endif" id="eKyc" role="tabpanel" aria-labelledby="pills-eKyc-tab">
                            <div class="card-body"> 
                                <form action="{{route('panel.partner.profile.submit-eKyc-doc')}}" method="POST" class="row" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-6 col-md-6">
                                        <div class="form-group">
                                            <label for="document_type">Document Type</label>
                                            <select name="document_type" id="" class="form-control select2">
                                                <option value="" readonly>Select Document Type</option>
                                                @foreach (getDocumentType() as $docType)
                                                    <option value="{{$docType['name']}}" @if (@$eKyc_details->document_type == $docType['name'])
                                                        selected @endif>{{$docType['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="document_number">Document Number</label>
                                            <input type="text" class="form-control" name="document_number" value="{{@$eKyc_details->document_number}}" placeholder="Enter Valid Number" id="document_number">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="image">Front Attachment</label>
                                            <input type="file" class="form-control" name="document_front" id="document_front">
                                        </div>
                                        <img class="w-50" src="{{asset('storage/backend/user/docs/'.@$eKyc_details->document_front)}}" alt="">
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="image">Back Attachment</label>
                                            <input type="file" class="form-control" name="document_back" id="document_back">
                                        </div>
                                        <img class="w-50" src="{{asset('storage/backend/user/docs/'.@$eKyc_details->document_back)}}" alt="">
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-success" type="submit">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="updateProfileImageModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="updateProfileImageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('panel.update-profile-img', $user->id) }}" method="POST" enctype="multipart/form-data">
                
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateProfileImageModalLabel">Update profile image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        @csrf
                        <img 
                        src="{{ ($user && $user->avatar) ? asset('storage/backend/users/'.$user->avatar) : asset('backend/default/default-avatar.png') }}"
                         class="img-fluid w-50 mx-auto d-block" alt="" id="profile-image">
                        <div class="form-group mt-5">
                            <label for="avatar" class="form-label">Select profile image<span class="text-danger">*</span></label> <br>
                            <input required type="file" name="avatar" id="avatar" accept="image/jpg,image/png,image/jpeg">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('script') 
        <script src="{{ asset('backend/plugins/datedropper/datedropper.min.js') }}"></script>
        <script src="{{ asset('backend/js/form-picker.js') }}"></script>
        <script src="{{ asset('backend/plugins/select2/dist/js/select2.min.js') }}"></script>
           <script>
           function getStates(countryId = 101) {
				$.ajax({
					url: '{{ route("world.get-states") }}',
					method: 'GET',
					data: {
						country_id: countryId
					},
					success: function(res) {
						$('#state').html(res).css('width', '100%').select2();
					}
				})
			}
			
			function getCities(stateId = 101) {
				$.ajax({
					url: '{{ route("world.get-cities") }}',
					method: 'GET',
					data: {
						state_id: stateId
					},
					success: function(res) {
						$('#city').html(res).css('width', '100%').select2();
					}
				})
			}
    
        	// Country, City, State Code
			$('#state, #country, #city').css('width', '100%').select2();
			
			$(document).ready(function(e) {
				getStates($(this).val());
			})
		
			$('#state').on('change', function(e) {
				getCities($(this).val());
			})

			 // this functionality work in edit page
			function getStateAsync(countryId) {
				return new Promise((resolve, reject) => {
					$.ajax({
						url: '{{ route("world.get-states") }}',
						method: 'GET',
					data: {
						country_id: countryId
					},
					success: function (data) {
						$('#state').html(data);
						$('.state').html(data);
					resolve(data)
					},
					error: function (error) {
					reject(error)
					},
				})
				})
			}
    
			function getCityAsync(stateId) {
				if(stateId != ""){
					return new Promise((resolve, reject) => {
						$.ajax({
							url: '{{ route("world.get-cities") }}',
							method: 'GET',
							data: {
								state_id: stateId
							},
							success: function (data) {
								$('#city').html(data);
								$('.city').html(data);
							resolve(data)
							},
							error: function (error) {
							reject(error)
							},
						})
					})
				}
			}
            $(document).ready(function(){
            var country = "{{ $user->country }}";
			var state = "{{ $user->state }}";
			var city = "{{ $user->city }}";

            if(state){
                getStateAsync(country).then(function(data){
                    $('#state').val(state).change();
                    $('#state').trigger('change');
                });
			}
			if(city){
                $('#state').on('change', function(){
                    if(state == $(this).val()){
                        getCityAsync(state).then(function(data){
                            $('#city').val(city).change();
                            $('#city').trigger('change');
                        });
                    }
                });
			}
            });
        </script>
    @endpush
    @endsection

