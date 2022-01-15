@extends('layouts.app')

@section('content')

<div class="card" style="max-width: 600px; margin: 0 auto;">

    <div class="card-header d-sm-flex align-items-center justify-content-between mb-2">
        <h5 class="h3 mb-0 text-gray-800">Estados</h5>
        <form method="GET" action="{{ route('states.index') }}">
            <div class="row align-items-center">
                <div class="col">
                    <input type="search" name="search" class="form-control" value="{{ request('search') ?? '' }}" id="inlineFormInput" placeholder="Pesquisar estado">
                </div>
                <div class="col">
                    <button type="submit" class="btn
                    btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
        <a href="{{ route('states.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Estado</a>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="">
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">País</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($states as $state)
                    <tr>
                        <td scope="row">#{{ $state->id }}</th>
                        <td>{{ $state->country->name }}</td>
                        <td>{{ $state->name }}</td>
                        <td>
                            <form action="{{ route('states.destroy', $state->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class="btn-group">
                                    <a href="{{ route('states.edit', $state->id) }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <button type="submit" onclick="return confirm('Tem certeza?')" class="btn btn-sm btn-outline-danger"><i class="fa fa-times"></i></button>
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
        {{ $states->links() }}
    </div>
</div>
@endsection