import {
    initSignaturePad,
    initSignatureModal
} from '../components/signature';

import {
    initModals
} from '../components/modal';

import {
    initMap,
    getUserLocation
} from '../components/map';

import {
    initUploads
} from '../components/upload';

import {
    initFormValidation
} from '../components/form';


/* =========================================================
   GLOBAL STATE
========================================================= */

let currentStep = 1;
const totalSteps = 8;

let residentialMap = null;


/* =========================================================
   DOM READY
========================================================= */

document.addEventListener('DOMContentLoaded', () => {

    console.log('Residential JS Loaded');


    /* =====================================================
       INITIALIZE COMPONENTS
    ===================================================== */

    try {
        initUploads();
    } catch (error) {
        console.error('initUploads failed:', error);
    }

    try {
        initFormValidation();
    } catch (error) {
        console.error('initFormValidation failed:', error);
    }

    try {
        initSignaturePad();
    } catch (error) {
        console.error('initSignaturePad failed:', error);
    }

    try {
        initSignatureModal();
    } catch (error) {
        console.error('initSignatureModal failed:', error);
    }

    try {
        initModals();
    } catch (error) {
        console.error('initModals failed:', error);
    }


    /* =====================================================
       FORM
    ===================================================== */

    const form = document.getElementById('residentialForm');

    if (!form) {
        console.warn('Residential form not found.');
        return;
    }

    const submitBtn =
    document.getElementById('submitBtn');

    let isSubmitting = false;


    /* =====================================================
       MAP
    ===================================================== */

    try {
        residentialMap = initMap();

        if (residentialMap) {
            console.log('Residential map initialized.');
        } else {
            console.warn('Residential map could not be initialized.');
        }
    } catch (error) {
        console.error('Map initialization failed:', error);
        residentialMap = null;
    }


    /* =====================================================
       GPS BUTTON
    ===================================================== */

    document
        .querySelectorAll('[data-get-location]')
        .forEach((button) => {

            button.addEventListener('click', () => {

                if (!residentialMap) {
                    console.warn('Map is not initialized.');
                    return;
                }

                try {
                    getUserLocation(residentialMap);
                } catch (error) {
                    console.error(
                        'Unable to get user location:',
                        error
                    );
                }

            });

        });


    /* =====================================================
       FORM SUBMIT
    ===================================================== */

    form.addEventListener('submit', async (event) => {

        if (isSubmitting) {
            event.preventDefault();
            return;
        }

        const declaration =
            document.getElementById('declarationCheck');

        const contract =
            document.getElementById('contractCheck');

        const signature =
            document.getElementById('digitalSignatureInput');


        /* ---------------------------------------------
           AGREEMENT VALIDATION
        --------------------------------------------- */

        if (declaration && !declaration.checked) {

            event.preventDefault();

            alert(
                "Please read and agree to the Subscriber's Declaration."
            );

            return;
        }


        if (contract && !contract.checked) {

            event.preventDefault();

            alert(
                'Please agree to the Terms & Contract Agreement.'
            );

            return;
        }


        if (signature && !signature.value) {

            event.preventDefault();

            alert(
                'Please add your digital signature before submitting.'
            );

            return;
        }


        /* ---------------------------------------------
        SUBMIT WITHOUT MAP SCREENSHOT
        --------------------------------------------- */

        event.preventDefault();

        const mapInput =
            document.getElementById('mapImage');

        if (mapInput) {
            mapInput.value = '';
        }


        /* ---------------------------------------------
        SUBMITTING STATE
        --------------------------------------------- */

        isSubmitting = true;

        if (submitBtn) {

            submitBtn.disabled = true;

            submitBtn.innerHTML = `
                <i class="fas fa-spinner fa-spin"></i>
                Submitting...
            `;
        }


        /* ---------------------------------------------
        ACTUAL SUBMISSION
        --------------------------------------------- */

        HTMLFormElement.prototype.submit.call(form);

    });


    /* =====================================================
       FILE INPUT DISPLAY
    ===================================================== */

    try {
        initFileInputs();
    } catch (error) {
        console.error('initFileInputs failed:', error);
    }


    /* =====================================================
       DRAG AND DROP
    ===================================================== */

    try {
        initDragAndDrop();
    } catch (error) {
        console.error('initDragAndDrop failed:', error);
    }


    /* =====================================================
       DECLARATION MODAL
    ===================================================== */

    try {
        initDeclarationModal();
    } catch (error) {
        console.error(
            'initDeclarationModal failed:',
            error
        );
    }


    /* =====================================================
       CONTRACT MODAL
    ===================================================== */

    try {
        initContractModal();
    } catch (error) {
        console.error(
            'initContractModal failed:',
            error
        );
    }

    /* =====================================================
       STEP NAVIGATION
    ===================================================== */

    try {
        initStepNavigation();
    } catch (error) {
        console.error(
            'initStepNavigation failed:',
            error
        );
    }


    /* =====================================================
       INITIAL STEP
    ===================================================== */

    showStep(1);

});


