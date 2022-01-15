@extends('layouts.app')

@section('content')

<div class="card" style="max-width: 600px; margin: 0 auto;">

    <div class="card-header d-sm-flex align-items-center justify-content-between mb-2">
        <h5 class="h3 mb-0 text-gray-800">Registar País</h5>
        <a href="{{ route('countries.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Voltar</a>
    </div>
    <div class="card-body">
        <form action="{{ route('countries.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="code">Código do País</label>
                        <input type="text" class="form-control" value="{{ old('code') }}" id="code" name="code">
                        @error('code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
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