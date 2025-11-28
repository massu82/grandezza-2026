@props(['title' => null, 'metaDescription' => null])

@include('layouts.public', ['title' => $title, 'metaDescription' => $metaDescription, 'slot' => $slot])
