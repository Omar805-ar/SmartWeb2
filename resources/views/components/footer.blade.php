<footer class="block py-4">
    <div class="container mx-auto px-4">
        <hr class="mb-4 border-b-1 border-blueGray-200">
        <div class="flex flex-wrap items-center md:justify-between justify-center">
            <div class="w-full md:w-4/12 px-4">
                <div class="text-sm text-blueGray-500 font-semibold py-1 text-center {{ (auth()->user()->locale == 'ar' ? 'md:text-right': 'md:text-left' ) }} ">
                    <div class="hidden">
                        {{ trans('global.copyright') }} © <span id="get-current-year">{{ date('Y') }}</span>
                    </div>
                   
                    {{ trans('global.made_by') }}
                    <a href="https://marketopiateam.com/" class="text-blueGray-500 hover:text-blueGray-700 text-sm font-semibold py-1" target="_blank">
                        Marketopia Team
                    </a>
                </div>
            </div>
          
        </div>
    </div>
</footer>