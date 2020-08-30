@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @if (Auth::check())
            <div class="card">
                <div class="card-header">{{ __('Welcome to the home page, please enter a link to be shortened') }}</div>
                <div class="card-body">
                <form id="link-form-user" method="POST" action="{{ route('store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Link to shorten: </label>
                            <div class="col-md-6">
                                <input id="longlink" type="text" class="form-control" name="longlink" required>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
                <div class="card text-center mt-3">
                    <div class="card-header"><p class="float-left mb-0">{{ Auth::user()->name }}'s Shortened Links:</p></div>
                    <div id="render-area" class="card-body">
                        @foreach ($userLinks as $lnk)
                            <a href="{{ route ('redir', $lnk->id) }}" target="_blank">{{$lnk->id}} - {{$lnk->shortlink}}</a><br>
                        @endforeach
                    </div>
                    <div class="card-footer text-muted">
                    </div>
                </div>
        @else
            <div class="card">
                <div class="card-header">{{ __('Welcome to the home page, please enter a new link to be shortened') }}</div>
                <div class="card-body">
                <form id="link-form-guest" method="POST" action="{{ route('store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Add to shorten: </label>
                            <div class="col-md-6">
                                <input id="longlink" type="text" class="form-control" name="longlink" required>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
                <div class="card text-center mt-3">
                    <div class="card-header"><p class="float-left mb-0">{{ $guest }}'s Shortened Links:</p></div>
                    <div id="render-area" class="card-body">
                        @foreach ($guestLinks as $lnk)
                            <a href="{{ route ('redir', $lnk->id) }}" target="_blank">{{$lnk->id}} - {{$lnk->shortlink}}</a><br>
                        @endforeach
                    </div>
                    <div class="card-footer text-muted">
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
