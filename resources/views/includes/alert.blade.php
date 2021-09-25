@if ($alert = session()->pull('alert'))
    <x-alert> {{$alert}} </x-alert>
@endif