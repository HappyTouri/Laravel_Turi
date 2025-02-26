@extends('admin.layout.master')

@section('main_content')
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Price List of {{$accommodation->name}}</h1>
                <div class="ml-auto">
                    <a href="{{ route('admin_accommodation_index', $accommodation->destination_id) }}" class="btn btn-primary"><i class="fas fa-plus"></i> Back to Previous</a>
                </div>
            </div>
            
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <form action="{{ route('admin_save_room_prices', $accommodation->id) }}" method="POST">
                                        @csrf
                                        <table class="table table-bordered" id="roomPriceTable">
                                            <thead>
                                                <tr>
                                                    <th>From</th>
                                                    <th>Till</th>
                                                    <th>Extra Bed</th>
                                                    @foreach ($accommodation_rooms_categories as $item)
                                                        <th>{{$item->room_category->category}}</th>
                                                    @endforeach
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($seasons->count() >0)
                                                    @foreach ($seasons as $season)
                                                    <tr class="price-row">
                                                        <input type="hidden" name="season_ids[]" value="{{ $season->id }}"> <!-- Track existing season ID -->
                                                        <td>
                                                            <input type="text" class="form-control border-0 w-auto" name="season_start_date[]" value="{{ \Carbon\Carbon::parse($season->start_date)->format('d.m.Y') }}" required size="10">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control border-0 w-auto" name="season_end_date[]" value="{{ \Carbon\Carbon::parse($season->end_date)->format('d.m.Y') }}" required size="10">
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control border-0" name="extra_bed_price[]" value="{{ $season->extra_bed }}" required min="0">
                                                        </td>
                                                        @foreach ($accommodation_rooms_categories as $item)
                                                            <td>
                                                                <input type="number" class="form-control border-0" name="room_prices[{{ $item->id }}][]" 
                                                                    value="{{ optional($season->roomPrices->firstWhere('accommodation_room_category_id', $item->id))->price }}" required min="0">
                                                            </td>
                                                        @endforeach
                                                        <td class="pt_10 pb_10">
                                                            <button type="button" class="btn btn-danger remove-row"><i class="fas fa-trash"></i></button>
                                                            <input type="checkbox" name="delete_season_ids[]" value="{{ $season->id }}" class="delete-checkbox" style="display: none;">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @endif
                                               
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-primary" id="addRow"><i class="fas fa-plus"></i> Add Row</button>
                                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save Prices</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        $(document).ready(function() {
        // Initialize datepickers for existing rows
        initializeDatepickers();

        let datepickerCount = 0; // Start count for unique datepicker IDs
        $('#addRow').click(function() {
            datepickerCount++; // Increment the count for a unique ID
            const table = $('#roomPriceTable tbody');
            const newRow = `
                <tr class="price-row">
                    <td><input type="text" id="datepicker${datepickerCount}" class="form-control border-0 w-auto" name="season_start_date[]" required size="10"></td>
                    <td><input type="text" id="datepicker${datepickerCount + 1}" class="form-control border-0 w-auto" name="season_end_date[]" required size="10"></td>
                    <td><input type="number" class="form-control border-0" name="extra_bed_price[]" required min="0"></td>
                    @foreach ($accommodation_rooms_categories as $item)
                        <td><input type="number" class="form-control border-0" name="room_prices[{{ $item->id }}][]" required min="0"></td>
                    @endforeach
                    <td class="pt_10 pb_10">
                        <button type="button" class="btn btn-danger remove-row"><i class="fas fa-trash"></i></button>
                        
                    </td>
                </tr>
            `;
            table.append(newRow);

            // Initialize datepicker for the newly created elements
            $(`#datepicker${datepickerCount}, #datepicker${datepickerCount + 1}`).datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                language: {
                    today: "Today",
                    days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                    daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                    daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
                    months: [
                        "January", "February", "March", "April", "May", "June", "July", "August", 
                        "September", "October", "November", "December"
                    ],
                    monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
                }
            });

            datepickerCount++; // Increment again for the second datepicker
        });

        // Event delegation for removing rows
        $('#roomPriceTable').on('click', '.remove-row', function() {
            const row = $(this).closest('tr');
            const checkbox = row.find('.delete-checkbox');

            // Check the delete checkbox if it exists
            if (checkbox.length > 0) {
                checkbox.prop('checked', true); // Mark for deletion
                row.find('input').prop('required', false); // Remove 'required' from all inputs in this row
            }

            row.addClass('deleted-row'); // Add class to mark the row as deleted
            row.hide(); // Hide the row from the UI instead of removing it
        });

            // Handle changes in checkboxes to remove 'required' when a row is marked for deletion
            $('#roomPriceTable').on('change', '.delete-checkbox', function() {
                const row = $(this).closest('tr');
                if ($(this).is(':checked')) {
                    row.find('input').prop('required', false); // Remove required from all inputs in this row
                } else {
                    row.find('input').prop('required', true); // Re-add required if unchecked
                }
            });
        });

        // Function to initialize all datepickers on page load
        function initializeDatepickers() {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true
            });
        }

    </script>
@endsection
