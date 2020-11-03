<li class="nav-item">
    <a href="{{ $href }}" class="nav-link @if($active) active bg-cyan @endif">
        <i class="@if($sub) far fa-circle @endif nav-icon  @if($icon) fas fa-{{ $icon }} @endif"></i>
        <p>{{ $slot }}</p>
        @if($badge)
        <span class="badge badge-{{$badgeType}} right">{{$badgeText}}</span>
        @endif
    </a>
</li>
