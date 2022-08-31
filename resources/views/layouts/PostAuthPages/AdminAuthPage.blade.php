<div class="root">
    @include('layouts.navbars.sidebar')
    
    <div class="main-panel">
        <div class="main-panel-navbar">
            @include('layouts.navigation')
        </div>

        <main class="main-panel-data">
            <div class="main-panel-container">
                    @yield('content')
                <div class="main-panel-footer">
                    @include('layouts.footers.main')
                </div>
            </div>
        </main>
    </div>
</div>