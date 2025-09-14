<x-app-layout>   
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900"> 
                    <div class="card"> 
                        <div class="container">  
                            
                            <div class="col-md-12 mt-3">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if (session('danger'))
                                <div class="alert alert-danger mt-3">{{ session('danger') }}</div>
                            @endif
                            @if($errors->any())
                                <div class="alert alert-danger">
                                {{ implode('', $errors->all(':message')) }}
                                </div>
                            @endif

                            @if ($interviews->count())
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Question</th>
                                            <th>Scores</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($interviews as $interview)
                                        <tr>
                                            <td>{{ $interview->name }}</td>
                                            <td>{{ $interview->title }}</td>
                                            <td>{{ $interview->description }}</td>
                                            <td>{{ $interview->questions }}</td>
                                            <td>{{ $interview->score }}</td>
                                            <td>
                                                <a href="{{ route('scores.edit', $interview->interviews_answers_id) }}" class="btn btn-warning btn-sm">Update Scores</a> 
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