/* =========================================================
   STEP NAVIGATION
========================================================= */

function showStep(step) {

    if (step < 1 || step > totalSteps) {
        return;
    }


    currentStep = step;


    /* =====================================================
       FORM STEPS
    ===================================================== */

    document
        .querySelectorAll('.form-step')
        .forEach((element) => {

            element.classList.remove('active');

        });


    const selectedStep =
        document.querySelector(
            `.form-step[data-step="${step}"]`
        );


    if (selectedStep) {
        selectedStep.classList.add('active');
    }


    /* =====================================================
       PROGRESS
    ===================================================== */

    document
        .querySelectorAll('.step-item')
        .forEach((item) => {

            const itemStep =
                parseInt(item.dataset.step, 10);


            item.classList.remove(
                'active',
                'completed'
            );


            if (itemStep === step) {

                item.classList.add('active');

            } else if (itemStep < step) {

                item.classList.add('completed');

            }

        });


    /* =====================================================
       CURRENT STEP NUMBER
    ===================================================== */

    const currentStepNumber =
        document.getElementById(
            'currentStepNumber'
        );


    if (currentStepNumber) {

        currentStepNumber.textContent = step;

    }


    /* =====================================================
       BACK BUTTON
    ===================================================== */

    const backBtn =
        document.getElementById('backBtn');


    if (backBtn) {

        backBtn.style.visibility =
            step === 1
                ? 'hidden'
                : 'visible';

    }


    /* =====================================================
       NEXT / SUBMIT BUTTON
    ===================================================== */

    const nextBtn =
        document.getElementById('nextBtn');

    const submitBtn =
        document.getElementById('submitBtn');


    if (step === totalSteps) {

        if (nextBtn) {
            nextBtn.style.display = 'none';
        }

        if (submitBtn) {
            submitBtn.style.display = 'inline-flex';
        }

        updateReview();

    } else {

        if (nextBtn) {
            nextBtn.style.display = 'inline-flex';
        }

        if (submitBtn) {
            submitBtn.style.display = 'none';
        }

    }


    /* =====================================================
       SCROLL
    ===================================================== */

    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });


    /* =====================================================
       REFRESH LEAFLET SIZE
    ===================================================== */

    /*
     * The map is normally on step 7.
     *
     * Leaflet needs invalidateSize() when a map
     * becomes visible after being hidden.
     */

    if (
        step === 7 &&
        residentialMap
    ) {

        setTimeout(() => {

            try {
                residentialMap.invalidateSize();
            } catch (error) {
                console.warn(
                    'Unable to refresh map size:',
                    error
                );
            }

        }, 300);

    }

}


/* =========================================================
   NEXT STEP
========================================================= */

function nextStep() {

    console.log(
        'nextStep() called. Current step:',
        currentStep
    );

    if (!validateCurrentStep()) {
        return;
    }


    if (currentStep < totalSteps) {

        showStep(
            currentStep + 1
        );

    }

}


