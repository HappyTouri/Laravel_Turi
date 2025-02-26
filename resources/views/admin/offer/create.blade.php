@extends('admin.layout.master')

@section('main_content')
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Create Offer</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_offer_index')}}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('admin_offer_create_submit')}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Select Destination</label>
                                                <select name="destination_id" id="destination" class="form-select">
                                                    @foreach ($destinations as $destination)
                                                    <option value="{{$destination->id}}" @if(old('destination_id') == $destination->id) selected @endif>{{$destination->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Select Title</label>
                                                <select name="package_title_id" class="form-select">
                                                    @foreach ($package_titles as $item)
                                                    <option value="{{$item->id}}" @if(old('package_title_id') == $item->id) selected @endif>{{$item->title_en}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 d-flex flex-row-reverse">
                                            <div class=" align-self-end  mb-3">
                                                <label class="form-label"></label>
                                                <button type="submit" class="btn btn-primary">Create Offer</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Row and Delete Row Buttons -->
                <div class="row mb-3">
                    <div class="col-12 text-end">
                        <button id="deleteRow" class="btn btn-danger">
                            <i class="fas fa-minus"></i> <!-- Minus icon -->
                        </button>
                        <span id="rowCountDisplay" class="mx-3">Rows: 1</span> <!-- Row count display -->
                        <button id="addRow" class="btn btn-success">
                            <i class="fas fa-plus"></i> <!-- Plus icon -->
                        </button>
                    </div>
                </div>

                <!-- Dynamic Table -->
                <div class="table-responsive">
                    <table id="offerTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Featured Photo</th>
                                <th>Name</th>
                                <th>Gallery</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <select name="city[]" class="form-select city-dropdown">
                                        <option value="">Select City</option>
                                        <!-- Cities will be populated dynamically here -->
                                    </select>                                    
                                </td>
                                <td><input type="text" name="name[]" class="form-control"></td>
                                <td><input type="file" name="gallery[]"></td>
                                <td class="pt_10 pb_10">
                                    <button class="btn btn-primary"><i class="fas fa-edit"></i></button>
                                    {{-- <button class="btn btn-danger delete-btn"><i class="fas fa-trash"></i></button> --}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <script>
        $(document).ready(function () {
            var rowCount = $('#offerTable tbody tr').length; // Initialize row count based on the table
            updateRowCountDisplay(); // Initial display update
    
            // Function to handle destination change and fetch cities
            function fetchCities(destinationId, targetDropdown) {
                if (destinationId) {
                    $.ajax({
                        url: "{{ url('get-cities') }}/" + destinationId, // Dynamic URL
                        method: 'GET',
                        success: function (data) {
                            targetDropdown.empty(); // Clear existing options
                            targetDropdown.append('<option value="">Select City</option>');
                            $.each(data, function (key, city) {
                                targetDropdown.append('<option value="' + city.id + '">' + city.name + '</option>');
                            });
                        },
                        error: function (xhr, status, error) {
                            console.error('Error fetching cities:', error);
                        }
                    });
                } else {
                    targetDropdown.empty(); // Clear the dropdown if no destination is selected
                    targetDropdown.append('<option value="">Select City</option>');
                }
            }
    
            // Attach change event to destination dropdown in the form
            $('#destination').on('change', function () {
                var destinationId = $(this).val();
                fetchCities(destinationId, $('.city-dropdown')); // Populate all city dropdowns
            });
    
            // Add Row
            $('#addRow').on('click', function (e) {
                e.preventDefault(); // Prevent form submission
                rowCount++;
                var newRow = `<tr>
                    <td>${rowCount}</td>
                    <td><select name="city[]" class="form-select city-dropdown"><option value="">Select City</option></select></td>
                    <td><input type="text" name="name[]" class="form-control"></td>
                    <td><input type="file" name="gallery[]"></td>
                    <td class="pt_10 pb_10">
                        <button class="btn btn-primary"><i class="fas fa-edit"></i></button>
                    </td>
                </tr>`;
                $('#offerTable tbody').append(newRow);
                updateRowCountDisplay(); // Update display after adding a row
    
                // Fetch cities for the new row based on the selected destination
                var destinationId = $('#destination').val();
                if (destinationId) {
                    fetchCities(destinationId, $('#offerTable tbody tr:last').find('.city-dropdown'));
                }
            });
    
            // Delete Last Row
            $('#deleteRow').on('click', function (e) {
                e.preventDefault(); // Prevent form submission
                if (rowCount > 1) { // Ensure there's at least one row
                    $('#offerTable tbody tr:last').remove();
                    rowCount--;
                    updateRowCountDisplay(); // Update display after deleting a row
                }
            });
    
            // Function to update row count display
            function updateRowCountDisplay() {
                $('#rowCountDisplay').text(`Rows: ${rowCount}`);
            }
        });
    </script>
    
    
@endsection
