<div class="modal fade" id="createGroupModal" tabindex="-1" aria-labelledby="createGroupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createGroupModalLabel">Create New Groups</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createGroupForm" action="{{ route('masters.groups.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="groupName" class="form-label fw-bold">Name</label>
                        <input type="text" class="form-control border-dark" id="groupName" name="name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--edit-->
<div class="modal fade" id="editGroupModal" tabindex="-1" aria-labelledby="editGroupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editGroupModalLabel">Edit Group</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editGroupForm" action="{{ route('masters.groups.update', 'group_id') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editGroupId" name="id">
                    <div class="mb-3">
                        <label for="editGroupName" class="form-label fw-bold">Name</label>
                        <input type="text" class="form-control border-dark" id="editGroupName" name="name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--delete-->
<div class="modal fade" id="deleteGroupModal" tabindex="-1" aria-labelledby="deleteGroupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteGroupModalLabel">Delete Group</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fw-bold">
                <p>Are you sure you want to delete this group?</p>
            </div>
            <div class="modal-footer">
                <form id="deleteGroupForm" action="{{ route('masters.groups.destroy', 'group_id') }}" method="POST">
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
    // edit button
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            const groupId = this.getAttribute('data-id');
            const groupName = this.getAttribute('data-name');

            document.getElementById('editGroupId').value = groupId;
            document.getElementById('editGroupName').value = groupName;

            let editForm = document.getElementById('editGroupForm');
            editForm.action = editForm.action.replace('group_id', groupId);
        });
    });

    //delete button
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            const groupId = this.getAttribute('data-id');

            let deleteForm = document.getElementById('deleteGroupForm');
            deleteForm.action = deleteForm.action.replace('group_id', groupId);
        });
    });
</script>
@endpush
