<x-app-layout>   
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900"> 
                    <div class="card"> 
                        <div class="container"> 
                            <div class="col-md-12">
                                <a href="{{ route('interviews.create') }}" class="btn btn-primary mb-3  mt-3">Create Interviews</a>
                            </div>
                            
                            <div class="col-md-12">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            
                            @if ($interviews->count())
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Question</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($interviews as $interview)
                                        <tr>
                                            <td>{{ $interview->title }}</td>
                                            <td>{{ $interview->description }}</td>
                                            <td>{{ $interview->questions }}</td>
                                            <td>
                                                <a href="{{ route('interviews.edit', $interview->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('interviews.destroy', $interview->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>No interviews available.</p>
                            @endif

                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
