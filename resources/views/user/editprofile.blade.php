@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Update Profile</h1>
          </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                @if (\Session::has('success'))
                <span class="is-invalid"></span>
                <span  class="error invalid-feedback">
                    <strong class="login-box-msg" ><h2>{!! \Session::get('success') !!}</h2></strong>
                </span>
            @endif
                <form method="POST" action="{{ route('user.updateprofile') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}" />
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">      
                                    <div class="form-group">
                                        <label>Email :</label>
                                        <label>{{ $user->email }}</label>
                                    </div> 
                                </div> 
                                <div class="col-sm-6">      
                                    <div class="form-group">
                                        <label>Status :</label>
                                        <label>{{ $user->status }}</label>
                                    </div> 
                                 </div> 
                            </div>   
                            <div class="row">
                                <div class="col-sm-6">      
                                        <div class="form-group">
                                            <label>Name</label>
                                             <input type="text"
                                                        name="user_name"
                                                        value="{{ $user->name }}"
                                                        placeholder="Name"
                                                        class="form-control @error('user_name') is-invalid @enderror">
                                            @error('user_name')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                </div> 
                                <div class="col-sm-6">      
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <input type="text"
                                                    name="company_name"
                                                    value="{{ $user->company_name }}"
                                                    placeholder="Name"
                                                    class="form-control @error('company_name') is-invalid @enderror">
                                                    @error('company_name')
                                                        <span class="error invalid-feedback">{{ $message }}</span>
                                                 @enderror
                                      </div>
                                </div> 
                            </div> 
                            <div class="row">
                                <div class="col-sm-6">      
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password"
                                                        name="password"
                                                        value=""
                                                        placeholder="Password"
                                                        class="form-control @error('password') is-invalid @enderror">
                                            @error('password')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                </div> 
                                <div class="col-sm-6">      
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password"
                                                    name="password_confirmation"
                                                    value=""
                                                    placeholder="Confirm password"
                                                    class="form-control">
                                        </div>
                                </div> 
                            </div> 
                            <div class="row">
                                <div class="col-sm-6">      
                                        <div class="form-group">
                                            <label>Mobile Number</label>
                                            <input type="text"
                                                        name="mobile_no"
                                                        value="{{ $user->mobile_no }}"
                                                        placeholder="Mobile Number"
                                                        class="form-control @error('mobile_no') is-invalid @enderror">
                                            @error('mobile_no')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                </div> 
                                <div class="col-sm-6">      
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio"  name="gender" value="m" {{ ($user->gender=="m")? "checked" : "" }} >
                                        <label class="form-check-label">Male</label>
                                        </div>
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" value="f" {{ ($user->gender=="f")? "checked" : "" }}>
                                        <label class="form-check-label">Female</label>
                                        </div>
                                    </div> 
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-sm-6">      
                                    <div class="form-group">
                                        <label>Profile Image</label>
                                        <div class="input-group">
                                        <input type="file"
                                            name="image"
                                            placeholder="Profile"
                                            class="custom-file-input @error('image') is-invalid @enderror"">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            @error('image')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                     </div> 
                                     @if($user->images)
                                     <img src="{{ URL::asset('uploads/'.$user->images->file) }}" width="100" height="100" />
                                     @endif
                                </div>
                                </div> 
                            </div>
                           
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                </form>  
            </div>
         </div>
         </div>
    </div>    
</section> 


@endsection
