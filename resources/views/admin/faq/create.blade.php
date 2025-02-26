
@extends('admin.layout.master')

@section('main_content')
       
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')



       

    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Create FAQ</h1>
                <div class="ml-auto">
                    <a href="{{route('admin_faq_index')}}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('admin_faq_create_submit')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                   
                                    <div class="row mb-3">
                                        <div class="mb-3">
                                            <label class="form-label">Question English</label>
                                            <input type="text" class="form-control" name="question_en" value="{{old('question_en')}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Answer English</label>
                                            <textarea name="answer_en" class="form-control h_200" id="" cols="30" rows="10">{{old('answer_en')}}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="mb-3">
                                            <label class="form-label">Question English</label>
                                            <input type="text" class="form-control" name="question_ru" value="{{old('question_ru')}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Answer English</label>
                                            <textarea name="answer_ru" class="form-control h_200" id="" cols="30" rows="10">{{old('answer_ru')}}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="mb-3">
                                            <label class="form-label">Question English</label>
                                            <input type="text" class="form-control" name="question_ar" value="{{old('question_ar')}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Answer English</label>
                                            <textarea name="answer_ar" class="form-control h_200" id="" cols="30" rows="10">{{old('answer_ar')}}</textarea>
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
