<div id="successMessage" class="message success hide">
    <span class="fas fa-check-circle"></span>
    <span class="text"></span>
    <span class="close-btn"><span class="fas fa-times"></span></span>
</div>

<div id="errorMessage" class="message error hide">
    <span class="fas fa-exclamation-circle"></span>
    <span class="text"></span>
    <span class="close-btn"><span class="fas fa-times"></span></span>
</div>
<script>
    document.querySelectorAll('.message .close-btn').forEach(function(closeBtn) {
        closeBtn.addEventListener('click', function() {
            const messageBox=closeBtn.closest('.message');
            messageBox.classList.add('hide');
        });
    });
</script>