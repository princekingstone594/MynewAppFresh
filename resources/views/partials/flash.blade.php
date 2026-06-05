@if (session('success'))
<div
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 4000)"
    x-show="show"
    x-transition
    class="mb-4 p-3 rounded bg-green-100 text-green-700 shadow"
>
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 4000)"
    x-show="show"
    x-transition
    class="mb-4 p-3 rounded bg-red-100 text-red-700 shadow"
>
    {{ session('error') }}
</div>
@endif