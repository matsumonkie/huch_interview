<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Users</title>
</head>
<body>
    <h2>Search Users by Email</h2>
    <form method="POST" action="{{ route('search-users') }}">
        @csrf
        <div>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
        </div>
        <div>
            <button type="submit">Search</button>
        </div>
    </form>

    @if (isset($users))
        <h3>Search Results</h3>
        @if ($users->isEmpty())
            <p>No users found with the given email.</p>
        @else
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <p>Query Duration: {{ $queryDuration }} seconds</p>
    @endif
</body>
</html>
