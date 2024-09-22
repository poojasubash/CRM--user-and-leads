<div class="modal fade" id="createSourceModal" tabindex="-1" aria-labelledby="createSourceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createSourceModalLabel">Create New Source</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createSourceForm" action="{{ route('masters.source.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="sourceName" class="form-label fw-bold">Name</label>
                        <input type="text" class="form-control border-dark" id="sourceName" name="name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editSourceModal" tabindex="-1" aria-labelledby="editSourceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSourceModalLabel">Edit Source</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editSourceForm" action="{{ route('masters.source.update', 'source_id') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editSourceId" name="id">
                    <div class="mb-3">
                        <label for="editSourceName" class="form-label fw-bold">Name</label>
                        <input type="text" class="form-control border-dark" id="editSourceName" name="name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteSourceModal" tabindex="-1" aria-labelledby="deleteSourceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSourceModalLabel">Delete Source</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fw-bold">
                <p>Are you sure you want to delete this source?</p>
                <form id="deleteSourceForm" action="{{ route('masters.source.destroy', 'source_id') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="deleteSourceId" name="id">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
     document.addEventListener('DOMContentLoaded', function () {
        // Edit button functionality
        const editButtons = document.querySelectorAll('.edit-btn');
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                console.log("test");

                const sourceId = this.getAttribute('data-id');
                const sourceName = this.getAttribute('data-name');

                document.getElementById('editSourceId').value = sourceId;
                document.getElementById('editSourceName').value = sourceName;

                let editForm = document.getElementById('editSourceForm');
                console.log(editForm);

                editForm.action = editForm.action.replace('source_id', sourceId);
            });
        });

        // Delete button functionality
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const sourceId = this.getAttribute('data-id');
                document.getElementById('deleteSourceId').value = sourceId;

                let deleteForm = document.getElementById('deleteSourceForm');
                deleteForm.action = deleteForm.action.replace('source_id', sourceId);
            });
        });
     });
    </script>
@endpush
