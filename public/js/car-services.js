/* ================= CREATE ================= */

const carServiceModal = document.getElementById(
    'carServiceModal'
);

const openCarServiceModal = document.getElementById(
    'openCarServiceModal'
);

const closeCarServiceModal = document.getElementById(
    'closeCarServiceModal'
);


openCarServiceModal.addEventListener('click', () => {

    carServiceModal.classList.add('show-modal');

});


closeCarServiceModal.addEventListener('click', () => {

    carServiceModal.classList.remove('show-modal');

});


/* ================= EDIT ================= */

const editCarServiceModal = document.getElementById(
    'editCarServiceModal'
);

const closeEditCarServiceModal = document.getElementById(
    'closeEditCarServiceModal'
);

const editCarServiceForm = document.getElementById(
    'editCarServiceForm'
);

const editPlateNumber = document.getElementById(
    'editPlateNumber'
);

const editStatus = document.getElementById(
    'editStatus'
);


document.querySelectorAll('.editCarServiceBtn').forEach(button => {

    button.addEventListener('click', () => {

        editPlateNumber.value = button.dataset.plate;

        editStatus.value = button.dataset.status;

        /* FIXED ROUTE */
        editCarServiceForm.action = button.dataset.url;

        editCarServiceModal.classList.add('show-modal');

    });

});


closeEditCarServiceModal.addEventListener('click', () => {

    editCarServiceModal.classList.remove('show-modal');

});


/* ================= DELETE ================= */

const deleteCarServiceModal = document.getElementById(
    'deleteCarServiceModal'
);

const cancelDeleteCarServiceBtn = document.getElementById(
    'cancelDeleteCarServiceBtn'
);

const deleteCarServiceForm = document.getElementById(
    'deleteCarServiceForm'
);


document.querySelectorAll('.deleteCarServiceBtn').forEach(button => {

    button.addEventListener('click', () => {

        /* FIXED ROUTE */
        deleteCarServiceForm.action = button.dataset.url;

        deleteCarServiceModal.classList.add('show-modal');

    });

});


cancelDeleteCarServiceBtn.addEventListener('click', () => {

    deleteCarServiceModal.classList.remove('show-modal');

});


/* ================= CLOSE OUTSIDE ================= */

window.addEventListener('click', (e) => {

    if(
        e.target === carServiceModal ||
        e.target === editCarServiceModal ||
        e.target === deleteCarServiceModal
    ){

        carServiceModal.classList.remove('show-modal');

        editCarServiceModal.classList.remove('show-modal');

        deleteCarServiceModal.classList.remove('show-modal');

    }

});