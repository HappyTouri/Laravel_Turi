
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Add User</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_users')}}" class="btn btn-primary"><i class="fas fa-plus"></i> All Users</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('admin_user_create_submit')}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3"> 
                                        <label class="form-label">Photo</label>
                                        <div><input type="file"  name="photo"></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="text" class="form-control" name="email" value="{{old('email')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Phone</label>
                                                <input type="text" class="form-control" name="phone" value="{{old('phone')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Country</label>
                                                <input type="text" class="form-control" name="country" value="{{old('country')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Address</label>
                                                <input type="text" class="form-control" name="address" value="{{old('address')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">State</label>
                                                <input type="text" class="form-control" name="state" value="{{old('state')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">City</label>
                                                <input type="text" class="form-control" name="city" value="{{old('city')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Zip Code</label>
                                                <input type="text" class="form-control" name="zip" value="{{old('zip')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Password</label>
                                                <input type="password" class="form-control" name="password" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-select">
                                                    <option value="1">Active</option>
                                                    <option value="0">Pending</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Rule</label>
                                                <select name="rule_id" id="rule-select" class="form-select" onchange="checkSelectedRule()">
                                                    <option value="">User</option>
                                                    @foreach ($rules as $item)
                                                    <option value="{{$item->id}}">{{$item->rule}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        {{-- Accommodations ID --}}
                                        <div class="col-md-6" id="accommodation-div" style="display: none;">
                                            <div class="mb-3">
                                                <label class="form-label">Accommodation</label>
                                                <select name="accommodation_id" class="form-select">
                                                    @foreach ($accommodations as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div> 
                                        </div>
                                        {{-- Tourguide ID --}}
                                        <div class="col-md-6" id="tourguide-div" style="display: none;">
                                            <div class="mb-3">
                                                <label class="form-label">Tourguide</label>
                                                <select name="tourguide_id" class="form-select">
                                                    @foreach ($tourguides as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div> 
                                        </div>
                                        {{-- Drivers ID --}}
                                        <div class="col-md-6" id="driver-div" style="display: none;">
                                            <div class="mb-3">
                                                <label class="form-label">Driver</label>
                                                <select name="driver_id" class="form-select">
                                                    @foreach ($drivers as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div> 
                                        </div>
                                        {{-- destination ID --}}
                                        <div class="col-md-6" id="destination-div" style="display: none;">
                                            <div class="mb-3">
                                                <label class="form-label">Destination</label>
                                                <select name="destination_id" class="form-select">
                                                    @foreach ($destinations as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div> 
                                        </div>
                                    </div>
                                    
                                    




                                    <div class="mb-3">
                                        <label class="form-label"></label>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
       function checkSelectedRule() {
        const ruleSelect = document.getElementById('rule-select');
        const selectedRule = ruleSelect.options[ruleSelect.selectedIndex].text; // Get the selected rule text
        
        // Define an object to map rules to their corresponding div IDs
        const divs = {
            'Hotel': 'accommodation-div',
            'Tour Guide': 'tourguide-div',
            'Driver': 'driver-div',
            'Tour Operator': 'destination-div'
        };

        // Loop through the divs to hide all and show the selected one
        for (const [rule, divId] of Object.entries(divs)) {
            const divElement = document.getElementById(divId);
            if (rule === selectedRule) {
                divElement.style.display = 'block'; // Show the relevant div
            } else {
                divElement.style.display = 'none'; // Hide all other divs
            }
    }
        }

    </script>
@endsection
