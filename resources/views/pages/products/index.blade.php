@extends('layouts.app')

@section('title', 'Product')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>product</h1>
                <div class="section-header-button">
                    <a href="{{ route('product.create') }}" class="btn btn-primary">Add New</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">product</a></div>
                    <div class="breadcrumb-item">All product</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Product</h2>
                <p class="section-lead">
                    You can manage all product, such as editing, deleting and more.
                </p>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Product</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-left">
                                    <select class="form-control selectric">
                                        <option>Action For Selected</option>
                                        <option>Move to Draft</option>
                                        <option>Move to Pending</option>
                                        <option>Delete Pemanently</option>
                                    </select>
                                </div>
                                <div class="float-right">
                                    <form method="GET" action="{{ route('product.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="clearfix mb-3"></div>
                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>No </th>
                                            <th>Name </th>
                                            <th>Deskription </th>
                                            <th>Price </th>
                                            <th>Stock </th>
                                            <th>Action </th>
                                        </tr>
                                        @foreach ($product as $item)
                                            <tr>
                                                <td>{{ $product->firstItem() + $loop->index }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td style="width: 900px; word-wrap: break-word;">{{ $item->description }}
                                                </td>
                                                <td>Rp. {{ $item->price }}
                                                </td>
                                                <td>{{ $item->stock }}</td>
                                                <td>
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="d-flex">
                                                                <form action="{{ route('product.destroy', $item->id) }}"
                                                                    method="POST" class="mr-2">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-icon btn-danger"
                                                                        onclick="return confirm('Are you sure you want to delete this product?')">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                </form>


                                                                <a href="{{ route('product.edit', $item->id) }}"
                                                                    class="btn btn-icon btn-primary"><i
                                                                        class="far fa-edit"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-left">
                                    Showing
                                    {{ $product->firstItem() }}
                                    to
                                    {{ $product->lastItem() }}
                                    of
                                    {{ $product->total() }}
                                </div>
                                <div class="float-right">
                                    {{ $product->withQueryString()->links() }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
