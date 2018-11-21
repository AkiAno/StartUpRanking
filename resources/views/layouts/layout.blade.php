<body>
        <div>
                <nav id="nav-menu" class="navbar navbar-expand-md navbar-laravel">
                    <div className="container-fluid">
                        <div className="navbar-header">
                                <div className="container">
                                        <a id="link" className="navbar-brand" to="/">
                                            <span className="start">Start</span>
                                            <span className="ups">ups</span>{" "}
                                            <span className="today">Today</span>
                                        </a>
                                    </div>
                        </div>
                        <ul className="nav navbar-nav">
                            <li className="active">
                                <a href="#">Home</a>
                            </li>
                            <li>
                                <a href="/news">News</a>
                            </li>
                            <li>
                                <a href="#">Login</a>
                            </li>
                            <li>
                                <a href="#">Register</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                
        </div>

        <main class="py-4">
                @yield('content')
        </main>
        <div class="footer fixed-bottom d-flex align-items-lg-center justify-content-lg-center">
                copyright @StartUpsToday
        </div>
</body>