@if($errors->any())
   <div class="alert alert-danger alert-dismissible fade show">
      @foreach($errors->all() as $error)
        <p class="mb-0">{{ $error }}</p>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>   
      @endforeach
   </div>
@endif