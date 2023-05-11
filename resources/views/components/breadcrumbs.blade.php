@props(['breadcrumbs' => []])

<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{request()->user() ? (request()->user()->hasRole('user') ? route('dashboard') : route('admin.dashboard')) : ''}}">Home</a>
                    </li>
                    @forelse ($breadcrumbs as $key => $url)
                    <li class="breadcrumb-item">
                        @if (last($breadcrumbs) == $url)
                            <span>{{is_numeric($key) ? $url : $key}}</span>
                        @else
                        <a href="{{is_numeric($key) ? '#' : $url}}">{{is_numeric($key) ? $url : $key}}</a>
                        @endif
                    </li>
                    @empty
                    @endforelse
                </ol>
            </div>
        </div>
      </div>
    </div>
</div>