<x-app-layout>
    <main>
        <x-admin-projects-table :projects="$projects"/>
        <x-admin-users-table :users="$users" />
        <x-admin-stats-table :users="$users" :projects="$projects" />


    </main>
</x-app-layout>
