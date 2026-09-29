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




let currentStep = 1;
const totalSteps = 8;

let residentialMap = null;




document.addEventListener('DOMContentLoaded', () => {

    console.log('Residential JS Loaded');




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




    const form = document.getElementById('residentialForm');

    if (!form) {
        console.warn('Residential form not found.');
        return;
    }

    const submitBtn =
    document.getElementById('submitBtn');

    let isSubmitting = false;




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


        

        event.preventDefault();

        const mapInput =
            document.getElementById('mapImage');

        if (mapInput) {
            mapInput.value = '';
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

    });




    try {
        initFileInputs();
    } catch (error) {
        console.error('initFileInputs failed:', error);
    }




    try {
        initDragAndDrop();
    } catch (error) {
        console.error('initDragAndDrop failed:', error);
    }




    try {
        initDeclarationModal();
    } catch (error) {
        console.error(
            'initDeclarationModal failed:',
            error
        );
    }




    try {
        initContractModal();
    } catch (error) {
        console.error(
            'initContractModal failed:',
            error
        );
    }



    try {
        initStepNavigation();
    } catch (error) {
        console.error(
            'initStepNavigation failed:',
            error
        );
    }




    showStep(1);

});





function showStep(step) {

    if (step < 1 || step > totalSteps) {
        return;
    }


    currentStep = step;




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




    const currentStepNumber =
        document.getElementById(
            'currentStepNumber'
        );


    if (currentStepNumber) {

        currentStepNumber.textContent = step;

    }




    const backBtn =
        document.getElementById('backBtn');


    if (backBtn) {

        backBtn.style.visibility =
            step === 1
                ? 'hidden'
                : 'visible';

    }




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




    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });




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




function previousStep() {

    if (currentStep > 1) {

        showStep(
            currentStep - 1
        );

    }

}




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




function getValue(name) {

    const field =
        document.querySelector(
            `[name="${name}"]`
        );


    return field
        ? field.value
        : '';

}




function updateReview() {



    setReviewText(
        'reviewBranch',
        getValue('branch') || '-'
    );




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




function setReviewText(id, value) {

    const element =
        document.getElementById(id);


    if (element) {

        element.textContent = value;

    }

}




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




    setReviewText(
        'contract_branch',
        getValue('branch') || '__________'
    );




    setReviewText(
        'contract_signature_name',
        fullName || '___________________________'
    );




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