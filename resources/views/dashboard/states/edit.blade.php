@extends('layouts.app')

@section('content')

<div class="card" style="max-width: 600px; margin: 0 auto;">

    <div class="card-header d-sm-flex align-items-center justify-content-between mb-2">
        <h5 class="h3 mb-0 text-gray-800">Editar Estado ({{ $state->name }})</h5>
        <a href="{{ route('states.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
    <div class="card-body">
        <form action="{{ route('states.update', $state->id) }}" method="post">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" value="{{ old('name') ?? $state->name }}" id="name" name="name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">

                        <label for="country_code">País</label>
                        <select name="country_id" id="country_id" class="form-control">
                            @foreach ($countries as $country)
                            <option value="{{ $country->id }}" @if($state->country_id == $country->id) {{ 'selected' }} @endif
                                >{{ $country->name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="col-12">
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection