@if($user)
    <li style="padding: 15px; color: white; cursor: pointer"><div>
            обмен 1С
             @if(\App\Settings::find(1)->exchange == 1)
                <span class="badge alert-success" title="Обмен 1С включен">
                    @else
                        <span class="badge alert-danger" title="Обмен 1С отключен">
                @endif
                <i class="fa fa-exchange" aria-hidden="true" style="color: white"></i>
            </span>
        </div>
    </li>
    <li style="padding: 15px; cursor: pointer" title="Время последнего обмена"><div>
            <span class="badge alert-info"><i class="fa fa-clock-o" aria-hidden="true" style="color: white"></i> {{ \App\Http\Controllers\ExchangeController::show() }}</span>
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