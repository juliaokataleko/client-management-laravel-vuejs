@extends('layouts.app')

@section('content')

<div class="card" style="max-width: 900px; margin: 0 auto;">

    <div class="card-header d-sm-flex align-items-center justify-content-between mb-2">
        <h5 class="h3 mb-0 text-gray-800">Países</h5>
        <form method="GET" action="{{ route('countries.index') }}">
            <div class="row align-items-center">
                <div class="col-9">
                    <input type="search" name="search" class="form-control" value="{{ request('search') ?? '' }}" id="inlineFormInput" placeholder="Pesquisar países">
                </div>
                <div class="col-3">
                    <button type="submit" class="btn
                    btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
        <a href="{{ route('countries.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> País</a>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="">
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Código do País</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($countries as $country)
                    <tr>
                        <td scope="row">#{{ $country->id }}</th>
                        <td>{{ $country->code }}</td>
                        <td>{{ $country->name }}</td>
                        <td>
                            <form action="{{ route('countries.destroy', $country->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class="btn-group">
                                    <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <button type="submit" onclick="return confirm('Tem certeza?')" class="btn btn-outline-danger btn-sm"><i class="fa fa-times"></i></button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div>

    </div>
    <div class="card-footer">
        {{ $countries->links() }}
    </div>
</div>

@endsection