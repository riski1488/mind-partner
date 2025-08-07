<form action="{{ route('admin.users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}" required>
    </div>
    <div>
        <button type="submit">Simpan</button>
    </div>
</form>