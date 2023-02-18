@php
    $navigation_links = \App\Helpers\ArrayHelper::arrayToObject(config('menu'));
@endphp


<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">
                <img class="d-inline-block" width="32px" height="30.61px" src="" alt="">
            </a>
        </div>
        @foreach ($navigation_links as $link)
            <ul class="sidebar-menu">
                <li class="menu-header">{{ __($link->text) }}</li>
                @if (!$link->is_multi)
                    <li class="{{ Request::routeIs($link->href) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route($link->href) }}">
                            <p class="icon-separate">
                                <i class="{{ $link->icon && isset($link->icon) ? $link->icon : '' }}"></i>
                            </p>
                            <span>{{ __('menu.dashboard') }}</span>
                        </a>
                    </li>
                @else
                    @foreach ($link->href as $section)
                        @if (isset($section->section_list) && $section->section_list)
                            @php
                                $routes = collect($section->section_list)->map(function ($child) {
                                    return Request::routeIs($child->href);
                                })->toArray();

                                $is_active = in_array(true, $routes);
                            @endphp
                        @endif
                        @if (isset($section->section_list) && $section->section_list)
                            @php($active = false)
                            @foreach($section->links as $link)
                                @if (!$active && Request::routeIs($link))
                                    @php($active = true)
                                @endif
                            @endforeach
                            @php($j = 0)
                            @if (isset($section->permission) && is_array($section->permission))
                                @foreach($section->permission as $permission)
                                    @if (!Gate::allows($permission))
                                        @php($j++)
                                    @endif
                                @endforeach

                            @endif
                            @if (count($section->permission) > $j)
                                <li class="dropdown {{ $active ? 'active' : '' }}">
                                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                                        <p class="icon-separate">
                                            <i class="{{ $section->icon && isset($section->icon) ? $section->icon : '' }}"></i>
                                        </p>
                                        <span>{{ __($section->section_text) }}</span>
                                    </a>
                                    <ul class="dropdown-menu" style="{{ $active ? 'display: block' : 'display: none' }}">
                                        @foreach ($section->section_list as $child)
                                            @if(Gate::allows($child->permission))
                                                <li class="{{ Request::routeIs($child->href) ? 'active' : '' }}"><a class="nav-link" href="{{ route($child->href) }}">{{ __($child->text) }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @else
                            <li class="dropdown {{ Request::routeIs($section->href) ? 'active' : '' }}">
                                @if((isset($section->permission) && Gate::allows($section->permission)) || !isset($section->permission))
                                    <a href="{{ route($section->href) }}" class="nav-link">
                                        <p class="icon-separate">
                                            <i class="{{ $section->icon && isset($section->icon) ? $section->icon : '' }}"></i>
                                        </p>
                                        <span>{{ __($section->text) }}</span>
                                    </a>
                                @endif
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
        @endforeach
    </aside>
</div>

