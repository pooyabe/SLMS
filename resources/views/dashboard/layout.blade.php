<x-dashboard.layout.header />

<x-dashboard.layout.sidebar />

<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">داشبورد</h1>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="container-fluid">

            <div class="row">

              @yield('content')

            </div>

        </div>
    </section>
</div>

<x-dashboard.layout.footer />
