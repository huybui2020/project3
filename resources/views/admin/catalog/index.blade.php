@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Catalog</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/catalog/create') }}" class="btn btn-success btn-sm" title="Add New Catalog">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/catalog', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Catalog Slug</th><th>Catalog Name</th><th>Catalog Active</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($catalog as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->catalog_slug }}</td><td>{{ $item->catalog_name }}</td>
                                        <td style="text-align: center"><a href="{{route('update_active', $item->id)}}">
                                            @if($item->catalog_active == 1)
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                            @else
                                            <i class="fa fa-circle" aria-hidden="true"></i>
                                            @endif

                                        </a></td>
                                        <td>
                                            <a href="{{ url('/admin/catalog/' . $item->id) }}" title="View Catalog"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                            <a href="{{ url('/admin/catalog/' . $item->id . '/edit') }}" title="Edit Catalog"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'url' => ['/admin/catalog', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete Catalog',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $catalog->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
