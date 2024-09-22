<div class="modal fade" id="createTagsModal" tabindex="-1" aria-labelledby="createTagsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTagsModalLabel">Create New Tags</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createTagForm" action="{{ route('masters.tags.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="tagsDescription" class="form-label fw-bold">Description</label>
                        <input type="text" class="form-control border-dark" id="tagsDescription" name="description" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--edit-->

<div class="modal fade" id="editTagsModal" tabindex="-1" aria-labelledby="editTagsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTagsModalLabel">Edit Tags</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editTagsForm" action="{{ route('masters.tags.update', 'tags_id') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editTagsId" name="id">
                    <div class="mb-3">
                        <label for="editTagsName" class="form-label fw-bold">Description</label>
                        <input type="text" class="form-control border-dark" id="editTagsName" name="description" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--delete-->
<div class="modal fade" id="deleteTagsModal" tabindex="-1" aria-labelledby="deleteTagsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTagsModalLabel">Delete Tag</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fw-bold">
                <p>Are you sure you want to delete this tag?</p>
            </div>
            <div class="modal-footer">
                <form id="deleteTagForm" action="{{ route('masters.tags.destroy', 'tags_id') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function () {
        const tagId = this.getAttribute('data-id');
        const tagDescription = this.getAttribute('data-description');

        document.getElementById('editTagsId').value = tagId;
        document.getElementById('editTagsName').value = tagDescription;

        let editForm = document.getElementById('editTagsForm');
        editForm.action = editForm.action.replace('tags_id', tagId);
        });
    });
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            const tagId = this.getAttribute('data-id');

            let deleteForm = document.getElementById('deleteTagForm');
            deleteForm.action = deleteForm.action.replace('tags_id', tagId);
        });
    });
</script>
@endpush
