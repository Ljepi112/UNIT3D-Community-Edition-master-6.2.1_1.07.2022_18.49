@extends('layout.default')

@section('title')
    <title>{{ __('stat.stats') }} - {{ config('other.title') }}</title>
@endsection

@section('breadcrumbs')
    <li class="breadcrumbV2">
        <a href="{{ route('stats') }}" class="breadcrumb__link">
            {{ __('stat.stats') }}
        </a>
    </li>
    <li class="breadcrumb--active">
        {{ __('common.users') }}
    </li>
@endsection

@section('nav-tabs')
    @include('partials.statsusermenu')
@endsection

@section('content')
    <div class="container">
        <div class="block">
            <h2>{{ __('stat.top-downloaders') }}</h2>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <p class="text-red"><strong><i
                                    class="{{ config('other.font-awesome') }} fa-arrow-down"></i> {{ __('stat.top-downloaders') }}
                        </strong></p>
                    <table class="table table-condensed table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('common.user') }}</th>
                            <th>{{ __('common.upload') }}</th>
                            <th>{{ __('common.download') }}</th>
                            <th>{{ __('common.ratio') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($downloaded as $key => $d)
                            <tr>
                                <td>
                                    {{ ++$key }}
                                </td>
                                <td @if (auth()->user()->username == $d->username) class="mentions" @endif>
                                    @if ($d->private_profile == 1)
                                        <span class="badge-user text-bold"><span class="text-orange"><i
                                                        class="{{ config('other.font-awesome') }} fa-eye-slash"
                                                        aria-hidden="true"></i>{{ strtoupper(__('common.hidden')) }}</span>@if (auth()->user()->id == $d->id || auth()->user()->group->is_modo)
                                                <a href="{{ route('users.show', ['username' => $d->username]) }}">({{ $d->username }}</a></span>
                                    @endif
                                    @else
                                        <span class="badge-user text-bold"><a
                                                    href="{{ route('users.show', ['username' => $d->username]) }}">{{ $d->username }}</a></span>
                                    @endif
                                </td>
                                <td>{{ \App\Helpers\StringHelper::formatBytes($d->uploaded, 2) }}</td>
                                <td>
                                    <span class="text-red">{{ \App\Helpers\StringHelper::formatBytes($d->downloaded, 2) }}</span>
                                </td>
                                <td>
                                    <span>{{ $d->getRatio() }}</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
