@if($user)
    <li style="padding: 15px"><div>
            <i class="fa fa-newspaper-o" aria-hidden="true" style="color: white"></i>
            <span class="badge alert-info"><?php echo \App\News::count(); ?>
        </div>
    </li>
    <li style="padding: 15px"><div>
            <i class="fa fa-user-o" aria-hidden="true" style="color: white"></i>
            <span class="badge alert-danger"><?php echo \App\UserProfile::count(); ?>
        </div>
    </li>
    <li style="padding: 15px"><div>
        <i class="fa fa-cart-plus" aria-hidden="true" style="color: white"></i>
        <span class="badge alert-success"><?php echo \App\Order::count(); ?>
        </div>
    </li>
    <li>
        <a href="/" target="_blank">
            <i class="fa fa-btn fa-globe"></i> @lang('sleeping_owl::lang.links.index_page')
        </a>
    </li>
    <li class="dropdown user user-menu" style="margin-right: 20px;">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
            <img src="/{{ $avatar }}" class="user-image" />
            <span class="hidden-xs">{{ $user->name }}</span>
        </a>
        <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
                <img src="/{{ $avatar }}" class="img-circle" />
                <p>
                    {{ $user->name }}
                    <small>@lang('sleeping_owl::lang.auth.since', ['date' => $user->created_at->format('d.m.Y')])</small>
                </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
                <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-btn fa-sign-out"></i> @lang('sleeping_owl::lang.auth.logout')
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </li>
@endif