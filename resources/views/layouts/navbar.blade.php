<nav class="navbar navbar-expand-lg navbar-light ">
    <div class="container-fluid py-3 px-5">
        <a class="navbar-brand" href="#"><i class="bi bi-luggage"></i> AdventureBooker </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end mt-2" id="navbarNav">
            <ul class="navbar-nav">

                <li class="nav-item d-flex  align-items-center active">
                    <i class="bi bi-building"></i>
                    <a class="nav-link  " aria-current="page" href="">Accommodation</a>
                </li>
                <li class="nav-item d-flex  align-items-center">
                    <i class="bi bi-globe"></i>
                    <a class="nav-link" href="#">Tours</a>
                </li>

                <li class="nav-item d-flex  align-items-center">
                    <i class="bi bi-person-badge"></i>
                    <a class="nav-link " data-bs-toggle="modal" data-bs-target="#registrationModal" href="#">Registration</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <i class="bi bi-box-arrow-in-left"></i>
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content  " id="loginModalContent">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>Login</h4>
                <form>
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" placeholder="Enter your email">
                    </div>
                    <div class="mb-1">
                        <label for="loginPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="Enter your password">
                    </div>
                    <a href="#" id="forget_password">Forget password?</a>

                    <div class="d-flex justify-content-cente mt-1">
                        <button type="submit" id="loginBtn" class="">Login</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content" id="registrationModalContent">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>Registration</h4>
                <form method="POST" id="registrationForm">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="firstName" class="form-label">First name</label>
                            <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Enter your name">
                            <div class="alert alert-danger mt-2 d-none" role="alert">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="lastName" class="form-label">Last name</label>
                            <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Enter your lastname">
                            <div class="alert alert-danger mt-2 d-none" role="alert">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 mb-s3">
                            <label for="loginEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="loginEmail" placeholder="Enter your email">
                            <div class="alert alert-danger mt-2 d-none" role="alert">
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label for="phoneNumber" class="form-label">Phone number</label>
                            <input type="text" class="form-control" name="phoneNum" id="phoneNumber" placeholder="Enter your phone number">
                            <div class="alert alert-danger mt-2 d-none" role="alert">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
                        <div class="alert alert-danger mt-2 d-none" role="alert">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm password</label>
                        <input type="password" class="form-control" name="oassword_confirmation" id="confirmPassword" placeholder="Confirm your password">
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" id="registerBtn" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('registrationForm').addEventListener('submit', async function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        try {
            const response = await fetch('/register', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'

                }
            });
            if (response.ok) {
                

            } else if (response.status === 422) {
                const errorsData = await response.json();
                const errors = errorsData.errors;
                clearErrors();
                for(let field in errors){
                    if(errors.hasOwnProperty(field)){
                        const errorMessages=errors[field];
                        showAlert(field,errorMessages[0]);
                    }
                }

            } else {
                console.error('Registration failed:', response.statusText);
            }

        } catch (error) {
        }
        function clearErrors() {
            const alertElements = document.querySelectorAll('.alert-danger');
            alertElements.forEach(
                alert => {
                    alert.classList.add('d-none');
                    alert.textContent='';
                }
            );
        }
        function showAlert(field,message){
            const alertElement=document.querySelector(`[name="${field}"]`).nextElementSibling;
            alertElement.classList.remove('d-none');
            alertElement.textContent=message;
        }
    });
</script>