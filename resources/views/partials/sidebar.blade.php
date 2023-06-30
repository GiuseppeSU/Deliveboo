<div id="container_sidebar">
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary general_container w-100 rounded-4 nav-pills" style="width: 280px;">
        <a href="{{ route('admin.dashboard') }}" class="nav-link link-body-emphasis fw-bolder title" aria-current="page">
            <svg class="bi pe-none me-2 d-none" width="16" height="16">
                <use xlink:href="#home"></use>
            </svg>
            <span class="text-center"><h3>Dashboard</h3></span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="mt-1">
                <a href="{{ route('admin.products.index') }}"
                    class="nav-link link-body-emphasis @if (Route::currentRouteName() == 'admin.products.index') active text-white @endif">
                    <svg class="bi pe-none me-2" width="16" height="16">
                        <use xlink:href="#speedometer2"></use>
                    </svg>
                    <span>Lista dei piatti</span>
                </a>
            </li>

            @if (Route::currentRouteName() == 'admin.products.index')
                <li class="mt-1">
                    <a href="{{ route('admin.products.create') }}"
                        class="nav-link link-body-emphasis @if (Route::currentRouteName() == 'admin.products.create') active text-white @endif">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#speedometer2"></use>
                        </svg>
                        <span>+ Aggiungi piatto</span>
                    </a>
                </li>
            @endif

            <li class="mt-1">
                <a href="{{ route('admin.orders.index') }}"
                    class="nav-link link-body-emphasis @if (Route::currentRouteName() == 'admin.orders.index') active text-white @endif">
                    <svg class="bi pe-none me-2" width="16" height="16">
                        <use xlink:href="#table"></use>
                    </svg>
                    <span> Ordini</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.stats.index') }}"
                    class="nav-link link-body-emphasis @if (Route::currentRouteName() == 'admin.orders.show') active text-white @endif">
                    <svg class="bi pe-none me-2" width="16" height="16">
                        <use xlink:href="#grid"></use>
                    </svg>
                    <span>Statistiche</span>
                </a>
            </li>

        </ul>
        <hr>

    </div>

</div>
