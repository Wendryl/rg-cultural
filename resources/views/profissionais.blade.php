@extends('templateIndex_head')

@section('head')
  <title>Encontre Profissionais - RG Cultural</title>
@endsection
@push('styles')
  <link rel="stylesheet" href="{{ asset('css/find-professionals.css') }}">
@endpush
@section('body')
  @foreach($professionals as $user)
    @if ($user->type == 1)
      @continue
    @endif
    <div class="card">
      <img src="{{ $user->profile_picture ?? '/img/profile.png' }}" class="profile-thumb">
      <div>
        <h5>{{ $user->name }}</h5>
        @if ($user->city != null)
        <p>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
          </svg>
          {{ $user->city }}
        </p>
        @endif
        <div class="tags">
          @foreach ($user->categories as $i => $category)
          @if ($i > 2)
          <span class="tag">
            +{{ count($user->categories) - $i }}
          </span>
          @break
          @else
          <span class="tag">
            {{ $category->title }}
          </span>
          @endif
          @endforeach
        </div>
        <a href="{{ $user->phone ? 'tel:' . $user->phone : 'mailto:' . $user->email }}" target="_blank">Entre em contato</a>
      </div>
    </div>
  @endforeach
@endsection