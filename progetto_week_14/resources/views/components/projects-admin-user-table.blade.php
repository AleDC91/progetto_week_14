@props(['projects'])

@php
if($projects > 3){
    $classText = "text-green-900";
    $classBg = "bg-green-200";
} elseif ($projects > 2){
    $classText = "text-orange-900";
    $classBg = "bg-orange-200";
} else {
    $classText = "text-red-900";
    $classBg = "bg-red-200";
}
@endphp


<span
class="relative inline-block px-3 py-1 font-semibol {{$classText}}leading-tight cursor-pointer">
<span aria-hidden
    class="absolute inset-0 {{$classBg}} opacity-50 rounded-full"></span>
<span class="relative">{{$projects}}</span>
</span>