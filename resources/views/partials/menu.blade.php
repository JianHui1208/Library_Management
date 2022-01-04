<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li>
                <a href="{{ route("admin.home") }}">
                    <i class="fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('user_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-users">

                        </i>
                        <span>{{ trans('cruds.userManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('permission_access')
                            <li class="{{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                <a href="{{ route("admin.permissions.index") }}">
                                    <i class="fa-fw fas fa-unlock-alt">

                                    </i>
                                    <span>{{ trans('cruds.permission.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="{{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                <a href="{{ route("admin.roles.index") }}">
                                    <i class="fa-fw fas fa-briefcase">

                                    </i>
                                    <span>{{ trans('cruds.role.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="{{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                <a href="{{ route("admin.users.index") }}">
                                    <i class="fa-fw fas fa-user">

                                    </i>
                                    <span>{{ trans('cruds.user.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('audit_log_access')
                            <li class="{{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                <a href="{{ route("admin.audit-logs.index") }}">
                                    <i class="fa-fw fas fa-file-alt">

                                    </i>
                                    <span>{{ trans('cruds.auditLog.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('book_management_menu_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-industry">

                        </i>
                        <span>{{ trans('cruds.bookManagementMenu.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('book_list_access')
                            <li class="{{ request()->is("admin/book-lists") || request()->is("admin/book-lists/*") ? "active" : "" }}">
                                <a href="{{ route("admin.book-lists.index") }}">
                                    <i class="fa-fw fas fa-book">

                                    </i>
                                    <span>{{ trans('cruds.bookList.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('book_category_access')
                            <li class="{{ request()->is("admin/book-categories") || request()->is("admin/book-categories/*") ? "active" : "" }}">
                                <a href="{{ route("admin.book-categories.index") }}">
                                    <i class="fa-fw fas fa-list">

                                    </i>
                                    <span>{{ trans('cruds.bookCategory.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('book_tag_access')
                            <li class="{{ request()->is("admin/book-tags") || request()->is("admin/book-tags/*") ? "active" : "" }}">
                                <a href="{{ route("admin.book-tags.index") }}">
                                    <i class="fa-fw fas fa-list">

                                    </i>
                                    <span>{{ trans('cruds.bookTag.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('book_loan_access')
                            <li class="{{ request()->is("admin/book-loans") || request()->is("admin/book-loans/*") ? "active" : "" }}">
                                <a href="{{ route("admin.book-loans.index") }}">
                                    <i class="fa-fw fas fa-piggy-bank">

                                    </i>
                                    <span>{{ trans('cruds.bookLoan.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('system_setting_access')
                <li class="{{ request()->is("admin/system-settings") || request()->is("admin/system-settings/*") ? "active" : "" }}">
                    <a href="{{ route("admin.system-settings.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.systemSetting.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('question_access')
                <li class="{{ request()->is("admin/questions") || request()->is("admin/questions/*") ? "active" : "" }}">
                    <a href="{{ route("admin.questions.index") }}">
                        <i class="fa-fw fas fa-question-circle">

                        </i>
                        <span>{{ trans('cruds.question.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('laravel_passport_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.laravel-passports.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/laravel-passports") || request()->is("admin/laravel-passports/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.laravelPassport.title') }}
                    </a>
                </li>
            @endcan
            @can('content_management_access')
                <li class="{{ request()->is("admin/content-managements") || request()->is("admin/content-managements/*") ? "active" : "" }}">
                    <a href="{{ route("admin.content-managements.index") }}">
                        <i class="fa-fw far fa-image">

                        </i>
                        <span>{{ trans('cruds.contentManagement.title') }}</span>

                    </a>
                </li>
            @endcan
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="{{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}">
                        <a href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>
    </section>
</aside>