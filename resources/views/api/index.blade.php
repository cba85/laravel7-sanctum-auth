@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tokens</div>

                <div class="card-body">
                    @if ($tokens->count())
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Created</th>
                                <th>Name</th>
                                <th>Ability</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tokens as $token)
                            <tr>
                                <td>{{ $token->created_at->diffForHumans() }}</td>
                                <td>{{ $token->name }}</td>
                                <td>@foreach ($token->abilities as $tokenAbility) {{ $tokenAbility }} @endforeach</td>
                                <td>
                                    <form action="{{ route('token') }}/{{ $token->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Revoke</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p>No token created yet.</p>
                    @endif

                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header">Create a token</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('token') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-4">
                                @foreach ($abilities as $ability)
                                <div class="form-check">
                                    <input type="checkbox" name="abilities[{{ $ability->id }}]" id="abilities[{{ $ability->id }}]" {{ in_array($ability->id, old('abilities') ?? []) ? 'checked' : ''}} value="{{ $ability->id }}">
                                    <label for="abilities[{{ $ability->id }}]">{{ $ability->name }} : {{ $ability->description }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