/* =========================================================
   PREVIOUS STEP
========================================================= */

function previousStep() {

    if (currentStep > 1) {

        showStep(
            currentStep - 1
        );

    }

}


/* =========================================================
   GO TO STEP
========================================================= */

function goToStep(step) {

    const targetStep =
        parseInt(step, 10);


    if (
        Number.isNaN(targetStep)
    ) {
        return;
    }

    if (targetStep <= currentStep) {

        showStep(targetStep);

    }

}


/* =========================================================
   VALIDATE CURRENT STEP
========================================================= */

function validateCurrentStep() {

    const current =
        document.querySelector(
            `.form-step[data-step="${currentStep}"]`
        );


    if (!current) {
        return true;
    }


    const requiredFields =
        current.querySelectorAll(
            'input[required], select[required], textarea[required]'
        );


    for (const field of requiredFields) {

        if (!field.checkValidity()) {

            field.reportValidity();

            field.focus();

            return false;

        }

    }


    return true;

}


/* =========================================================
   INDUSTRY - OTHER
========================================================= */

function toggleOtherIndustry(select) {

    const box =
        document.getElementById(
            'otherIndustryBox'
        );


    if (!box || !select) {
        return;
    }


    if (select.value === 'Others') {

        box.style.display = 'flex';

    } else {

        box.style.display = 'none';

    }

}


/* =========================================================
   GET FORM VALUE
========================================================= */

function getValue(name) {

    const field =
        document.querySelector(
            `[name="${name}"]`
        );


    return field
        ? field.value
        : '';

}


/* =========================================================
   REVIEW
========================================================= */

function updateReview() {

    /* ---------------------------------------------
       BRANCH
    --------------------------------------------- */

    setReviewText(
        'reviewBranch',
        getValue('branch') || '-'
    );


    /* ---------------------------------------------
       PLAN
    --------------------------------------------- */

    const selectedPlan =
        document.querySelector(
            'input[name="monthly_subscription"]:checked'
        );


    setReviewText(
        'reviewPlan',
        selectedPlan
            ? selectedPlan.value
            : '-'
    );


    /* ---------------------------------------------
       PERSONAL
    --------------------------------------------- */

    const fullName = [

        getValue('salutation'),
        getValue('first_name'),
        getValue('middle_name'),
        getValue('last_name')

    ]
        .filter(Boolean)
        .join(' ');


    setReviewText(
        'reviewName',
        fullName || '-'
    );


    setReviewText(
        'reviewGender',
        getValue('gender') || '-'
    );


    setReviewText(
        'reviewBirthday',
        getValue('birthday') || '-'
    );


    setReviewText(
        'reviewCivilStatus',
        getValue('civil_status') || '-'
    );


    setReviewText(
        'reviewCitizenship',
        getValue('citizenship') || '-'
    );


    setReviewText(
        'reviewMobile',
        getValue('mobile_no') || '-'
    );


    setReviewText(
        'reviewEmail',
        getValue('email') || '-'
    );


    /* ---------------------------------------------
       ADDRESS
    --------------------------------------------- */

    const address = [

        getValue('street'),
        getValue('barangay'),
        getValue('city'),
        getValue('zip')

    ]
        .filter(Boolean)
        .join(', ');


    setReviewText(
        'reviewAddress',
        address || '-'
    );


    setReviewText(
        'reviewOwnership',
        getValue('home_ownership') || '-'
    );


    setReviewText(
        'reviewStay',
        getValue('years_of_stay') || '-'
    );


    /* ---------------------------------------------
       EMPLOYMENT
    --------------------------------------------- */

    let industry =
        getValue('industry');


    if (industry === 'Others') {

        industry =
            getValue('industry_other');

    }


    setReviewText(
        'reviewIndustry',
        industry || '-'
    );


    setReviewText(
        'reviewPosition',
        getValue('position') || '-'
    );


    setReviewText(
        'reviewIncome',
        getValue('monthly_income') || '-'
    );


    setReviewText(
        'reviewOfficeTel',
        getValue('office_tel') || '-'
    );


    /* ---------------------------------------------
       AUTHORIZED CONTACT
    --------------------------------------------- */

    const authName = [

        getValue('auth_first'),
        getValue('auth_middle'),
        getValue('auth_last')

    ]
        .filter(Boolean)
        .join(' ');


    setReviewText(
        'reviewAuthName',
        authName || '-'
    );


    setReviewText(
        'reviewAuthRelation',
        getValue('auth_relation') || '-'
    );


    setReviewText(
        'reviewAuthContact',
        getValue('auth_contact') || '-'
    );


    /* ---------------------------------------------
       FILES
    --------------------------------------------- */

    updateFileReview(
        'valid_id',
        'reviewValidId'
    );


    updateFileReview(
        'proof_billing',
        'reviewBilling'
    );


    updateFileReview(
        'other_attachment',
        'reviewOther'
    );


    /* ---------------------------------------------
       LOCATION
    --------------------------------------------- */

    const lat =
        getValue('latitude');

    const lng =
        getValue('longitude');


    if (lat && lng) {

        setReviewText(
            'reviewCoordinates',
            `${lat}, ${lng}`
        );

    } else {

        setReviewText(
            'reviewCoordinates',
            'Not selected'
        );

    }

}


