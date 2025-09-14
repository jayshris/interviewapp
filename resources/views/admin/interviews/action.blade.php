<x-app-layout>   
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900"> 
                    <div class="card">  
                        <div class="container">
                            <div class="row mb-3 mt-3">
                            <h3><b>{{isset($interview) ?  'Edit' : 'Create'}} Interview</b></h3>
                            </div>
                            <div class="row">
                                <form action="{{ route('interviews.store') }}" method="POST">
                                    @csrf
                                    <div class="col-md-12 form-group">
                                        <label for="title">Title</label>  
                                        <input type="text" name="title" id="title" value="{{isset($interview) ?  $interview->title : ''}}" class="form-control" required>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control" required>{{isset($interview) ?  $interview->description : '' }}</textarea>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="title">Question</label>
                                        <input type="text" name="questions" id="questions" value="{{isset($interview) ?  $interview->questions : ''}}" class="form-control" required>
                                    </div>
                                    <div class="col-md-12 mt-3 mb-3">
                                    <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

