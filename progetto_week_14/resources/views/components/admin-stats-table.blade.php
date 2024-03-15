<div class="admin-projects-table m-10 p-8 bg-slate-200">
    <div class=" flex flex-col md:flex-row  items-center justify-between pb-6">
        <div class="flex">
            <span class="text-4xl pb-4 mb-2">Statistics</span>
        </div>
    </div>
    <x-activity-users-ratio-graph :users="$users" :projects="$projects"/>
</div>
