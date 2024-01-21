@extends('layouts.app')

@section('content')

<body>
    <h1>Strona Administracyjna</h1>
    <h2>Lista Użytkowników</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status Blokady</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if ($user->isBlocked())
                    Zablokowany
                    @else
                    Niezablokowany
                    @endif
                </td>
                <td>
                    @if ($user->isBlocked())
                    <form method="post" action="{{ route('admin.users.unblock', $user) }}">
                        @csrf
                        <button type="submit">Odblokuj</button>
                    </form>
                    @else
                    <form method="post" action="{{ route('admin.users.block', $user) }}">
                        @csrf
                        <button type="submit">Zablokuj</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
@endsection