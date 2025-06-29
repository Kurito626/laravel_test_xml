<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Товары</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
</head>
<body class="text-center bg-light">
<div class="container">
    <h1>Каталог товаров</h1>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('products.index') }}">
                <div class="row">
                    <div class="col-md-6">
                        <label for="vendor" class="form-label">Фильтр по производителю:</label>
                        <select name="vendor" id="vendor" class="form-select" onchange="this.form.submit()">
                            <option value="">Все производители</option>
                            @foreach($vendors as $v)
                                <option
                                    value="{{ $v->vendor }}" {{ request('vendor') == $v->vendor ? 'selected' : '' }}>
                                    {{ $v->vendor }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Сбросить фильтры</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th>Производитель</th>
                        <th>Категория</th>
                        <th>Цена</th>
                        <th>Оптовая цена</th>
                        <th>Артикул</th>
                        <th>Цвет</th>
                        <th>Статусы</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>
                                <a href="{{ $product->url }}" target="_blank">{{ $product->name }}</a>
                                @if($product->picture)
                                    <br><small><a href="{{ $product->picture }}" target="_blank">Изображение</a></small>
                                @endif
                            </td>
                            <td>{{ $product->vendor }}</td>
                            <td>{{ $product->category->name ?? 'Нет категории' }}</td>
                            <td>{{ number_format($product->price, 2) }}</td>
                            <td>{{ number_format($product->opt_price, 2) }}</td>
                            <td>{{ $product->articul }}</td>
                            <td>{{ $product->extrop->season ?? 'Не указан' }}</td>
                            <td>
                                @if($product->status_new)
                                    <span class="badge bg-success">Новый</span>
                                @endif
                                @if($product->status_action)
                                    <span class="badge bg-danger">Акция</span>
                                @endif
                                @if($product->status_top)
                                    <span class="badge bg-warning">Топ</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Товары не найдены</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
</body>
</html>
