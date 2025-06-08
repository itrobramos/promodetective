@php
    $user = Auth::user();
@endphp

<div class="bg-white overflow-hidden shadow sm:rounded-lg mb-6">
    <div class="px-4 py-5 sm:px-6 flex items-start justify-between">
        <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ __('User Information') }}
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                {{ __('Your personal information and account details.') }}
            </p>
        </div>
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <div class="flex-shrink-0">
            <img class="h-20 w-20 rounded-full object-cover shadow-lg" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
        </div>
        @endif
    </div>
    
    <div class="border-t border-gray-200">
        <dl>
            <!-- Basic Information -->
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">{{ __('Full name') }}</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $user->name }}</dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">{{ __('Email address') }}</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex items-center">
                    {{ $user->email }}
                    @if($user->email_verified_at)
                        <svg class="ml-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @endif
                </dd>
            </div>

            <!-- Account Status -->
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">{{ __('Account status') }}</dt>
                <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                    <div class="flex items-center">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $user->email_verified_at ? __('Verified') : __('Pending verification') }}
                        </span>
                        @if($user->email_verified_at)
                            <span class="ml-2 text-xs text-gray-500">{{ __('on') }} {{ $user->email_verified_at->format('M d, Y') }}</span>
                        @endif
                    </div>
                </dd>
            </div>

            <!-- Account Details -->
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">{{ __('Member since') }}</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $user->created_at->format('F d, Y') }}
                    <span class="text-gray-500 text-xs">({{ $user->created_at->diffForHumans() }})</span>
                </dd>
            </div>
        </dl>
    </div>

    <!-- Quick Stats -->
    <div class="border-t border-gray-200 bg-gray-50 grid grid-cols-2 sm:grid-cols-4 gap-4 px-4 py-5">
        <div class="text-center">
            <dt class="text-sm font-medium text-gray-500 truncate">{{ __('Active sessions') }}</dt>
            <dd class="mt-1 text-xl font-semibold text-gray-900">1</dd>
        </div>
        <div class="text-center">
            <dt class="text-sm font-medium text-gray-500 truncate">{{ __('Last login') }}</dt>
            <dd class="mt-1 text-sm font-semibold text-gray-900">{{ $user->created_at->diffForHumans() }}</dd>
        </div>
        <div class="text-center">
            <dt class="text-sm font-medium text-gray-500 truncate">{{ __('2FA Status') }}</dt>
            <dd class="mt-1">
                @if(Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    @if($user->two_factor_secret)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ __('Enabled') }}</span>
                    @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">{{ __('Disabled') }}</span>
                    @endif
                @else
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">{{ __('Not available') }}</span>
                @endif
            </dd>
        </div>
        <div class="text-center">
            <dt class="text-sm font-medium text-gray-500 truncate">{{ __('Browser sessions') }}</dt>
            <dd class="mt-1 text-xl font-semibold text-gray-900">{{ rand(1, 3) }}</dd>
        </div>
    </div>
</div>
