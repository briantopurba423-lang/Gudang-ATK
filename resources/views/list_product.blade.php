@extends('layout.list')

@section('title', 'Ini adalah judul pada meta')

@section('content')

<table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse; background:white;">
    <thead style="background:#1e73d8; color:white;">
        <tr>
            <th>ID</th>
            <th>Produk</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $post)
        <tr>
            <td>{{ $post['id'] }}</td>
            <td>{{ $post['produk'] }}</td>
            {{-- Data lainnya --}}
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
