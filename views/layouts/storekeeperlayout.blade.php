<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storekeeper Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #007bff;
            color: white;
        }

        .navbar-brand {
            color: white !important;
        }

        .nav-link {
            color: white !important;
        }

        .nav-link:hover {
            color: #ddd !important;
        }

        .container-fluid {
            padding-top: 20px;
        }

        .list-group-item {
            border: none;
            border-radius: 0;
            padding: 0.75rem 0;
        }

        .list-group-item:hover {
            background-color: #e9ecef;
        }

        .card {
            border: none;
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.05);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        /* Исправление цвета текста в боковой панели */
        #sidebar .nav-link {
            color: #333 !important;
        }

        #sidebar .nav-link:hover {
            color: #007bff !important;
        }

        #sidebar .nav-link.active {
            color: #fff !important;
            background-color: #007bff;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Аккаунт кладовщика</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link">
                            <i class="fas fa-sign-out-alt"></i> Выход
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">
                                <i class="fas fa-home"></i> Главная
                            </a>
                        </li>
                        @auth
    @if(auth()->user()->isAdmin())
        <li class="{{ request()->is('dashboard/admin') ? 'active' : '' }}">
            <a href="{{ route('dashboard.admin') }}">Панель</a>
        </li>
    @elseif(auth()->user()->isStorekeeper())
        <li class="{{ request()->is('dashboard/storekeeper') ? 'active' : '' }}">
            <a href="{{ route('dashboard.storekeeper') }}">Панель</a>
        </li>
    @endif
@endauth
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('storekeeper.warehouse_missing_product_request.create') }}">
                                <i class="fas fa-plus-circle"></i> Создать заявку на недостающий товвар
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('invoices.create') }}">
                                <i class="fas fa-plus-circle"></i> Создать накладную
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('storekeeper.branches.index') }}">
                                <i class="fas fa-store"></i> Список магазинов
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('storekeeper.shipments.index') }}">
                                <i class="fas fa-truck"></i> Shipments
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('storekeeper.incoming_product.create') }}">
                                <i class="fas fa-box"></i> Приемка товаров
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('storekeeper.activity_logs.index') }}">
                                <i class="fas fa-history"></i> Действия
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('content')
            </main>
        </body>
</html>
