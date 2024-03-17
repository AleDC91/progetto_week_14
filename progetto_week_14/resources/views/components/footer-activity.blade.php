<div class="flex justify-end gap-3">

    <div>
        <i class="fa-regular fa-pen-to-square"></i>
        <a href="/activities/{{$activity->id}}/edit">edit</a>
    </div>
    <div>
        <form action="{{ route('activities.destroy', ['activity' => $activity]) }}" method="post">            @csrf
            @method('delete')
            <button type="submit">
            <i class="fa-regular fa-trash-can"></i> 
            delete   
            </button>

        </form>
    </div>

</div>
