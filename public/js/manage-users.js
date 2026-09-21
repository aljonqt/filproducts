
/* ================= CREATE MODAL ================= */

const openModalBtn = document.getElementById(
    'openCreateUserModal'
);

const closeModalBtn = document.getElementById(
    'closeCreateUserModal'
);

const createUserModal = document.getElementById(
    'createUserModal'
);

openModalBtn.addEventListener('click', () => {

    createUserModal.classList.add('show-modal');

});

closeModalBtn.addEventListener('click', () => {

    createUserModal.classList.remove('show-modal');

});


/* ================= EDIT MODAL ================= */

const editUserModal = document.getElementById(
    'editUserModal'
);

const closeEditUserModal = document.getElementById(
    'closeEditUserModal'
);

const editUsername = document.getElementById(
    'editUsername'
);

const editRole = document.getElementById(
    'editRole'
);

const editStatus = document.getElementById(
    'editStatus'
);

const editUserForm = document.getElementById(
    'editUserForm'
);


document.querySelectorAll('.editUserBtn').forEach(button => {

    button.addEventListener('click', () => {

        editUsername.value = button.dataset.username;

        editRole.value = button.dataset.role;

        editStatus.value = button.dataset.status;

        editUserForm.action = button.dataset.url;

        editUserModal.classList.add('show-modal');

    });

});


closeEditUserModal.addEventListener('click', () => {

    editUserModal.classList.remove('show-modal');

});


/* ================= DELETE MODAL ================= */

const deleteUserModal = document.getElementById(
    'deleteUserModal'
);

const cancelDeleteBtn = document.getElementById(
    'cancelDeleteBtn'
);

const deleteUserForm = document.getElementById(
    'deleteUserForm'
);


document.querySelectorAll('.deleteUserBtn').forEach(button => {

    button.addEventListener('click', () => {

        deleteUserForm.action = button.dataset.url;

        deleteUserModal.classList.add('show-modal');

    });

});


cancelDeleteBtn.addEventListener('click', () => {

    deleteUserModal.classList.remove('show-modal');

});


/* ================= CLOSE OUTSIDE ================= */

window.addEventListener('click', (e) => {

    if(e.target === createUserModal){

        createUserModal.classList.remove('show-modal');

    }

    if(e.target === editUserModal){

        editUserModal.classList.remove('show-modal');

    }

    if(e.target === deleteUserModal){

        deleteUserModal.classList.remove('show-modal');

    }

});
