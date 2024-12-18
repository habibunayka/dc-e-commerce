@extends('layouts.app')

@section('title', 'Produk - DC E-Commerce')

@section('content')

<div class="flex justify-between items-center mb-6">
    <div class="flex space-x-4">
        <form method="GET" action="{{ route('home') }}">
            <select name="category" class="border rounded-md px-3 py-2" onchange="this.form.submit()">
                <option value="">Kategori Produk</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </form>
        <select class="border rounded-md px-3 py-2">
            <option>Urutan</option>
            <option value="price_asc">Harga Termurah</option>
            <option value="price_desc">Harga Termahal</option>
        </select>
    </div>
    <form method="GET" action="{{ route('home') }}" class="flex">
        <input type="text" name="search" placeholder="Cari produk" value="{{ request('search') }}"
            class="border rounded-l-md px-4 py-2 w-64">
        <button class="bg-blue-600 text-white px-4 rounded-r-md hover:bg-blue-700">Cari</button>
    </form>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-6">
    @foreach ($products as $product)
        <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
            <img src="{{ $product->photos->first() ? asset('storage/' . $product->photos->first()->path) : 'https://via.placeholder.com/300' }}"
                 alt="{{ $product->name }}" class="rounded-t-lg w-full h-48 object-cover">
            <div class="p-4">
                <h2 class="text-lg font-bold mb-2">{{ $product->name }}</h2>
                <p class="text-red-600 font-semibold mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <div class="text-yellow-400 mb-2">
                    ⭐⭐⭐⭐⭐ <span class="text-gray-500">(42 reviews)</span>
                </div>
                <button class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">
                    Tambah ke Keranjang
                </button>
            </div>
        </div>
    @endforeach
</div>

@endsection
