
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Edit FAQ of {{$package->packageTitle->title_en}}</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_package_faqs',$package->id)}}" class="btn btn-primary"> View All</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin_package_faq_edit_submit', $faq->id) }}" method="post" >                                    @csrf
                                    
                                    <div class="row mb-3">
                                        <div class="mb-3">
                                            <label class="form-label">Question English</label>
                                            <input type="text" class="form-control" name="question_en" value="{{$faq->question_en}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Answer English</label>
                                            <textarea name="answer_en" class="form-control h_200" id="" cols="30" rows="10">{{$faq->answer_en}}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="mb-3">
                                            <label class="form-label">Question Russian</label>
                                            <input type="text" class="form-control" name="question_ru" value="{{$faq->question_ru}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Answer Russian</label>
                                            <textarea name="answer_ru" class="form-control h_200" id="" cols="30" rows="10">{{$faq->answer_ru}}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="mb-3">
                                            <label class="form-label">Question Arabic</label>
                                            <input type="text" class="form-control" name="question_ar" value="{{$faq->question_ar}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Answer Arabic</label>
                                            <textarea name="answer_ar" class="form-control h_200" id="" cols="30" rows="10">{{$faq->answer_ar}}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label"></label>
                                        <button type="submit" class="btn btn-primary">Update</button>
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
