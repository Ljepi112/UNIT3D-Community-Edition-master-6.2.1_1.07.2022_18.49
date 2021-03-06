@extends('layout.default')

@section('title')
    <title>{{ $user->username }} - Privacy - {{ __('common.members') }} - {{ config('other.title') }}</title>
@endsection

@section('breadcrumbs')
    <li class="breadcrumbV2">
        <a href="{{ route('users.show', ['username' => $user->username]) }}" class="breadcrumb__link">
            {{ $user->username }}
        </a>
    </li>
    <li class="breadcrumbV2">
        <a href="{{ route('user_settings', ['username' => $user->username]) }}" class="breadcrumb__link">
            {{ __('user.settings') }}
        </a>
    </li>
    <li class="breadcrumb--active">
        {{ __('user.privacy') }}
    </li>
@endsection

@section('nav-tabs')
    @include('user.buttons.user')
@endsection

@section('content')
    <div class="container">
        <div class="block">
            <div class="container-fluid p-0 some-padding">
                <ul class="nav nav-tabs" role="tablist" id="basetabs">
                    <li class="active"><a href="#profile_tab" data-toggle="tab">Profile</a></li>
                    <li><a href="#achievement_tab" data-toggle="tab">Achievements</a></li>
                    <li><a href="#follower_tab" data-toggle="tab">Followers</a></li>
                    <li><a href="#forum_tab" data-toggle="tab">Forums</a></li>
                    <li><a href="#request_tab" data-toggle="tab">Requests</a></li>
                    <li><a href="#torrent_tab" data-toggle="tab">Torrents</a></li>
                    <li><a href="#other_tab" data-toggle="tab">Other</a></li>
                </ul>
                <br>
                <div class="tab-content">


                    <div role="tabpanel" class="tab-pane" id="other_tab">
                        <form role="form" method="POST"
                              action="{{ route('privacy_other', ['username' => $user->username]) }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="well">
                                <h3>{{ __('user.other-privacy') }}:</h3>
                                <div class="help-block">{{ __('user.other-help') }}.</div>
                                <hr>
                                <div class="form-group">
                                    <div class="button-holder">
                                        <div class="button-left">
                                            {{ __('user.other-privacy-online') }}.
                                        </div>
                                        <div class="button-right">
                                            @if(!$user->privacy || ($user->privacy && $user->privacy->show_online == 1))
                                                <label>
                                                    <input type="checkbox" name="show_online" value="1" CHECKED/>
                                                </label>
                                            @else
                                                <label>
                                                    <input type="checkbox" name="show_online" value="1"/>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="some-padding">
                                    <h3>{{ __('user.visible-to-other') }}:</h3>
                                    <div class="help-block">{{ __('user.visible-to-other-help') }}.</div>
                                    <hr>
                                    <div class="form-group">
                                        @foreach($groups as $group)
                                            @if($group->is_modo || $group->is_admin)
                                            @else
                                                <div class="button-holder">
                                                    <div class="button-left">
                                                        {{ $group->name }}
                                                    </div>
                                                    <div class="button-right">
                                                        @if(!$user->privacy || !$user->privacy->json_other_groups ||
                                                            $group->isAllowed($user->privacy->json_other_groups,$group->id))
                                                            <label>
                                                                <input type="checkbox" name="approved[]"
                                                                       value="{{ $group->id }}"
                                                                       CHECKED/>
                                                            </label>
                                                        @else
                                                            <label>
                                                                <input type="checkbox" name="approved[]"
                                                                       value="{{ $group->id }}"/>
                                                            </label>
                                                        @endif
                                                    </div>
                                                </div>
                                                <hr class="some-padding">
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr class="some-padding">
                                </div>
                            </div>
                            <div class="well text-center">
                                <button type="submit" class="btn btn-primary">{{ __('common.save') }}
                                    {{ __('user.other-privacy') }}</button>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="request_tab">
                        <form role="form" method="POST"
                              action="{{ route('privacy_request', ['username' => $user->username]) }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="well">
                                <h3>{{ __('user.request-privacy') }}:</h3>
                                <div class="help-block">{{ __('user.request-help') }}.</div>
                                <hr>
                                <div class="form-group">
                                    <div class="button-holder">
                                        <div class="button-left">
                                            {{ __('user.request-privacy-requested') }}.
                                        </div>
                                        <div class="button-right">
                                            @if(!$user->privacy || ($user->privacy && $user->privacy->show_requested == 1))
                                                <label>
                                                    <input type="checkbox" name="show_requested" value="1" CHECKED/>
                                                </label>
                                            @else
                                                <label>
                                                    <input type="checkbox" name="show_requested" value="1"/>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="some-padding">
                                    <h3>{{ __('user.visible-to-request') }}:</h3>
                                    <div class="help-block">{{ __('user.visible-to-request-help') }}.</div>
                                    <hr>
                                    <div class="form-group">
                                        @foreach($groups as $group)
                                            @if($group->is_modo || $group->is_admin)
                                            @else
                                                <div class="button-holder">
                                                    <div class="button-left">
                                                        {{ $group->name }}
                                                    </div>
                                                    <div class="button-right">
                                                        @if(!$user->privacy || !$user->privacy->json_request_groups ||
                                                            $group->isAllowed($user->privacy->json_request_groups,$group->id))
                                                            <label>
                                                                <input type="checkbox" name="approved[]"
                                                                       value="{{ $group->id }}"
                                                                       CHECKED/>
                                                            </label>
                                                        @else
                                                            <label>
                                                                <input type="checkbox" name="approved[]"
                                                                       value="{{ $group->id }}"/>
                                                            </label>
                                                        @endif
                                                    </div>
                                                </div>
                                                <hr class="some-padding">
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr class="some-padding">
                                </div>
                            </div>
                            <div class="well text-center">
                                <button type="submit" class="btn btn-primary">{{ __('common.save') }}
                                    {{ __('user.request-privacy') }}</button>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="torrent_tab">
                        <form role="form" method="POST"
                              action="{{ route('privacy_torrent', ['username' => $user->username]) }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="well">
                                <h3>{{ __('user.torrent-privacy') }}:</h3>
                                <div class="help-block">{{ __('user.torrent-help') }}.</div>
                                <hr>
                                <div class="form-group">
                                    <div class="button-holder">
                                        <div class="button-left">
                                            {{ __('user.torrent-privacy-upload') }}.
                                        </div>
                                        <div class="button-right">
                                            @if(!$user->privacy || ($user->privacy && $user->privacy->show_upload == 1))
                                                <label>
                                                    <input type="checkbox" name="show_upload" value="1" CHECKED/>
                                                </label>
                                            @else
                                                <label>
                                                    <input type="checkbox" name="show_upload" value="1"/>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="some-padding">
                                    <div class="button-holder">
                                        <div class="button-left">
                                            {{ __('user.torrent-privacy-download') }}.
                                        </div>
                                        <div class="button-right">
                                            @if(!$user->privacy || ($user->privacy && $user->privacy->show_download == 1))
                                                <label>
                                                    <input type="checkbox" name="show_download" value="1" CHECKED/>
                                                </label>
                                            @else
                                                <label>
                                                    <input type="checkbox" name="show_download" value="1"/>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="some-padding">
                                    <div class="button-holder">
                                        <div class="button-left">
                                            {{ __('user.torrent-privacy-peer') }}.
                                        </div>
                                        <div class="button-right">
                                            @if(!$user->privacy || ($user->privacy && $user->privacy->show_peer == 1))
                                                <label>
                                                    <input type="checkbox" name="show_peer" value="1" CHECKED/>
                                                </label>
                                            @else
                                                <label>
                                                    <input type="checkbox" name="show_peer" value="1"/>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="some-padding">
                                    <h3>{{ __('user.visible-to-torrent') }}:</h3>
                                    <div class="help-block">{{ __('user.visible-to-torrent-help') }}.</div>
                                    <hr>
                                    <div class="form-group">
                                        @foreach($groups as $group)
                                            @if($group->is_modo || $group->is_admin)
                                            @else
                                                <div class="button-holder">
                                                    <div class="button-left">
                                                        {{ $group->name }}
                                                    </div>
                                                    <div class="button-right">
                                                        @if(!$user->privacy || !$user->privacy->json_torrent_groups ||
                                                            $group->isAllowed($user->privacy->json_torrent_groups,$group->id))
                                                            <label>
                                                                <input type="checkbox" name="approved[]"
                                                                       value="{{ $group->id }}"
                                                                       CHECKED/>
                                                            </label>
                                                        @else
                                                            <label>
                                                                <input type="checkbox" name="approved[]"
                                                                       value="{{ $group->id }}"/>
                                                            </label>
                                                        @endif
                                                    </div>
                                                </div>
                                                <hr class="some-padding">
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr class="some-padding">
                                </div>
                            </div>
                            <div class="well text-center">
                                <button type="submit" class="btn btn-primary">{{ __('common.save') }}
                                    {{ __('user.torrent-privacy') }}</button>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane active" id="profile_tab">
                        <form role="form" method="POST"
                              action="{{ route('privacy_profile', ['username' => $user->username]) }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="well">
                                <h3>{{ __('user.profile-privacy') }}:</h3>
                                <div class="help-block">{{ __('user.profile-privacy-help') }}.</div>
                                <hr>
                                <div class="form-group">
                                    <div class="button-holder">
                                        <div class="button-left">
                                            {{ __('user.profile-privacy-torrent-count') }}.
                                        </div>
                                        <div class="button-right">
                                            @if(!$user->privacy || ($user->privacy &&
                                                $user->privacy->show_profile_torrent_count == 1))
                                                <label>
                                                    <input type="checkbox" name="show_profile_torrent_count" value="1"
                                                           CHECKED/>
                                                </label>
                                            @else
                                                <label>
                                                    <input type="checkbox" name="show_profile_torrent_count" value="1"/>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="some-padding">
                                    <div class="button-holder">
                                        <div class="button-left">
                                            {{ __('user.profile-privacy-title') }}.
                                        </div>
                                        <div class="button-right">
                                            @if(!$user->privacy || ($user->privacy && $user->privacy->show_profile_title ==
                                                1))
                                                <label>
                                                    <input type="checkbox" name="show_profile_title" value="1" CHECKED/>
                                                </label>
                                            @else
                                                <label>
                                                    <input type="checkbox" name="show_profile_title" value="1"/>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="some-padding">
                                    <div class="button-holder">
                                        <div class="button-left">
                                            {{ __('user.profile-privacy-about') }}.
                                        </div>
                                        <div class="button-right">
                                            @if(!$user->privacy || ($user->privacy && $user->privacy->show_profile_about ==
                                                1))
                                                <label>
                                                    <input type="checkbox" name="show_profile_about" value="1" CHECKED/>
                                                </label>
                                            @else
                                                <label>
                                                    <input type="checkbox" name="show_profile_about" value="1"/>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="some-padding">
                                    <div class="button-holder">
                                        <div class="button-left">
                                            {{ __('user.profile-privacy-torrent-ratio') }}.
                                        </div>
                                        <div class="button-right">
                                            @if(!$user->privacy || ($user->privacy &&
                                                $user->privacy->show_profile_torrent_ratio == 1))
                                                <label>
                                                    <input type="checkbox" name="show_profile_torrent_ratio" value="1"
                                                           CHECKED/>
                                                </label>
                                            @else
                                                <label>
                                                    <input type="checkbox" name="show_profile_torrent_ratio" value="1"/>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="some-padding">
                                    <div class="button-holder">
                                        <div class="button-left">
                                            {{ __('user.profile-privacy-torrent-seed') }}.
                                        </div>
                                        <div class="button-right">
                                            @if(!$user->privacy || ($user->privacy &&
                                                $user->privacy->show_profile_torrent_seed == 1))
                                                <label>
                                                    <input type="checkbox" name="show_profile_torrent_seed" value="1"
                                                           CHECKED/>
                                                </label>
                                            @else
                                                <label>
                                                    <input type="checkbox" name="show_profile_torrent_seed" value="1"/>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="some-padding">
                                    <div class="button-holder">
                                        <div class="button-left">
                                            {{ __('user.profile-privacy-bon-extra') }}.
                                        </div>
                                        <div class="button-right">
                                            @if(!$user->privacy || ($user->privacy && $user->privacy->show_profile_bon_extra
                                                == 1))
                                                <label>
                                                    <input type="checkbox" name="show_profile_bon_extra" value="1"
                                                           CHECKED/>
                                                </label>
                                            @else
                                                <label>
                                                    <input type="checkbox" name="show_profile_bon_extra" value="1"/>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="some-padding">
                                    <div class="button-holder">
                                        <div class="button-left">
                                            {{ __('user.profile-privacy-torrent-extra') }}.
                                        </div>
                                        <div class="button-right">
                                            @if(!$user->privacy || ($user->privacy &&
                                                $user->privacy->show_profile_torrent_extra == 1))
                                                <label>
                                                    <input type="checkbox" name="show_profile_torrent_extra" value="1"
                                                           CHECKED/>
                                                </label>
                                            @else
                                                <label>
                                                    <input type="checkbox" name="show_profile_torrent_extra" value="1"/>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="some-padding">
                                    <div class="button-holder">
                                        <div class="button-left">
                                            {{ __('user.profile-privacy-comment-extra') }}.
                                        </div>
                                        <div class="button-right">
                                            @if(!$user->privacy || ($user->privacy &&
                                                $user->privacy->show_profile_comment_extra == 1))
                                                <label>
                                                    <input type="checkbox" name="show_profile_comment_extra" value="1"
                                                           CHECKED/>
                                                </label>
                                            @else
                                                <label>
                                                    <input type="checkbox" name="show_profile_comment_extra" value="1"/>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="some-padding">
                                    <div class="button-holder">
                                        <div class="button-left">
                                            {{ __('user.profile-privacy-request-extra') }}.
                                        </div>
                                        <div class="button-right">
                                            @if(!$user->privacy || ($user->privacy &&
                                                $user->privacy->show_profile_request_extra == 1))
                                                <label>
                                                    <input type="checkbox" name="show_profile_request_extra" value="1"
                                                           CHECKED/>
                                                </label>
                                            @else
                                                <label>
                                                    <input type="checkbox" name="show_profile_request_extra" value="1"/>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="some-padding">
                                    <div class="button-holder">
                                        <div class="button-left">
                                            {{ __('user.profile-privacy-forum-extra') }}.
                                        </div>
                                        <div class="button-right">
                                            @if(!$user->privacy || ($user->privacy &&
                                                $user->privacy->show_profile_forum_extra == 1))
                                                <label>
                                                    <input type="checkbox" name="show_profile_forum_extra" value="1"
                                                           CHECKED/>
                                                </label>
                                            @else
                                                <label>
                                                    <input type="checkbox" name="show_profile_forum_extra" value="1"/>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="some-padding">
                                    <div class="button-holder">
                                        <div class="button-left">
                                            {{ __('user.profile-privacy-warning') }}.
                                        </div>
                                        <div class="button-right">
                                            @if(!$user->privacy || ($user->privacy && $user->privacy->show_profile_warning
                                                == 1))
                                                <label>
                                                    <input type="checkbox" name="show_profile_warning" value="1"
                                                           CHECKED/>
                                                </label>
                                            @else
                                                <label>
                                                    <input type="checkbox" name="show_profile_warning" value="1"/>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="some-padding">
                                    <div class="button-holder">
                                        <div class="button-left">
                                            {{ __('user.profile-privacy-badge') }}.
                                        </div>
                                        <div class="button-right">
                                            @if(!$user->privacy || ($user->privacy && $user->privacy->show_profile_badge ==
                                                1))
                                                <label>
                                                    <input type="checkbox" name="show_profile_badge" value="1" CHECKED/>
                                                </label>
                                            @else
                                                <label>
                                                    <input type="checkbox" name="show_profile_badge" value="1"/>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="some-padding">
                                    <div class="button-holder">
                                        <div class="button-left">
                                            {{ __('user.profile-privacy-achievement') }}.
                                        </div>
                                        <div class="button-right">
                                            @if(!$user->privacy || ($user->privacy &&
                                                $user->privacy->show_profile_achievement == 1))
                                                <label>
                                                    <input type="checkbox" name="show_profile_achievement" value="1"
                                                           CHECKED/>
                                                </label>
                                            @else
                                                <label>
                                                    <input type="checkbox" name="show_profile_achievement" value="1"/>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="some-padding">
                                    <div class="button-holder">
                                        <div class="button-left">
                                            {{ __('user.profile-privacy-follower') }}.
                                        </div>
                                        <div class="button-right">
                                            @if(!$user->privacy || ($user->privacy && $user->privacy->show_profile_follower
                                                == 1))
                                                <label>
                                                    <input type="checkbox" name="show_profile_follower" value="1"
                                                           CHECKED/>
                                                </label>
                                            @else
                                                <label>
                                                    <input type="checkbox" name="show_profile_follower" value="1"/>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="some-padding">
                                </div>
                                <h3>{{ __('user.visible-to-profile') }}:</h3>
                                <div class="help-block">{{ __('user.visible-to-profile-help') }}.</div>
                                <hr>
                                <div class="form-group">
                                    @foreach($groups as $group)
                                        @if($group->is_modo || $group->is_admin)
                                        @else
                                            <div class="button-holder">
                                                <div class="button-left">
                                                    {{ $group->name }}
                                                </div>
                                                <div class="button-right">
                                                    @if(!$user->privacy || !$user->privacy->json_profile_groups ||
                                                        $group->isAllowed($user->privacy->json_profile_groups,$group->id))
                                                        <label>
                                                            <input type="checkbox" name="approved[]"
                                                                   value="{{ $group->id }}" CHECKED/>
                                                        </label>
                                                    @else
                                                        <label>
                                                            <input type="checkbox" name="approved[]"
                                                                   value="{{ $group->id }}"/>
                                                        </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr class="some-padding">
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="well text-center">
                                <button type="submit" class="btn btn-primary">{{ __('common.save') }}
                                    {{ __('user.profile-privacy') }}</button>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="forum_tab">
                        <form role="form" method="POST"
                              action="{{ route('privacy_forum', ['username' => $user->username]) }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="well">
                                <h3>{{ __('user.forum-privacy') }}:</h3>
                                <div class="help-block">{{ __('user.forum-help') }}.</div>
                                <hr>
                                <div class="form-group">
                                    <div class="button-holder">
                                        <div class="button-left">
                                            {{ __('user.forum-privacy-topic') }}.
                                        </div>
                                        <div class="button-right">
                                            @if(!$user->privacy || ($user->privacy && $user->privacy->show_topic == 1))
                                                <label>
                                                    <input type="checkbox" name="show_topic" value="1" CHECKED/>
                                                </label>
                                            @else
                                                <label>
                                                    <input type="checkbox" name="show_topic" value="1"/>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="some-padding">
                                    <div class="button-holder">
                                        <div class="button-left">
                                            {{ __('user.forum-privacy-post') }}.
                                        </div>
                                        <div class="button-right">
                                            @if(!$user->privacy || ($user->privacy && $user->privacy->show_post == 1))
                                                <label>
                                                    <input type="checkbox" name="show_post" value="1" CHECKED/>
                                                </label>
                                            @else
                                                <label>
                                                    <input type="checkbox" name="show_post" value="1"/>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="some-padding">
                                    <h3>{{ __('user.visible-to-forum') }}:</h3>
                                    <div class="help-block">{{ __('user.visible-to-forum-help') }}.</div>
                                    <hr>
                                    <div class="form-group">
                                        @foreach($groups as $group)
                                            @if($group->is_modo || $group->is_admin)
                                            @else
                                                <div class="button-holder">
                                                    <div class="button-left">
                                                        {{ $group->name }}
                                                    </div>
                                                    <div class="button-right">
                                                        @if(!$user->privacy || !$user->privacy->json_forum_groups ||
                                                            $group->isAllowed($user->privacy->json_forum_groups,$group->id))
                                                            <label>
                                                                <input type="checkbox" name="approved[]"
                                                                       value="{{ $group->id }}"
                                                                       CHECKED/>
                                                            </label>
                                                        @else
                                                            <label>
                                                                <input type="checkbox" name="approved[]"
                                                                       value="{{ $group->id }}"/>
                                                            </label>
                                                        @endif
                                                    </div>
                                                </div>
                                                <hr class="some-padding">
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="well text-center">
                                <button type="submit" class="btn btn-primary">{{ __('common.save') }}
                                    {{ __('user.forum-privacy') }}</button>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="follower_tab">
                        <form role="form" method="POST"
                              action="{{ route('privacy_follower', ['username' => $user->username]) }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="well">
                                <h3>{{ __('user.follower-privacy') }}:</h3>
                                <div class="help-block">{{ __('user.follower-help') }}.</div>
                                <hr>
                                <div class="form-group">
                                    <div class="button-holder">
                                        <div class="button-left">
                                            {{ __('user.follower-privacy-list') }}.
                                        </div>
                                        <div class="button-right">
                                            @if(!$user->privacy || ($user->privacy && $user->privacy->show_follower == 1))
                                                <label>
                                                    <input type="checkbox" name="show_follower" value="1" CHECKED/>
                                                </label>
                                            @else
                                                <label>
                                                    <input type="checkbox" name="show_follower" value="1"/>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="some-padding">
                                    <h3>{{ __('user.visible-to-follower') }}:</h3>
                                    <div class="help-block">{{ __('user.visible-to-follower-help') }}.</div>
                                    <hr>
                                    <div class="form-group">
                                        @foreach($groups as $group)
                                            @if($group->is_modo || $group->is_admin)
                                            @else
                                                <div class="button-holder">
                                                    <div class="button-left">
                                                        {{ $group->name }}
                                                    </div>
                                                    <div class="button-right">
                                                        @if(!$user->privacy || !$user->privacy->json_follower_groups ||
                                                            $group->isAllowed($user->privacy->json_follower_groups,$group->id))
                                                            <label>
                                                                <input type="checkbox" name="approved[]"
                                                                       value="{{ $group->id }}"
                                                                       CHECKED/>
                                                            </label>
                                                        @else
                                                            <label>
                                                                <input type="checkbox" name="approved[]"
                                                                       value="{{ $group->id }}"/>
                                                            </label>
                                                        @endif
                                                    </div>
                                                </div>
                                                <hr class="some-padding">
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="well text-center">
                                <button type="submit" class="btn btn-primary">{{ __('common.save') }}
                                    {{ __('user.follower-privacy') }}</button>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="achievement_tab">
                        <form role="form" method="POST"
                              action="{{ route('privacy_achievement', ['username' => $user->username]) }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="well">
                                <h3>{{ __('user.achievement-privacy') }}:</h3>
                                <div class="help-block">{{ __('user.achievement-help') }}.</div>
                                <hr>
                                <div class="form-group">
                                    <div class="button-holder">
                                        <div class="button-left">
                                            {{ __('user.achievement-privacy-list') }}.
                                        </div>
                                        <div class="button-right">
                                            @if(!$user->privacy || ($user->privacy && $user->privacy->show_achievement ==
                                                1))
                                                <label>
                                                    <input type="checkbox" name="show_achievement" value="1" CHECKED/>
                                                </label>
                                            @else
                                                <label>
                                                    <input type="checkbox" name="show_achievement" value="1"/>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                    <hr class="some-padding">
                                    <h3>{{ __('user.visible-to-achievement') }}:</h3>
                                    <div class="help-block">{{ __('user.visible-to-achievement-help') }}.</div>
                                    <hr>
                                    <div class="form-group">
                                        @foreach($groups as $group)
                                            @if($group->is_modo || $group->is_admin)
                                            @else
                                                <div class="button-holder">
                                                    <div class="button-left">
                                                        {{ $group->name }}
                                                    </div>
                                                    <div class="button-right">
                                                        @if(!$user->privacy || !$user->privacy->json_achievement_groups ||
                                                            $group->isAllowed($user->privacy->json_achievement_groups,$group->id))
                                                            <label>
                                                                <input type="checkbox" name="approved[]"
                                                                       value="{{ $group->id }}"
                                                                       CHECKED/>
                                                            </label>
                                                        @else
                                                            <label>
                                                                <input type="checkbox" name="approved[]"
                                                                       value="{{ $group->id }}"/>
                                                            </label>
                                                        @endif
                                                    </div>
                                                </div>
                                                <hr class="some-padding">
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="well text-center">
                                <button type="submit" class="btn btn-primary">{{ __('common.save') }}
                                    {{ __('user.achievement-privacy') }}</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    <script nonce="{{ HDVinnie\SecureHeaders\SecureHeaders::nonce('script') }}">
      $(window).on('load', function () {
        loadTab()
      })

      function loadTab () {
        if (window.location.hash && window.location.hash == '#visible_tab') {
          $('#basetabs a[href="#visible_tab"]').tab('show')
        }
        if (window.location.hash && window.location.hash == '#torrent_tab') {
          $('#basetabs a[href="#torrent_tab"]').tab('show')
        }
        if (window.location.hash && window.location.hash == '#forum_tab') {
          $('#basetabs a[href="#forum_tab"]').tab('show')
        }
        if (window.location.hash && window.location.hash == '#profile_tab') {
          $('#basetabs a[href="#profile_tab"]').tab('show')
        }
        if (window.location.hash && window.location.hash == '#follower_tab') {
          $('#basetabs a[href="#follower_tab"]').tab('show')
        }
        if (window.location.hash && window.location.hash == '#achievement_tab') {
          $('#basetabs a[href="#achievement_tab"]').tab('show')
        }
        if (window.location.hash && window.location.hash == '#request_tab') {
          $('#basetabs a[href="#request_tab"]').tab('show')
        }
        if (window.location.hash && window.location.hash == '#other_tab') {
          $('#basetabs a[href="#other_tab"]').tab('show')
        }
      }

    </script>
@endsection
