const materialModal = document.getElementById('materialModal');

const openMaterialModal = document.getElementById('openMaterialModal');

const closeMaterialModal = document.getElementById('closeMaterialModal');


openMaterialModal.addEventListener('click', () => {

    materialModal.classList.add('show-modal');

});


closeMaterialModal.addEventListener('click', () => {

    materialModal.classList.remove('show-modal');

});


/* ================= EDIT ================= */

const editMaterialModal = document.getElementById('editMaterialModal');

const closeEditMaterialModal = document.getElementById('closeEditMaterialModal');

const editMaterialForm = document.getElementById('editMaterialForm');

const editName = document.getElementById('editName');

const editSerial = document.getElementById('editSerial');

const editMac = document.getElementById('editMac');

const editStock = document.getElementById('editStock');

const editUnit = document.getElementById('editUnit');


document.querySelectorAll('.editMaterialBtn').forEach(button => {

    button.addEventListener('click', () => {

        const materialId = button.dataset.id;

        editName.value = button.dataset.name;

        editSerial.value = button.dataset.serial;

        editMac.value = button.dataset.mac;

        editStock.value = button.dataset.stock;

        editUnit.value = button.dataset.unit;

        editMaterialForm.action = `/materials/${materialId}`;

        editMaterialModal.classList.add('show-modal');

    });

});


closeEditMaterialModal.addEventListener('click', () => {

    editMaterialModal.classList.remove('show-modal');

});


/* ================= DELETE ================= */

const deleteMaterialModal = document.getElementById('deleteMaterialModal');

const cancelDeleteMaterialBtn = document.getElementById('cancelDeleteMaterialBtn');

const deleteMaterialForm = document.getElementById('deleteMaterialForm');


document.querySelectorAll('.deleteMaterialBtn').forEach(button => {

    button.addEventListener('click', () => {

        const materialId = button.dataset.id;

        deleteMaterialForm.action = `/materials/${materialId}`;

        deleteMaterialModal.classList.add('show-modal');

    });

});


cancelDeleteMaterialBtn.addEventListener('click', () => {

    deleteMaterialModal.classList.remove('show-modal');

});


/* ================= CLOSE OUTSIDE ================= */

window.addEventListener('click', (e) => {

    if(
        e.target.classList.contains('material-modal') ||
        e.target.classList.contains('material-overlay')
    ){

        materialModal.classList.remove('show-modal');

        editMaterialModal.classList.remove('show-modal');

        deleteMaterialModal.classList.remove('show-modal');

        assignMaterialModal.classList.remove('show-modal');

        transactionHistoryModal.classList.remove('show-modal'); 

    }

});

/* ================= ASSIGN MODAL ================= */

const assignMaterialModal = document.getElementById('assignMaterialModal');

const openAssignMaterialModal = document.getElementById('openAssignMaterialModal');

const closeAssignMaterialModal = document.getElementById('closeAssignMaterialModal');


openAssignMaterialModal.addEventListener('click', () => {

    assignMaterialModal.classList.add('show-modal');

});


closeAssignMaterialModal.addEventListener('click', () => {

    assignMaterialModal.classList.remove('show-modal');

});


/* ================= HISTORY MODAL ================= */

const transactionHistoryModal = document.getElementById('transactionHistoryModal');

const openTransactionHistoryModal = document.getElementById('openTransactionHistoryModal');

const closeTransactionHistoryModal = document.getElementById('closeTransactionHistoryModal');


openTransactionHistoryModal.addEventListener('click', () => {

    transactionHistoryModal.classList.add('show-modal');

});


closeTransactionHistoryModal.addEventListener('click', () => {

    transactionHistoryModal.classList.remove('show-modal');

});

const shouldOpenHistoryModal = (
    request()-has('from_date') ||
    request()-has('to_date') ||
    request()-has('sort')
); 

window.addEventListener('load', () => {

    if(shouldOpenHistoryModal){

        transactionHistoryModal.classList.add('show-modal');

    }

});