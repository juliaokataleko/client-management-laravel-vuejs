@extends('layouts.app')

@section('content')

<div class="card" style="max-width: 750px; margin: 0 auto;">

    <div class="card-header d-sm-flex align-items-center justify-content-between mb-2">
        <h5 class="h3 mb-0 text-gray-800">Cidades</h5>
        <form method="GET" action="{{ route('cities.index') }}">
            <div class="row align-items-center">
                <div class="col">
                    <input type="search" name="search" class="form-control" value="{{ request('search') ?? '' }}" id="inlineFormInput" placeholder="Pesquisar cidades">
                </div>
                <div class="col">
                    <button type="submit" class="btn
                    btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
        <a href="{{ route('cities.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Cidade</a>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="">
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Estado</th>
                        <th scope="col">País</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($cities as $city)
                    <tr>
                        <td scope="row">#{{ $city->id }}</th>
                        <td>{{ $city->name }}</td>
                        <td>{{ $city->state->name }}</td>
                        <td>{{ $city->country->name }}</td>
                        <td>
                            <form action="{{ route('cities.destroy', $city->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class="btn-group">
                                    <a href="{{ route('cities.edit', $city->id) }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-edit"></i></a>
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

        <div class="float-right">
            {{ $cities->links() }}
        </div>

    </div>
</div>
@endsection