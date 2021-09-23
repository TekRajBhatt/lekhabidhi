<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height=100%">
    <a href="{{ route('dashboard.index') }}" class="brand-link" style="background-color:#374f65">
        <img src="{{ asset('img/AdminLTELogo.png') }}" alt="Lekha Bidhi" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ @$websites->website_name ?? env('APP_NAME') }}</span>
    </a>


    <div class="sidebar">
        <div class="user-panel mt-3 pb-0 mb-3 d-flex">
            <div class="image">
                <a href="" class="">
                    <img src="{{ asset('img/AdminLTELogo.png') }}" class="img-circle elevation-2" alt="User Image">
                </a>
            </div>

            <div class="info">
                <a href="{{ route('dashboard.index') }}" class="d-block">{{ @$websites->website_name ?? env('APP_NAME') }}<br>
                    <small>{{ request()->user()->roles->first()->name }}</small></a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview"
                role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}"
                        class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ request()->user()->roles->first()->name }} Dashboard
                        </p>
                    </a>
                </li>



                <li class="nav-header">WEB CONTENT</li>
                <li class="nav-item">
                    <a href="{{ route('index') }}" target="_blank" class="nav-link">
                        <i class="nav-icon fas fa-globe-asia"></i>
                        <p>Website</p>
                    </a>
                </li>
                <li
                    class="nav-item has-treeview {{ request()->is('admin/tag*') || request()->is('admin/blog*') || request()->is('admin/benefit*') || request()->is('admin/container*') || request()->is('admin/slider*') || request()->is('admin/clients*') || request()->is('admin/information*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ request()->is('admin/tag*') || request()->is('admin/blog*') || request()->is('admin/benefit*') || request()->is('admin/container*') || request()->is('admin/slider*') || request()->is('admin/clients*') || request()->is('admin/information*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-globe"></i>
                        <p>
                            CMS Content
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (in_array('slider', $app_content))
                            @canany(['slider-list', 'slider-create', 'slider-edit', 'slider-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('slider.index') }}"
                                        class="nav-link {{ request()->is('admin/slider*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-sliders-h"></i>
                                        <p>Slider</p>
                                    </a>
                                </li>
                            @endcanany
                        @endif

                        @if (in_array('information', $app_content))
                            @canany(['information-list', 'information-create', 'information-edit',
                                'information-delete'])
                                <li class="nav-item">
                                    <a href="{{ route('information.index') }}"
                                        class="nav-link {{ request()->is('admin/information*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-tools"></i>
                                        <p>Trending Software</p>
                                    </a>
                                </li>
                            @endcanany
                        @endif


                        {{-- @if (in_array('business', $app_content)) --}}
                        @canany(['business-list', 'business-create', 'business-edit', 'business-delete'])
                            <li class="nav-item">
                                <a href="{{ route('business.index') }}"
                                    class="nav-link {{ request()->is('admin/businesss*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Build Your Business</p>
                                </a>
                            </li>
                        @endcanany

                        {{-- @if (in_array('marketing', $app_content)) --}}
                        @canany(['marketing-list', 'marketing-create', 'marketing-edit',
                            'marketing-delete'])
                            <li class="nav-item">
                                <a href="{{ route('marketing.index') }}"
                                    class="nav-link {{ request()->is('admin/marketing*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tools"></i>
                                    <p>Marketing Service</p>
                                    </a>
                                </li>
                        @endcanany


                        {{-- @if (in_array('commit', $app_content)) --}}
                        @canany(['commit-list', 'commit-create', 'commit-edit',
                            'commit-delete'])
                            <li class="nav-item">
                                <a href="{{ route('commit.index') }}"
                                    class="nav-link {{ request()->is('admin/commit*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tools"></i>
                                    <p>Committed To Change</p>
                                    </a>
                                </li>
                        @endcanany

                         {{-- @if (in_array('satisfy', $app_content)) --}}
                         @canany(['satisfy-list', 'satisfy-create', 'satisfy-edit', 'satisfy-delete'])
                         <li class="nav-item">
                             <a href="{{ route('satisfy.index') }}"
                                 class="nav-link {{ request()->is('admin/satisfy*') ? 'active' : '' }}">
                                 <i class="nav-icon fas fa-user-friends"></i>
                                 <p>Satisfied Clients</p>
                             </a>
                         </li>
                         @endcanany

                        {{-- @if (in_array('testimonial', $app_content)) --}}
                        @canany(['testimonial-list', 'testimonial-create', 'testimonial-edit', 'testimonial-delete'])
                        <li class="nav-item">
                            <a href="{{ route('testimonial.index') }}"
                                class="nav-link {{ request()->is('admin/testimonial*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-sticky-note"></i>
                                <p>Testimonials</p>
                            </a>
                        </li>
                        @endcanany


                        {{-- @if (in_array('step', $app_content)) --}}
                        @canany(['step-list', 'step-create', 'step-edit',
                            'step-delete'])
                            <li class="nav-item">
                                <a href="{{ route('step.index') }}"
                                    class="nav-link {{ request()->is('admin/step*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tools"></i>
                                    <p>Steps To Grow Business</p>
                                    </a>
                                </li>
                        @endcanany

                           {{-- @if (in_array('work', $app_content)) --}}
                           @canany(['work-list', 'work-create', 'work-edit', 'work-delete'])
                           <li class="nav-item">
                               <a href="{{ route('work.index') }}"
                                   class="nav-link {{ request()->is('admin/work*') ? 'active' : '' }}">
                                   <i class="nav-icon fas fa-users"></i>
                                   <p>Work Together</p>
                               </a>
                           </li>
                       @endcanany

                         {{-- @if (in_array('plan', $app_content)) --}}
                         @canany(['plan-list', 'plan-create', 'plan-edit', 'plan-delete'])
                         <li class="nav-item">
                             <a href="{{ route('plan.index') }}"
                                 class="nav-link {{ request()->is('admin/plan*') ? 'active' : '' }}">
                                 <i class="nav-icon fas fa-users"></i>
                                 <p>Pricing Plan</p>
                             </a>
                         </li>
                         @endcanany

                        {{-- @if (in_array('partner', $app_content)) --}}
                        @canany(['partner-list', 'partner-create', 'partner-edit', 'partner-delete'])
                            <li class="nav-item">
                                <a href="{{ route('partner.index') }}"
                                    class="nav-link {{ request()->is('admin/partner*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Trusted Partners</p>
                                </a>
                            </li>
                        @endcanany

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-list"></i>
                      <p>
                        Menu Management
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route('menu.index') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>View Menu List</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('menu.create') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Create Menu</p>
                        </a>
                      </li>
                    </ul>
                  </li>

                @canany(['website-list', 'website-create', 'website-edit', 'website-delete'])
                    <li class="nav-item">
                        <a href="{{ route('website.index') }}"
                            class="nav-link {{ request()->is('admin/website*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-sticky-note"></i>
                            <p>Website Content</p>
                        </a>
                    </li>
                @endcanany

                {{-- @canany(['detail-list', 'detail-create', 'detail-edit', 'detail-delete']) --}}
                <li class="nav-item">
                    <a href="{{ route('detail.index') }}"
                        class="nav-link {{ request()->is('admin/detail*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-sticky-note"></i>
                        <p>Services Page Content</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('touch.index') }}"
                        class="nav-link {{ request()->is('admin/touch*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>User Management</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('team.index') }}"
                        class="nav-link {{ request()->is('admin/team*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-sticky-note"></i>
                        <p>Team Management</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('subscribe.index')}}"
                        class="nav-link {{ request()->is('admin/welcome*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-sticky-note"></i>
                        <p>Subscriber Management</p>
                    </a>
                </li>





            </ul>
        </nav>
    </div>
</aside>
{{-- <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('#lfm').filemanager('image');

</script>
<script>
    jQuery(function(){
        jQuery('#lfm').click();
    });
</script> --}}
