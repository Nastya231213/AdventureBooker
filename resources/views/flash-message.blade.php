@if(session()->has('successMessage'))
<div class="message show">
    <span class="fas fa-check-circle"></span>
    <span class="text">{{ session('successMessage') }}</span>

    <span class="close-btn"><span class="fas fa-times"></span></span>
</div>
@endif