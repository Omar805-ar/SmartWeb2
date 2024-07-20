<nav
    class="{{ auth()->user()->locale == 'ar' ? 'md:right-0' : 'md:left-0' }} md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6">
    <div
        class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">
        <button
            class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
            type="button" onclick="toggleNavbar('example-collapse-sidebar')">
            <i class="fas fa-bars"></i>
        </button>
        <a class="md:block text-left md:pb-2 text-blueGray-700 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"
            href="{{ route('admin.home') }}">
            {{ trans('panel.site_title') }}
        </a>
        <div class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden"
            id="example-collapse-sidebar">
            <div class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blueGray-300">
                <div class="flex flex-wrap">
                    <div class="w-6/12">
                        <a class="md:block text-left md:pb-2 text-blueGray-700 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"
                            href="{{ route('admin.home') }}">
                            {{ trans('panel.site_title') }}
                        </a>
                    </div>
                    <div class="w-6/12 flex justify-end">
                        <button type="button"
                            class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                            onclick="toggleNavbar('example-collapse-sidebar')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>



            <!-- Divider -->
            <div class="flex md:hidden">
                @if (file_exists(app_path('Http/Livewire/LanguageSwitcher.php')))
                    <livewire:language-switcher />
                @endif
            </div>
            <hr class="mb-6 md:min-w-full" />
            <!-- Heading -->

            <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                <li class="items-center">
                    <a href="{{ route('admin.home') }}"
                        class="{{ request()->is('admin') ? 'sidebar-nav-active' : 'sidebar-nav' }}">
                        <i class="fas fa-tv"></i>
                        {{ trans('global.dashboard') }}
                    </a>
                </li>

                @can('user_management_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is('admin/permissions*') || request()->is('admin/roles*') || request()->is('admin/users*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                            href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-users">
                            </i>
                            {{ trans('cruds.userManagement.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('permission_access')
                                <li class="items-center">
                                    <a class="{{ request()->is('admin/permissions*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="{{ route('admin.permissions.index') }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-unlock-alt">
                                        </i>
                                        {{ trans('cruds.permission.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="items-center">
                                    <a class="{{ request()->is('admin/roles*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="{{ route('admin.roles.index') }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-briefcase">
                                        </i>
                                        {{ trans('cruds.role.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="items-center">
                                    <a class="{{ request()->is('admin/users*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="{{ route('admin.users.index') }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-user">
                                        </i>
                                        {{ trans('cruds.user.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('shipping_management_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is('admin/countries*') || request()->is('admin/governments*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                            href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-shipping-fast">
                            </i>
                            {{ trans('cruds.shippingManagement.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('country_access')
                                <li class="items-center">
                                    <a class="{{ request()->is('admin/countries*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="{{ route('admin.countries.index') }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-globe-africa">
                                        </i>
                                        {{ trans('cruds.country.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('government_access')
                                <li class="items-center">
                                    <a class="{{ request()->is('admin/governments*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="{{ route('admin.governments.index') }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-building">
                                        </i>
                                        {{ trans('cruds.government.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('product_management_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is('admin/categories*') || request()->is('admin/colors*') || request()->is('admin/sizes*') || request()->is('admin/suppliers*') || request()->is('admin/products*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                            href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-boxes">
                            </i>
                            {{ trans('cruds.productManagement.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('category_access')
                                <li class="items-center">
                                    <a class="{{ request()->is('admin/categories*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="{{ route('admin.categories.index') }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-tag">
                                        </i>
                                        {{ trans('cruds.category.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('color_access')
                                <li class="items-center">
                                    <a class="{{ request()->is('admin/colors*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="{{ route('admin.colors.index') }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-palette">
                                        </i>
                                        {{ trans('cruds.color.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('size_access')
                                <li class="items-center">
                                    <a class="{{ request()->is('admin/sizes*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="{{ route('admin.sizes.index') }}">
                                        <i class="fa-fw c-sidebar-nav-icon fab fa-scribd">
                                        </i>
                                        {{ trans('cruds.size.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('supplier_access')
                                <li class="items-center">
                                    <a class="{{ request()->is('admin/suppliers*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="{{ route('admin.suppliers.index') }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-parachute-box">
                                        </i>
                                        {{ trans('cruds.supplier.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('product_access')
                                <li class="items-center">
                                    <a class="{{ request()->is('admin/products*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="{{ route('admin.products.index') }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-box">
                                        </i>
                                        {{ trans('cruds.product.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('merchant_management_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is('admin/merchants*') || request()->is('admin/penalties*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                            href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-user-tie">
                            </i>
                            {{ trans('cruds.merchantManagement.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('merchant_access')
                                <li class="items-center">
                                    <a class="{{ request()->is('admin/merchants*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="{{ route('admin.merchants.index') }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-user-tie">
                                        </i>
                                        {{ trans('cruds.merchant.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('penalty_access')
                                <li class="items-center">
                                    <a class="{{ request()->is('admin/penalties*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="{{ route('admin.penalties.index') }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-hand-holding-usd">
                                        </i>
                                        {{ trans('cruds.penalty.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('bonu_access')
                                <li class="items-center">
                                    <a class="{{ request()->is('admin/bonus*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="{{ route('admin.bonus.index') }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-angle-double-up">
                                        </i>
                                        {{ trans('cruds.bonu.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('faq_management_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is('admin/faq-categories*') || request()->is('admin/faq-questions*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                            href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-question">
                            </i>
                            {{ trans('cruds.faqManagement.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('faq_category_access')
                                <li class="items-center">
                                    <a class="{{ request()->is('admin/faq-categories*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="{{ route('admin.faq-categories.index') }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-briefcase">
                                        </i>
                                        {{ trans('cruds.faqCategory.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('faq_question_access')
                                <li class="items-center">
                                    <a class="{{ request()->is('admin/faq-questions*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="{{ route('admin.faq-questions.index') }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-question">
                                        </i>
                                        {{ trans('cruds.faqQuestion.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('content_management_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is('admin/content-categories*') || request()->is('admin/content-tags*') || request()->is('admin/content-pages*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                            href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-book">
                            </i>
                            {{ trans('cruds.contentManagement.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('content_category_access')
                                <li class="items-center">
                                    <a class="{{ request()->is('admin/content-categories*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="{{ route('admin.content-categories.index') }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-folder">
                                        </i>
                                        {{ trans('cruds.contentCategory.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('content_tag_access')
                                <li class="items-center">
                                    <a class="{{ request()->is('admin/content-tags*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="{{ route('admin.content-tags.index') }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-tags">
                                        </i>
                                        {{ trans('cruds.contentTag.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('content_page_access')
                                <li class="items-center">
                                    <a class="{{ request()->is('admin/content-pages*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="{{ route('admin.content-pages.index') }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-file">
                                        </i>
                                        {{ trans('cruds.contentPage.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('user_alert_access')
                    <li class="items-center">
                        <a class="{{ request()->is('admin/user-alerts*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                            href="{{ route('admin.user-alerts.index') }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-bell">
                            </i>
                            {{ trans('cruds.userAlert.title') }}
                        </a>
                    </li>
                @endcan
                @can('order_access')
                    <li class="items-center">
                        <a class="{{ request()->is('admin/orders*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                            href="{{ route('admin.orders.index') }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-clipboard-list">
                            </i>
                            {{ trans('cruds.order.title') }}
                        </a>
                    </li>
                @endcan
                @can('setting_access')
                    <li class="items-center">
                        <a class="{{ request()->is('admin/settings*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                            href="{{ route('admin.settings.index') }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                            </i>
                            {{ trans('cruds.setting.title') }}
                        </a>
                    </li>
                @endcan
                @can('training_management_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is('admin/training-categories*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                            href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-chalkboard-teacher">
                            </i>
                            {{ trans('cruds.trainingManagement.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('training_category_access')
                                <li class="items-center">
                                    <a class="{{ request()->is('admin/training-categories*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="{{ route('admin.training-categories.index') }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-list">
                                        </i>
                                        {{ trans('cruds.trainingCategory.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('training_access')
                                <li class="items-center">
                                    <a class="{{ request()->is('admin/trainings*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="{{ route('admin.trainings.index') }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-chalkboard-teacher">
                                        </i>
                                        {{ trans('cruds.training.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('ticket_management_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is('admin/ticket-categories*') || request()->is('admin/tickets*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                            href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-cogs">
                            </i>
                            {{ trans('cruds.ticketManagement.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('ticket_category_access')
                                <li class="items-center">
                                    <a class="{{ request()->is('admin/ticket-categories*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="{{ route('admin.ticket-categories.index') }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-ticket-alt">
                                        </i>
                                        {{ trans('cruds.ticketCategory.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('ticket_access')
                                <li class="items-center">
                                    <a class="{{ request()->is('admin/tickets*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                        href="{{ route('admin.tickets.index') }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-ticket-alt">
                                        </i>
                                        {{ trans('cruds.ticket.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @if (file_exists(app_path('Http/Controllers/Auth/UserProfileController.php')))
                    @can('auth_profile_edit')
                        <li class="items-center">
                            <a href="{{ route('profile.show') }}"
                                class="{{ request()->is('profile') ? 'sidebar-nav-active' : 'sidebar-nav' }}">
                                <i class="fa-fw c-sidebar-nav-icon fas fa-user-circle"></i>
                                {{ trans('global.my_profile') }}
                            </a>
                        </li>
                    @endcan
                @endif

                <li class="items-center">
                    <a href="#"
                        onclick="event.preventDefault(); document.getElementById('logoutform').submit();"
                        class="sidebar-nav">
                        <i class="fa-fw fas fa-sign-out-alt"></i>
                        {{ trans('global.logout') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
