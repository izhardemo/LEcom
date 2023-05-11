<x-bootstrap.card>
    <x-slot name="title">
        <h4 class="mb-0 fw-bolder">{{ __('Browser Sessions') }}</h4>
    </x-slot>

    <x-slot name="subTitle">
        <small>
            {{ __('Manage and log out your active sessions on other browsers and devices.') }}
        </small>
    </x-slot>

    <x-slot name="content">
        <hr>
        <div class="mt-2 fs-5">
            {{ __('If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.') }}
        </div>

        @if (count($this->sessions) > 0)
            <div class="mt-4">
                <!-- Other Browser Sessions -->
                @foreach ($this->sessions as $session)
                    <div class="d-flex align-items-center my-1">
                        <div>
                            @if ($session->agent->isDesktop())
                                <i class="fas fa-desktop fa-2x"></i>
                            @else
                                <i data-feather='smartphone'></i>
                            @endif
                        </div>

                        <div class="ms-1">
                            <div class="fw-bolder">
                                {{ $session->agent->platform() }} - {{ $session->agent->browser() }}
                            </div>

                            <div>
                                <div class="fs-6">
                                    {{ $session->ip_address }},

                                    @if ($session->is_current_device)
                                        <span class="text-success fw-bolder">{{ __('This device') }}</span>
                                    @else
                                        {{ __('Last active') }} {{ $session->last_active }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="d-flex align-items-center mt-3">
            <button class="btn btn-gradient-dark btn-sm fw-bolder fs-6 px-2" data-bs-toggle="modal" data-bs-target="#confirmLogout">
                {{ __('Log Out Other Browser Sessions') }}
            </button>

            <x-bootstrap.action-message class="ms-1" on="loggedOut">
                {{ __('Done.') }}
            </x-bootstrap.action-message>
        </div>

        <!-- Log Out Other Devices Confirmation Modal -->
        <div class="modal fade text-start" id="confirmLogout" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">
                            {{ __('Log Out Other Browser Sessions') }}
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="fw-bolder fs-5">
                            {{ __('Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices.') }}
                        </div>
                        <form action="{{route('admin.profile.logout.other.browser',[Auth::user()->id,'session'])}}" method="POST" id="form1">
                            @csrf
                            <div class="mt-2">
                                <input type="password" name="cpassword" class="form-control" placeholder="{{ __('Password') }}" required autofocus />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-gradient-secondary" data-bs-dismiss="modal">
                            {{ __('Cancel') }}
                        </button>
        
                        <button type="submit" class="btn btn-sm btn-gradient-dark ms-2" form="form1">
                            {{ __('Log Out Other Browser Sessions') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </x-slot>
</x-bootstrap.card>

@push('js-url')
<script src="{{ asset('app-assets/js/scripts/components/components-modals.js') }}"></script>
@endpush