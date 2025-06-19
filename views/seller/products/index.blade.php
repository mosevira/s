

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="

        crossorigin="anonymous" referrerpolicy="no-referrer" />
         <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <!-- Подключение CSS Bootstrap через CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        <a class="navbar-brand" href="#">Аккаунт продавца</a>
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
            <!-- Главная -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('seller.dashboard') ? 'active' : '' }}"
                   href="{{ route('seller.dashboard') }}">
                    <i class="fas fa-home"></i> Главная
                </a>
            </li>

            <!-- Накладные -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('seller.invoices.index') }}">
    <i class="fas fa-clipboard-list"></i> Накладные
</a>
            </li>

            <!-- Товары -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('seller.products.*') ? 'active' : '' }}"
                   href="{{ route('seller.products.index') }}">
                    <i class="fas fa-boxes"></i> Товары
                </a>
            </li>

            <!-- Списание -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('seller.products.index') ? 'active' : '' }}"
                   href="{{ route('seller.products.index') }}">
                    <i class="fas fa-minus-circle"></i> Списание
                </a>
            </li>

            <!-- Продажи -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('sales.*') ? 'active' : '' }}"
                   href="{{ route('sales.index') }}">
                    <i class="fas fa-cash-register"></i> Продажи
                </a>
            </li>

            <!-- Заявки на недостающий товар -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('seller.missing_requests.*') ? 'active' : '' }}"
                   href="{{ route('seller.missing_requests.create') }}">
                    <i class="fas fa-exclamation-circle"></i> Заявки
                </a>
            </li>
        </ul>
    </div>
</nav>
            <!-- Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Продукты</h1>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Количество в магазине</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productsWithQuantity as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }} ₽</td>
                        <td>{{ $product->quantity }}</td>
                        <td>
                            <form method="POST" action="{{ route('seller.products.updateQuantity', $product->id) }}" class="form-inline">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-2 mr-2">
                                    <input type="number" name="quantity" value="{{ $product->quantity }}" min="0" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">Изменить</button>
                            </form>
                            <a href="{{ route('seller.products.details', $product) }}" class="btn btn-info btn-sm mb-2">Подробнее</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
</main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
