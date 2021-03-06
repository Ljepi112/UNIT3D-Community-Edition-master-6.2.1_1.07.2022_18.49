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
    <li class="breadcrumbV2">
        <a href="{{ route('groups') }}" class="breadcrumb__link">
            {{ __('stat.groups') }}
        </a>
    </li>
    <li class="breadcrumb--active">
        {{ __('stat.group') }}
    </li>
@endsection

@section('content')
    <div class="container">
        <div class="block">
            <h2>{{ $group->name }} {{ __('stat.group') }}</h2>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <p class="text-red"><strong><i
                                    class="{{ $group->icon }}"></i> {{ $group->name }} {{ __('stat.group') }}
                        </strong> ({{ __('stat.users-in-group') }})</p>
                    <table class="table table-condensed table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>{{ __('common.user') }}</th>
                            <th>{{ __('stat.registration-date') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $u)
                            <tr>
                                <td>
                                    @if ($u->private_profile == 1)
                                        <span class="badge-user text-bold"><span class="text-orange"><i
                                                        class="{{ config('other.font-awesome') }} fa-eye-slash"
                                                        aria-hidden="true"></i>{{ strtoupper(__('common.hidden')) }}</span>@if (auth()->user()->id == $u->id || auth()->user()->group->is_modo)
                                                <a href="{{ route('users.show', ['username' => $u->username]) }}">({{ $u->username }}
                                                    )</a></span>
                                    @endif
                                    @else
                                        <span class="badge-user text-bold"><a
                                                    href="{{ route('users.show', ['username' => $u->username]) }}">{{ $u->username }}</a></span>
                                    @endif
                                </td>
                                <td>
                                    <span>{{ date('d M Y', strtotime($u->created_at)) }}</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
