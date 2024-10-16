@extends('layout.template')

@section('title', 'doctor')

@push ('meta-header')
<meta name="author" content="Azima">
@endpush

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Doctor</h1>
    </div>

    <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->

    <div class="container">
        <div class="row container"">
            <a class=" btn btn-primary mb-3 col-1" href="{{url('doctor/create')}}">Create</a>
            <!-- input form pencarian -->
            <form class="d-flex col-md-6 mb-3 ms-auto" method="GET" action="{{url('doctor/search')}}">
                <input class="form-control me-2 border border-dark" name="search" type="search" placeholder="Nama atau email" aria-label="Search">
                <button class="btn btn-success" type="submit"><i class="bi bi-search"></i></button>
            </form>
            
        </div>
        @if (session('success'))
        <div class="alert alert-success">
            {{session('success')}}
            <button class="btn-close float-end" type="button" aria-label="Close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        <div class="row justify-content-center">
            <div class="col md-8">
                <div class="card">
                    <div class="card-body">
                        {{ $doctors->links() }}
                        @if ($doctors->count() == 0)
                        <tr>
                            <td colspan="7" class="text-center">Data tidak ditemukan</td>
                        </tr>
                        @else
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Telephone number</th>
                                    <th scope="col">Address</th>
                                    <th scope="col" width="12%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($doctors as $doctor)
                                <tr>
                                    <td>{{($doctors->currentPage()-1) * $doctors->perPage() + $loop->iteration}}</td>
                                    <td>{{$doctor->name}}</td>
                                    <td>{{$doctor->gender}}</td>
                                    <td>{{$doctor->email}}</td>
                                    <td>{{$doctor->phone}}</td>
                                    <td>{{$doctor->address}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-primary" href="{{url('doctor/edit/'.$doctor->id)}}"><i class="bi bi-pencil-square"></i></a>
                                        <form class="d-inline" action="{{url('doctor/delete/'.$doctor->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class=" btn btn-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>

@endsection