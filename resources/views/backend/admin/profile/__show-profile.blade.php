<div class="d-box flex-mode content-center">
    <section>
        <div class="text-center">
            <img src="{{auth()->user()->image->url ? asset(auth()->user()->image->url) : asset('images/user-img.png')}}" role="presentation" class="profile-img">
            <h3 class="page-title my-3">{{__($user->name ?? '----------')}}</h3>
        </div>
        <div class="flex-mode gap-2 content-center">
            <img height="20" class="filter" src="{{asset('images/icons/at-icon.svg')}}" alt="">
            <span class="sub-title">{{__($user->username  ?? '----------')}}</span>
        </div>
        <div class="flex-mode my-2 gap-2 content-center">
            <img height="20" class="filter" src="{{asset('images/icons/phone-icon.svg')}}" alt="">
            <span class="sub-title">{{__($user->mobile_number  ?? '----------')}}</span>
        </div>
        <div class="flex-mode gap-2 content-center">
            <img height="20" class="filter" src="{{asset('images/icons/email-icon.svg')}}" alt="">
            <span class="sub-title">{{__($user->email  ?? '-')}}</span>
        </div>
    </section>
</div>
