<x-app-layout>   
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900"> 
                    <div class="card">  
                        <div class="container">
                            <div class="row mb-3 mt-3">
                            <h3><b>Update Answer</b></h3>
                            </div>
                            <div class="row">
                                <div class="col-md-12 ">
                                @if (session('success'))
                                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                                @endif
                                @if($errors->any())
                                    <div class="alert alert-danger mt-3">
                                    {{ implode('', $errors->all(':message')) }}
                                    </div>
                                @endif
                                </div> 
                                <form method="POST" action="{{ route('scores.update', isset($interviews_answers_id) ? $interviews_answers_id : 0) }}" enctype="multipart/form-data">

                                    @csrf
                                    @method('PUT')
                                     <div class="col-md-12 form-group mt-3 mb-3">
                                        <label for="title">Candidate: {{isset($interview) ?  $interview->name : ''}}</label>  
                                    </div>
                                    <div class="col-md-12 form-group mt-3 mb-3">
                                        <label for="title">Title: {{isset($interview) ?  $interview->title : ''}}</label>  
                                    </div>
                                    <div class="col-md-12 form-group mt-3 mb-3">
                                        <label for="description">Description: {{isset($interview) ?  $interview->description : '' }}</label>
                                    </div>
                                    <div class="col-md-12 form-group mt-3 mb-3">
                                        <label for="title">Question:{{isset($interview) ?  $interview->questions : ''}}</label>
                                    </div> 
                                    <div class="col-md-12 form-group mt-3 mb-3">
                                        @if(isset($interview->answer_audio_file)) 
                                            <label for="image">Uploaded Answer:  </label>
                                           <audio controls>
                                                <source src="{{ asset('storage/' . $interview->answer_audio_file) }}" type="audio/mpeg">
                                                <!-- Fallback for browsers that don't support the audio element -->
                                                Your browser does not support the audio element.
                                            </audio> 
                                        @endif
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="title">Scores (/10)</label>
                                        <input type="text" name="score" id="score" value="{{isset($interview) ?  $interview->score : ''}}" class="form-control" required>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="title">Comment</label>
                                        <textarea type="text" name="comment" id="comment" class="form-control" required>{{isset($interview) ?  $interview->comment : ''}}</textarea>
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

