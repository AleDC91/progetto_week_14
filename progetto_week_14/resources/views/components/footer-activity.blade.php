<div class="flex justify-end gap-3">

    <div class="py-2 px-4 bg-blue-300 hover:bg-blue-500 rounded-lg">
        <a href={{ route('activities.edit', ['activity' => $activity]) }}>
            <i class="fa-regular fa-pen-to-square"></i>
            edit</a>
    </div>
    <div class="py-2 px-4 bg-red-300 hover:bg-red-500 rounded-lg">
        <form action="{{ route('activities.destroy', ['activity' => $activity]) }}" method="post">

            @csrf
            @method('delete')
            <button type="submit"
            onclick="return confirmDelete()">
                
                <i class="fa-regular fa-trash-can"></i>
                delete
            </button>

        </form>
    </div>

</div>
<script>
    function confirmDelete() {
        // Display a confirmation dialog
        return confirm("Are you sure you want to delete this activity?");
    }
</script>