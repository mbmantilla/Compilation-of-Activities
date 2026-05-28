<form method="POST" action="{{ $action }}">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <label>Service Name</label>
    <input type="text" name="name" value="{{ old('name', $service->name ?? '') }}" required>

    <label>Description</label>
    <textarea name="description" rows="5" required>{{ old('description', $service->description ?? '') }}</textarea>

    <label>Price</label>
    <input type="number" step="0.01" name="price" value="{{ old('price', $service->price ?? '') }}" required>

    <label>Inclusions</label>
    <textarea name="inclusions" rows="5">{{ old('inclusions', $service->inclusions ?? '') }}</textarea>

    <label>Availability Status</label>
    <select name="availability_status" required>
        @php $selected = old('availability_status', $service->availability_status ?? 'available'); @endphp
        <option value="available" @selected($selected === 'available')>Available</option>
        <option value="unavailable" @selected($selected === 'unavailable')>Unavailable</option>
    </select>

    <label>Image Path / URL (optional)</label>
    <input type="text" name="image" value="{{ old('image', $service->image ?? '') }}">

    <br><br>
    <button class="btn" type="submit">Save Service</button>
</form>