/* =========================================================
   REVIEW HELPER
========================================================= */

function setReviewText(id, value) {

    const element =
        document.getElementById(id);


    if (element) {

        element.textContent = value;

    }

}


/* =========================================================
   FILE REVIEW
========================================================= */

function updateFileReview(
    inputName,
    reviewId
) {

    const input =
        document.querySelector(
            `input[name="${inputName}"]`
        );


    const output =
        document.getElementById(
            reviewId
        );


    if (!output) {
        return;
    }


    if (
        input &&
        input.files &&
        input.files.length > 0
    ) {

        output.textContent =
            input.files[0].name;

    } else {

        output.textContent =
            'Not uploaded';

    }

}


/* =========================================================
   FILE INPUTS
========================================================= */

function initFileInputs() {

    document
        .querySelectorAll('.file-input')
        .forEach((input) => {

            input.addEventListener(
                'change',
                function () {

                    const box =
                        this.closest('.upload-box');


                    if (!box) {
                        return;
                    }


                    const fileName =
                        box.querySelector(
                            '.file-name'
                        );


                    if (
                        this.files &&
                        this.files.length > 0
                    ) {

                        if (fileName) {

                            fileName.textContent =
                                this.files[0].name;

                        }

                        box.classList.add(
                            'has-file'
                        );

                    } else {

                        if (fileName) {

                            fileName.textContent =
                                '';

                        }

                        box.classList.remove(
                            'has-file'
                        );

                    }

                }
            );

        });

}


/* =========================================================
   DRAG AND DROP
========================================================= */

function initDragAndDrop() {

    document
        .querySelectorAll('.upload-box')
        .forEach((box) => {

            box.addEventListener(
                'dragover',
                (event) => {

                    event.preventDefault();

                    box.classList.add(
                        'dragging'
                    );

                }
            );


            box.addEventListener(
                'dragleave',
                () => {

                    box.classList.remove(
                        'dragging'
                    );

                }
            );


            box.addEventListener(
                'drop',
                (event) => {

                    event.preventDefault();

                    box.classList.remove(
                        'dragging'
                    );


                    const input =
                        box.querySelector(
                            '.file-input'
                        );


                    if (
                        input &&
                        event.dataTransfer.files.length
                    ) {

                        try {

                            input.files =
                                event.dataTransfer.files;

                            input.dispatchEvent(
                                new Event(
                                    'change',
                                    {
                                        bubbles: true
                                    }
                                )
                            );

                        } catch (error) {

                            console.error(
                                'Unable to assign dropped files:',
                                error
                            );

                        }

                    }

                }
            );

        });

}


/* =========================================================
   DECLARATION MODAL
========================================================= */

