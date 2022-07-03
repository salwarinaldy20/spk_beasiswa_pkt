@extends('layout.auth')


@section('customcss')
    <style>
        @media only screen and (max-width: 600px) {

        .lottieanim {
            width: 60%;
            height: auto;
        }
    }
    @media only screen and (min-width: 601px) {

        .lottieanim {
            width: 70%;
            height: auto;
        }
    }
    </style>
@endsection

@section('content')

<div class="d-flex flex-column flex-root">
	<!--begin::Authentication - Sign-in -->
	<div class="d-flex flex-column flex-lg-row flex-column-fluid">
		<!--begin::Aside-->
		<div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative" style="background-color: #FFECA2">
			<!--begin::Wrapper-->
			<div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
				<!--begin::Content-->
				<div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
					<!--begin::Logo-->
					<a href="{{route('landing')}}" class="py-9 mb-5">
						<img alt="Logo" src="{{ asset('assets/media/logos/logo.svg') }}" class="h-60px">
					</a>
					<!--end::Logo-->
					<!--begin::Title-->
					<h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #FFFF;">Welcome to {{ config('app.name', 'Laravel') }}</h1>
					<!--end::Title-->
					<!--begin::Description-->

					<!--end::Description-->
				</div>
				<!--end::Content-->
				<!--begin::Illustration-->
				<div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px">
                    <lottie-player class="lottieanim mx-auto" src="{{asset('assets/media/lottie/signup.json')}}"  background="transparent"  speed="1"  style=""  loop autoplay></lottie-player>
                </div>
				<!--end::Illustration-->
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Aside-->
		<!--begin::Body-->
		<div class="d-flex flex-column flex-lg-row-fluid py-10">
			<!--begin::Content-->
			<div class="d-flex flex-center flex-column flex-column-fluid">
				<!--begin::Wrapper-->
				<div class="w-lg-500px p-10 p-lg-15 mx-auto">
					<!--begin::Form-->

					<div id="alertx"></div>

					<form class="form w-100 validatex" id="form1" novalidate="novalidate" id="kt_sign_up_form">
						<!--begin::Heading-->
						<div class="mb-10 text-center">
							<!--begin::Title-->
							<h1 class="text-dark mb-3">Create an Account</h1>
							<!--end::Title-->
							<!--begin::Link-->
							<div class="text-gray-400 fw-bold fs-4">Already have an account?
							<a href="{{route('signin')}}" class="link-primary fw-bolder">Sign in here</a></div>
							<!--end::Link-->
						</div>
						<!--end::Heading-->
						<!--begin::Action-->
						<a href="{{ route('authgoogle') }}" class="btn btn-light-primary fw-bolder w-100 mb-10">
						<img alt="Logo" src="{{asset('assets/media/svg/brand-logos/google-icon.svg')}}" class="h-20px me-3" />Sign in with Google</a>
						<!--end::Action-->
						<!--begin::Separator-->
						<div class="d-flex align-items-center mb-10">
							<div class="border-bottom border-gray-300 mw-50 w-100"></div>
							<span class="fw-bold text-gray-400 fs-7 mx-2">OR</span>
							<div class="border-bottom border-gray-300 mw-50 w-100"></div>
						</div>
						<!--end::Separator-->
						<!--begin::Input group-->
						<div class="row fv-row mb-7">
							<!--begin::Col-->
							<div class="col-xl-12">
								<label class="form-label fw-bolder text-dark fs-6">Name</label>
								<input class="form-control form-control-lg form-control-solid" placeholder="Name" id="nama" type="text" placeholder="" name="first-name" autocomplete="off" required/>
							</div>
							<!--end::Col-->
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<label class="form-label fw-bolder text-dark fs-6">Email</label>
							<input class="form-control form-control-lg form-control-solid" placeholder="Email" id="email" type="email" placeholder="" name="email" autocomplete="off" required />
						</div>

						<div class="fv-row mb-7">
							<label class="form-label fw-bolder text-dark fs-6">Username</label>
							<input class="form-control form-control-lg form-control-solid" placeholder="Username" id="username" type="text" placeholder="" name="email" autocomplete="off" required />
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="mb-10 fv-row" data-kt-password-meter="true">
							<!--begin::Wrapper-->
							<div class="mb-1">
								<!--begin::Label-->
								<label class="form-label fw-bolder text-dark fs-6">Password</label>
								<!--end::Label-->
								<!--begin::Input wrapper-->
								<div class="position-relative mb-3">
									<input class="form-control form-control-lg form-control-solid pswd" type="password" id="password" name="password" placeholder="Password" autocomplete="off" style="padding-right:45px;" required />
									<span class="hint spass tpass"></span>
								</div>
								<!--end::Input wrapper-->
							</div>
						</div>
						<!--end::Input group=-->
						<!--begin::Input group-->
						<div class="fv-row mb-10">
							<label class="form-label fw-bolder text-dark fs-6">Confirm Password</label>
							<div class="position-relative mb-3">
								<input class="form-control form-control-lg form-control-solid pswd" type="password" id="password1" name="password1" placeholder="Password" autocomplete="off" data-v-equal="#password" style="padding-right:45px;" required />
								<span class="hint spass tpass"></span>
							</div>
						</div>
						<!--end::Input group-->

						<!--begin::Actions-->
						<div class="d-grid text-center mt-5">
							<button type="submit" id="btnlogin" class="btn btn-lg btn-warning">
								<span class="indicator-label">Submit</span>
								<span class="indicator-progress">Please wait...
								<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
							</button>
						</div>
						<!--end::Actions-->
					</form>
			<!--end::Form-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Content-->
			<!--begin::Footer-->
			<div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
				<!--begin::Links-->
				<div class="d-flex flex-center fw-bold fs-6">
					<small class="text-center" style="color: #6a96d7;">Copyright &copy; 2022 | Sistem Pakar Diagnosis Kesehatan Mental</small>
				</div>
				<!--end::Links-->
			</div>
			<!--end::Footer-->
		</div>
		<!--end::Body-->
	</div>
	<!--end::Authentication - Sign-in-->
</div>

@endsection


@section('customjs')
<script src="{{ asset('js/signup.js') }}"></script>

@endsection
