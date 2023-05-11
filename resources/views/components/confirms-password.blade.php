@props(['title' => __('Confirm Password'), 'content' => __('For your security, please confirm your password to continue.'), 'button' => __('Confirm')])

@php
    $confirmableId = md5($attributes->wire('then'));
@endphp

<span
    {{ $attributes->wire('then') }}
    x-data
    x-ref="span"
    x-on:click="$wire.startConfirmingPassword('{{ $confirmableId }}')"
    x-on:password-confirmed.window="setTimeout(() => $event.detail.id === '{{ $confirmableId }}' && $refs.span.dispatchEvent(new CustomEvent('then', { bubbles: false })), 250);"
>
    {{ $slot }}
</span>

@once
<!-- Password Confirm Modal -->
<div wire:ignore.self class="modal fade" id="passwordConfirmModal" tabindex="-1" aria-labelledby="passwordConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordConfirmModalLabel">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="">
                    {{ $content }}
                </p>
                <form id="passwordConfirmFrm" wire:submit.prevent="confirmPassword">
                    <div class="mb-1" x-data="{}" x-on:confirming-password.window="setTimeout(() => $refs.confirmable_password.focus(), 250)">
                        <label for="confirmable_password" class="form-label fw-bold">{{ __('Password') }}</label>
                        <input type="password" name="password" x-ref="confirmable_password" wire:model.defer="confirmablePassword" wire:keydown.enter="confirmPassword" class="form-control" id="confirmable_password" placeholder="{{ __('Password') }}" autofocus>
                        @error('confirmable_password')
                            <div class="text-danger small">{{$message}}</div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" wire:click="stopConfirmingPassword" wire:loading.attr="disabled" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="submit" class="btn btn-primary" dusk="confirm-password-button" wire:loading.attr="disabled" form="passwordConfirmFrm">
                    {{ $button }}
                </button>
            </div>
        </div>
    </div>
</div>
@endonce

@push('js')
<script>
    // modal show
    window.addEventListener('confirming-password', event => {
        $('#passwordConfirmModal').modal('show');
    });
    // modal hide
    window.addEventListener('password-confirmed', event => {
        $('#passwordConfirmModal').modal('hide');
    });
</script>
@endpush