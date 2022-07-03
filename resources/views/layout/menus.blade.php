<div class="menu-item me-lg-1  {{ Omjin::set_active(['dashboard'], 'here show') }}">
    <a href="{{route('dashboard')}}" class="menu-link py-3">
        <span class="menu-title">Dashboard</span>
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
            <a href="{{route('atribut')}}" class="menu-link {{ Omjin::set_active(['atributRead']) }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Atribut</span>
            </a>
        </div>
        {{-- @endif  --}}

        {{-- @if(Omjin::permission(['aclRead'])) --}}
        <div class="menu-item">
            <a href="{{route('kategori')}}" class="menu-link {{ Omjin::set_active(['kategoriRead']) }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Kategori Beasiswa</span>
            </a>
        </div>
        {{-- @endif  --}}

        {{-- @if(Omjin::permission(['aclRead'])) --}}
        <div class="menu-item">
            <a href="{{route('kriteria')}}" class="menu-link {{ Omjin::set_active(['kriteriaRead']) }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Kriteria</span>
            </a>
        </div>
        {{-- @endif  --}}
        {{-- @if(Omjin::permission(['aclRead'])) --}}
        <div class="menu-item">
            <a href="{{route('penilaian')}}" class="menu-link {{ Omjin::set_active(['penilaianRead']) }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Penilaian</span>
            </a>
        </div>
        {{-- @endif  --}}
        {{-- @if(Omjin::permission(['aclRead'])) --}}
        <div class="menu-item">
            <a href="{{route('periode')}}" class="menu-link {{ Omjin::set_active(['aclRole']) }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Periode</span>
            </a>
        </div>
        {{-- @endif  --}}
        {{-- @if(Omjin::permission(['aclRead'])) --}}
        <div class="menu-item">
            <a href="{{route('rules')}}" class="menu-link {{ Omjin::set_active(['aclRole']) }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Rules Penilaian</span>
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

