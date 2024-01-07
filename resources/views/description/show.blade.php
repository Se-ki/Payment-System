<form action="{{ route('description.update', $description->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="form-floating mb-3">
        <input type="text" name="name" value="{{ $description->name }}" class="form-control" id="floatingDescription"
            placeholder="" required>
        <label for="floatingDescription">Description</label>
    </div>
    <div class="form-floating">
        <select name="status" class="form-select" id="floatingSelect" aria-label="Floating label select example">
            <option value="1" {{ $description->status === 1 ? 'selected' : null }}>
                Active
            </option>
            <option value="0" {{ $description->status === 0 ? 'selected' : null }}>
                Inactive
            </option>
        </select>
        <label for="floatingSelect">Status</label>
    </div>
    <div class="modal-footer">
        <div class="table-group-divider"></div>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
    </div>
</form>
