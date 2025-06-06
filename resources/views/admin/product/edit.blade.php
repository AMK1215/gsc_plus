@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Game Type</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card  col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-10 offset-1"
                style="border-radius: 15px;">
                <div class="card-header">
                    <div class="card-title col-12">
                        <h5 class="d-inline fw-bold">
                            Edit Game Type </h5>
                        <a href="{{ route('admin.gametypes.index') }}" class="btn btn-primary d-inline float-right">
                            <i class="fas fa-arrow-left mr-2"></i> Back
                        </a>
                    </div>
                </div>
                <form action="{{ route('admin.gametypesproduct.update', [$gameType->id, $productId]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body mt-2">
                        <div class="row">
                            <div class="col-lg-12 offset-lg-0 col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-10 offset-1">
                                <div class="form-group">
                                    <label>Game Type<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ $gameType->name }}"
                                        name="payment_method" readonly> @error('user_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control"
                                        value="{{ $gameType->products[0]['product_name'] }}" readonly> @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                <label>Image<span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="image">
                                @php
                                    $pivotImage = optional($gameType->products[0])->pivot->image ?? null;
                                @endphp
                                @if($pivotImage)
                                    <img src="{{ asset('assets/img/game_logo/'.$pivotImage) }}" width="100px" alt="Current Image">
                                @endif

                            </div>


                            </div>

                        </div>

                    </div>
                    <div class="card-footer col-12 bg-white">
                        <button type="submit" class="btn btn-success float-right">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </section>
@endsection
