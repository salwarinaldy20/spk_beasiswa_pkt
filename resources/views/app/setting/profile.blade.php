@extends('layout.app')

@section('customcss')

@endsection

@section('panelhead')

<div class="page-title d-flex flex-column align-items-start me-3 py-2 py-lg-0 gap-2">
    <h1 class="d-flex text-white fw-bolder m-0 fs-3">My Profile</h1>
    <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7">
        <li class="breadcrumb-item text-gray-600">
            <a href="#" class="text-gray-600 text-hover-primary">User</a>
        </li>
        <li class="breadcrumb-item text-gray-600">My Profile</li>
    </ul>
</div>

@endsection

@section('content')

<div class="d-flex flex-column flex-lg-row">
    <!--begin::Sidebar-->
    <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
        <!--begin::Card-->
        <div class="card mb-5 mb-xl-8">
            <!--begin::Card body-->
            <div class="card-body">
                <!--begin::Summary-->
                <!--begin::User Info-->
                <div class="d-flex flex-center flex-column py-5">
                    <!--begin::Avatar-->

                    <!--begin::Image input-->
                    <div class="image-input image-input-circle" data-kt-image-input="true"
                        style="background-image: url({{asset('/assets/media/svg/avatars/blank.svg')}})">
                        <!--begin::Image preview wrapper-->
                        <div class="image-input-wrapper w-125px h-125px"
                            style="background-image: url({{asset('storage/foto_user/'.Auth::user()->foto_user)}})"></div>
                        <!--end::Image preview wrapper-->

                        <!--begin::Edit button-->
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                            data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Change avatar">
                            <i class="bi bi-pencil-fill fs-7"></i>

                            <!--begin::Inputs-->
                            <input type="file" id="foto" name="foto" accept=".png, .jpg, .jpeg" />
                            <input type="hidden" name="avatar_remove" />
                            <!--end::Inputs-->
                        </label>
                        <!--end::Edit button-->


                    </div>
                    <!--end::Image input-->

                    <!--end::Avatar-->
                    <!--begin::Name-->
                    <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-3">{{Auth::user()->nama}}</a>
                    <!--end::Name-->
                    <!--begin::Position-->
                    <div class="mb-9">
                        <!--begin::Badge-->
                        <div class="badge badge-lg badge-light-primary d-inline">{{Auth::user()->role_user}}</div>
                        <!--begin::Badge-->
                    </div>
                    <!--end::Position-->
                    <!--begin::Info-->
                    <!--begin::Info heading-->
                    <div class="fw-bolder mb-3">{{Omjin::tglWaktu1(Auth::user()->last_login)}}
                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Number of support tickets assigned, closed and pending this week." data-bs-original-title="" title=""></i></div>
                    <!--end::Info heading-->

                </div>
                <!--end::User Info-->
                <!--end::Summary-->
                <!--begin::Details toggle-->
                <div class="d-flex flex-stack fs-4 py-3">
                    <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">Details
                    <span class="ms-2 rotate-180">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http:
                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span></div>
                </div>
                <!--end::Details toggle-->
                <div class="separator"></div>
                <!--begin::Details content-->
                <div id="kt_user_view_details" class="collapse show">
                    <div class="pb-5 fs-6">
                        <!--begin::Details item-->
                        <div class="fw-bolder mt-5">Username</div>
                        <div class="text-gray-600">{{Auth::user()->username}}</div>
                        <!--begin::Details item-->
                        <!--begin::Details item-->
                        <div class="fw-bolder mt-5">Created At</div>
                        <div class="text-gray-600">
                            <a href="#" class="text-gray-600 text-hover-primary">{{Omjin::tglWaktu1(Auth::user()->created_on)}}</a>
                        </div>
                        <!--begin::Details item-->
                        <div class="fw-bolder mt-5">Last Login</div>
                        <div class="text-gray-600">{{Omjin::tglWaktu1(Auth::user()->last_login)}}</div>
                        <!--begin::Details item-->
                    </div>
                </div>
                <!--end::Details content-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->

    </div>
    <!--end::Sidebar-->
    <!--begin::Content-->
    <div class="flex-lg-row-fluid ms-lg-15">

        <div class="card card-flush mb-6 mb-xl-9">
            <!--begin::Card header-->
            <div class="card-header mt-6">
                <!--begin::Card title-->
                <div class="card-title flex-column">
                    <h2 class="mb-1">Account Setting</h2>
                    <div class="fs-6 fw-bold text-muted">You can change your account personal via the following form</div>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body p-9 pt-4">

                <div class="row">
                    <div class="col-md-12">
                        <form id="reg" novalidate="novalidate">

                            <div class="fv-row mb-5">
                                <label class="form-label fs-6 fw-bolder text-dark">Nama</label>
                                <input class="form-control form-control-lg form-control-solid" type="text" id="nama" name="nama"  placeholder="{{Auth::user()->nama}}" autocomplete="off" />
                                <!--end::Input-->
                            </div>
                            <div class="fv-row mb-5">
                                <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                                <input class="form-control form-control-lg form-control-solid" type="email" id="email" name="email"  placeholder="{{Auth::user()->email}}" autocomplete="off" />
                                <!--end::Input-->
                            </div>

                            <div class="form-check form-check-custom form-check-solid  mb-3">
                                <input class="form-check-input" type="checkbox" value="1" id="cekp">
                                <label class="form-check-label fs-6 fw-bolder text-dark" for="cekp">Change Password</label>
                            </div>

                            <div class="fv-row mb-5" id="fpassword" style="display: none;">
                                <div>
                                    <input class="form-control form-control-lg form-control-solid pswd" type="password" id="password" name="password" placeholder="Password" autocomplete="off" style="padding-right:45px;" />
                                    <span class="hint spass tpass"></span>
                                </div>
                            </div>



                            <hr>

                            <div class="d-flex justify-content-end">
                                <button type="submit" id="btnsave" class="btn btn-lg btn-warning w-100 mb-5">
                                    <span class="indicator-label">Save</span>
                                    <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!--end::Content-->
</div>



@endsection

@section('modals')

@endsection

@section('customjs')

<script src="{{ asset('js/profile.js') }}"></script>

@endsection

