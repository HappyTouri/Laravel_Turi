
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Create Day Tour of {{$destination->name}}</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_destination_day_tours',$destination->id)}}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('admin_destination_day_tour_create_submit',$destination->id)}}" method="post">
                                    @csrf
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Select City</label>
                                            <select name="city_id" class="form-select">
                                                @foreach ($cities as $city)
                                                <option value="{{$city->id}}" @if(old('city_id') == $city->id) selected @endif>{{$city->city_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                               
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">Title English</label>
                                                <input type="text" class="form-control" name="title_en" value="{{old('title_en')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="mb-3">
                                                <label class="form-label">Description English</label>
                                                <textarea name="description_en" class="form-control editor" id="" cols="30" rows="10">{{old('description_en')}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">Title Russian</label>
                                                <input type="text" class="form-control" name="title_ar" value="{{old('title_ar')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="mb-3">
                                                <label class="form-label">Description Russian</label>
                                                <textarea name="description_ar" class="form-control editor" id="" cols="30" rows="10">{{old('description_ar')}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">Title Arabic</label>
                                                <input type="text" class="form-control" name="title_ru" value="{{old('title_ru')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="mb-3">
                                                <label class="form-label">Description Arabic</label>
                                                <textarea name="description_ru" class="form-control editor" id="" cols="30" rows="10">{{old('description_ru')}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">Title Local</label>
                                                <input type="text" class="form-control" name="title_local" value="{{old('title_local')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="mb-3">
                                                <label class="form-label">Description Local</label>
                                                <textarea name="description_local" class="form-control editor" id="" cols="30" rows="10">{{old('description_local')}}</textarea>
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
@endsection
