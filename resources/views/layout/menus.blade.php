<div class="menu-item me-lg-1  {{ Omjin::set_active(['dashboard'], 'here show') }}">
    <a href="{{route('dashboard')}}" class="menu-link py-3">
        <span class="menu-title">Dashboard</span>
    </a>
</div>

<div class="menu-item me-lg-1  {{ Omjin::set_active(['diagnosa'], 'here show') }}">
    <a href="{{route('diagnosa')}}" class="menu-link py-3">
        <span class="menu-title">Diagnosa</span>
    </a>
</div>

<div class="menu-item me-lg-1  {{ Omjin::set_active(['profile'], 'here show') }}">
    <a href="{{route('profile')}}" class="menu-link py-3">
        <span class="menu-title">List Diagnosa</span>
    </a>
</div>

<div class="menu-item me-lg-1  {{ Omjin::set_active(['training'], 'here show') }}">
    <a href="{{route('training')}}" class="menu-link py-3">
        <span class="menu-title">Training</span>
    </a>
</div>


{{-- @if(Omjin::permission(['aclRead','quotaRead'])) --}}

<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1  {{ Omjin::set_active(['profile'], 'here show') }}">
    <span class="menu-link py-3">
        <span class="menu-title">Master</span>
        <span class="menu-arrow d-lg-none"></span>
    </span>
    <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
        {{-- @if(Omjin::permission(['aclRead'])) --}}
        <div class="menu-item">
            <a href="{{route('gejala')}}" class="menu-link {{ Omjin::set_active(['gejala']) }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Gejala</span>
            </a>
        </div>
        {{-- @endif  --}}
        {{-- @if(Omjin::permission(['aclRead'])) --}}
        <div class="menu-item">
            <a href="{{route('penyakit')}}" class="menu-link {{ Omjin::set_active(['penyakit']) }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Penyakit</span>
            </a>
        </div>
        {{-- @endif  --}}
        {{-- @if(Omjin::permission(['aclRead'])) --}}
        <div class="menu-item">
            <a href="{{route('rules')}}" class="menu-link {{ Omjin::set_active(['rules']) }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Rules</span>
            </a>
        </div>
        {{-- @endif  --}}
        {{-- @if(Omjin::permission(['aclRead'])) --}}
        <div class="menu-item">
            <a href="{{route('user')}}" class="menu-link {{ Omjin::set_active(['aclRole']) }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">User</span>
            </a>
        </div>
        {{-- @endif  --}}
    </div>
</div>
{{-- @endif --}}

{{-- @if(Omjin::permission(['aclRead','quotaRead'])) --}}

<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1  {{ Omjin::set_active(['profile'], 'here show') }}">
    <span class="menu-link py-3">
        <span class="menu-title">Settings</span>
        <span class="menu-arrow d-lg-none"></span>
    </span>
    <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
        {{-- @if(Omjin::permission(['aclRead'])) --}}
        <div class="menu-item">
            <a href="{{route('aclRole')}}" class="menu-link {{ Omjin::set_active(['aclRole']) }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Access Control</span>
            </a>
        </div>
        {{-- @endif  --}}
    </div>
</div>
{{-- @endif --}}

