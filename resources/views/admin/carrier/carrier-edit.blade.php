@extends('admin.layout.base-layout')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header text-start">
                ویرایش پیک |
                <a href="{{ route('carrier-create') }}">
                    بازگشت به صفحه پیک ها
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('carrier-update', $carrier) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="name" class="form-label">نام پیک</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="نام کامل پیک را وارد کنید" value="{{ old('name') ?? $carrier->name }}">
                        </div>
                        <div class="col">
                            <label for="description" class="form-label">توضیحات کوتاه درباره پیک</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="یک توضیح کوتاه وارد کنید" value="{{old('description') ?? $carrier->description}}">
                        </div>
                        <div class="col">
                            <label for="image_url" class="form-label">بارگذاری عکس</label>
                            <input type="file" class="form-control" id="image_url" name="image" placeholder="عکس را انتخاب کنید" >
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-2">
                            <button type="submit" class="btn btn-success form-control" name="submit" value="submit">افزودن</button>
                        </div>
                    </div>


                </form>

            </div>
        </div>

    </div>
@endsection
