const createProjectButton = $('#createProjectButton');
const createProjectForm = $('#createProjectForm');

// Handle form submission logic (replace with your AJAX implementation)
createProjectForm.addEventListener('submit', (event) => {
  event.preventDefault();
  
  $('#createProjectModal').modal('hide'); // Hide modal on successful submission (optional)
});

// Handle modal show/hide events (optional)
createProjectButton.addEventListener('click', () => {
  // Reset form fields on modal show (optional)
  createProjectForm.show();
});