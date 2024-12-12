<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div>
                <h2 class="mb-2 text-2xl font-bold">Users</h2>
                <table class="table-responsive" >
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Course</th>
                            <th>Year</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->student->address }}</td>
                                <td>{{ $user->student->course }}</td>
                                <td>{{ $user->student->year }}</td>
                                <td class="space-y-1">
                                    <a class="primary-button"
                                        href="{{ route('student.show', [$user->student]) }}">Show</a>
                                    @can('update', App\Models\User::class)
                                        <a class="info-button" href="{{ route('student.edit', [$user->student]) }}">Edit</a>
                                        <form action="{{ route('student.destroy', [$user->student]) }}"
                                            class="danger-button" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button>Delete</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="py-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
