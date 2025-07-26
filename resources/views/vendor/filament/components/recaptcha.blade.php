<div class="mt-4">
    {!! NoCaptcha::display() !!}
    @error('g-recaptcha-response')
        <span class="text-red-600 text-sm">{{ $message }}</span>
    @enderror
</div>