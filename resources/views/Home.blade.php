@extends('layouts.app')

@section('content')
    <div class="">
        <div class="users">
            <div class="card-header d-flex align-items-center">
                <h2 class="h3">Chat </h2>
            </div>
            <div class="card-body no-padding">
                <ul style="list-style-type: none;">
                    @foreach ($users as $user)
                        <li>
                            <div class="col item d-flex align-items-center">
                                <div class="image"><img src="{{ asset('/dist/img/default.png') }}" alt="..."
                                        class="img-fluid rounded-circle"></div>
                                <div class="text"><a href="/conversation?id={{ $user->id }}">
                                        <h3 class="h5">{{ $user->name }}</h3>
                                </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
