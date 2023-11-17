
    // Add an event listener to handle company selection
    
    document.querySelectorAll('.dropdown-item').forEach(function(item) {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            var companyId = e.target.getAttribute('data-company-id');
            document.querySelector('#company_id').value = companyId;
            document.querySelector('.btn-secondary').textContent = e.target.textContent;
        });
    });

// _________________________________________________________________________Nav link

 const currentUrl = window.location.href;

 // Get all navigation links
 const navLinks = document.querySelectorAll('.nav-link');

 navLinks.forEach(link => {
     if (link.href === currentUrl) {
         link.classList.add('active');
     }
 });