function initDeclarationModal() {

    const modal =
        document.getElementById(
            'declarationModal'
        );


    if (!modal) {
        return;
    }


    document
        .querySelectorAll('[data-open-declaration]')
        .forEach((button) => {

            button.addEventListener(
                'click',
                () => {

                    modal.classList.add(
                        'active'
                    );

                    document.body.classList.add(
                        'modal-open'
                    );

                }
            );

        });


    document
        .querySelectorAll('[data-close-declaration]')
        .forEach((button) => {

            button.addEventListener(
                'click',
                () => {

                    modal.classList.remove(
                        'active'
                    );

                    document.body.classList.remove(
                        'modal-open'
                    );

                }
            );

        });

}


/* =========================================================
   CONTRACT MODAL
========================================================= */

function initContractModal() {

    const modal =
        document.getElementById(
            'contractModal'
        );


    if (!modal) {
        return;
    }


    document
        .querySelectorAll('[data-open-contract]')
        .forEach((button) => {

            button.addEventListener(
                'click',
                () => {

                    modal.classList.add(
                        'active'
                    );

                    document.body.classList.add(
                        'modal-open'
                    );


                    updateContractPreview();

                }
            );

        });


    document
        .querySelectorAll('[data-close-contract]')
        .forEach((button) => {

            button.addEventListener(
                'click',
                () => {

                    modal.classList.remove(
                        'active'
                    );

                    document.body.classList.remove(
                        'modal-open'
                    );

                }
            );

        });

}


/* =========================================================
   CONTRACT PREVIEW
========================================================= */

function updateContractPreview() {

    const first =
        getValue('first_name');

    const middle =
        getValue('middle_name');

    const last =
        getValue('last_name');


    const fullName = [

        first,
        middle,
        last

    ]
        .filter(Boolean)
        .join(' ');


    setReviewText(
        'contract_name',
        fullName || '________________'
    );


    /* ---------------------------------------------
       ADDRESS
    --------------------------------------------- */

    const address = [

        getValue('street'),
        getValue('barangay'),
        getValue('city'),
        getValue('zip')

    ]
        .filter(Boolean)
        .join(', ');


    setReviewText(
        'contract_address',
        address || '________________'
    );


    /* ---------------------------------------------
       BRANCH
    --------------------------------------------- */

    setReviewText(
        'contract_branch',
        getValue('branch') || '__________'
    );


    /* ---------------------------------------------
       SIGNATURE NAME
    --------------------------------------------- */

    setReviewText(
        'contract_signature_name',
        fullName || '___________________________'
    );


    /* ---------------------------------------------
       CONTRACT DATE
    --------------------------------------------- */

    const date =
        new Date();


    setReviewText(
        'contract_day',
        date.getDate()
    );


    setReviewText(
        'contract_month',
        date.toLocaleString(
            'en-US',
            {
                month: 'long'
            }
        )
    );


    setReviewText(
        'contract_year',
        date.getFullYear()
    );

}


/* =========================================================
   STEP NAVIGATION EVENTS
========================================================= */

function initStepNavigation() {

    document
        .querySelectorAll('.step-item')
        .forEach((item) => {

            item.addEventListener(
                'click',
                function () {

                    const step =
                        parseInt(
                            this.dataset.step,
                            10
                        );


                    if (
                        Number.isNaN(step)
                    ) {
                        return;
                    }

                    if (
                        step <= currentStep
                    ) {

                        showStep(step);

                    }

                }
            );

        });

}


console.log('🔥 ABOUT TO CREATE GLOBAL FUNCTIONS');

window.nextStep = nextStep;
window.previousStep = previousStep;
window.goToStep = goToStep;
window.toggleOtherIndustry = toggleOtherIndustry;
window.updateReview = updateReview;

console.log(
    'Residential inquiry functions registered:',
    {
        nextStep: typeof window.nextStep,
        previousStep: typeof window.previousStep,
        goToStep: typeof window.goToStep
    }
);