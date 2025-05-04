<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ReviewHub</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Icons (Optional) -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>

<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand fw-bold fs-4" href="#">
      <span style="background: linear-gradient(to right, white, #2196f3); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Bazaar</span><span style="color: #f44336;">Bondhu</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNavbar">
      <!-- Left: Category Dropdown -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown">
            Browse Categories
          </a>
          <ul class="dropdown-menu">
            @foreach ($categories as $category)
              <li>
                  <a class="dropdown-item" href="{{ route('dashboard.filter', $category->id) }}">
                      {{ $category->name }}
                  </a>
              </li>
          @endforeach
          </ul>
        </li>
      </ul>

      <!-- Right: Other Links + Logout -->
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="#">Shop</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>

        @auth
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link btn btn-link text-danger" style="text-decoration: none;">
              Logout
            </button>
          </form>
        </li>
        @endauth
      </ul>

      <!-- Search -->
      <form class="d-flex ms-lg-3" role="search">
        <input class="form-control me-2" type="search" placeholder="Search product..." aria-label="Search">
        <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
      </form>
    </div>
  </div>
</nav>

<!-- Product Section -->
<div class="container mt-4">
  <section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3 bg-primary">
      <h4>All Products</h4>
      <a href="{{ route('dashboard') }}" class="btn btn-primary">View All Product</a>
    </div>

    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4 mt-3">
      @forelse ($products as $product)
        <div class="col">
          <div class="card h-100 shadow-sm">
            <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Product Image">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">{{ $product->name }}</h5>
              <p class="text-muted small">{{ Str::limit($product->description, 80) }}</p>
              <div class="mt-auto">
                <p class="fw-bold text-danger mb-1">${{ $product->price }}</p>
                <small class="text-muted">Views: {{ $product->views ?? 0 }}</small><br>
                <small class="text-muted">Category: {{ $product->category->name ?? 'N/A' }}</small><br>
                <small class="text-muted">By: {{ $product->user->name ?? 'Unknown' }}</small>
              </div>
            </div>
            <div class="card-footer bg-white border-top-0 d-flex justify-content-between">
              <button class="btn btn-info">Add To Cart</button>
              <button class="btn btn-warning">View</button>
              <button class="btn btn-primary">Buy Now</button>
            </div>
          </div>
        </div>
      @empty
        <div class="alert alert-info text-center mt-4">
          No products available.
        </div>
      @endforelse
    </div>
  </section>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
