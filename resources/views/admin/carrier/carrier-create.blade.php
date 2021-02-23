@extends('admin.layout.base-layout')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header text-start">
                اضافه کردن پیک به مجموعه
            </div>
            <div class="card-body">
                @include('admin.carrier.carrier-form')
            </div>
        </div>

        <div class="col mt-2">
            @if(count($carriers) > 0)
                <div class="row justify-content-between">
                    @foreach($carriers as $carrier)
                        <div class="col-4 mt-3">
                            <div class="card mb-3 p-1 m-0 mw-100 h-100" style="max-width: 540px;">
                                <div class="row g-0 w-100 h-100 rounded-1">
                                    <div class="col-md-4 h-100">
                                        <img class="h-100 w-100 rounded-1"
                                             src="{{ asset("storage/images/{$carrier->image_url}") }}">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body h-100">
                                            <h5 class="card-title">{{ $carrier->name }}</h5>
                                            <p class="card-text text-primary">{{ $carrier->description ?? 'توضیحاتی وجود ندارد'  }}</p>
                                            <div class="row">
                                                <div class="col-2">
                                                    <p class="card-text text-muted"><small
                                                            class="text-muted">پیک</small></p>
                                                </div>
                                                <div class="col-6">
                                                    <a href="{{ route('carrier-edit', $carrier) }}"
                                                       class="btn btn-sm btn-light btn-block">ویرایش پیک</a>
                                                </div>
                                                <div class="col-4">
                                                    <form action="{{ route('carrier-delete', $carrier) }}" method="POST">
                                                        @csrf
                                                        <input type="submit" class="btn btn-sm btn-danger" value="حذف پیک">
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
