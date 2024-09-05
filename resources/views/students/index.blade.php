@extends('students.layout')
@section('content')

<div class="container mt-5">
    <div class="container mt-5">
      
    <div class="card">
        <div class="card-body" id="main">
            <h1 class="display-one mt-5 text-center">PHP Laravel Project - CRUD</h1>
            <p class="text-center">Welcome to the PHP Laravel project demo for beginners</p>
            <br>
            <div class="text-center">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                    Add New
                </button>
                
            </div>
            <br><br>
            
            <!--Create Modal -->
           <div class="modal fade @if($errors->any()) show @endif" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" @if($errors->any()) style="display: block;" @endif>
               <div class="modal-dialog" role="document">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel"><b>Add New Student</b></h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                           </button>
                       </div>
                       <div class="modal-body">
                           @if ($errors->any())
                               <div class="alert alert-danger">
                                   <ul>
                                       @foreach ($errors->all() as $error)
                                           <li>{{ $error }}</li>
                                       @endforeach
                                   </ul>
                               </div>
                           @endif   
                           <form action="{{ url('student') }}" method="post">
                               @csrf
                               <div class="form-group">
                                   <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Full Name" value="{{ old('name') }}">
                                   <p id="nam" style="text-align: left"></p>
                                   @error('name')
                                       <div class="invalid-feedback">{{ $message }}</div>
                                   @enderror
                                   <br>
                                   <input type="text" class="form-control @error('adress') is-invalid @enderror" id="adress" name="adress" placeholder="Address" value="{{ old('adress') }}">
                                   <p id="adr" style="text-align: left"></p>
                                   @error('adress')
                                       <div class="invalid-feedback">{{ $message }}</div>
                                   @enderror
                                   <br>
                                   <input type="number" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" placeholder="Mobile Number" value="{{ old('mobile') }}">
                                   <p id="num"  style="text-align: left"></p>
                                   @error('mobile')
                                       <div class="invalid-feedback">{{ $message }}</div>
                                   @enderror
                                   <br>
                               </div>
                               <div class="modal-footer">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                   <button type="submit" class="btn btn-primary">Save</button>
                               </div>
                           </form>
                       </div>
                   </div>
               </div>
           </div>
           <!--End of Create Modal -->
            <!-- Table View  -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col"  style="text-align: center">#</th>
                            <th scope="col" style="text-align: center">Name</th>
                            <th scope="col" style="text-align: center">Address</th>
                            <th scope="col" style="text-align: center">Mobile Number</th>
                            <th scope="col" style="text-align: center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $item)
                        <tr>
                            
                                <td>{{ $item -> id }}</td>
                                <td>{{ $item -> name }}</td>
                                <td>{{ $item -> adress }}</td>
                                <td>{{ $item -> mobile }}</td>
                            
                                <td>
                                    <!-- View Button -->
                                   <button type="button" class="btn btn-info" data-toggle="modal" data-target="#viewModal-{{ $item->id }}"><i class="fa fa-eye" aria-hidden="true"></i> View </button>

                                     <!-- Edit Button -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal-{{ $item->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>

                                    <!-- Delete Button -->
                                    <form action="{{ url('student/' . $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Confirm Delete?')">
                                            <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                        </button>
                                    </form>
                                </td>
                        </tr>
                        <!-- Table View  -->
                        <!-- View Modal -->
                        <div class="modal fade" id="viewModal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel-{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel-{{ $item->id }}"><b>View Student</b></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5 class="card-title">Name: {{ $item->name }}</h5>
                                        <p class="card-text">Address: {{ $item->adress }}</p>
                                        <p class="card-text">Mobile: {{ $item->mobile }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of View Modal -->

                        <!-- Edit Modal -->
                       @foreach ($students as $item)
                       <div class="modal fade" id="editModal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-{{ $item->id }}" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <h5 class="modal-title" id="editModalLabel-{{ $item->id }}"><b>Edit Student</b></h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                       </button>
                                   </div>
                                   <div class="modal-body">
                                       @if ($errors->has('edit_' . $item->id))
                                           <div class="alert alert-danger">
                                               <ul>
                                                   @foreach ($errors->all() as $error)
                                                       <li>{{ $error }}</li>
                                                   @endforeach
                                               </ul>
                                           </div>
                                       @endif
                                       <form action="{{ url('student/' . $item->id) }}" method="post" id="editModal-{{ $item->id }}">
                                           @csrf
                                           @method('PATCH')
                                           <div class="form-group">
                                               <input type="text" class="form-control @error('name') is-invalid @enderror" id="name-{{ $item->id }}" name="name" value="{{ old('name', $item->name) }}">
                                               <p id="edit-nam-{{ $item->id }}"  style="text-align: left"></p>
                                               @error('name')
                                                   <div class="invalid-feedback">{{ $message }}</div>
                                               @enderror
                                               <br>
                                               <input type="text" class="form-control @error('adress') is-invalid @enderror" id="adress-{{ $item->id }}" name="adress" value="{{ old('adress', $item->adress) }}">
                                               <p id="edit-adr-{{ $item->id }}" style="text-align: left"></p>
                                               @error('adress')
                                                   <div class="invalid-feedback">{{ $message }}</div>
                                               @enderror
                                               <br>
                                               <input type="number" class="form-control @error('mobile') is-invalid @enderror" id="mobile-{{ $item->id }}" name="mobile" value="{{ old('mobile', $item->mobile) }}">
                                               <p id="edit-num-{{ $item->id }}"  style="text-align: left"></p>
                                               @error('mobile')
                                                   <div class="invalid-feedback">{{ $message }}</div>
                                               @enderror
                                               <br>
                                           </div>
                                           <div class="modal-footer">
                                               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                               <button type="submit" class="btn btn-primary">Update</button>
                                           </div>
                                       </form>
                                   </div>
                               </div>
                           </div>
                       </div>
                       @endforeach
                       <!-- End of Edit Modal -->
                      @endforeach    
                    </tbody>
                </table>
                <!-- End of Table View -->
            </div>
        </div>
    </div>
</div>
<script>
    // Check if there are validation errors and keep the modal open
    @if ($errors->any())
        $(document).ready(function () {
            // Open the appropriate modals if there are validation errors
            @foreach ($students as $item)
                @if ($errors->has('edit_' . $item->id))
                    $('#editModal-{{ $item->id }}').modal('show');
                @endif
            @endforeach
        });
    @endif

    function validateForm(event) {
        var isValid = true;

        // Get form elements
        var name = document.getElementById('name').value.trim();
        var address = document.getElementById('adress').value.trim();
        var mobile = document.getElementById('mobile').value.trim();

        // Reset previous error messages
        document.getElementById('nam').innerText = ''; 
        document.getElementById('adr').innerText = ''; 
        document.getElementById('num').innerText = ''; 

        document.getElementById('name').classList.remove('is-invalid'); 
        document.getElementById('adress').classList.remove('is-invalid'); 
        document.getElementById('mobile').classList.remove('is-invalid'); 

        var msg;

        // Validate each field
        if (name === "") {
            document.getElementById('nam').style.color="red";
            msg = 'Full Name is required.';
            document.getElementById('nam').innerText = msg;
            document.getElementById('name').classList.add('is-invalid');
            isValid = false;
        }

        if (address === "") {
            document.getElementById('adr').style.color="red";
            msg = 'Address is required.';
            document.getElementById('adr').innerText = msg;
            document.getElementById('adress').classList.add('is-invalid');
            isValid = false;
        }

        if (mobile === "" || mobile.length < 10 || mobile.length > 15) {
            document.getElementById('num').style.color="red";
            msg = 'Mobile Number must be between 10 and 15 digits.';
            document.getElementById('num').innerText = msg;
            document.getElementById('mobile').classList.add('is-invalid');
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault(); 
        }
    }

    // Attach event listeners to the forms
    document.querySelectorAll('#exampleModal form').forEach(form => {
        form.addEventListener('submit', validateForm);
    });

    @foreach ($students as $item)
        document.querySelector(`#editModal-{{ $item->id }} form`).addEventListener('submit', function(event) {
            var isValid = true;
            var name = document.getElementById('name-{{ $item->id }}').value.trim();
            var address = document.getElementById('adress-{{ $item->id }}').value.trim();
            var mobile = document.getElementById('mobile-{{ $item->id }}').value.trim();

            // Reset previous error messages
            document.getElementById('edit-nam-{{ $item->id }}').innerText = '';
            document.getElementById('edit-adr-{{ $item->id }}').innerText = '';
            document.getElementById('edit-num-{{ $item->id }}').innerText = '';
            document.getElementById('name-{{ $item->id }}').classList.remove('is-invalid');
            document.getElementById('adress-{{ $item->id }}').classList.remove('is-invalid');
            document.getElementById('mobile-{{ $item->id }}').classList.remove('is-invalid');

            if (name === "") {
                document.getElementById('edit-nam-{{ $item->id }}').style.color="red";
                document.getElementById('edit-nam-{{ $item->id }}').innerText = 'Full Name is required.';
                document.getElementById('name-{{ $item->id }}').classList.add('is-invalid');
                isValid = false;
            }

            if (address === "") {
                document.getElementById('edit-adr-{{ $item->id }}').style.color="red";
                document.getElementById('edit-adr-{{ $item->id }}').innerText = 'Address is required.';
                document.getElementById('adress-{{ $item->id }}').classList.add('is-invalid');
                isValid = false;
            }

            if (mobile === "" || mobile.length < 10 || mobile.length > 15) {
                document.getElementById('edit-num-{{ $item->id }}').style.color="red";
                document.getElementById('edit-num-{{ $item->id }}').innerText = 'Mobile Number must be between 10 and 15 digits.';
                document.getElementById('mobile-{{ $item->id }}').classList.add('is-invalid');
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault();
            }
        });
    @endforeach
</script>


@stop

