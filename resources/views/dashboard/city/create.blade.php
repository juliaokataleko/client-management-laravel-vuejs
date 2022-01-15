@extends('layouts.app')

@section('content')

<div class="card" style="max-width: 750px; margin: 0 auto;">

    <div class="card-header d-sm-flex align-items-center justify-content-between mb-2">
        <h5 class="h3 mb-0 text-gray-800">Registar Cidade</h5>
        <a href="{{ route('cities.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Voltar</a>
    </div>
    <div class="card-body">
        <form action="{{ route('cities.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
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

                        <label for="country_code">País</label>
                        <select name="country_id" id="country_id" class="form-control">
                            @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>

                        @error('country_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">

                        <label for="state_id">Estado</label>
                        <select name="state_id" required id="state_id" class="form-control">
                            <option value="">Selecionar</option>
                        </select>

                        @error('stated_id')
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

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {

        loadStates()

        $('#country_id').on('change', function(e) {
            loadStates();
        });
    });

    function loadStates() {
        var country_id = $("#country_id").val();

        $.ajax({
            url: "{{ route('get-states') }}",
            type: "POST",
            data: {
                country: country_id
            },
            success: function(data) {
                console.log(data);
                $('#state_id').empty();
                $.each(data.states, function(index, state) {
                    $('#state_id').append('<option value="' + state.id + '">' + state.name + '</option>');
                })
            }
        })
    }
    
</script>
@endsection