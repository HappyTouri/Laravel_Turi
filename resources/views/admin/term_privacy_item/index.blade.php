
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Edit Terms & Privacy Item</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin_term_privacy_item_update', $term_privacy_item->id) }}" method="post" > 
                                    @csrf
                                   
                                    <div class="mb-3">
                                        <label class="form-label">Terms</label>
                                        <textarea name="term" class="form-control editor" id="" cols="30" rows="10">{{$term_privacy_item->term}}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Privacies</label>
                                        <textarea name="privacy" class="form-control editor" id="" cols="30" rows="10">{{$term_privacy_item->privacy}}</textarea>
                                    </div>

                                   
                                    <div class="mb-3">
                                        <label class="form-label"></label>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
