import {
    initSignaturePad,
    initSignatureModal
} from '../components/signature';

import {
    initMap,
    getUserLocation,
    refreshMap
} from '../components/map.js';

import {
    initModals
} from '../components/modal';


import {
    initUploads
} from '../components/upload';

import {
    initFormValidation
} from '../components/form';


/* =========================================================
   INITIALIZATION
========================================================= */

document.addEventListener('DOMContentLoaded', () => {

    console.log('Filbiz JS Loaded');

    /* ================= COMPONENTS ================= */

    initUploads();
    initFormValidation();
    initSignaturePad();
    initSignatureModal();
    initModals();


    /* ================= FORM ================= */

    const form =
        document.getElementById('filbizForm');

    if (!form) {
        console.error('Filbiz form not found.');
        return;
    }


    /* =====================================================
       FORM SETTINGS
    ===================================================== */

    let currentStep = 1;

    const totalSteps = 7;

    let isSubmitting = false;


    /* =====================================================
       ELEMENTS
    ===================================================== */

    const nextBtn =
        document.getElementById('nextBtn');

    const prevBtn =
        document.getElementById('prevBtn');

    const submitBtn =
        document.getElementById('submitBtn');

    const currentStepText =
        document.getElementById('currentStepText');


    /* =====================================================
       MAP
    ===================================================== */

    const map = initMap();

    let mapInstance = map;


    /* =====================================================
       GPS BUTTON
    ===================================================== */

    document
        .querySelectorAll('[data-get-location]')
        .forEach(button => {

            button.addEventListener('click', () => {

                if (!mapInstance) {
                    return;
                }

                getUserLocation();

            });

        });


    /* =====================================================
       STEP NAVIGATION
    ===================================================== */

    function showStep(step) {

        step = parseInt(step, 10);

        if (
            isNaN(step) ||
            step < 1 ||
            step > totalSteps
        ) {
            return;
        }


        currentStep = step;


        /* ================= FORM STEPS ================= */

        document
            .querySelectorAll('.form-step')
            .forEach(element => {

                element.classList.remove('active');

            });


        const selectedStep =
            document.querySelector(
                `.form-step[data-step="${step}"]`
            );


        if (selectedStep) {

            selectedStep.classList.add('active');

        }


        /* ================= STEP INDICATORS ================= */

        document
            .querySelectorAll('.step-item')
            .forEach(item => {

                const itemStep =
                    parseInt(
                        item.dataset.step,
                        10
                    );


                item.classList.remove(
                    'active',
                    'completed'
                );


                if (itemStep === step) {

                    item.classList.add('active');

                }
                else if (itemStep < step) {

                    item.classList.add('completed');

                }

            });


        /* ================= CURRENT STEP ================= */

        if (currentStepText) {

            currentStepText.textContent =
                step;

        }


        /* ================= PREVIOUS BUTTON ================= */

        if (prevBtn) {

            prevBtn.style.display =
                step === 1
                    ? 'none'
                    : 'inline-flex';

        }


        /* ================= NEXT / SUBMIT ================= */

        if (nextBtn) {

            nextBtn.style.display =
                step === totalSteps
                    ? 'none'
                    : 'inline-flex';

        }


        if (submitBtn) {

            submitBtn.style.display =
                step === totalSteps
                    ? 'inline-flex'
                    : 'none';

        }


        /* ================= REVIEW ================= */

        if (step === totalSteps) {

            updateReview();

        }


        /* ================= MAP ================= */

        if (step === 6) {

    setTimeout(() => {

        if (mapInstance) {

            mapInstance.invalidateSize(true);

            // Force Leaflet to redraw after becoming visible
            mapInstance.eachLayer(layer => {
                if (layer.redraw) {
                    layer.redraw();
                }
            });

        }

    }, 500);

}


        /* ================= SCROLL ================= */

        window.scrollTo({

            top: 0,

            behavior: 'smooth'

        });

    }


    /* =====================================================
       NEXT STEP
    ===================================================== */

    function nextStep() {

        if (!validateCurrentStep()) {
            return;
        }


        if (currentStep < totalSteps) {

            showStep(
                currentStep + 1
            );

        }

    }


    /* =====================================================
       PREVIOUS STEP
    ===================================================== */

    function previousStep() {

        if (currentStep > 1) {

            showStep(
                currentStep - 1
            );

        }

    }


    /* =====================================================
       DIRECT STEP
    ===================================================== */

    function goToStep(step) {

        step = parseInt(step, 10);

        if (
            isNaN(step) ||
            step < 1 ||
            step > totalSteps
        ) {
            return;
        }


        /*
         * Only allow going backward
         * or returning to current step.
         */
        if (step <= currentStep) {

            showStep(step);

        }

    }


    /* =====================================================
       EXPOSE NAVIGATION FOR BLADE / HTML
    ===================================================== */

    window.nextStep =
        nextStep;

    window.previousStep =
        previousStep;

    window.goToStep =
        goToStep;

    window.updateReview =
        updateReview;


    /* =====================================================
       VALIDATE CURRENT STEP
    ===================================================== */

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

            if (
                field.disabled ||
                field.type === 'hidden'
            ) {
                continue;
            }


            if (!field.checkValidity()) {

                field.reportValidity();

                field.focus();

                return false;

            }

        }


        /* ================= BUSINESS LOCATION ================= */

        if (currentStep === 6) {

            const latitude =
                getValue('latitude');

            const longitude =
                getValue('longitude');


            if (
                !latitude ||
                !longitude
            ) {

                alert(
                    'Please mark your business location on the map.'
                );

                return false;

            }

        }


        return true;

    }


    /* =====================================================
       STEP CLICK NAVIGATION
    ===================================================== */

    document
        .querySelectorAll('.step-item')
        .forEach(item => {

            item.addEventListener(
                'click',
                () => {

                    const step =
                        parseInt(
                            item.dataset.step,
                            10
                        );


                    if (step <= currentStep) {

                        showStep(step);

                    }

                }
            );

        });


    /* =====================================================
       GET VALUE
    ===================================================== */

    function getValue(name) {

        const byName =
            document.querySelector(
                `[name="${name}"]`
            );


        if (byName) {

            return (
                byName.value || ''
            ).trim();

        }


        const byId =
            document.getElementById(name);


        return byId
            ? (
                byId.value || ''
            ).trim()
            : '';

    }


    /* =====================================================
       SET REVIEW TEXT
    ===================================================== */

    function setReviewText(id, value) {

        const element =
            document.getElementById(id);


        if (element) {

            element.textContent =
                value || '-';

        }

    }


    /* =====================================================
       PLAN SELECTION
    ===================================================== */

    const planInputs =
        document.querySelectorAll(
            'input[name="monthly_subscription"]'
        );


    const selectedPlanBox =
        document.getElementById(
            'selectedPlanBox'
        );


    planInputs.forEach(input => {

        input.addEventListener(
            'change',
            () => {

                const card =
                    input.closest(
                        '.plan-card'
                    );


                if (!card) {
                    return;
                }


                const planName =
                    card.querySelector(
                        'h3'
                    )?.textContent.trim()
                    || '';


                const speed =
                    card.querySelector(
                        '.speed'
                    )?.textContent.trim()
                    || '';


                const price =
                    card.querySelector(
                        '.price'
                    )?.textContent.trim()
                    || '';


                if (selectedPlanBox) {

                    selectedPlanBox.innerHTML = `
                        <i class="fas fa-check-circle"></i>

                        <span>
                            Selected:
                            <strong>${planName}</strong>
                            -
                            ${speed}
                            -
                            ${price}
                        </span>
                    `;

                }

            }
        );

    });


    /* =====================================================
       REVIEW
    ===================================================== */

    function updateReview() {

        /* ================= BRANCH ================= */

        const branch =
            getValue('branch');


        const branchSelect =
            document.querySelector(
                '[name="branch"]'
            ) ||
            document.getElementById('branch');


        const branchText =
            branchSelect?.options[
                branchSelect.selectedIndex
            ]?.textContent.trim()
            || '-';


        setReviewText(
            'reviewBranch',
            branch
                ? branchText
                : '-'
        );


        /* ================= PLAN ================= */

        const selectedPlan =
            document.querySelector(
                'input[name="monthly_subscription"]:checked'
            );


        let planText = '-';


        if (selectedPlan) {

            const card =
                selectedPlan.closest(
                    '.plan-card'
                );


            if (card) {

                const planName =
                    card.querySelector(
                        'h3'
                    )?.textContent.trim()
                    || '';


                const speed =
                    card.querySelector(
                        '.speed'
                    )?.textContent.trim()
                    || '';


                const price =
                    card.querySelector(
                        '.price'
                    )?.textContent.trim()
                    || '';


                planText =
                    [
                        planName,
                        speed,
                        price
                    ]
                        .filter(Boolean)
                        .join(' - ');

            }

        }


        setReviewText(
            'reviewPlan',
            planText
        );


        /* ================= BUSINESS ================= */

        setReviewText(
            'reviewCompany',
            getValue('companyname')
        );


        setReviewText(
            'reviewNature',
            getValue('natureofbusiness')
        );


        setReviewText(
            'reviewBusinessAddress',
            getValue('businessaddress')
        );


        /* ================= PERSONAL ================= */

        const fullName = [

            getValue('first_name'),

            getValue('middle_name'),

            getValue('last_name')

        ]
            .filter(Boolean)
            .join(' ');


        setReviewText(
            'reviewName',
            fullName
        );


        setReviewText(
            'reviewPosition',
            getValue('position')
        );


        setReviewText(
            'reviewMobile',
            getValue('mobile_no')
        );


        setReviewText(
            'reviewEmail',
            getValue('email')
        );


        setReviewText(
            'reviewLandline',
            getValue('landline')
        );


        setReviewText(
            'reviewContactPerson',
            getValue('contact_person')
        );


        /* ================= LOCATION ================= */

        const latitude =
            getValue('latitude');

        const longitude =
            getValue('longitude');


        setReviewText(
            'reviewLatitude',
            latitude || 'Not selected'
        );


        setReviewText(
            'reviewLongitude',
            longitude || 'Not selected'
        );


        /* ================= FILES ================= */

        updateReviewFile(
            'business_permit',
            'reviewBusinessPermit'
        );


        updateReviewFile(
            'dti_sec',
            'reviewDti'
        );


        updateReviewFile(
            'bir_form',
            'reviewBir'
        );


        updateReviewFile(
            'valid_id',
            'reviewValidId'
        );

    }


    /* =====================================================
       REVIEW FILE
    ===================================================== */

    function updateReviewFile(
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

        }
        else {

            output.textContent =
                'Not uploaded';

        }

    }


    /* =====================================================
       FILE UPLOAD DISPLAY
    ===================================================== */

    document
        .querySelectorAll('.file-input')
        .forEach(input => {

            input.addEventListener(
                'change',
                function () {

                    const box =
                        this.closest(
                            '.upload-box'
                        );


                    if (!box) {
                        return;
                    }


                    const fileName =
                        box.querySelector(
                            '.file-name'
                        );


                    if (!fileName) {
                        return;
                    }


                    if (
                        this.files &&
                        this.files.length > 0
                    ) {

                        fileName.textContent =
                            this.files[0].name;

                        box.classList.add(
                            'has-file'
                        );

                    }
                    else {

                        fileName.textContent =
                            'No file chosen';

                        box.classList.remove(
                            'has-file'
                        );

                    }

                }
            );

        });


    /* =====================================================
       DRAG AND DROP
    ===================================================== */

    document
        .querySelectorAll('.upload-box')
        .forEach(box => {

            box.addEventListener(
                'dragover',
                event => {

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
                event => {

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

                    }

                }
            );

        });


    /* =====================================================
       DECLARATION MODAL
    ===================================================== */

    const declarationModal =
        document.getElementById(
            'declarationModal'
        );


    document
        .querySelectorAll(
            '[data-open-declaration]'
        )
        .forEach(button => {

            button.addEventListener(
                'click',
                () => {

                    if (!declarationModal) {
                        return;
                    }


                    declarationModal.classList.add(
                        'active'
                    );

                    document.body.classList.add(
                        'modal-open'
                    );

                }
            );

        });


    document
        .querySelectorAll(
            '[data-close-declaration]'
        )
        .forEach(button => {

            button.addEventListener(
                'click',
                () => {

                    if (!declarationModal) {
                        return;
                    }


                    declarationModal.classList.remove(
                        'active'
                    );

                    document.body.classList.remove(
                        'modal-open'
                    );

                }
            );

        });


    /* =====================================================
       CONTRACT MODAL
    ===================================================== */

    const contractModal =
        document.getElementById(
            'contractModal'
        );


    document
        .querySelectorAll(
            '[data-open-contract]'
        )
        .forEach(button => {

            button.addEventListener(
                'click',
                () => {

                    updateContractPreview();


                    if (!contractModal) {
                        return;
                    }


                    contractModal.classList.add(
                        'active'
                    );

                    document.body.classList.add(
                        'modal-open'
                    );

                }
            );

        });


    document
        .querySelectorAll(
            '[data-close-contract]'
        )
        .forEach(button => {

            button.addEventListener(
                'click',
                () => {

                    if (!contractModal) {
                        return;
                    }


                    contractModal.classList.remove(
                        'active'
                    );

                    document.body.classList.remove(
                        'modal-open'
                    );

                }
            );

        });


    /* =====================================================
       CONTRACT PREVIEW
    ===================================================== */

    function updateContractPreview() {

        const fullName = [

            getValue('first_name'),

            getValue('middle_name'),

            getValue('last_name')

        ]
            .filter(Boolean)
            .join(' ');


        const address =
            getValue('businessaddress');


        setReviewText(
            'contract_name',
            fullName || '________________'
        );


        setReviewText(
            'contract_address',
            address || '________________'
        );


        setReviewText(
            'contract_branch',
            getValue('branch') || '__________'
        );


        setReviewText(
            'contract_signature_name',
            fullName ||
            '___________________________'
        );


        /* ================= DATE ================= */

        const date =
            new Date();


        const contractDay =
            document.getElementById(
                'contract_day'
            );


        const contractMonth =
            document.getElementById(
                'contract_month'
            );


        const contractYear =
            document.getElementById(
                'contract_year'
            );


        if (contractDay) {

            contractDay.textContent =
                date.getDate();

        }


        if (contractMonth) {

            contractMonth.textContent =
                date.toLocaleString(
                    'en-US',
                    {
                        month: 'long'
                    }
                );

        }


        if (contractYear) {

            contractYear.textContent =
                date.getFullYear();

        }


        /* ================= SIGNATURE ================= */

        const signature =
            getValue(
                'digitalSignatureInput'
            );


        const signatureImage =
            document.getElementById(
                'contract_signature_img'
            );


        if (
            signature &&
            signatureImage
        ) {

            signatureImage.src =
                signature;

            signatureImage.style.display =
                'block';

        }

    }


    /* =====================================================
       AGREEMENT / SUBMIT VALIDATION
    ===================================================== */

    form.addEventListener(
        'submit',
        async event => {

            if (isSubmitting) {
            event.preventDefault();
            return;
        }
            if (currentStep !== totalSteps) {

                event.preventDefault();

                return;

            }


            /* ================= FORM VALIDATION ================= */

            if (!form.checkValidity()) {

                event.preventDefault();

                form.reportValidity();

                return;

            }


            /* ================= DECLARATION ================= */

            const declaration =
                document.getElementById(
                    'declarationCheck'
                );


            if (
                declaration &&
                !declaration.checked
            ) {

                event.preventDefault();

                alert(
                    "Please read and agree to the Subscriber's Declaration."
                );

                return;

            }


            /* ================= CONTRACT ================= */

            const contract =
                document.getElementById(
                    'contractCheck'
                );


            if (
                contract &&
                !contract.checked
            ) {

                event.preventDefault();

                alert(
                    'Please agree to the Terms & Contract Agreement.'
                );

                return;

            }


            /* ================= SIGNATURE ================= */

            const signature =
                getValue(
                    'digitalSignatureInput'
                );


            if (!signature) {

                event.preventDefault();

                alert(
                    'Please add your digital signature before submitting.'
                );

                return;

            }


            /* ================= LOCATION ================= */

            const latitude =
                getValue('latitude');

            const longitude =
                getValue('longitude');


            if (
                !latitude ||
                !longitude
            ) {

                event.preventDefault();

                alert(
                    'Please mark your business location on the map.'
                );

                goToStep(6);

                return;

            }


/* ================= CAPTURE MAP ================= */

if (mapInstance) {

    event.preventDefault();

    try {

        /* ---------------------------------------------
           MAKE SURE LEAFLET HAS THE CORRECT SIZE
        --------------------------------------------- */

        mapInstance.invalidateSize(true);


        /* ---------------------------------------------
           WAIT FOR MAP TO RENDER
        --------------------------------------------- */

        await new Promise(resolve =>
            setTimeout(resolve, 500)
        );


            /* ---------------------------------------------
            CAPTURE MAP
            --------------------------------------------- */

        const mapInput =
            document.getElementById(
                'mapImage'
            );

        if (mapInput) {
            mapInput.value = '';
        }

        submitForm();

        }
        catch (error) {

            console.error(
                'Map capture failed:',
                error
            );

            alert(
                'Unable to capture the map. Please try again.'
            );

        }

    }

        }
    );


    /* =====================================================
       SUBMIT FORM
    ===================================================== */

        function submitForm() {

            if (isSubmitting) {
                return;
            }

            isSubmitting = true;

            if (submitBtn) {

                submitBtn.disabled = true;

                submitBtn.innerHTML = `
                    <i class="fas fa-spinner fa-spin"></i>
                    Submitting...
                `;
            }

            HTMLFormElement.prototype.submit.call(form);
        }


    /* =====================================================
       MAP RESIZE
    ===================================================== */

    window.addEventListener(
        'resize',
        () => {

            if (
                mapInstance &&
                currentStep === 6
            ) {

                setTimeout(() => {

                    mapInstance.invalidateSize();

                }, 100);

            }

        }
    );


    /* =====================================================
       INITIALIZE
    ===================================================== */

    showStep(1);


    console.log(
        'Filbiz application form initialized successfully.'
    );

});