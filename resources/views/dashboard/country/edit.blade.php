@extends('layouts.app')

@section('content')

<div class="card" style="max-width: 600px; margin: 0 auto;">

    <div class="card-header d-sm-flex align-items-center justify-content-between mb-2">
        <h5 class="h3 mb-0 text-gray-800">Editar País ({{ $country->name }})</h5>
        <a href="{{ route('countries.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Voltar</a>
    </div>
    <div class="card-body">
        <form action="{{ route('countries.update', $country->id) }}" method="post">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" value="{{ old('name') ?? $country->name }}" id="name" name="name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="code">Código do País</label>
                        <input type="text" class="form-control" value="{{ old('code') ?? $country->code }}" id="code" name="code">
                    </div>
                </div>
                <div class="col-12">
                    <hr>
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection