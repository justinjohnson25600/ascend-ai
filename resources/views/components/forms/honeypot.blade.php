@props(['model' => 'website'])
{{-- Off-screen trap for bots. Real visitors never see or fill this field. --}}
<div class="absolute -left-[9999px] top-0 w-px h-px overflow-hidden" aria-hidden="true">
    <label>
        Website
        <input type="text" name="website" tabindex="-1" autocomplete="off" x-model="{{ $model }}">
    </label>
</div>
